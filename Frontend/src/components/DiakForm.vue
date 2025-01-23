<template>
  <div>
    <p>{{ dataLine }}</p>
    <form class="row g-4 needs-validation was-validated" novalidate>
      <!-- Name -->
      <div class="col-md-7">
        <label for="name" class="form-label">Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="dataLine.nev"
        />
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">Name is required to be filled out</div>
      </div>
      <!-- OsztalyId -->
      <div class="col-md-2">
        <label for="osztalyId" class="form-label">OsztalyId:</label>
        <input
          type="number"
          class="form-control"
          id="osztalyId"
          required
          v-model="dataLine.osztalyId"
        />
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">OsztalyId is required</div>
      </div>
      <!-- Gender -->
      <div class="col-md-3">
        <label class="form-check-label"> Gender </label>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="neme"
            :value="true"
            id="ferfi"
            v-model="dataLine.neme"
          />
          <label class="form-check-label" for="ferfi"> Male </label>
        </div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="neme"
            id="no"
            :value="false"
            v-model="dataLine.neme"
          />
          <label class="form-check-label" for="no"> Female </label>
        </div>
      </div>
      <!-- Birth Date -->
      <div class="col-md-3">
        <label for="birthdate" class="form-label">Birth Date:</label>
        <input
          type="date"
          class="form-control"
          id="birthdate"
          required
          v-model="formattedDate"
        />
      </div>
      <!-- City -->
      <div class="col-md-8">
        <label for="city" class="form-label">City:</label>
        <input
          type="text"
          class="form-control"
          id="city"
          required
          v-model="dataLine.helyseg"
        />
      </div>
      <!-- Scholarship (Text Input) -->
      <div class="col-md-4">
        <label for="scholarship" class="form-label">Scholarship:</label>
        <input
          type="text"
          class="form-control"
          id="scholarship"
          v-model="dataLine.osztondij"
        />
      </div>
      <!-- Average -->
      <div class="col-md-4">
        <label for="average" class="form-label">Average:</label>
        <input
          type="number"
          class="form-control"
          id="average"
          step="0.01"
          v-model="dataLine.atlag"
        />
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>
      
<script>
import dateFormat, { masks } from "dateformat";
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
  computed: {
    formattedDate: {
      get() {
        if (!this.dataLine.szuletett) {
          return null;
        }
        return dateFormat(this.dataLine.szuletett, "yyyy-mm-dd");

        // return this.dataLine.szuletett
      },
      set(newValue) {
        this.dataLine.szuletett = dateFormat(newValue, "yyyy.mm.dd");
      },
    },
  },
};
</script>
      
      <style>
</style>