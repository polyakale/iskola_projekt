<template>
  <div>
    <p>{{ dataLine }}</p>
    <form class="row g-4 needs-validation was-validated" novalidate>
      <!-- Name -->
      <div class="col-md-7">
        <label for="nev" class="form-label">Name:</label>
        <input
          type="text"
          class="form-control"
          id="nev"
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
          min="1"
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
      <div class="col-md-4">
        <label for="szuletett" class="form-label">Született:</label>
        <input
          type="date"
          class="form-control"
          id="szuletett"
          required
          v-model="formattedDate"
        />
      </div>
      <!-- City -->
      <div class="col-md-8">
        <label for="helyseg" class="form-label">City:</label>
        <input
          type="text"
          class="form-control"
          id="helyseg"
          required
          v-model="dataLine.helyseg"
        />
      </div>
      <!-- Scholarship -->
      <div class="col-md-4">
        <label for="osztondij" class="form-label">Scholarship:</label>
        <input
          type="text"
          class="form-control"
          id="osztondij"
          v-model="dataLine.osztondij"
        />
      </div>
      <!-- Average -->
      <div class="col-md-4">
        <label for="atlag" class="form-label">Average:</label>
        <input
          type="number"
          class="form-control"
          id="atlag"
          step="0.01"
          v-model="dataLine.atlag"
        />
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>

<script>
import dateFormat from "dateformat";

export default {
  props: ["dataLine"],
  emits: ["saveItem"],
  mounted() {
    const forms = document.querySelectorAll(".needs-validation");
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
      },
      set(newValue) {
        if (newValue) {
          const formattedDate = new Date(newValue).toISOString(); // 'yyyy-mm-ddT00:00:00.000Z'
          this.dataLine.szuletett = formattedDate; // A dátumot ISO formátumban tároljuk
        }
      },
    },
  },
};
</script>

<style>
</style>
