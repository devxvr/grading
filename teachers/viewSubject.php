<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); 

}
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
                                        <?php
                                require_once './subject_class.php';
                                

                                $subject = new Subjects();

                                // Fetch subject data (you should modify this to retrieve data from your database)
                                $subjectArray = $subject->show();
                                
                                    
                            ?>
                                <table id="subject" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            
                                            <th scope="col">Subject Id</th>
                                            <th scope="col">Subject Name</th>
                                            <th scope="col" width="5%">Action</th>
                                        </tr>
                                        </thead>
                                            <tbody>
                                            <?php
                                                if ($subjectArray) {
                                                    foreach ($subjectArray as $item) {
                                            ?>
                                                    <tr>
                                                        
                                                        <td>
                                                            <?= $item['subject_id'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $item['name'] ?>
                                                    </td>
                                                        <td class="text-center">
                                                            <a href="edit_subject.php?id=<?= $item['subject_id'] ?>"><i class="lni lni-pencil" aria-hidden="true" style="color: black;">
                                                                                </i></a>
                                                                                <a href="delete_subject.php?subject_id=<?= $item['subject_id'] ?>"><i class="lni lni-trash-can" aria-hidden="true" style="color: black;"></i></a>

                                                        </td>

                                                        <?php
                                                        
                                                    }
                                                }
                                            ?>              
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