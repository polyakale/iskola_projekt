<template>
  <nav aria-label="Page navigation example">
    <ul class="my-border pagination">
      <li class="page-item" @click="onClickPrevious()"><a class="page-link" href="#">Previous</a></li>
      <li
        class="page-item"
        @click="activePage(page)"
        :class="{ 'active': page === pageNumber }"
        v-for="page in pagesArray"
        :key="page"
        >
        <a class="page-link"
          href="#"
        >{{ page }}</a>
      </li>
      <li class="page-item" @click="onClickNext()"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: ["pagesArray", "pageNumber"],
  data() {
    return {
      currentPage: this.pageNumber,
    }
  },
  watch: {
    pageNumber() {
      this.currentPage = this.pageNumber
    }
  },
  methods: {
    activePage(page) {
      this.$emit("pageSelector", page);
    },
    onClickPrevious() {
      this.currentPage = Math.max( 1, this.currentPage - 1);
      this.$emit("pageSelector", this.currentPage);
  
    },
    onClickNext() {
      this.currentPage = Math.min(this.currentPage + 1, this.pagesArray.length);
      this.$emit("pageSelector", this.currentPage);
  
    }
  },
};
</script>

<style>
</style>