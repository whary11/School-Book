<script>
import { Bar, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;

export default {
  props: ["options", "chartData"],
  extends: Bar,
  mixins: [reactiveProp],
  mounted() {
    this.renderChart(this.chartData, this.options);
  }
};
</script>