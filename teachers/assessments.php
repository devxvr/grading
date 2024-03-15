
<?php
include_once './manage_assessments.php';
include_once './assessment-class.php';

$database = new Database(); 
$conn = $database->connect();

$assessment = new assessment_list();

// Fetch assessment data from the database
$assessmentArray = $assessment->show();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.css">
    <title>Assessment</title>
</head>
<body>


<main class="col-md-10 ms-sm-auto col-lg-12 py-5">
    <a href="./manage_assessments.php">Add New</a>
    <div id="table-container">
        <table id="user" class="table table-striped table-sm" style="margin-left:50px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Class</th>
                    <th scope="col">Component</th>
                    <th scope="col">Quarter</th>
                    <th scope="col">Name</th>
                    <th scope="col">HPS</th>
                    <th scope="col" width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT a.*, 
                               CONCAT(s.name, ' ', c.grade, ' - ', c.section) AS class, 
                               cc.name AS component 
                        FROM assessment_list a 
                        INNER JOIN class_list c ON a.class_id = c.class_id 
                        INNER JOIN subjects s ON c.subject_id = s.subject_id 
                        INNER JOIN grading_components cc ON a.component_id = cc.component_id 
                        ORDER BY class ASC, component ASC, quarter ASC, a.name ASC, a.hps ASC";

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
</main>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
