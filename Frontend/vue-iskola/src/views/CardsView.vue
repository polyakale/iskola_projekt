// CardsView.vue
<template>
  <h2>Cards</h2>
</template>

<script>
import axios from "axios";
import CardsComponent from "../components/CardsComponent.vue";
export default {
  inject: ["urlApi"],
  data() {
    return {
      url: this.urlApi,
      // rows: [],
    };
  },
  // mounted() {
  //   this.getOstalynevsor();
  // },
  // methods: {
  //   async getOstalynevsor() {
  //     const url = `${this.url}/queryOsztalynevsor`;
  //     const request = await fetch(url);
  //     this.rows = await request.json();
  //     console.log(this.rows);
  //   },
  // },
};
</script>