<template>
  <h2>Cards</h2>

  <CardsComponent :cards="cards"/>

</template>

<script>
import CardsComponent from "../components/CardsComponent.vue";
import axios from "axios";
export default {
  components: {
    CardsComponent,
  },
  data() {
    return {
      url: "http://localhost:8000/api",
      cards: [],
      PageNumber: 3,
      RowsByPage: 3,
    };
  },
  mounted() {
    console.log("hello");
    
    this.getClassList();
  },
  methods: {
    async getClassList() {
      const url = `${this.url}/queryOsztalynevsorLimit/${this.PageNumber}/${this.RowsByPage}`;
      console.log(url);
      
      
      const response = await axios.get(url);
      this.cards = response.data.data;
      // console.log("adatok",this.cards);
      
    },

  },
};
</script>