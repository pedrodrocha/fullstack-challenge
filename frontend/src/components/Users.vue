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
          <div class="flex flex-col flex-nowrap w-full h-full">
            <div>
              <p>Weather: <span v-text="details.weather"></span>
              </p>
              <p>
                Temperature: <span v-text="Math.round(details.temp) "></span> ºC
              </p>
              <p>
                Max Temperature: <span v-text="Math.round(details.temp_max)"></span> ºC
              </p>
              <p>
                Min Temperature: <span v-text="Math.round(details.temp_min)"></span> ºC
              </p>
              <p>
                Clouds: <span v-text="Math.round(details.clouds)"></span>%
              </p>
              <p>
                Pressure: <span v-text="Math.round(details.pressure)"></span>
              </p>
              <p>
                Humidity: <span v-text="Math.round(details.humidity)"></span>
              </p>
              <p>
                Sunrise: <span v-text="Math.round(details.sunrise)"></span>
              </p>
              <p>
                Sunset: <span v-text="Math.round(details.sunset)"></span>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>     
  
  </div>
</template>