<?php
require_once("./includes/database.php"); // Include database connection file

// Establish a database connection
$db = new Database();
$conn = $db->connect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.css">

    <title>Maintenance</title>

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./DataTables/datatables.min.css">
    <script src="./DataTables/datatables.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <script src="./js/script.js"></script>
</head>


<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Assessment List</h3>
        <div class="card-tools align-middle">
            <button class="btn btn-dark btn-sm py-1 rounded-0" type="button" id="create_new">Add New</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="10%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center p-0">#</th>
                    <th class="text-center p-0">Class</th>
                    <th class="text-center p-0">Component</th>
                    <th class="text-center p-0">Quarter</th>
                    <th class="text-center p-0">Name</th>
                    <th class="text-center p-0">HPS</th>
                    <th class="text-center p-0">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT a.*, (s.name || ' ' || c.grade || ' - ' || c.section) as class, cc.name as component FROM `assessment_list` a inner join `class_list` c on a.class_id = c.class_id inner join `subjects` s on c.subject_id = s.subject_id inner join `grading_components` cc on a.component_id = cc.component_id order by class asc, component asc, quarter asc, `name` asc, hps asc ";
                $qry = $conn->query($sql);
                $i = 1;
                while($row = $qry->fetch(PDO::FETCH_ASSOC)):

                ?>
                <tr>
                    <td class="text-center p-0"><?php echo $i++; ?></td>
                    <td class="py-0 px-1"><?php echo $row['class'] ?></td>
                    <td class="py-0 px-1"><?php echo $row['component'] ?></td>
                    <td class="py-0 px-1">
                    <?php 
                    switch($row['quarter']){
                        case '1':
                            echo "First";
                        break;
                        case '2':
                            echo "Second";
                        break;
                        case '3':
                            echo "Third";
                        break;
                        case '4':
                            echo "Fourth";
                        break;
                    }
                    ?>
                    </td>
                    <td class="py-0 px-1"><?php echo $row['name'] ?></td>
                    <td class="py-0 px-1"><?php echo $row['hps'] ?></td>
                    <td class="text-center py-0 px-1">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['assessment_id'] ?>' href="./manage_assessments.php">Edit</a></li>
                            <li><a class="dropdown-item delete_data" data-id = '<?php echo $row['assessment_id'] ?>' data-name = '<?php echo $row['class']." - ".$row['name'] ?>' href="javascript:void(0)">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
               
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New Assessment In Class',"manage_assessment.php")
        })
        $('.edit_data').click(function(){
            uni_modal('Edit Assessment Details In Class',"manage_assessment.php?id="+$(this).attr('data-id'))
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b> from list?",'delete_data',[$(this).attr('data-id')])
        })
        $('table td,table th').addClass('align-middle')
        $('table').dataTable({
            columnDefs: [
                { orderable: false, targets:4 }
            ]
        })
    })
    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'./Actions.php?a=delete_assessment',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert("An error occurred.")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
</script>