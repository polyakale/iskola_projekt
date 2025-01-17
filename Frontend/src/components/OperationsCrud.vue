<template>
  <div>
    <!-- Delete -->
    <button
      type="button"
      class="btn btn-outline-danger btn-sm"
      data-bs-toggle="modal"
      data-bs-target="#modal"
      @click="onClickDeleteButton(item)"
    >
      <i class="bi bi-trash3"></i>
    </button>
    <!-- Modify -->
    <button
      type="button"
      class="btn btn-outline-primary btn-sm ms-2"
      data-bs-toggle="modal"
      data-bs-target="#modal"
      @click="onClickUpdate(item)"
    >
      <i class="bi bi-pencil"></i>
    </button>
    <!-- New -->
    <button
      type="button"
      class="btn btn-outline-success btn-sm ms-2"
      data-bs-toggle="modal"
      data-bs-target="#modal"
      @click="onClickCreate()"
    >
      <i class="bi bi-plus-lg"></i>
    </button>

  </div>
</template>

<script>
export default {
  props: ["item"],
  emits: ["onClickDeleteButton", "onClickUpdate", "onClickCreate"],
  methods: {
    onClickDeleteButton(item) {
      this.$emit("onClickDeleteButton", item);
    },
    onClickUpdate(item) {
      this.$emit("onClickUpdate", item);
    },
    onClickCreate() {
      this.$emit("onClickCreate");
    },
  },
};
</script>

<style>
</style>