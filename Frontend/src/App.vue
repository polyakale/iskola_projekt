<script>
import { useCounterStore } from "@/stores/counter";
import { RouterLink, RouterView } from "vue-router";
export default {
  data() {
    return {
      state: useCounterStore(),
    };
  },
};
</script>

<template>
  <div class="container-fluid my-border my-container">
    <h1>Iskola-Projekt</h1>

    <nav class="my-border p-4">
      <RouterLink to="/">Home</RouterLink> |
      <RouterLink to="/cards">Cards</RouterLink> |
      <span>Counter: ({{ state.paddedCount }})</span>
    </nav>

    <div class="my-border p-2">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>
</style>
