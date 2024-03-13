const eValues = ["With Honors", "With HIgh Honors", "No Academic Honor"];
                const qValues = [55, 49, 53];
                const varColors = [
                    "#FFFA81",
                    "#FFC600",
                    "#1E96FC"
                ];

                new Chart("myChart2", {
                    type: "doughnut",
                    data: {
                        labels: eValues,
                        datasets: [{
                            backgroundColor: varColors,
                            data: qValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Academic achievement"
                        }
                    }
                });