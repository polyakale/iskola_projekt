<template>
  <div>
    <h1>Sportok</h1>
    <!-- Table -->
    <table class="table table-striped">
      <thead>
        <tr>
          <!-- Módositás -->
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
              :item="item"
              @onClickDeleteButton="onClickDeleteButton"
              @onClickUpdate="onClickUpdate"
              @onClickCreate="onClickCreate"
            />
          </td>
          <!-- Módositás -->
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
      <!-- Form sport -->
      <DataForm
        v-if="state == 'Create' || state == 'Update'"
        :dataLine="dataLine"
        @saveSport="saveRowsHandler"
      />
    </Modal>
  </div>
</template>

<script>
import { BASE_URL } from "../helpers/baseUrls";
import { useAuthStore } from "@/stores/useAuthStore";
import OperationsCrud from "@/components/OperationsCrud.vue";
// Móddositás
import DataForm from "@/components/SportForm.vue";
import Modal from "@/components/Modal.vue";
import * as bootstrap from "bootstrap";
import axios from "axios";

// Módositás
class DataLine {
  constructor(sportNev = null) {
    this.sportNev = sportNev;
  }
}

export default {
  components: { OperationsCrud, Modal, DataForm },
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
      store: useAuthStore(),
      dataLine: new DataLine(),
      // Módositás
      urlBase: `${BASE_URL}/sports`,
    };
  },
  mounted() {
    this.getCollections();
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  methods: {
    async getCollections() {
      const url = this.urlBase;
      const response = await axios.get(url);
      this.collection = response.data.data;
      console.log(this.collection);
    },
    async deleteDataLine() {
      const url = `${this.urlBase}/${this.selectedId}`;
      const token = this.store.token;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      console.log("headers, url:", headers, url);

      try {
        await axios.delete(url, {
          headers: headers,
        });
        this.getCollections();
      } catch (error) {
        console.log(error);
      }
    },
    async createDataLine() {
      const url = this.urlBase;
      const token = this.store.token;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      console.log("dataline",this.dataLine);
      console.log("headers",headers);
      try {
        await axios.post(
          url,
          this.dataLine,
          {
            headers: headers,
          },
          
        );
        this.getCollections();
      } catch (error) {
        console.log(error.response.status);
      }
    },
    async updateDataLine() {
      const url = `${this.urlBase}/${this.selectedId}`;
      const token = this.store.token;
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      console.log("dataline",this.dataLine);
      console.log("headers",headers);
      try {
        await axios.patch(
          url,
          this.dataLine,
          {
            headers: headers,
          },
          
        );
        this.getCollections();
      } catch (error) {
        console.log(error.response.status);
      }
    },
    yesEventHandler() {
      if (this.state === "Delete") {
        this.deleteDataLine();
        this.modal.hide();
      }
    },
    onClickDeleteButton(dataLine) {
      this.title = "Delete";
      this.messageYesNo = `Are you sure you want to delete it? ${dataLine.sportNev}`;
      this.yes = "Yes";
      this.no = "No";
      this.size = null;
      this.state = "Delete";
      this.selectedId = dataLine.id;
    },
    onClickUpdate(dataLine) {
      this.state = "Update";
      this.title = "Modify";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.dataLine = dataLine;
    },
    onClickCreate() {
      this.title = "New create";
      this.yes = null;
      this.no = "Cancel";
      this.size = "lg";
      this.state = "Create";
      this.dataLine = new DataLine();
    },
    onClickTr(id) {
      this.selectedId = id;
    },
    saveRowsHandler(dataLine) {
      this.dataLine = dataLine;
      this.modal.hide();
      if (this.state == "Create") {
        this.createDataLine();
      } else if (this.state == "Update") {
        this.updateDataLine();
      }
    },
  },
};
</script>

<style>
</style>
