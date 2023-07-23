<script lang="ts">
import Spinner from '@/components/Spinner.vue';
import Profile from '@/components/Profile.vue';

import { defineComponent } from 'vue'
import { getUserProfiles } from '../helpers/api-requests';

export default defineComponent({
    
  data: () => ({
    Profiles: null
  }),
  components: {
    Spinner,
    Profile,
  },
  created() {
    this.fetchData()
  },
  methods: {
    async fetchData() {
      const url = 'http://localhost/'
      this.Profiles = await getUserProfiles(url)
    }
  }
})
</script>

<template>
    <h1 class="font-serif font-bold text-4xl text-indigo-950 text-center ">
        Users
    </h1>
  <div v-if="!Profiles" class="flex flex-col flex-nowrap w-full items-center">
    <Spinner/>
  </div>

  <div v-if="Profiles" class="flex flex-row flex-wrap gap-8 w-full justify-center">
    <div v-for="profile in Profiles">
        <Profile :profile="profile"/>
    </div>
  </div>
</template>