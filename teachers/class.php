



<?php
require_once './class-class.php';
require_once './section-class.php'; 

$database = new Database(); 
$conn = $database->connect();

$class = new class_list();
$section = new Section(); 


$sql = "SELECT c.class_id, c.grade, c.section, s.name AS subject_name 
        FROM class_list c 
        INNER JOIN subjects s ON c.subject_id = s.subject_id";

$stmt = $conn->query($sql);


if (!$stmt) {
    echo "Error executing SQL query: " . $conn->errorInfo()[2];
    exit;
}

$classArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($classArray)) {
    echo "No classes found";
    exit;
}

$grades = $section->fetchAllGrades();
$sections = $section->fetchAllSections();
?>


<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<body>
<?php
    require_once('../includes/sidebar.php');
?> 
<div class="main p-3">

    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Calendar</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
        <?php
    require_once './manage_class.php';
    ?>
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
        </div>
    </div>
</div>
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
<script>
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
<?php
    
    require_once('../includes/script.js.php');
?>
</html>