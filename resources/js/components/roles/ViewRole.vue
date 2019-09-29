<template>
  <div>
    <form
      class="modal fade"
      id="roles"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
      @submit.prevent="saveRole()"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre del rol</label>
              <input
                type="text"
                class="form-control"
                id="name"
                aria-describedby="emailHelp"
                placeholder="Nombre del rol"
                v-model="role.name"
                required
              />
            </div>
            <div class="form-group">
              <label for="name">
                <span class="text-center">Seleccione los permisos para este rol</span>
              </label>
              <v-select
                :options="permissions"
                label="name"
                v-model="role.permissions"
                multiple
                required
                :className="role_error.permissions.class[0]"
              ></v-select>
              <div
                :class="role_error.permissions.class[1]"
                v-if="role_error.permissions.class.length > 0"
              >Debe seleccionar un permisos.</div>
            </div>
            <div class="row justify-content-center" v-if="btn_disable">
              <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-warning" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-danger" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              :disabled="btn_disable"
            >Cerrar</button>
            <button type="submit" class="btn btn-primary" :disabled="btn_disable">Guardar cambios</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["role"],
  data() {
    return {
      btn_disable: false,
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
      if (!this.role.permissions || this.role.permissions.length == 0) {
        this.$swal({
          title: "Ups!",
          text: "Debe seleccionar un permiso",
          type: "error"
        });
      } else {
        this.btn_disable = true;
        let permissions = [];
        this.role.permissions.map(permission => {
          permissions.push(permission.name);
        });

        this.role.permissions = permissions;
        axios
          .post(this.getUrl, this.role)
          .then(resp => {
            if (resp.data.transaction.status) {
              this.$emit("updateRoles", resp.data.data);
              $("#roles").modal("hide");
              this.$message({
                supportHTML: true,
                message: "Acción realizada con éxito.",
                zIndex: 2000,
                position: "top-right",
                iconImg: "/fonts/font-svg/check-solid.svg"
              });
            } else {
              this.$swal({
                title: "Ups!",
                text: "Intenta nuevamente",
                type: "error"
              });
            }
            this.btn_disable = false;
          })
          .catch(error => {
            this.btn_disable = false;
            this.$swal({
              title: "Ups!",
              text: "Intenta nuevamente",
              type: "error"
            });
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
      if (this.role.guard_name) {
        return (this.url = "/api/role/editRole");
      } else if (this.role.email) {
        return (this.url = "/api/role/assign_permissions_to_user");
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