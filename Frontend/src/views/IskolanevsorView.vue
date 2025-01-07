<template>
  <div>
    <h1>Iskolanévsor</h1>
    <div v-for="(oszt, index) in osztalynevsorok" :key="index">
      <h3>{{ oszt.osztalyNev }}</h3>
      <ul v-for="nev in oszt.nevek" :key="nev">
        <li>{{ nev }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
export default {
  data() {
    return {
      urlApi: BASE_URL,
      osztalynevsorok: [],
    };
  },
  mounted() {
    this.getOsztalynevsorok();
  },
  methods: {
    async getOsztalynevsorok() {
      const url = `${this.urlApi}/queryOsztalynevsorObj`;
      const response = await axios.get(url);
      this.osztalynevsorok = response.data.data;
      console.log(this.osztalynevsorok);
    },
  },
};
</script>

<style>
</style>