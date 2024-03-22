<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}


require_once './class-class.php'; 
require_once './assessment-class.php'; 
require_once './mark-class.php'; 
require_once '../includes/student-class.php'; 

$classList = new class_list();
$assessmentList = new assessment_list();
$markList = new MarkList();
$student = new student();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_marks'])) {
    
    $class_id = $_POST['class_id'];
    $assessment_id = $_POST['assessment_id'];
    $student_id = $_POST['student_id'];
    $mark = $_POST['mark'];

    
    $markList->modifyMark($student_id, $class_id, $assessment_id, $mark);

    $assessments = $assessmentList->show($_GET['class_id'] ?? null); 

if ($student_details) { 
    echo "<tr>";
    echo "<td>{$student_details['firstname']} {$student_details['lastname']}</td>";
    echo "<td><input type='number' step='any' class='form-control form-control-sm rounded-0 w-100 text-end' name='mark[{$mark['student_id']}]' value='{$mark['mark']}' required></td>";
    echo "</tr>";
} else {
    
}
$marks_qry = $markList->fetchMarks($_GET['class_id'], $_GET['section'], $_GET['assessment_id']);


}



$classes = $classList->show();
$assessments = $assessmentList->show($_GET['class_id'] ?? null);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.css">
    <title>Class Assessment Marks</title>
</head>
<body>
<div class="container">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Class Assessment Marks</h3>
    </div>
    <hr>
    <form action="" method="GET" id="marks-form">
        <div class="row align-items-end">
            <div class="form-group col-md-4">
                <label for="class_id" class="control-label">Class</label>
                <select name="class_id" id="class_id" class="form-select form-select-sm rounded-0" required>
                    <option disabled <?php echo !isset($_GET['class_id']) ? 'selected' : ''; ?>>Please Select Here</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?php echo $class['class_id']; ?>" <?php echo (isset($_GET['class_id']) && $_GET['class_id'] == $class['class_id']) ? 'selected' : ''; ?>><?php echo $class['grade'] . ' - ' . $class['section']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="assessment_id" class="control-label">Assessment</label>
                <select name="assessment_id" id="assessment_id" class="form-select form-select-sm rounded-0" required>
                    <option disabled <?php echo !isset($_GET['assessment_id']) ? 'selected' : ''; ?>>Please Select Here</option>
                    <?php foreach ($assessments as $assessment): ?>
                        <option value="<?php echo $assessment['assessment_id']; ?>" <?php echo (isset($_GET['assessment_id']) && $_GET['assessment_id'] == $assessment['assessment_id']) ? 'selected' : ''; ?>><?php echo $assessment['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <button class="btn btn-primary rounded-0" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <hr>
    <?php if(isset($_GET['class_id']) && isset($_GET['assessment_id'])): ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>">
        <input type="hidden" name="assessment_id" value="<?php echo $_GET['assessment_id']; ?>">
        <div class="row">
           
            <div class="col-md-12 py-3">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Mark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $marks_qry = $markList->fetchMarks($_GET['class_id'], $_GET['assessment_id']); 
                        if (!empty($marks_qry)) {
                            foreach ($marks_qry as $mark) {
                                $student_details = $student->fetch($mark['student_id']);
                                echo "<tr>";
                                echo "<td>{$student_details['firstname']} {$student_details['lastname']}</td>";
                                echo "<td><input type='number' step='any' class='form-control form-control-sm rounded-0 w-100 text-end' name='mark[{$mark['student_id']}]' value='{$mark['mark']}' required></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No marks recorded for this assessment</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="update_marks" class="btn btn-primary">Update Marks</button>
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
