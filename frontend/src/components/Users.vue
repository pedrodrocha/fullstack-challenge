<script lang="ts">
import Spinner from '@/components/Spinner.vue';
import Profile from '@/components/Profile.vue';
import CloseIcon from "@/components/icons/CloseIcon.vue";
import DetailsModal from '@/components/DetailsModal.vue';

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
    DetailsModal,
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

    <div v-if="modal">
      <DetailsModal :details="details" @close-details="closeDetails"/>
    </div>     
  
  </div>
</template>