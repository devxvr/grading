<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<body>
<?php
    require_once('../includes/sidebar.php');
?> 
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Dashboard</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
                <script>
                    new Chart(document.getElementById("chartjs-doughnut"), {
                type: "doughnut",
        data: {
    labels: ["Social", "Search Engines", "Direct", "Other"],
    datasets: [{
      data: [260, 125, 54, 146],
      backgroundColor: [
        window.theme.primary,
        window.theme.success,
        window.theme.warning,
        "#dee2e6"
      ],
      borderColor: "transparent"
    }]
  },
  options: {
    maintainAspectRatio: false,
    cutoutPercentage: 65,
  }
});
                </script>  
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>