<template>
  <div class="card" v-if="rolesTable.rows.length >0">
    <div class="card-header">
      <div class="btn-toolbar justify-content-center">
        <div class="btn-group" role="group">
          <label class="btn btn-primary" style="cursor:pointer" @click="showModlaRoles()">Crear</label>
          <span class="input-group-append div_import">
            <input
              type="file"
              @change="filePermissions"
              name="archivo"
              id="archivo"
              style="display:none"
            />
            <label for="archivo" class="btn btn-success" style="cursor:pointer">
              <i class="fas fa-upload"></i>
              Cargar Permisos
            </label>
          </span>
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
        class="table-sm"
      >
        <template slot="Permisos" slot-scope="props">
          <span
            class="badge badge-dark m-1"
            v-for="(item, index) in props.row.permissions"
            :key="index"
          >{{item.display_name}}</span>
        </template>
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

    <view-role :role="role" @updateRoles="updateRoles" :permissions="permissions"></view-role>
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
      permissions: [],
      rolesTable: {
        columns: ["name", "description", "Permisos", "Editar"],
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
    this.getPermissions();
  },
  methods: {
    getPermissions() {
      axios
        .get("/api/role/allPermissions")
        .then(resp => {
          this.permissions = resp.data.data;
        })
        .catch(function(error) {});
    },
    filePermissions(e) {
      let archvio = e.target.files[0];
      let extension = archvio.name.split(".")[
        archvio.name.split(".").length - 1
      ];

      if (extension == "xls" || extension == "xlsx") {
        this.$swal({
          title: "Cargar Excel",
          text: `¿Estás seguro(a) de subir el documento '${archvio.name}'?`,
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Continuar",
          cancelButtonText: "Cancelar"
        }).then(resp => {
          if (resp.value) {
            let loader = this.$loading.show({
              loader: "spinner"
            });
            let formData = new FormData();
            formData.append("file", $("#archivo")[0].files[0]);
            axios
              .post("/api/role/permissions/import", formData)
              .then(res => {
                loader.hide();
                if (res.data.transaction.status) {
                  loader.hide();
                  this.$swal({
                    text: `Permisos registrados correctamente.`,
                    type: "success"
                  });
                  this.permissions = res.data.data;
                } else {
                  alert("Tenemos un par de errores.");
                }
              })
              .catch(error => {
                loader.hide();
                alert("Tenemos un par de errores.");
              });
          }
        });
      }
    },
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
  computed: {
    showPermissions() {}
  }
};
</script>



<style>
.vs__dropdown-toggle {
  max-height: 1000px !important;
  height: auto !important;
}
</style>