<template>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <bar-chart :chartData="datacollection" :options="options" :styles="myStyles"></bar-chart>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BarChart from "./BarChart";
export default {
  components: {
    BarChart
  },
  data() {
    return {
      myStyles: {
        // height: `500px`,
        width: "300px"
        // position: "relative"
      },
      datacollection: null,
      options: {
        responsive: true,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true
              }
            }
          ]
        }
      }
    };
  },
  mounted() {
    this.fillData();
  },

  methods: {
    fillData() {
      this.datacollection = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "# of Votes",
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)"
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)"
            ],
            borderWidth: 1
          }
        ]
      };
    }
  }
};
</script>