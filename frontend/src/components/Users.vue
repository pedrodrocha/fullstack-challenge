<script lang="ts">
import Spinner from '@/components/Spinner.vue'
export default {
  data: () => ({
    usersData: null
  }),

  created() {
    this.fetchData()
  },

  methods: {
    async fetchData() {
      const url = 'http://localhost/'
      this.usersData = await (await fetch(url)).json()
    }
  }
}
</script>

<template>
    <h1 class="font-serif font-bold text-4xl text-indigo-950 text-center ">
        Users
    </h1>
  <div v-if="!usersData" class="flex flex-col flex-nowrap w-full items-center">
    <Spinner/>
  </div>

  <div v-if="usersData" class="flex flex-row flex-wrap gap-6 w-full justify-center">
    <div v-for="users in usersData.users" class="bg-slate-100 border border-gray-200 text-slate-900 w-72 h-56 p-4 shadow shadow-gray-200">
        <p class="font-sans font-bold text-indigo-950">
            <code> {{ users.name }} </code>
        </p>
    </div>
  </div>
</template>