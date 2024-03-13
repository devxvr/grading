const xValues = ["Passed", "Failed"];
                const yValues = [55, 49];
                const barColors = [
                    "#FFFA81",
                    "#FFC600"
                ];

                new Chart("myChart", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Quality Metrics"
                        }
                    }
                });