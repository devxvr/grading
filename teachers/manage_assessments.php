<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}


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
<main class="col-md-10 ms-sm-auto col-lg-12 py-5">
    <div class="container">
        <h2>Add/Edit Assessment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Hidden field for assessment ID if editing -->
            <input type="hidden" name="assessment_id" value="">
            <div class="mb-3">
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" id="class_id" class="form-select">
                    <?php foreach ($classList as $class): ?>
                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['grade'] . ' - ' . $class['section']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="component_id" class="form-label">Component</label>
                <select name="component_id" id="component_id" class="form-select">
                    <?php foreach ($componentList as $component): ?>
                        <option value="<?php echo $component['component_id']; ?>"><?php echo $component['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="subject_id" class="form-label">Subject</label>
                <select name="subject_id" id="subject_id" class="form-select">
                    <?php foreach ($subjectList as $subject): ?>
                        <option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quarter" class="form-label">Quarter</label>
                <select name="quarter" id="quarter" class="form-select">
                    <option value="1">First</option>
                    <option value="2">Second</option>
                    <option value="3">Third</option>
                    <option value="4">Fourth</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="hps" class="form-label">HPS</label>
                <input type="number" name="hps" id="hps" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
