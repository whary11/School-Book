<template>
  <div class="card" v-if="rolesTable.rows.length >0">
    <div class="card-header">
      <div class="row">
        <div class="btn-group Justify-content-start" role="group" aria-label="Basic example">
          <button class="btn btn-sm btn-primary j" @click="showModlaRoles()">Crear</button>
        </div>
      </div>
    </div>
    <div class="card-body" v-if="rolesTable.rows.length >0">
      <v-client-table
        :pagination="{edge:true}"
        :data="rolesTable.rows"
        :columns="rolesTable.columns"
        :options="{
        texts,headings,perPage,collapseGroups
        }"
      >
        <button
          slot="Editar"
          slot-scope="props"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#roles"
          @click="showModlaRoles(props.row)"
        >Editar</button>
      </v-client-table>
    </div>

    <view-role :role="role" @updateRoles="updateRoles"></view-role>
  </div>
</template>
<script>
import ViewRole from "./ViewRole";
export default {
  components: {
    ViewRole
  },
  data() {
    return {
      rolesTable: {
        columns: ["name", "created_at", "updated_at", "Editar"],
        rows: []
      },
      role: {},
      headings: {
        name: "Nombre",
        created_at: "Fecha de creación",
        updated_at: "Fecha de actualización",
        3: "Editar"
      },
      collapseGroups: true,
      perPage: 5,
      texts: {
        count:
          "Montrando del {from} al {to} de {count} Roles|{count} Roles|1 rol",
        first: "First",
        last: "Last",
        filter: "",
        filterPlaceholder: "Buscar rol",
        limit: "",
        page: "Page:",
        noResults: "Sin resultados",
        filterBy: "Filter by {column}",
        loading: "Cargando...",
        defaultOption: "Select {column}",
        columns: "Columns"
      }
    };
  },
  mounted() {
    this.getRoles();
  },
  methods: {
    getRoles() {
      axios
        .get("/api/role/allRoles")
        .then(resp => {
          this.rolesTable.rows = resp.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    editRole(role) {
      console.log(role);
    },
    showModlaRoles(row = {}) {
      this.role = row;
      $("#roles").modal({
        // keyboard: false
      });
    },
    updateRoles(data) {
      this.rolesTable.rows = data;
    }
  },
  computed: {}
};
</script>