<template>
  <div class="d-flex flex-column container-fluid">
    <div class="d-flex justify-content-between">
      <h2>Cards</h2>
      <!-- kártya/oldal -->
      <div>
        <p>card/page:</p>
        <!-- <div>
          <button data-bs-toggle="dropdown" aria-expanded="false">
            {{ totalPages }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item">{{  }}</a></li>
          </ul>
        </div> -->
      </div>
    </div>
    <!-- kártyák  -->
    <div class="my-cards-height overflow-auto">
      <CardsComponent :cards="cards" />
    </div>
    <!-- paginátor -->
    <Paginator
      :pagesArray="pagesArray"
      :pageNumber="pageNumber"
      @pageSelector="pageSelected"
    />
  </div>
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
      pageNumber: 1, // melyik oldalon vagyunk
      cardsByPage: 4, // kártyák/oldal : egy oldalon hány kártya jelenik meg
      totalPages: 3, // az összes oldal
      pagesArray: [], // oldalszámok tömbje
      cardsByPageArray: [1,3,5,10,25,100] // oldalankénti kártyák száma tömb
    };
  },
  mounted() {
    this.getClassList();
    this.getTotalPages();
  },
  watch: {
    pageNumber(){
      this.getClassList();
    }
  },
  methods: {
    async getClassList() {
      const url = `${this.url}/queryOsztalynevsorLimit/${this.pageNumber}/${this.cardsByPage}`;
      const response = await axios.get(url);
      this.cards = response.data.data;
    },
    async getTotalPages() {
      const url = `${this.url}/queryHanyOldalVan/${this.cardsByPage}`;
      const response = await axios.get(url);
      this.totalPages = response.data.data.oldalszam;
      for (let i = 0; i < this.totalPages; i++) {
        this.pagesArray.push(i + 1);
      }
    },
    pageSelected(page) {
      this.pageNumber = page;
    },
  },
};
</script>

<style scoped>
.my-cards-height {
  height: calc(100vh - 252px);
}
</style>