<script>
import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  data() {
    return {
      url: "api/chart",
      names: [],
      labels: [],
      data: ""
    };
  },

  methods: {

    getParticipations() {
      axios.get(this.url).then(response => {
        this.data = response.data;
        if (this.data) {
          this.data.forEach(element => {
            this.names.push(element.first_name);
            this.labels.push(element.value);

          });
          this.renderChart(
            {
              labels: this.names,
              datasets: [
                {
                    label: "Dados ",
                    backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                    data: this.labels
                }
              ]
            },
            { responsive: true }
          );
        } else {
          console.log("Sem Dados");
        }
      });
    }
  },
  mounted() {
    this.getParticipations();
  }
};
</script>
