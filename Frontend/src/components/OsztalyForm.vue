<template>
  <div>
    <p>{{ dataLine }}</p>
    <form class="row g-4 needs-validation was-validated" novalidate>
      <!-- Name -->
      <div class="col-md-8">
        <label for="name" class="form-label">Class Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="dataLine.osztalyNev"
        />
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">
          Class name is required to be filled out
        </div>
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>
    
    <script>
export default {
  props: ["dataLine"],
  emits: ["saveItem"],
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
      this.$emit("saveItem", this.dataLine);
    },
  },
};
</script>
    
    <style>
</style>