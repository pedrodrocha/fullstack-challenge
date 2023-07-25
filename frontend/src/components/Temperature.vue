<template>
    <div class="flex flex-col w-full h-full">

        <div class="flex flex-col items-center gap-2 mb-8">
            <p class="text-gray-900 font-medium font-medium font-sans">
                Current Temperature
            </p>

            <div v-if="!weather" class="bg-slate-400 h-10 w-24 animate-pulse">
            </div>

            <div v-if="weather">
                <div v-if="weather.temp">
                    <p class="font-serif font-bold text-4xl text-gray-700">
                        <code>{{ Math.round(weather.temp) }}</code> ºC
                    </p>
                </div>
            </div>

        </div>

        <div class="flex flex-row flex-nowrap justify-between w-full px-2 mb-4">
            <button v-if="weather" @click="updateWeather" type="button" class="flex flex-row flex-nowrap items-center justify-center gap-2">
                <div class="h-3 w-3"><RefreshIcon/></div>
                <p class="text-sky-900 font-bold text-sm">
                    Refresh
                </p>                        
            </button>

            <button v-if="weather" type="button" @click="$emit('openDetails', weather)">
                <p class="text-sky-900 font-bold text-sm">
                    More Details
                </p>
            </button>

            <div v-if="!weather" class="bg-slate-400 h-6 w-20 animate-pulse"></div>
            <div v-if="!weather" class="bg-slate-400 h-6 w-20 animate-pulse"></div>
        </div>

        <div>

            <div v-if="!weather" class="bg-slate-400 h-3 w-24 animate-pulse">
            </div>

            <p v-if="weather" class="font-serif font-light text-slate-400  text-xs self-start justify-self-start">
                
                Last Updated: <span v-text="lastUpdate()"> </span> min ago
            </p>
        </div>
    </div>
</template>

<script lang="ts">
    import RefreshIcon from '@/components/icons/RefreshIcon.vue';
    import { getUserWeather } from '@/helpers/api-requests';


    import { defineComponent } from 'vue'


    interface WeatherData {
        temp?: number;
    }


    export default defineComponent({
        data: () => ({
            weather: null as WeatherData | null,
            lastRetrieved: false as string | boolean,    

        }),
        props: {
            id: {
                type: Number,
                required: true,
            },
        },
        components: {
            RefreshIcon,
        },
        created(): void {
            this.fetchData(false)
        },
        methods: {
            async fetchData(refresh_data: boolean): Promise<void> {
                try {
                    let response = await getUserWeather(this.id, refresh_data)

                    if (response.status === 200 && response.data.success) {
                        this.weather = response.data.data

                        this.lastRetrieved = response.data.last_retrieved;
                    } else {
                        this.weather = null;
                    }
                
                } catch (error) {
                    console.log(error)
                    this.weather = null;
                }
            },
            async updateWeather(): Promise<void> {
                this.weather = null
                await this.fetchData(true)
            },
            lastUpdate(): Number {
                // @ts-ignore 
                const lastDate = new Date(this.lastRetrieved)
                return this.minutesFromNow(lastDate)
            },
            minutesFromNow(date: Date): Number {
                let now = new Date();
                return Math.round((now.getTime() - date.getTime()) / 60000)
            }
        }
        
    })
</script>