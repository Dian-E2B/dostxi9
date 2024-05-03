dashboardchartsprgram();
function dashboardchartsprgram() {
    document.addEventListener("DOMContentLoaded", function () {
        axios
            .get("/dashboardgraph")
            .then(function (response) {
                var chartData = response.data;
                var labels = Object.keys(chartData);
                var datasets = [];
                for (var programName in chartData[labels[0]]) {
                    var data = [];
                    labels.forEach(function (label) {
                        data.push(chartData[label][programName] || 0);
                    });
                    var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                    datasets.push({
                        label: programName,
                        data: data,
                        backgroundColor: randomColor,
                        borderWidth: 1
                    });
                }
                var ctx = document.getElementById("programschartline").getContext("2d");
                var programschartline = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels, datasets: datasets
                    },
                    options: {
                        scales: {
                            yAxes: [
                                {
                                    ticks:
                                        { beginAtZero: true }
                                }]
                        }
                    }
                });
            })
            .catch(function (error) {
                console.error("Error fetching chart data:", error);
            });
    });
}
