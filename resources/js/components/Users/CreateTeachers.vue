<template>
  <div>
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
          "Acciones"
        ]
      },
      config: {
        scope: "docente",
        rol: "TEACHER",
        urlSave: "/api/user/saveUser",
        urlEdit: `/api/user/editUser`
      }
    };
  },
  mounted() {}
};
</script>