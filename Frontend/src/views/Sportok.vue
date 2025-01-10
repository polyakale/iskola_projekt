<template>
  <div>
    <h1>Sportok</h1>

    <table class="table table-bordered border">
      <thead>
        <tr>
          <th scope="col">Operations</th>
          <th scope="col">Id</th>
          <th scope="col">SportNev</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in rows" :key="row.id">
          <OperationsCrud
              @onClickDeleteButton="onClickDeleteButton"
              @onClickUpdate="onClickUpdate"
              @onClickCreate="onClickCreate"
            />
          <td>{{ row.id }}</td>
          <td>{{ row.sportNev }}</td>
        </tr>
      </tbody>
    </table>
    
  </div>
</template>
  
<script>
import { BASE_URL } from "../helpers/baseUrls";
import OperationsCrud from "@/components/OperationsCrud.vue";
import axios from "axios";

export default {
  components: { OperationsCrud },
  data() {
    return {
      rows: [],
    };
  },
  mounted() {
    this.getSports();
  },
  methods: {
    async getSports() {
      const url = `${BASE_URL}/sports`;
      const response = await axios.get(url);
      this.rows = response.data.data;
    },
  },
};
</script>
