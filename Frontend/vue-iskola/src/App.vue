<script>
export default {
  data() {
    return {
      urlApi: "http://localhost:8000/api",
    };
  },
};
</script>

<template>
  <div class="container-fluid my-border my-container">
    <h1>Iskola-projekt</h1>

    <nav class="my-border p-4">
      <RouterLink to="/">Home</RouterLink> |
      <RouterLink to="/cards">Cards</RouterLink>
    </nav>

    <div class="my-border p-2">
      <RouterView />
    </div>
  </div>
</template>

<style>
</style>