<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text"></p>
    </div>
  </div>
</template>

<script>
export default {
  inject: ["urlApi"],
  data() {
    return {
      url: this.urlApi,
    };
  },
};
</script>

<style>
</style>