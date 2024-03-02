<!DOCTYPE html>
<html lang="en">

<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<body>
<?php
    require_once('../includes/sidebar.subjectTeachers.php');
?> 
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Dashboard</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
        <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body" style="box-shadow: 0 4px 2px -2px gray;">
                            <div class="section-handled">       
                                <h2></h2><h5>Section: </u></h5><!-- Log on to codeastro.com for more projects! -->
                                <a href="#" title="View Section Details"><i class="las la-info-circle"></i><i><u>View Section</u></i></a>
                            </div><!-- /.card-left -->
                        </div>

                    </div>
                </div>                                                
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>