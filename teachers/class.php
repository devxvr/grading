<?php
require_once './manage_class.php';
require_once './class-class.php';
require_once './section-class.php'; 

$database = new Database(); 
$conn = $database->connect();

$class = new class_list();
$section = new Section(); // Create an instance of the Section class

// Fetch class data from the database along with subject name
$sql = "SELECT c.class_id, c.grade, c.section, s.name AS subject_name 
        FROM class_list c 
        INNER JOIN subjects s ON c.subject_id = s.subject_id";

$stmt = $conn->query($sql);

// Check for errors during SQL execution
if (!$stmt) {
    echo "Error executing SQL query: " . $conn->errorInfo()[2];
    exit;
}

$classArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if $classArray is empty
if (empty($classArray)) {
    echo "No classes found";
    exit;
}

// Fetch all grades and sections
$grades = $section->fetchAllGrades();
$sections = $section->fetchAllSections();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.css">
    <title>Classes</title>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div id="table-container">
        <table id="class" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Section</th>
                    <th scope="col" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($classArray as $row) {
                    ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= $row['subject_name'] ?></td>
                        <td><?= $row['grade'] ?></td>
                        <td><?= $row['section'] ?></td>
                        <td class="text-center">
                            <a href="edit_class.php?id=<?= $row['class_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger delete-class" data-id="<?= $row['class_id'] ?>">Delete</button>
                        </td>
                    </tr>
                    <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script>
    // JavaScript to handle class deletion
    document.querySelectorAll('.delete-class').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this class?')) {
                const classId = this.getAttribute('data-id');
                window.location.href = `delete_class.php?id=${classId}`;
            }
        });
    });
</script>
</body>
</html>
