<template>
  <div class="continer-fluid" id="enrollment">
    <div class="card">
      <div class="card-header">
        <h5 class="text-center">Gestionar matricula</h5>
      </div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-md-6 form-group">
            <v-select
              v-model="newEnrollment.degrees"
              :options="options.degrees"
              label="name"
              placeholder="Grado"
              @input="searchStudent"
              :getOptionLabel="getLabelDegrees"
            >
              <template slot="selected-option" slot-scope="option">
                <span>{{option.name}}-{{option.level.name}}</span>
              </template>

              <template slot="option" slot-scope="option">
                <span>{{option.name}}-{{option.level.name}}</span>
              </template>
            </v-select>
          </div>
          <div class="col-md-6 form-group">
            <v-select
              v-model="newEnrollment.year"
              :options="options.years"
              placeholder="Periodo"
              @input="searchStudent"
            ></v-select>
          </div>
          <div class="col-md-12 form-group" v-if="selectStudent">
            <v-select
              v-model="newEnrollment.student"
              :options="options.students"
              placeholder="Estudiantes"
              :getOptionLabel="getLabel"
              @input="changeStudent"
            >
              <template slot="selected-option" slot-scope="option">
                <span>{{option.document}} - {{option.names}} {{option.surnames}}</span>
              </template>

              <template slot="option" slot-scope="option">
                <span class="p-1">
                  <img :src="option.avatar" class="img-avatar" style="width:30px" alt />
                  {{option.document}} - {{option.names}} {{option.surnames}}
                </span>
              </template>
            </v-select>
          </div>
          <div class="col-md-12 table-responsive" v-if="selectStudent">
            <ul class="list-group">
              <li class="list-group-item disabled" aria-disabled="true">
                <h5 class="text-center">
                  <P>Grado: {{newEnrollment.degrees.name}}-{{newEnrollment.degrees.level.name}}</P>
                  <P>Periodo: {{newEnrollment.year}}</P>
                </h5>
              </li>
              <table
                class="table table-sm table-striped table-fixed"
                v-if="newEnrollment.details.length > 0"
              >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in newEnrollment.details" :key="index">
                    <td class="align-middle">{{index+1}}</td>
                    <td class="p-0">
                      <img :src="item.avatar" class="img-avatar" style="width:50px" alt />
                    </td>
                    <td class="align-middle">{{item.document}}</td>
                    <td class="align-middle">{{item.names}} {{item.surnames}}</td>
                    <td class="align-middle">
                      <button
                        class="btn btn-danger btn-sm"
                        @click.prevent="deletDetalle(item,index)"
                      >
                        <i class="fas fa-user-slash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </ul>
          </div>
          <div class="col-md-6">
            <button
              class="btn btn-block btn-primary"
              v-if="newEnrollment.details.length > 0"
              @click.prevent="assignStudentDegrees()"
            >Asignar estudiantes al grado {{newEnrollment.degrees.name}}-{{newEnrollment.degrees.level.name}}</button>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="card" v-else>
      <div class="card-body row">
        <div class="col-md-12">
          <h5 class="text-center text-muted">
            No hay estudiantes registrados, registralos
            <span>
              <router-link tag="a" to="/gateway/students" class="nav-link">aquí</router-link>
            </span>
          </h5>
        </div>
      </div>
    </div>-->
  </div>
</template>
<script>
export default {
  data() {
    return {
      options: {
        students: [],
        degrees: [],
        years: []
      },
      newEnrollment: {
        degrees: null,
        details: []
      }
    };
  },
  mounted() {
    this.getOptions();
  },
  methods: {
    searchStudent() {
      if (
        this.newEnrollment.year != null &&
        this.newEnrollment.degrees != null
      ) {
        this.options.students = [];
        let loader = this.$loading.show({
          loader: "spinner"
        });
        axios
          .get(
            `/api/enrollment/getStudents/${this.newEnrollment.year}/${this.newEnrollment.degrees.name}`
          )
          .then(res => {
            this.options.students = res.data.data;
            loader.hide();
            // this.options.students = [];
            console.log(res);
          })
          .catch(error => {
            loader.hide();
          });
      }
    },

    changeStudent() {
      this.options.students = this.options.students.filter(
        item => item.id != this.newEnrollment.student.id
      );

      // if (filtro.length == 0) {
      this.newEnrollment.details.push(this.newEnrollment.student);
      this.newEnrollment.student = null;
      // } else {
      //   alert("El estudiante ya se encuentra en la lista");
      // }
    },
    deletDetalle(item, index) {
      this.newEnrollment.details.splice(index, 1);
      this.options.students.push(item);
    },
    getLabel(option) {
      if (typeof option === "object") {
        if (!option.hasOwnProperty("names")) {
          return console.warn(
            `[vue-select warn]: Label key "option.${this.label}" does not` +
              ` exist in options object ${JSON.stringify(option)}.\n` +
              "http://sagalbot.github.io/vue-select/#ex-labels"
          );
        }
        return `${option.document} - ${option.names} ${option.surnames}`;
      }
      return option;
    },
    getLabelDegrees(option) {
      if (typeof option === "object") {
        if (!option.hasOwnProperty("name")) {
          return console.warn(
            `[vue-select warn]: Label key "option.${this.label}" does not` +
              ` exist in options object ${JSON.stringify(option)}.\n` +
              "http://sagalbot.github.io/vue-select/#ex-labels"
          );
        }
        return `${option.name}-${option.level.name}`;
      }
      return option;
    },
    getOptions() {
      axios
        .get("/api/enrollment/getOptions")
        .then(res => {
          this.options.degrees = res.data.data.degrees;
          this.options.years = res.data.data.years;
          // this.options.students = [];
          console.log(res);
        })
        .catch(error => {});
    },

    assignStudentDegrees() {
      let loader = this.$loading.show({
        loader: "spinner"
      });
      axios
        .post("/api/enrollment/assignStudentDegrees", this.newEnrollment)
        .then(res => {
          if (res.data.transaction.status) {
            this.$swal({
              text: `
                ${this.newEnrollment.details.length} estudiantes asignados al grado 
                ${this.newEnrollment.degrees.name}-${this.newEnrollment.degrees.level.name}
                para el periodo ${this.newEnrollment.year}
                `,
              type: "success"
            });
            this.options.students = [];
            this.newEnrollment = {
              degrees: null,
              details: []
            };
          }
          console.log(res.data);
          loader.hide();
        })
        .catch(error => {
          loader.hide();
        });
    }
  },
  computed: {
    selectStudent() {
      if (
        this.newEnrollment.degrees != null &&
        this.newEnrollment.year != null
      ) {
        return true;
      } else {
        return false;
      }
    }
  }
};
</script>