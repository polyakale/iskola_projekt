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
          <td>{{ item.sportNev }}</td>
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
import { BASE_URL } from "../helpers/baseUrls";
import Modal from "@/components/Modal.vue";
import * as bootstrap from "bootstrap";
import axios from "axios";
import { useAuthStore } from "@/stores/useAuthStore";

export default {
  components: { OperationsCrud, Modal },
  data() {
    return {
      modal: null,
      selectedId: null,
      messageYesNo: null,
      state: "Read",
      title: null,
      yes: null,
      no: null,
      size: null,
      collection: [],
      rows: {},
      store: useAuthStore(),
    };
  },
  mounted() {
    this.getSports();
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
      const url = `${BASE_URL}/sports/${this.selectedId}`;
      const token = this.store.token;
      const headers = {
        Accept: 'application/json',
        "Content-Type": 'application/json',
        Authorization: `Bearer ${token}`,
      };
      console.log("headers, url:",headers, url);
      
      try {
        await axios.delete(url, {
          headers: headers,
        });
        this.getSports();
      } catch (error) {
        console.log(error);
      }
    },
    createSport() {
      this.collection.push(this.rows);
      this.state = "Read";
    },
    updateSport() {
      const index = this.collection.findIndex((p) => p.id === this.rows.id);
      if (index !== -1) {
        this.collection[index] = this.rows;
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
      this.selectedId = rows.id;
    },
    onClickUpdate(rows) {
      this.state = "Update";
      this.title = "Sport modify";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.rows = { ...rows };
    },
    onClickCreate() {
      this.title = "New sport creation";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.state = "Create";
      this.rows = {};
    },
    onClickTr(id) {
      this.selectedId = id;
    },
  },
};
</script>

<style>
</style>
