<template>
    <div class="absolute h-full w-full top-0 left-0">
      <div class="flex items-center justify-center z-10 fixed h-full w-full bg-slate-50/[.50]">
            <div class="bg-slate-500 h-96 w-96 rounded shadow-lg p-2 relative max-sm:mx-4">
                <CloseIcon  @click="$emit('closeDetails')" class="absolute top-2 right-2 stroke-slate-50 cursor-pointer"/>

                <div class="flex flex-col flex-nowrap gap-8 w-full h-full pt-10 items-center">
                    <div v-if="details?.weather">
                        <h2 v-text="details.weather" class="text-center font-serif font-bold text-2xl text-gray-50 select-none"></h2>
                    </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-6 w-full p-0 justify-center">
                        <DetailsModalItem v-if="details?.clouds" :label="'Clouds (%)'" :value="details.clouds" :unit="'%'" />
                        <DetailsModalItem v-if="details?.humidity" :label="'Humidity'" :value="details.humidity" :unit="'%'" />
                        <DetailsModalItem v-if="details?.wind_speed" :label="'Wind Speed'" :value="details.wind_speed" :unit="'m/s'" />
                        <DetailsModalItem v-if="details?.wind_deg" :label="'Wind Degree'" :value="details.wind_deg" :unit="'º'" />
                        <DetailsModalItem v-if="details?.wind_gust" :label="'Wind Gust'" :value="details.wind_gust" :unit="'m/s'" />
                        <DetailsModalItem v-if="details?.pressure" :label="'Atmospheric Pressure'" :value="details.pressure" :unit="'hPa'" />
                    </div>
                </div>
            </div>

        </div>
    </div>  
</template>

<script lang="ts">
    import CloseIcon from "@/components/icons/CloseIcon.vue";
    import DetailsModalItem from "./DetailsModalItem.vue";

    import { defineComponent } from 'vue'

    interface WeatherDetails {
        weather?: string;
        clouds?: number;
        humidity?: number;
        wind_speed?: number;
        wind_deg?: number;
        wind_gust?: number;
        pressure?: number;
    }

    export default defineComponent({
        props: {
            details: {
                type: Object as () => WeatherDetails | null,
                required: true,
            },
        },
        components: {
            CloseIcon,
            DetailsModalItem
        }

    })
</script>