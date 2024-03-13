<?php
    $title = 'School Year';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>School Year</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
    <div class="card-header">
                <strong class="card-title"><h2 align="center">Add New School Year</h2></strong>
            </div>
        <div  div class="card-body">
            
        <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                <form method="Post" action="">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">School Year:</label>
                                                <input id="sessionName" name="sessionName" type="phone" maxlength="9" minlength="9" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-exp="Please enter a valid security code" placeholder="eg. 2023-2024">
                                            </div>
                                        </div>
                                                
                                    </div>
                                    <div>
                                        <button type="submit" name="submit" class="btn btn-primary mt-3 ">Add School Year</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- Card -->
                        <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All School Year</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-bordered table-hover table-striped text-center " width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>School Year</th>
                                            <th>Status</th>
                                            <th>Actions</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="" onclick="change_color(this)" title="Activate Session"><i class="lni lni-check-box text-black"></i></a>
                                                <a href="" title="Edit Session Details"><i class="lni lni-pencil-alt text-black"></i></a>
                                                <a class="delete" data-href="" title="Delete Session"><i class="lni lni-trash-can text-black"></i></a></td>
                                        </tr>
                                                                  
                                    </tbody>
                                </table>
                                </div>
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