<!DOCTYPE html>
<html lang="en">

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
            <h2>Master List</h2>
        </div>
    </div>

<div class="content">
<div class="card mb-3 mt-4">
        <div class="card-header">
             <strong class="card-title"><h2 align="center">List of Grades In</h2></strong>
        </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>FullName</th>
                                    <th>1st Grading</th>
                                    <th>2nd Grading</th>
                                    <th>3rd Grading</th>
                                    <th>4th Grading</th>
                                    <th>Final Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td id = "finalgrade"></td>
                                </tr>                                       
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
<!-- end of datatable -->

</div><!-- .content -->
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>