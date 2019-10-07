<template>
  <div class="mt-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Iniciar sesión en su cuenta</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="email"
                    placeholder="Username"
                    v-model="auth.email"
                  />
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="password"
                    placeholder="Password"
                    v-model="auth.password"
                  />
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="button" @click="iniciar()">Iniciar</button>
                  </div>
                  <div class="col-6 text-right">
                    <button class="btn btn-link px-0" type="button">Se te olvidó tu contraseña?</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>
                    Lorem ipsum sdolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </p>
                  <button class="btn btn-primary active mt-3" type="button">Register Now!</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapMutations, mapState } from "vuex";
export default {
  data() {
    return {
      auth: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    ...mapMutations(["login"]),
    iniciar() {
      axios
        .post("/api/auth/login", this.auth)
        .then(resp => {
          resp.data.status = true;
          this.login(resp.data);
          // this.$router.push("/gateway");
          location.reload();
        })
        .catch(error => {});
      // this.login(true);
    },
    validarEmail(email) {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
        return true;
      } else {
        return false;
      }
    }
  },
  computed: {
    // ...mapState(["auth"])
  }
};
</script>