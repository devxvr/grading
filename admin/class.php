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
<?php
require_once './manage_class.php';
require_once './class-class.php';

$database = new Database(); 
$conn = $database->connect();

$class = new class_list();

// Fetch class data from the database along with subject name
$sql = "SELECT c.class_id, c.grade, c.section, s.name AS subject_name 
FROM class_list c 
INNER JOIN subjects s ON c.subject_id = s.subject_id";

$stmt = $conn->query($sql);
$classArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <div id="table-container">
        <table id="user" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Section</th>
                    <th scope="col" width="5%">Action</th>
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
</body>
</html>
