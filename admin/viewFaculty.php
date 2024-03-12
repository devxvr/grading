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
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
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
                                    <tr>
                                            <td></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ><a href="" title="Edit Faculty Details"><i class="las la-edit"></i></a>
                                                <a class="delete" data-href="" title="Delete Faculty Details"><i class="las la-trash-alt"></i></a></td>
                                            
                                        </tr>
                            </div>                                              
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>