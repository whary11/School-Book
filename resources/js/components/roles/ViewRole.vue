<template>
  <div>
    <div
      class="modal fade"
      id="roles"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- <form class="needs-validation"> -->
            <div class="form-group">
              <label for="name">Nombre del rol</label>
              <input
                type="text"
                :class="'form-control ' +role_error.name.class[0]"
                id="name"
                aria-describedby="emailHelp"
                placeholder="Nombre del rol"
                v-model="role.name"
              />
              <div
                :class="role_error.name.class[1]"
                v-if="role_error.name.class.length > 0"
              >Error en el nombre.</div>
            </div>

            <span>Añadir todos</span>
            <div>
              <label class="switch switch-3d switch-primary">
                <input
                  class="switch-input"
                  type="checkbox"
                  :checked="checked"
                  @change="addAllPermissions"
                />
                <span class="switch-slider"></span>
              </label>
            </div>
            <div class="form-group">
              <label for="name">
                <span class="text-center">O seleccione los permisos para este rol</span>
              </label>

              <v-select :options="permissions" label="name" v-model="role.permissions" multiple></v-select>
            </div>
            <!-- </form> -->
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" @click="saveRole()">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>
    <pre></pre>
  </div>
</template>

<script>
export default {
  props: ["role"],
  data() {
    return {
      checked: false,
      permissions: [],
      url: false,

      role_error: {
        permissions: {
          class: []
        },
        name: {
          class: []
        }
      }
    };
  },
  mounted() {
    this.getUrl;
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

    saveRole() {
      if (this.role.name == "") {
        this.role_error.name.class = ["is-invalid", "invalid-feedback"];
      } else {
        axios
          .post(this.getUrl, this.role)
          .then(resp => {
            if (resp.data.transaction.status) {
              this.$emit("updateRoles", resp.data.data);
              $("#roles").modal("hide");
              this.$message({
                supportHTML: true,
                message: "Permisos actualizados con éxito.",
                zIndex: 2000,
                position: "top-right",
                iconImg: "/fonts/font-svg/check-solid.svg"
              });
            }
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    addAllPermissions(e) {
      if (e.target.checked) {
        this.role.permissions = this.permissions;
      } else {
        this.role.permissions = [];
      }
    }
  },
  computed: {
    getUrl() {
      if (this.role.created_at) {
        return (this.url = "/api/role/editRole");
      } else {
        return (this.url = "/api/role/createRole");
      }
    }
  }
};
</script>

<style>
.vs__selected {
  align-items: center;
  background-color: #20a8d8 !important;
  border: 0.5px solid white !important;
  border-radius: 6px !important;
  color: white !important;
  line-height: 1.4;
  margin: 4px 2px 0;
  padding: 0 0.25em;
}
</style>