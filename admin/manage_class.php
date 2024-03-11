<?php
require_once './class-class.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

    if ($_POST['action'] == 'add') {
       
        $class = new class_list();

        
        $class->subject_id = $_POST['subject']; 
        $class->grade = $_POST['grade'];
        $class->section = $_POST['section'];

        // Add the class
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
                <input type="text" class="form-control" id="grade" name="grade" required>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" required>
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="add">Add Class</button>
        </form>
       
    </div>
    <div id="table-container">
    
    </div>
</main>
