<template>
    <div class="flex flex-col flex-nowrap items-center justify-center gap-1">
        <p class="font-sans font-bold text-gray-50 text-lg text-center leading-none">
            {{ label }}
        </p>

        <p class="font-sans font-regular text-gray-50 text-base">
            <span v-text="value"></span>{{ unit }}
        </p>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    label: {
      type: String,
      required: true,
    },
    value: {
      type: Number,
      required: true,
    },
    unit: {
      type: String,
      required: true,
    },
  },
});
</script>