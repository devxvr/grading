<?php
    $title = 'Subject';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Subject</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
    <div class="card-header">
                <strong class="card-title"><h2 align="center">View Subject</h2></strong>
            </div>
             <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover text-center table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Grade Level</th>
                                                <th>Subject</th>
                                                <th>Actions</th>                                            
                                            </tr>
                                        </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <a href="#">
                                                        <i class="lni lni-pencil" aria-hidden="true" style="color: black;">
                                                        </i>
                                                    </a>
                                                </td>
                                             </tr>                              
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                    <!-- CONTENT -->
        </div>
    </div>
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>