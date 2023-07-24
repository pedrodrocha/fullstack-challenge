<script lang="ts">
import Spinner from '@/components/Spinner.vue';
import Profile from '@/components/Profile.vue';
import CloseIcon from "@/components/icons/CloseIcon.vue";

import { defineComponent } from 'vue'
import { getUserProfiles } from '../helpers/api-requests';

export default defineComponent({
    
  data: () => ({
    Profiles: null,
    details: null,
    modal: null,
    

  }),
  components: {
    Spinner,
    Profile,
    CloseIcon,
  },
  created() {
    this.fetchData()
  },
  methods: {
    async fetchData() {
      const url = 'http://localhost/'
      this.Profiles = await getUserProfiles(url)
    },
    openDetails(data) {
      this.details = data
      this.modal = true
    },
    closeDetails() {
      this.modal = false
      this.details = null
    }
  },

})
</script>

<template>
  <div class="flex flex-col flex-nowrap gap-8 my-6 w-full h-full">
    <h1 class="font-serif font-bold text-4xl text-indigo-950 text-center ">
        Users
    </h1>


    <div v-if="!Profiles" class="flex flex-col flex-nowrap w-full items-center">
      <Spinner/>
    </div>

    <div v-if="Profiles" class="flex flex-row flex-wrap gap-8 w-full justify-center">
      <div v-for="profile in Profiles">
          <Profile :profile="profile" @open-details="openDetails"/>
      </div>
    </div>

    <div v-if="modal" class="absolute h-full w-full top-0">
      <div class="flex items-center justify-center z-10 fixed h-full w-full bg-slate-50/[.50]">
        <div class="bg-slate-500 h-96 w-96 rounded shadow-lg p-2 relative">
          <CloseIcon class="absolute top-2 right-2 stroke-slate-50 cursor-pointer" @click="closeDetails"/>
          <div class="flex flex-col flex-nowrap gap-8 w-full h-full pt-10 items-center">
            <div v-if="details.weather">
              <h2 v-text="details.weather" class="text-center font-serif font-bold text-2xl text-gray-50 select-none"></h2>
            </div>

            <div class="grid grid-cols-2 gap-x-6 gap-y-6 w-full p-0 justify-center">
              <div v-if="details.clouds" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Clouds (%)
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.clouds"></span>%
                </p>
              </div>


              <div v-if="details.humidity" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Humidity
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.humidity"></span>%
                </p>
              </div>

              <div v-if="details.wind_speed" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Wind Speed
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.wind_speed"></span> m/s
                </p>
              </div>


              <div v-if="details.wind_deg" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Wind Degree
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.wind_deg"></span>º
                </p>
              </div>

              <div v-if="details.wind_gust" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Wind Gust
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.wind_gust"></span> m/s
                </p>
              </div>
              <div v-if="details.pressure" class="flex flex-col flex-nowrap items-center justify-center gap-1">
                <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
                  Atmospheric Pressure
                </p>

                <p class="font-sans font-regular text-gray-50 text-base">
                  <span v-text="details.pressure"></span> hPa
                </p>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>     
  
  </div>
</template>