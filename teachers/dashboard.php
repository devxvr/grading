<?php
if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); 
}
    $title = 'Home';
    require_once('../includes/head.teachers.dashboard.php');
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
            <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Quarter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">1st Quarter</a></li>
                        <li><a class="dropdown-item" href="#">2nd Quarter</a></li>
                        <li><a class="dropdown-item" href="#">3rd Quarter</a></li>
                        <li><a class="dropdown-item" href="#">4th Quarter</a></li>
                    </ul>
                    </div>
                <div class="allcharts" style="gap: 40px; height: 300px; margin-top:3%">
                    <div class="chart" style="background-color: #f6f6f6; width: 450px; padding: 10px; border-radius: 5px; box-shadow: 2px 4px 8px 1px rgba(29, 45, 68, 0.389);">
                        <canvas id="myChart" style="width:100%;max-width:600px;height: 250px;"></canvas>
                                    <?php

                            require_once('../includes/script.chart1.js.php');
                        ?>
                    </div>
                    <div class="chart2" style="background-color: #efefef; width: 450px;  padding: 10px; border-radius: 5px; box-shadow: 2px 4px 8px 1px rgba(29, 45, 68, 0.389);">
                        <canvas id="myChart2" style="width:100%;max-width:600px;height: 250px;"></canvas>
                                        <?php
                                
                                require_once('../includes/script.chart2.js.php');
                            ?>
                    </div>
                </div>
        </div>
    </div>
    <div class="card mb-3 mt-4">
        <div  div class="card-body">

        <div class="table-responsive">
                <h2>RANKINGS</h2>
            <div class="ranking" style="overflow-y: scroll; height: 250px; width: 100%">
                <table class="table table-striped table-hover text-center table-bordered" style="border: 1px black;">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">GRADE & SECTION</th>
                        <th scope="col">GENERAL AVERAGE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>