<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}


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
                <h2>Promote Student</h2>
            </div>
        </div>

        <div class="card mb-3 mt-4">
            <div div class="card-body">
                <div class="content">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">
                                <h2 align="center">Promote Student of Section
                                    
                                </h2>
                            </strong>
                        </div>
                        <div class="card-body">
                            <div class="" role="alert">
                                
                            </div>
                            <form method="Post" action="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="x_card_code" class="control-label mb-1">Grade Level</label>
                                            <select Required name="levelId" class="levelId form-select">
                                            <option value="" >Select Grade</option>
                                                <option value="" >Grade 7</option>
                                                <option value="" >Grade 8</option>
                                                <option value="" >Grade 9</option>
                                                <option value="" >Grade 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label mb-1">Section</label>
                                            <select  id="select_sectionId" name="sectionId" class="form-select">
                                                <option value="" >Select Section</option>
                                                <option value="" >Section A</option>
                                                <option value="" >Section B</option>
                                                <option value="" >Section C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-4">
                                            <div class="form-group">
                                                <label for="x_card_code" class="control-label mb-1">School Year</label>
                                                
                                            </div>
                                        </div>-->
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered center">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectall" /> Select All</th>
                                                <th>FullName</th>
                                                <th>LRN</th>
                                                <!--<th>Date Created</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            <tr>
                                                <td><input type="checkbox" class="name" name="student[]"
                                                        value=""> </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <button type="submit" name="promote" class="btn">Promote Students</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">
                                    <h2 align="center">Promoted Students</h2>
                                </strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table"
                                        class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>FullName</th>
                                                <th>Grade Level</th>
                                                <th>Section</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           
                                            <tr>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td><a href="editpromoted.php?editpromoted="
                                                        title="Edit Details"><i class="las la-edit"></i></a>
                                                    <a class="delete"
                                                        data-href="deletepromoted.php?delid="
                                                        title="Delete Student Details"><i
                                                            class="las la-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of datatable -->

                </div><!-- .content -->
            </div>
        </div>
    </div>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>

</html>