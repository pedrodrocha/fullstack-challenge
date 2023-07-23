<script lang="ts">
import RefreshIcon from '@/components/icons/RefreshIcon.vue';
import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        profile: Object
    },
    components: {
        RefreshIcon,
    }
    
})
</script>

<template>
    <div class="flex flex-col w-full h-full">
        <div class="flex flex-col items-center gap-2 mb-8">
            <p class="text-gray-900 font-medium font-medium font-sans">
                Current Temperature
            </p>
            <p class="font-serif font-bold text-4xl text-gray-700">
                36ºC
            </p>
        </div>

        <div class="flex flex-row flex-nowrap justify-between w-full px-2 mb-4">
            <div>
                <button type="button" class="flex flex-row flex-nowrap items-center justify-center gap-2">
                    <div class="h-3 w-3"><RefreshIcon/></div>
                    <p class="text-sky-900 font-bold text-sm">
                        Refresh
                    </p>
                        
                </button>
            </div>
            <button type="button">
                <p class="text-sky-900 font-bold text-sm">
                    More Details
                </p>
            </button>
        </div>

        <div>
            <p class="font-serif font-light text-slate-400  text-xs self-start justify-self-start">
                Last Updated: <span>30 min</span> ago
            </p>
        </div>
    </div>
</template>