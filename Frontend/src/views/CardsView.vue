<template>
  <div>
    <h2>Cards</h2>
  </div>
  <div>
    <p>card/page:</p>
  </div>

  <CardsComponent :cards="cards" />
  <Paginator />
</template>

<script>
import CardsComponent from "../components/CardsComponent.vue";
import Paginator from "../components/Paginator.vue";
import axios from "axios";
export default {
  components: {
    CardsComponent,
    Paginator,
  },
  data() {
    return {
      url: "http://localhost:8000/api",
      cards: [],
      PageNumber: 1,
      RowsByPage: 3,
    };
  },
  mounted() {
    this.getClassList();
  },
  methods: {
    async getClassList() {
      const url = `${this.url}/queryOsztalynevsorLimit/${this.PageNumber}/${this.RowsByPage}`;
      const response = await axios.get(url);
      this.cards = response.data.data;
    },
  },
};
</script>

<style>
</style>