<script lang="ts">

import { defineComponent } from 'vue'


export default defineComponent({
    props: {
        profile: Array
    }
    
})
</script>
<template>
    <div class="hover:scale-105 flex flex-col flex-nowrap gap-4 bg-slate-100 border border-gray-200 text-slate-900 w-72 h-56 p-4 shadow shadow-gray-200">
        <p class="font-sans font-bold text-indigo-950">
            <code> {{ profile.name }} </code>
        </p>

        <div class="flex flex-col items-center justify-between h-full w-full border">
            <div class="flex flex-col items-center gap-2">
                <p class="text-indigo-950 font-medium font-medium font-sans">
                    Current Temperature
                </p>
                <p class="font-serif font-bold text-3xl text-gray-700">
                    36ºC
                </p>
            </div>
        </div>

    </div>   
</template>