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
          v-for="rows in collection"
          :key="rows.id"
          @click="onClickTr(rows.id)"
          :class="{ 'table-success': selectedRowsId == rows.id }"
        >
          <td class="text-nowrap">
            <OperationsCrud
              :rows="rows"
              @onClickDeleteButton="onClickDeleteButton"
              @onClickUpdate="onClickUpdate"
              @onClickCreate="onClickCreate"
            />
          </td>
          <td>{{ rows.name }}</td>
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
import * as bootstrap from "bootstrap";

// import uniqid from "uniqid";
export default {
  components: { OperationsCrud },
  mounted() {
    this.login();
    this.getSports();
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  data() {
    return {
      modal: null,
      selectedRowsId: null,
      messageYesNo: null,
      state: "Read", //CRUD: Create, Read, Update, Delete
      title: null,
      yes: null,
      no: null,
      size: null,
      rows: [],
      collection: [],
    };
  },
  mounted() {
    this.collection = this.rows;
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  methods: {
    async login() {
      const url = "http://localhost:8000/api/users/login";
      try {
        const response = await fetch(url, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: "test@example.com",
            password: "123",
          }),
        });
        if (!response.ok) {
          throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        console.log(json);
        token = json.user.token;
      } catch (error) {
        console.error(error.message);
      }
    },
    async getSports() {
      const url = `${BASE_URL}/sports`;
      const response = await axios.get(url);
      this.rows = response.data.data;
    },
    async deleteSport() {
      const url = `${BASE_URL}/sports`;
      const response = await axios.get(url);
      this.rows = response.data.data;
      try {
        await login();
        console.log("token:", token);
        const response = await fetch(url, {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        });
        if (!response.ok) {
          throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
      } catch (error) {
        console.error(error.message);
      }
      this.collection = this.collection.filter(
        (p) => p.id != this.selectedRowsId
      );
    },
    createSport() {
      this.collection.push(this.rows);
      this.state = "Read";
    },
    updateSport() {
      const index = this.collection.findIndex((p) => p.id == this.rows.id);
      this.collection[index] = this.rows;
      this.state = "Read";
    },
    yesEventHandler() {
      if (this.state == "Delete") {
        this.deleteDataLineById();
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
    },
    onClickTr(id) {
      this.selectedRowDataLineId = id;
    },
    saveDataLineHandler(rows) {
      this.rows = rows;
      this.modal.hide();
      if (this.state == "Create") {
        this.createDataLine();
      } else if (this.state == "Update") {
        this.updateDataLine();
      }
    },
  },
  computed: {
    // collection(){
    //   //rename
    //   return this.professions
    // }
  },
};
</script>

<style>
</style>

