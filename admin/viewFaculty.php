<?php
    $title = 'Faculty';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Faculty</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
            <div class="card-header">
                <strong class="card-title"><h2 align="center">All Faculty</h2></strong>
            </div>
            <div class="card-body">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table text-center table-hover table-striped table-bordered">
                                <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Faculty Name</th>
                                            <th>Faculty ID</th>
                                            <th>Designation</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                                                                    
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <td></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td class="text-center">
                                                    <a href="#">
                                                        <i class="lni lni-pencil" aria-hidden="true" style="color: black;">
                                                        </i>
                                                    </a>
                                                </td>
                                        </tr>
                                        </tbody>
                            </div>                                              
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>