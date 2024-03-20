<?php
session_start();

if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); // 
require_once './class-class.php';
require_once './section-class.php'; 

$sectionObj = new Section(); 


$grades = $sectionObj->fetchAllGrades();
$sections = $sectionObj->fetchAllSections();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $class = new class_list();

        $class->subject_id = $_POST['subject'];
        $class->grade = $_POST['grade'];
        $class->section = $_POST['section'];

        
        if ($class->add()) {
            header("Location: class.php");
            exit();
        } else {
            echo "Failed to add class.";
        }
    }

    

} else {

    $database = new Database(); 
    $conn = $database->connect();

    
    $sql = "SELECT * FROM subjects";
    $stmt = $conn->query($sql);
    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $sql = "SELECT gradelvl FROM section";
    $stmt = $conn->query($sql);
    $grades = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $sql = "SELECT section FROM section";
    $stmt = $conn->query($sql);
    $sections = $stmt->fetchAll(PDO::FETCH_COLUMN);

    
    if (!$subjects) {
        echo "Error fetching subjects.";
    }
}
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div class="container">
        <h2>Add New Class</h2>
        
        <form action="./manage_class.php" method="POST">
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <?php
                        
                        foreach ($subjects as $subject) {
                            echo "<option value=\"{$subject['subject_id']}\">{$subject['name']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <select class="form-select" id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <?php
                        
                        foreach ($grades as $grade) {
                            echo "<option value=\"{$grade}\">{$grade}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <select class="form-select" id="section" name="section" required>
                    <option value="">Select Section</option>
                    <?php
                            
                            foreach ($sections as $section) {
                                echo "<option value=\"{$section}\">{$section}</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="action" value="add">Add Class</button>
            </form>
        </div>
    </main>
</body>
</html>

                           