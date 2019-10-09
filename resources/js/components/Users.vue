<template>
  <div>
    <div class="card">
      <div class="card-header">
        <div class="row justify-content-center">
          <div class="text-center btn-group">
            <label
              href="#"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#modal_user"
              @click="user = {
                responsable: ''
              }"
              style="cursor:pointer"
            >Nuevo {{config.scope}}</label>
            <span class="input-group-append div_import" v-permissions="['import students']">
              <input
                type="file"
                @change="validaPlano"
                name="archivo"
                id="archivo"
                style="display:none"
              />
              <label for="archivo" class="btn btn-success" style="cursor:pointer">
                <i class="fas fa-upload"></i>
                Cargar {{config.scope}}s
              </label>
            </span>
          </div>
        </div>
      </div>

      <div id="algo" v-permissions="['import students']">no mas, borrate</div>

      <div class="card-body">
        <v-client-table
          :pagination="{edge:true}"
          :data="rows"
          :columns="table.columns"
          :options="{
        texts,headings,perPage,collapseGroups,pagination
        }"
          class="table-sm"
        >
          <span slot="is_active" slot-scope="props">
            <span v-if="props.row.is_active ==1" class="badge badge-success">Activo</span>
            <span v-else class="badge badge-danger">Inactivo</span>
          </span>

          <div slot="Acciones" slot-scope="props" class="btn-group">
            <button
              class="btn btn-dark btn-sm"
              data-toggle="modal"
              data-target="#modal_user"
              @click="user = props.row"
            >
              <i class="far fa-edit"></i>
            </button>

            <button
              class="btn btn-danger btn-sm"
              v-if="props.row.is_active == 1"
              @click.prevent="changeState(props.row.id,0)"
            >
              <i class="fas fa-lock"></i>
            </button>
            <button
              class="btn btn-success btn-sm"
              v-else
              @click.prevent="changeState(props.row.id,1)"
            >
              <i class="fas fa-lock-open"></i>
            </button>
          </div>
        </v-client-table>
      </div>
    </div>

    <!-- Modals -->
    <form
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
      id="modal_user"
      @submit.prevent="setUser"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" ref="modal_user">
          <div class="modal-header">
            <h5 class="modal-title">
              <span v-if="user.created_at">Editar {{config.scope}}</span>
              <span v-else>Nuevo {{config.scope}}</span>
            </h5>
          </div>
          <div class="modal-body row justify-content-center">
            <div class="col-md-12">
              <div
                class="alert alert-danger"
                role="alert"
                v-if="showAlert>0"
              >Tiene {{showAlert}} campos requeridos sin diligenciar.</div>
              <!-- <div class="alert alert-success" role="alert">Información correcta</div> -->
            </div>
            <div class="col-md-12 mb-4">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    data-toggle="tab"
                    href="#home4"
                    role="tab"
                    aria-controls="home"
                  >
                    <i class="far fa-address-card"></i>
                    Información básica del {{config.scope}}
                    <!-- <span class="badge badge-success">New</span> -->
                  </a>
                </li>
                <li class="nav-item" v-if="config.rol == 'STUDENT'">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    href="#profile4"
                    role="tab"
                    aria-controls="profile"
                  >
                    <i class="fas fa-chalkboard-teacher"></i> Acudiente
                    <!-- <span class="badge badge-pill badge-danger">29</span> -->
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="home4" role="tabpanel">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.document_type"
                        :options="optionComplements.documentType"
                        label="name"
                        placeholder="Tipo de documento"
                      ></v-select>
                    </div>
                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-id-card-alt"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.document"
                        class="form-control"
                        id="prependedInput"
                        placeholder="Documento (Requerido)"
                        size="16"
                        type="number"
                        required
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user-edit"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.names"
                        class="form-control"
                        placeholder="Nombres (Requerido)"
                        size="16"
                        type="text"
                        required
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user-edit"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.surnames"
                        class="form-control"
                        id="prependedInput"
                        placeholder="Apellidos (Requerido)"
                        size="16"
                        type="text"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-12">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-envelope-square"></i>
                        </span>
                      </div>
                      <input
                        class="form-control"
                        v-model="user.email"
                        placeholder="Email (Requerido)"
                        size="16"
                        type="email"
                        required
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-envelope-square"></i>
                        </span>
                      </div>
                      <datetime
                        v-model="user.birth_date"
                        input-class="form-control"
                        title="Fecha de nacimineto"
                        input-style="width:100%"
                        placeholder="Fecha de nacimiento"
                        value-zone="America/Bogota"
                        :auto="true"
                      ></datetime>
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.sex"
                        :options="optionComplements.sex"
                        label="name"
                        placeholder="Sexo (Requerido)"
                      ></v-select>
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-map-marker-alt"></i>
                        </span>
                      </div>
                      <input
                        class="form-control"
                        v-model="user.address"
                        placeholder="Dirección (Requerido)"
                        size="16"
                        type="text"
                        required
                      />
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        :options="optionComplements.neighborhood"
                        v-model="user.neighborhood"
                        label="name"
                        placeholder="Barrio (Requerido)"
                      ></v-select>
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.phone1"
                        class="form-control"
                        placeholder="Teléfono principal (Requerido)"
                        size="16"
                        type="number"
                        required
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.phone2"
                        class="form-control"
                        placeholder="Teléfono opcional"
                        size="16"
                        type="number"
                      />
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.eps"
                        :options="optionComplements.eps"
                        label="name"
                        placeholder="EPS"
                      ></v-select>
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.bloodGroup"
                        :options="optionComplements.bloodGroup"
                        label="name"
                        placeholder="Grupo sanguineo"
                      ></v-select>
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.arl"
                        :options="optionComplements.arl"
                        label="name"
                        placeholder="ARL"
                      ></v-select>
                    </div>

                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.compensation"
                        :options="optionComplements.compensation"
                        label="name"
                        placeholder="Caja de compensación"
                      ></v-select>
                    </div>

                    <div class="col-md-12">
                      <!-- {{user}} -->
                      <hr />
                    </div>

                    <h3 class="text-center col-md-12">Contacto en caso de emergencia</h3>
                    <div class="form-group input-prepend input-group col-md-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user-edit"></i>
                        </span>
                      </div>
                      <input
                        class="form-control"
                        v-model="user.name_ref"
                        placeholder="Nombres"
                        size="16"
                        type="text"
                      />
                    </div>
                    <div class="form-group input-prepend input-group col-md-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.phone_ref"
                        class="form-control"
                        placeholder="Teléfono"
                        size="16"
                        type="number"
                      />
                    </div>
                    <div class="form-group input-prepend input-group col-md-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-retweet"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.relationship_ref"
                        class="form-control"
                        placeholder="Parentesco"
                        size="16"
                        type="text"
                      />
                    </div>
                  </div>
                </div>
                <!-- Tab para los datos del acudiaente -->
                <div class="tab-pane" id="profile4" role="tabpanel" v-if="config.rol == 'STUDENT'">
                  <div class="row" v-if="newResposable ">
                    <div class="form-group col-md-12">
                      <a
                        href="#"
                        @click.prevent="newResposable=false;user.responsable = ''"
                        class="btn btn-sm btn-primary"
                      >Volver a buscar</a>
                    </div>
                    <div class="form-group col-md-6">
                      <v-select
                        v-model="user.responsable.document_type"
                        :options="optionComplements.documentType"
                        label="name"
                        placeholder="Tipo de documento (Requerido)"
                      ></v-select>
                    </div>
                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-id-card-alt"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.document"
                        class="form-control"
                        id="prependedInput"
                        placeholder="Documento (Requerido)"
                        size="16"
                        type="text"
                        :required="newResposable"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user-edit"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.names"
                        class="form-control"
                        placeholder="Nombres (Requerido)"
                        size="16"
                        type="text"
                        :required="newResposable"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user-edit"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.surnames"
                        class="form-control"
                        id="prependedInput"
                        placeholder="Apellidos (Requerido)"
                        size="16"
                        type="text"
                        :required="newResposable"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-12">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-envelope-square"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.email"
                        class="form-control"
                        placeholder="Email (Requerido)"
                        size="16"
                        type="email"
                        :required="newResposable"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.phone1"
                        class="form-control"
                        placeholder="Teléfono principal (Requerido)"
                        size="16"
                        type="number"
                        :required="newResposable"
                      />
                    </div>

                    <div class="form-group input-prepend input-group col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </span>
                      </div>
                      <input
                        v-model="user.responsable.phone2"
                        class="form-control"
                        placeholder="Teléfono opcional"
                        size="16"
                        type="number"
                      />
                    </div>
                  </div>
                  <div class="row" v-else>
                    <div class="form-group col-md-12">
                      <label for="responsible">Selecciona un acudiente</label>
                      <v-select
                        v-model="user.responsable"
                        :options="optionComplements.responsables"
                        label="names"
                        id="responsible"
                        placeholder="Selecciona un acudiente"
                      >
                        <p slot="no-options">
                          El acudiente que buscas no existe,
                          <a
                            href="#"
                            @click.prevent="newResposable=true;user.responsable = {}"
                          >debes crearlo</a>
                        </p>
                      </v-select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- <pre>
            {{user.responsable}}
          </pre>-->

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="validation"
              v-if="user.created_at"
            >Editar</button>
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="validation"
              v-else
            >Guardar cambios</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>



