<script lang="ts">
import RefreshIcon from '@/components/icons/RefreshIcon.vue';
import { getUserWeather } from '@/helpers/api-requests';


import { defineComponent } from 'vue'

export default defineComponent({
    data: () => ({
        Weather: null
    }),
    props: {
        id: Number
    },
    components: {
        RefreshIcon,
    },
    created() {
        this.fetchData(false)
    },
    methods: {
        async fetchData(refresh: boolean) {
            const url = 'http://localhost/users/weather/' + this.id
            this.Weather = await getUserWeather(url, refresh)
        },
        lastUpdate(last: Date) {
            let now = new Date();

            return Math.round((now.getTime() - last.getTime()) / 60000)
        },
        async updateWeather() {
            this.Weather = null
            await this.fetchData(true)
        },
    }
    
})
</script>

<template>
    <div class="flex flex-col w-full h-full">

        <div class="flex flex-col items-center gap-2 mb-8">
            <p class="text-gray-900 font-medium font-medium font-sans">
                Current Temperature
            </p>

            <div v-if="!Weather" class="bg-slate-400 h-10 w-24 animate-pulse">
            </div>

            <div v-if="Weather">
                <div v-if="Weather.data.temp">
                    <p class="font-serif font-bold text-4xl text-gray-700">
                        <code>{{ Math.round(Weather.data.temp) }}</code> ºC
                    </p>
                </div>

                <div v-if="!Weather.data.temp">
                    <p class="font-serif font-bold text-sm text-red-600 text-center">
                        Oops.. something went wrong
                    </p>
                    <p class="font-serif font-bold text-sm text-red-600 text-center">
                        Try refreshing the card
                    </p>
                </div>
            </div>

        </div>

        <div class="flex flex-row flex-nowrap justify-between w-full px-2 mb-4">
            <button v-if="Weather" @click="updateWeather" type="button" class="flex flex-row flex-nowrap items-center justify-center gap-2">
                <div class="h-3 w-3"><RefreshIcon/></div>
                <p class="text-sky-900 font-bold text-sm">
                    Refresh
                </p>                        
            </button>

            <button v-if="Weather" type="button" @click="$emit('openDetails', Weather.data)">
                <p class="text-sky-900 font-bold text-sm">
                    More Details
                </p>
            </button>

            <div v-if="!Weather" class="bg-slate-400 h-6 w-20 animate-pulse"></div>
            <div v-if="!Weather" class="bg-slate-400 h-6 w-20 animate-pulse"></div>
        </div>

        <div>

            <div v-if="!Weather" class="bg-slate-400 h-3 w-24 animate-pulse">
            </div>

            <p v-if="Weather" class="font-serif font-light text-slate-400  text-xs self-start justify-self-start">
                Last Updated: <span v-text="lastUpdate(new Date(this.Weather.last_retrieved))"> </span> min ago
            </p>
        </div>
    </div>
</template>