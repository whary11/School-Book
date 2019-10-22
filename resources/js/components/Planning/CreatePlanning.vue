<template>
  <div>
    <form-wizard
      color="#20a8d8"
      title="Crear planeación"
      subtitle="Un subtitulo atractivo"
      nextButtonText="Siguiente"
      backButtonText="Atrás"
      finishButtonText="Enviar a revisión"
    >
      <tab-content title="Información básica">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent class="row">
              <div class="form-group col-md-6">
                <label for="responsible">Selecciona un grado</label>
                <v-select
                  v-model="planning.degree"
                  :options="options.degrees"
                  label="name"
                  id="degree"
                  placeholder="Selecciona un grado"
                >
                  <template slot="selected-option" slot-scope="option">
                    <span>{{option.name}}-{{option.level.name}}</span>
                  </template>

                  <template slot="option" slot-scope="option">
                    <span>{{option.name}}-{{option.level.name}}</span>
                  </template>
                </v-select>
              </div>
              <div class="form-group col-md-6">
                <label for="responsible">Selecciona un tema</label>
                <v-select
                  v-model="planning.topic"
                  :options="options.topics"
                  label="name"
                  id="topic"
                  placeholder="Selecciona un tema"
                >
                  <template slot="selected-option" slot-scope="option">
                    <span>{{option.name}}</span>
                  </template>

                  <template slot="option" slot-scope="option">
                    <span>{{option.name}}</span>
                  </template>
                </v-select>
              </div>
              <div class="form-group col-md-6">
                <label for="objetive">Describa un objetivo</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="planning.objetive"
                  id="objetive"
                  placeholder="Describa un objetivo"
                />
              </div>

              <div class="form-group col-md-6">
                <label for="methodology">Metodologia a utilizar</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="planning.methodology"
                  id="methodology"
                  placeholder="Metodologia a utilizar"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="observations">Observaciones</label>
                <textarea class="form-control" v-model="planning.observations" id="observations" />
              </div>
              <pre>
                {{planning}}
              </pre>
            </form>
          </div>
        </div>
      </tab-content>
      <tab-content title="Additional Info">My second tab content</tab-content>
      <tab-content title="Last step">Yuhuuu! This seems pretty damn simple</tab-content>
    </form-wizard>
  </div>
</template>

<script>
export default {
  data() {
    return {
      options: {
        degrees: [],
        topics: [
          { name: "Seres Vivos" },
          {
            name: "El mundo del deporte"
          }
        ]
      },
      planning: {
        degree: "",
        topic: "",
        methodology: "",
        objetive: "",
        observations: ""
      }
    };
  },
  mounted() {
    this.getOptions();
  },
  methods: {
    getOptions() {
      axios
        .get("/api/planning/getOptions")
        .then(res => {
          console.log(res.data.data);

          this.options.degrees = res.data.data.degrees;
        })
        .catch(error => {});
    }
  }
};
</script>