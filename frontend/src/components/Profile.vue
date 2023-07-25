<template>
  <div
    class="flex flex-col flex-nowrap bg-slate-100 border border-gray-200 text-slate-900 w-72 h-56 p-4 shadow shadow-gray-200 hover:scale-105"
  >
    <p class="font-sans font-bold text-indigo-950 mb-4">
      <code> {{ profile?.name }} </code>
    </p>

    <Temperature
      v-if="profile?.id"
      :id="profile?.id"
      @open-details="openDetails"
    />
  </div>
</template>

<script lang="ts">
import Temperature from "@/components/Temperature.vue";
import { defineComponent } from "vue";

interface UserProfile {
  id: number;
  name: string;
}

interface WeatherData {}

export default defineComponent({
  props: {
    profile: {
      type: Object as () => UserProfile | null | undefined,
      required: true,
    },
  },
  components: {
    Temperature,
  },
  methods: {
    openDetails(data: WeatherData) {
      this.$emit("openDetails", data);
    },
  },
});
</script>
