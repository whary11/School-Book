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
        columns: ["names", "surnames", "email", "Editar"],
        rows: []
      },
      config: {
        scope: "estudiante"
      }
    };
  },
  mounted() {
    axios
      .get("/api/user/getUsersAll")
      .then(res => {
        this.table.rows = res.data.data;
      })
      .catch(function(error) {});
  }
};
</script>