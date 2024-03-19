<?php
    $title = 'Section';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Section</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        
        <div class="card-header">
            <strong class="card-title"><h2 align="center">Assign Adviser</h2></strong>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Grade Level:</label>
                                        <select name="" id="" class="form-select">
                                        <option value="">Select a Grade Level</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Section:</label>
                                        <select name="" id="" class="form-select">
                                        <option value="">Select a Section</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Adviser:</label>
                                        <select name="" id="" class="form-select">
                                        <option value="">Select a Adviser</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                                   
                                   
                    </div> <!-- .card -->
                </div><!--/.col-->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="submit" name="submit">Add</button>
                        </div>
        </div>
    </div>
    
</div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>