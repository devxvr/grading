<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<?php
    require_once('../includes/sidebar.php');
?>




<body>
<?php
include_once './manage_assessments(copy).php';
include_once './assessment-class.php';

$database = new Database(); 
$conn = $database->connect();

$assessment = new assessment_list();

// Fetch assessment data from the database
$assessmentArray = $assessment->show();
?>


<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