<script>
import { mapMutations } from "vuex";
import { log } from "util";

export default {
  props: {
    table: {
      type: Object,
      required: true
    },
    config: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      rows: [],
      showAlert: 0,
      optionComplements: [],
      user: {
        responsable: ""
      },
      newResposable: false,
      objectValidateUser: [
        "document_type",
        "document",
        "names",
        "email",
        "neighborhood",
        "sex",
        "address",
        "phone1"
      ],
      objectValidateResponsable: [
        "document_type",
        "document",
        "names",
        "email",
        "phone1"
      ],

      role: {},
      headings: {
        document: "Identificacion",
        names: "Nombre",
        surnames: "Apellidos",
        email: "Email",
        is_active: "Estado"
      },
      pagination: { nav: "scroll", chunk: 6 },

      collapseGroups: true,
      perPage: 20,
      texts: {
        count:
          "Montrando del {from} al {to} de {count} Registros|{count} Registros|1 rol",
        first: "First",
        last: "Last",
        filter: "",
        filterPlaceholder: "Buscar registro",
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
    this.getComplements();
    this.getUsersAll();
  },
  methods: {
    ...mapMutations([""]),

    getUsersAll() {
      let loader = this.$loading.show({
        loader: "spinner"
      });
      axios
        .get(`/api/user/getUsersAll/${this.config.rol}`)
        .then(res => {
          loader.hide();
          this.rows = res.data.data;
        })
        .catch(function(error) {
          loader.hide();
        });
    },
    setUser() {
      if (this.showAlert == 0) {
        let loader = this.$loading.show({
          loader: "spinner",
          container: this.$refs.modal_user
        });
        let url = this.config.urlSave;
        if (this.user.created_at) {
          url = this.config.urlEdit;
        }

        this.user.birth_date ? new Date(this.user.birth_date) : null;
        this.user.newRol = this.config.rol;

        axios
          .post(url, this.user)
          .then(res => {
            loader.hide();
            if (res.data.transaction.status) {
              this.rows = res.data.data;
              this.getComplements();
              this.newResposable = false;
              $("#modal_user").modal("hide");
              this.$message({
                supportHTML: true,
                message: "Acción realizada con éxito.",
                zIndex: 2000,
                position: "top-right",
                iconImg: "/fonts/font-svg/check-solid.svg"
              });

              this.user = {
                responsable: ""
              };
            } else {
            }
          })
          .catch(error => {
            loader.hide();

            console.log(error.response.data.errors);

            if (error.response.data.errors.document) {
              this.$swal({
                text: "El documento ya exite.",
                type: "error"
              });
            } else if (error.response.data.errors.email) {
              this.$swal({
                text: "El email ya exite.",
                type: "error"
              });
            }

            // data.responseJSON.errors.identificacion
          });
      }
    },

    getComplements() {
      axios
        .get("/api/user/getComplements")
        .then(res => {
          this.optionComplements = res.data.data;
        })
        .catch(function(error) {});
    },

    changeState(user_id, newState) {
      let loader = this.$loading.show({
        loader: "spinner"
      });
      axios
        .get(`/api/user/changeState/${user_id}/${newState}/${this.config.rol}`)
        .then(res => {
          loader.hide();
          console.log(res);
          if (res.data.transaction.status) {
            this.rows = res.data.data;
          }
        })
        .catch(function(error) {
          loader.hide();
        });
    },

    validaPlano(e) {
      let archvio = e.target.files[0];
      let extension = archvio.name.split(".");
      extension = extension[extension.length - 1];

      if (extension == "xls" || extension == "xlsx") {
        this.$swal({
          title: "Cargar Excel",
          text: `¿Estás seguro(a) de subir el documento '${archvio.name}'?`,
          icon: "warning",
          buttons: [true, "Continuar"],
          dangerMode: true
        }).then(willDelete => {
          if (willDelete) {
            let loader = this.$loading.show({
              loader: "spinner"
            });
            let formData = new FormData();
            formData.append("file", $("#archivo")[0].files[0]);
            formData.append("rol", this.config.rol);

            axios
              .post("/api/user/importUsers", formData)
              .then(resp => {
                loader.hide();
                if (resp.data.transaction.status) {
                  this.$swal({
                    text: `Usuarios registrados correctamente`,
                    type: "success"
                  });
                  this.rows = resp.data.data;
                } else {
                  this.$swal({
                    title: "Ups!",
                    text: "No se pudieron registrar los usuarios",
                    type: "error"
                  });
                }
              })
              .catch(error => {
                loader.hide();
              });
          } else {
            swal({
              title: "",
              text: `Haz cancelado la acción`,
              icon: "warning"
            });
          }
          $("#archivo").val("");
        });
      } else {
        swal({
          title: "",
          text: `El archivo con extensión "${extension}" no es permitido`,
          icon: "error"
        });
      }
    }
  },
  computed: {
    validation() {
      let count = 0;
      this.showAlert =
        this.objectValidateUser.length + this.objectValidateResponsable.length;
      for (const key in this.user) {
        if (this.user.hasOwnProperty(key)) {
          this.objectValidateUser.map(o => {
            if (o == key && this.user[key] != "") {
              count++;
              this.showAlert--;
            }
          });
        }
      }

      if (this.config.rol == "STUDENT") {
        for (const key in this.user.responsable) {
          if (this.user.responsable.hasOwnProperty(key)) {
            this.objectValidateResponsable.map(o => {
              if (o == key && this.user.responsable[key] != "") {
                count++;
                this.showAlert--;
              }
            });
          }
        }
      } else {
        this.objectValidateResponsable = [];
      }

      if (
        count ==
        this.objectValidateUser.length + this.objectValidateResponsable.length
      ) {
        return false;
      } else {
        return true;
      }
    }
  }
};
</script>
<style>
.vdatetime {
  width: 89% !important;
}
.vs__search {
  color: #5c6873;
}
.vs__dropdown-toggle {
  border: 1px solid #e4e7ea !important;
  height: calc(1.5em + 0.75rem + 2px);
}
</style>
