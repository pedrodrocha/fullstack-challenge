<template>
  <div class="flex flex-col flex-nowrap gap-8 my-6 w-full h-full justify-center items-center">
    <h1 class="font-serif font-bold text-4xl text-indigo-950 text-center">
        Users
    </h1>


    <div v-if="!profiles" class="flex flex-col flex-nowrap w-full items-center">
      <Spinner/>
    </div>

    <div v-if="false" class="flex flex-col flex-nowrap w-full items-center">
      <p class="font-sans text-red-500 font-bold mb-4">
        Oops.. Something went wrong
      </p>
      <button type="button" class="border p-2 rounded bg-slate-600 border-slate-200" @click="reloadUsers">
        <p class="text-slate-50 font-sans font-regular text-sm">
          Try Again
        </p>
      </button>
    </div>

    <div v-if="profiles" class="flex flex-row flex-wrap gap-8 w-full justify-center max-w-screen-2xl">
      <div v-for="profile in profiles">
          <Profile :profile="profile" @open-details="openDetails"/>
      </div>
    </div>

    <div v-if="modal">
      <DetailsModal :details="details" @close-details="closeDetails"/>
    </div>     
  
  </div>
</template>

<script lang="ts">
  import Spinner from '@/components/Spinner.vue';
  import Profile from '@/components/Profile.vue';
  import CloseIcon from "@/components/icons/CloseIcon.vue";
  import DetailsModal from '@/components/DetailsModal.vue';

  import { defineComponent } from 'vue'
  import { getUserProfiles } from '../helpers/api-requests';

  export default defineComponent({
      
    data: () => ({
      profiles: false,
      details: false,
      modal: false,
      

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
        this.profiles = await getUserProfiles(url)
      },
      openDetails(data: Object) {
        this.details = data
        this.modal = true
      },
      closeDetails() {
        this.modal = false
        this.details = null
      },
      async reloadUsers() {
        this.profiles = false
        this.profiles = await this.fetchData()

        if (!this.profiles) {
          this.profiles = false
        }
      }
    },

  })
</script>