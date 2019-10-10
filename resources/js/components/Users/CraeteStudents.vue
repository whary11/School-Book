<template>
  <div>
    <div id="algo" v-permissions="['import students']">no mas, borrate</div>

    <Users :table="table" :config="config" />
  </div>
</template>

<script>
import Users from "../Users";
export default {
  components: {
    Users
  },
  data() {
    return {
      table: {
        columns: [
          "document",
          "names",
          "surnames",
          "email",
          "is_active",
          "sex.name",
          "Acciones"
        ]
      },
      config: {
        scope: "estudiante",
        rol: "STUDENT",
        urlSave: "/api/user/saveUser",
        urlEdit: `/api/user/editUser`
      }
    };
  },
  mounted() {}
};
</script>