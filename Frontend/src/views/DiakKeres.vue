<template>
  <h1>Diák kereső</h1>
  <div class="d-flex" role="search">
    <input
      class="form-control me-2"
      type="search"
      placeholder="Search"
      aria-label="Search"
      v-model="searchInput"
    />
    <button
      class="btn btn-outline-success"
      type="submit"
      @click="onClickSearch()"
    >
      Search
    </button>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">OsztalyId</th>
        <th scope="col">Neme</th>
        <th scope="col">Szuletett</th>
        <th scope="col">Helyseg</th>
        <th scope="col">Osztondij</th>
        <th scope="col">Atlag</th>
        <th scope="col">OsztalyNev</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="row in rows" :key="row.id">
        <td>{{ row.id }}</td>
        <td>{{ row.osztalyId }}</td>
        <td>{{ row.neme }}</td>
        <td>{{ row.szuletett }}</td>
        <td>{{ row.helyseg }}</td>
        <td>{{ row.osztondij }}</td>
        <td>{{ row.atlag }}</td>
        <td>{{ row.osztalynev }}</td>
      </tr>
    </tbody>
  </table>
</template>
  
<script>
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";

export default {
  data() {
    return {
      urlApi: BASE_URL,
      rows: [],
      searchInput: null,
      searchWord: null,
    };
  },
  mounted() {
    this.getDiaks();
  },
  methods: {
    async getDiaks() {
      const url = `${BASE_URL}/queryDiakKeres/${this.searchWord}`;
      const headers = {
        Accept: "application/json",
      };
      const response = await axios.get(url, headers);
      this.rows = response.data.data;
      console.log("Answer", this.rows);
    },
    onClickSearch() {
      this.searchWord = this.searchInput;
      this.getDiaks();
    },
  },
};
</script>

<style>
</style>