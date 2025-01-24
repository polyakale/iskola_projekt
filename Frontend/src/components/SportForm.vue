<template>
  <div>
    <p>{{ dataLine }}</p>
    <form class="row g-4 needs-validation was-validated" novalidate>
      <!-- Name -->
      <div class="col-md-8">
        <label for="name" class="form-label">Sport Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          pattern="^.{3,}$"
          v-model="dataLine.sportNev"
        />
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">
          Sport Name is required and must be at least 2 characters long.
        </div>
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>
  
  <script>
export default {
  props: ["dataLine"],
  emits: ["saveSport"],
  mounted() {
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
          event.preventDefault();
          event.stopPropagation();
          if (form.checkValidity()) {
            this.onClickSubmit();
          }
        },
        false
      );
    });
  },
  methods: {
    onClickSubmit() {
      console.log("Save");
      this.$emit("saveSport", this.dataLine);
    },
  },
};
</script>
  
  <style>
</style>