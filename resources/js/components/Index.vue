<template>
  <div>
    <!-- <chat></chat> -->

    <header class="app-header navbar" v-show="auth">
      <button
        class="navbar-toggler sidebar-toggler d-lg-none mr-auto"
        type="button"
        data-toggle="sidebar-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img
          class="navbar-brand-full"
          src="/img/brand/logo.svg"
          width="89"
          height="25"
          alt="CoreUI Logo"
        />
        <img
          class="navbar-brand-minimized"
          src="/img/brand/sygnet.svg"
          width="30"
          height="30"
          alt="CoreUI Logo"
        />
      </a>
      <button
        class="navbar-toggler sidebar-toggler d-md-down-none"
        type="button"
        data-toggle="sidebar-lg-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Settings</a>
        </li>
      </ul>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-bell"></i>
            <span class="badge badge-pill badge-danger">5</span>
          </a>
        </li>
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-list"></i>
          </a>
        </li>
        <li class="nav-item d-md-down-none">
          <a class="nav-link" href="#">
            <i class="icon-location-pin"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link"
            data-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <div class="avatar">
              <img class="img-avatar" :src="user.avatar" :alt="user.names" v-if="user.avatar" />
              <span class="avatar-status badge-danger"></span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>{{user.names}} {{user.surnames}}</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-bell-o"></i> Updates
              <span class="badge badge-info">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-envelope-o"></i> Messages
              <span class="badge badge-success">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-tasks"></i> Tasks
              <span class="badge badge-danger">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-comments"></i> Comments
              <span class="badge badge-warning">42</span>
            </a>
            <div class="dropdown-header text-center">
              <strong>Configuraciones</strong>
            </div>

            <router-link tag="a" to="/gateway/perfil" class="dropdown-item">
              <i class="fa fa-user"></i> Perfil
            </router-link>

            <a class="dropdown-item" href="#">
              <i class="fa fa-wrench"></i> Settings
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-usd"></i> Payments
              <span class="badge badge-secondary">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-file"></i> Projects
              <span class="badge badge-primary">42</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-shield"></i> Lock Account
            </a>
            <a class="dropdown-item" href="#" @click="logout()">
              <i class="fa fa-lock"></i> Cerrar sesión
            </a>
          </div>
        </li>
      </ul>
      <button
        class="navbar-toggler aside-menu-toggler d-md-down-none"
        type="button"
        data-toggle="aside-menu-lg-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <button
        class="navbar-toggler aside-menu-toggler d-lg-none"
        type="button"
        data-toggle="aside-menu-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
    </header>
    <div class="app-body">
      <div class="sidebar" v-show="auth">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <router-link tag="a" to="/gateway/" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
              </router-link>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-universal-access"></i> Permisos
              </a>

              <ul class="nav-dropdown-items">
                <!-- <li class="nav-item"> -->
                <li class="nav-item">
                  <router-link tag="a" to="/gateway/permissions_roles" class="nav-link">
                    <i class="nav-icon fas fa-pencil-ruler"></i> Permisos vs Roles
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link tag="a" to="/gateway/permissions_users" class="nav-link">
                    <i class="nav-icon fas fa-pencil-ruler"></i> Permisos vs Usuarios
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fas fa-school"></i> Usuarios
              </a>
              <ul class="nav-dropdown-items">
                <!-- <li class="nav-item"> -->
                <li class="nav-item">
                  <router-link tag="a" to="/gateway/students" class="nav-link">
                    <i class="nav-icon fas fa-user-graduate"></i> Estudiantes
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link tag="a" to="/gateway/teachers" class="nav-link">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i> Docentes
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link tag="a" to="/gateway/enrollments" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i> Matriculas
              </router-link>
            </li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <div class="container mt-4">
          <!-- content -->
          <transition name="component-fade" mode="out-in">
            <router-view></router-view>
          </transition>
        </div>
      </main>
      <aside class="aside-menu" v-show="auth">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
              <i class="icon-list"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
              <i class="icon-speech"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
              <i class="icon-settings"></i>
            </a>
          </li>
        </ul>
        <!-- Tab panes-->
        <div class="tab-content">
          <div class="tab-pane active" id="timeline" role="tabpanel">
            <div class="list-group list-group-accent">
              <div
                class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"
              >Today</div>
              <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                <div class="avatar float-right">
                  <img class="img-avatar" src="/img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                </div>
                <div>
                  Meeting with
                  <strong>Lucas</strong>
                </div>
                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i> 1 - 3pm
                </small>
                <small class="text-muted">
                  <i class="icon-location-pin"></i> Palo Alto, CA
                </small>
              </div>
              <div class="list-group-item list-group-item-accent-info">
                <div class="avatar float-right">
                  <img class="img-avatar" src="/img/avatars/4.jpg" alt="admin@bootstrapmaster.com" />
                </div>
                <div>
                  Skype with
                  <strong>Megan</strong>
                </div>
                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i> 4 - 5pm
                </small>
                <small class="text-muted">
                  <i class="icon-social-skype"></i> On-line
                </small>
              </div>
              <div
                class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"
              >Tomorrow</div>
              <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                <div>
                  New UI Project -
                  <strong>deadline</strong>
                </div>
                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i> 10 - 11pm
                </small>
                <small class="text-muted">
                  <i class="icon-home"></i> creativeLabs HQ
                </small>
                <div class="avatars-stack mt-2">
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/2.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/3.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/4.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/5.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/6.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                </div>
              </div>
              <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                <div>
                  <strong>#10 Startups.Garden</strong> Meetup
                </div>
                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i> 1 - 3pm
                </small>
                <small class="text-muted">
                  <i class="icon-location-pin"></i> Palo Alto, CA
                </small>
              </div>
              <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                <div>
                  <strong>Team meeting</strong>
                </div>
                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i> 4 - 6pm
                </small>
                <small class="text-muted">
                  <i class="icon-home"></i> creativeLabs HQ
                </small>
                <div class="avatars-stack mt-2">
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/2.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/3.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/4.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/5.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/6.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/7.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                  <div class="avatar avatar-xs">
                    <img
                      class="img-avatar"
                      src="/img/avatars/8.jpg"
                      alt="admin@bootstrapmaster.com"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane p-3" id="messages" role="tabpanel">
            <div class="message">
              <div class="py-3 pb-5 mr-3 float-left">
                <div class="avatar">
                  <img class="img-avatar" src="img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                  <span class="avatar-status badge-success"></span>
                </div>
              </div>
              <div>
                <small class="text-muted">Lukasz Holeczek</small>
                <small class="text-muted float-right mt-1">1:52 PM</small>
              </div>
              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
              <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt...
              </small>
            </div>
            <hr />
            <div class="message">
              <div class="py-3 pb-5 mr-3 float-left">
                <div class="avatar">
                  <img class="img-avatar" src="/img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                  <span class="avatar-status badge-success"></span>
                </div>
              </div>
              <div>
                <small class="text-muted">Lukasz Holeczek</small>
                <small class="text-muted float-right mt-1">1:52 PM</small>
              </div>
              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
              <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt...
              </small>
            </div>
            <hr />
            <div class="message">
              <div class="py-3 pb-5 mr-3 float-left">
                <div class="avatar">
                  <img class="img-avatar" src="/img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                  <span class="avatar-status badge-success"></span>
                </div>
              </div>
              <div>
                <small class="text-muted">Lukasz Holeczek</small>
                <small class="text-muted float-right mt-1">1:52 PM</small>
              </div>
              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
              <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt...
              </small>
            </div>
            <hr />
            <div class="message">
              <div class="py-3 pb-5 mr-3 float-left">
                <div class="avatar">
                  <img class="img-avatar" src="img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                  <span class="avatar-status badge-success"></span>
                </div>
              </div>
              <div>
                <small class="text-muted">Lukasz Holeczek</small>
                <small class="text-muted float-right mt-1">1:52 PM</small>
              </div>
              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
              <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt...
              </small>
            </div>
            <hr />
            <div class="message">
              <div class="py-3 pb-5 mr-3 float-left">
                <div class="avatar">
                  <img class="img-avatar" src="img/avatars/7.jpg" alt="admin@bootstrapmaster.com" />
                  <span class="avatar-status badge-success"></span>
                </div>
              </div>
              <div>
                <small class="text-muted">Lukasz Holeczek</small>
                <small class="text-muted float-right mt-1">1:52 PM</small>
              </div>
              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
              <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt...
              </small>
            </div>
          </div>
          <div class="tab-pane p-3" id="settings" role="tabpanel">
            <h6>Settings</h6>
            <div class="aside-options">
              <div class="clearfix mt-4">
                <small>
                  <b>Option 1</b>
                </small>
                <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                  <input class="switch-input" type="checkbox" checked />
                  <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
              </div>
              <div>
                <small class="text-muted">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </small>
              </div>
            </div>
            <div class="aside-options">
              <div class="clearfix mt-3">
                <small>
                  <b>Option 2</b>
                </small>
                <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                  <input class="switch-input" type="checkbox" />
                  <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
              </div>
              <div>
                <small class="text-muted">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </small>
              </div>
            </div>
            <div class="aside-options">
              <div class="clearfix mt-3">
                <small>
                  <b>Option 3</b>
                </small>
                <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                  <input class="switch-input" type="checkbox" />
                  <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
              </div>
            </div>
            <div class="aside-options">
              <div class="clearfix mt-3">
                <small>
                  <b>Option 4</b>
                </small>
                <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                  <input class="switch-input" type="checkbox" checked />
                  <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
              </div>
            </div>
            <hr />
            <h6>System Utilization</h6>
            <div class="text-uppercase mb-1 mt-4">
              <small>
                <b>CPU Usage</b>
              </small>
            </div>
            <div class="progress progress-xs">
              <div
                class="progress-bar bg-info"
                role="progressbar"
                style="width: 25%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <small class="text-muted">348 Processes. 1/4 Cores.</small>
            <div class="text-uppercase mb-1 mt-2">
              <small>
                <b>Memory Usage</b>
              </small>
            </div>
            <div class="progress progress-xs">
              <div
                class="progress-bar bg-warning"
                role="progressbar"
                style="width: 70%"
                aria-valuenow="70"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <small class="text-muted">11444GB/16384MB</small>
            <div class="text-uppercase mb-1 mt-2">
              <small>
                <b>SSD 1 Usage</b>
              </small>
            </div>
            <div class="progress progress-xs">
              <div
                class="progress-bar bg-danger"
                role="progressbar"
                style="width: 95%"
                aria-valuenow="95"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <small class="text-muted">243GB/256GB</small>
            <div class="text-uppercase mb-1 mt-2">
              <small>
                <b>SSD 2 Usage</b>
              </small>
            </div>
            <div class="progress progress-xs">
              <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: 10%"
                aria-valuenow="10"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <small class="text-muted">25GB/256GB</small>
          </div>
        </div>
      </aside>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from "vuex";

import Chat from "../components/Chat/Chat";
export default {
  components: {
    Chat
  },
  data() {
    return {};
  },
  mounted() {
    if (JSON.parse(localStorage.getItem("auth"))) {
      this.getUser();
    }
  },
  methods: {
    ...mapActions(["rediretNoAuth", "getUser"]),
    logout() {
      axios
        .post("/api/auth/logout")
        .then(resp => {
          if (resp.data.message.type == "token") {
            this.rediretNoAuth();
          } else {
            localStorage.clear();
            location.reload();
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  },

  computed: {
    ...mapState(["auth", "user"])
  }
};
</script>