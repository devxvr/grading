<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<?php
    require_once('../includes/sidebar.php');
?>

<?php
require_once './assessment-class.php'; // Include assessment class definition

// Assuming the Database class and its connect method are defined in another file

// Check if form is submitted for adding or editing assessment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assessment = new assessment_list();

    // Assign form data to assessment object properties
    $assessment->class_id = $_POST['class_id'];
    $assessment->component_id = $_POST['component_id'];
    $assessment->quarter = $_POST['quarter'];
    $assessment->name = $_POST['name'];
    $assessment->hps = $_POST['hps'];

    // Check if assessment ID is provided for editing
    if (!empty($_POST['assessment_id'])) {
        $assessment->assessment_id = $_POST['assessment_id'];
        // Call update method
        if ($assessment->edit()) {
            echo "Assessment updated successfully.";
        } else {
            echo "Failed to update assessment.";
        }
    } else {
        // Call add method
        if ($assessment->add()) {
            echo "Assessment added successfully.";
        } else {
            echo "Failed to add assessment.";
        }
    }
}

// Fetch necessary data from the database to populate dropdowns or for editing purposes
$database = new Database();
$conn = $database->connect();

// Fetch class list
$classList = $conn->query("SELECT * FROM class_list")->fetchAll(PDO::FETCH_ASSOC);

// Fetch grading components list
$componentList = $conn->query("SELECT * FROM grading_components")->fetchAll(PDO::FETCH_ASSOC);

// Fetch subjects list
$subjectList = $conn->query("SELECT * FROM subjects")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <title>Manage Assessments</title>
</head>
<body>
<div class="main p-3">
        <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Add/Edit Assessment</h2>
        </div>
    </div>
    <div class="card mb-3 mt-3 p-3">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Hidden field for assessment ID if editing -->
            <input type="hidden" name="assessment_id" value="">
            <div class="mb-2">
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" id="class_id" class="form-select">
                    <?php foreach ($classList as $class): ?>
                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['grade'] . ' - ' . $class['section']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="component_id" class="form-label">Component</label>
                <select name="component_id" id="component_id" class="form-select">
                    <?php foreach ($componentList as $component): ?>
                        <option value="<?php echo $component['component_id']; ?>"><?php echo $component['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="subject_id" class="form-label">Subject</label>
                <select name="subject_id" id="subject_id" class="form-select">
                    <?php foreach ($subjectList as $subject): ?>
                        <option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="quarter" class="form-label">Quarter</label>
                <select name="quarter" id="quarter" class="form-select">
                    <option value="1">First</option>
                    <option value="2">Second</option>
                    <option value="3">Third</option>
                    <option value="4">Fourth</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="mb-2">
                <label for="hps" class="form-label">HPS</label>
                <input type="number" name="hps" id="hps" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <div class="btn btn-primary">
        <a href="./manage_assessments(copy).php" style="text-decoration: none; color:white;">Add New</a>
        </div>
    <div id="table-container">
    <div class="card mb-3 mt-3 p-3">
        <table id="user" class="table table-striped table-sm" style="margin-left:0px;">
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
                                <li><a class="dropdown-item edit_data" data-id = '<?php echo $row['assessment_id'] ?>' href="./manage_assessments(copy).php">Edit</a></li>
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
    </div>
</div>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
