<template>
  <div>
    <h1>Sportok</h1>
    <!-- Table -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Operations</th>
          <th scope="col">SportNev</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in collection"
          :key="item.id"
          @click="onClickTr(item.id)"
          :class="{ 'table-success': selectedId == item.id }"
        >
          <td class="text-nowrap">
            <OperationsCrud
              :rows="rows"
              @onClickDeleteButton="onClickDeleteButton"
              @onClickUpdate="onClickUpdate"
              @onClickCreate="onClickCreate"
            />
          </td>
          <td>{{ item.sportNev }}</td>  <!-- Change from 'collection' to 'item' -->
        </tr>
      </tbody>
    </table>
    <!-- Modal -->
    <Modal
      :title="title"
      :yes="yes"
      :no="no"
      :size="size"
      @yesEvent="yesEventHandler"
    >
      <!-- yes-no (Modal) -->
      <div v-if="state == 'Delete'">
        {{ messageYesNo }}
      </div>
    </Modal>
  </div>
</template>

<script>
import OperationsCrud from "@/components/OperationsCrud.vue";
import Modal from "@/components/Modal.vue";
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
import * as bootstrap from "bootstrap";

export default {
  components: { OperationsCrud, Modal },
  data() {
    return {
      modal: null,
      selectedId: null,
      messageYesNo: null,
      state: "Read", //CRUD: Create, Read, Update, Delete
      title: null,
      yes: null,
      no: null,
      size: null,
      collection: [],
      rows: {}, // Initialize rows as an empty object to avoid undefined errors
    };
  },
  mounted() {
    this.getSports(); // Add call to fetch sports data
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  methods: {
    async getSports() {
      const url = `${BASE_URL}/sports`;
      const response = await axios.get(url);
      this.collection = response.data.data;
      console.log(this.collection);
    },
    async deleteSport() {
      const url = `${BASE_URL}/sports/${this.selectedId}`; // Use selectedId for deletion
      await axios.delete(url);
      this.collection = this.collection.filter((p) => p.id !== this.selectedId); // Remove deleted item from collection
    },
    createSport() {
      this.collection.push(this.rows); // Add new sport to collection
      this.state = "Read";
    },
    updateSport() {
      const index = this.collection.findIndex((p) => p.id === this.rows.id);
      if (index !== -1) {
        this.collection[index] = this.rows; // Update existing sport in collection
      }
      this.state = "Read";
    },
    yesEventHandler() {
      if (this.state === "Delete") {
        this.deleteSport();
        this.modal.hide();
      }
    },
    onClickDeleteButton(rows) {
      this.title = "Delete";
      this.messageYesNo = `Are you sure you want to delete? Sport: ${rows.sportNev}`;
      this.yes = "Yes";
      this.no = "No";
      this.size = null;
      this.state = "Delete";
      this.selectedId = rows.id; // Set selectedId for the delete operation
    },
    onClickUpdate(rows) {
      this.state = "Update";
      this.title = "Sport modify";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.rows = { ...rows }; // Copy the selected sport data to rows
    },
    onClickCreate() {
      this.title = "New sport creation";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.state = "Create";
      this.rows = {}; // Reset rows for creating a new sport
    },
    onClickTr(id) {
      this.selectedId = id;
    },
  },
};
</script>

<style>
</style>
