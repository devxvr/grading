<?php
    $title = 'Section';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
        <div class="content">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Section</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Section</th>
                                                <th>Grade Level</th>
                                                <th>Actions</th>                                            
                                            </tr>
                                        </thead>
                                            <tbody>
                                                                                    
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

</div><!-- .content -->


</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>