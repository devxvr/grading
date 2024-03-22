<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}


require_once('../includes/database.php');
require_once './component_class.php';


$database = new Database(); 
$conn = $database->connect(); 

if (isset($_REQUEST['save_component'])) {
    $name = $_REQUEST['name'];

    
    if (empty($name)) {
        $errors[] = "Component is required.";
    }
    
    if (empty($errors)) {
        
        $query = "INSERT INTO grading_components (name) VALUES (:name)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $result = $stmt->execute();
        
        if (!$result) {
            die("Query failed: " . $stmt->errorInfo()[2]); // Handle query execution error
        }
        header("Location: {$_SERVER['PHP_SELF']}?success=true");
        exit();
    }
}
if (isset($_REQUEST['save_subject'])) {
    $name = $_REQUEST['name'];

    // Validation: Check if fields are empty
    if (empty($name)) {
        $errors[] = "Subject is required.";
    }
    
    if (empty($errors)) {
        // If no errors, proceed with inserting into the database
        $query = "INSERT INTO subjects (name) VALUES (:name)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $result = $stmt->execute();
        
        if (!$result) {
            die("Query failed: " . $stmt->errorInfo()[2]); // Handle query execution error
        }
        header("Location: {$_SERVER['PHP_SELF']}?success=true");
        exit();
    }
}
?>

<?php
    $title = 'Maintenance';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.php');
?> 
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Maintenance</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
            
        <div class="card h-100 d-flex flex-column">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Maintenance</h3>
            <div class="card-tools align-middle">
            </div>
        </div>

        <div class="card-body flex-grow-1">
            <div class="col-12 h-100">
                <div class="row h-100">
                    <div class="col-md-6 h-100 d-flex flex-column">
                        <div class="w-100 d-flex border-bottom border-dark py-1 mb-1">
                            <div class="fs-5 col-auto flex-grow-1"><b>Component List</b></div>
                            <div class="col-auto flex-grow-0 d-flex justify-content-end">
                                <button id="manage_components_btn" class="btn btn-dark btn-sm bg-gradient rounded-2"
                                    data-bs-toggle="modal" data-bs-target="#add_component_modal"><span
                                        class="fa fa-plus"></span></button>
                            </div>
                        </div>
                        <div class="h-100 overflow-auto border rounded-1 border-dark">
                            <ul class="list-group">
                                <?php 
                            $dept_qry = $conn->query("SELECT * FROM `grading_components` order by `name` asc");
                            while($row = $dept_qry->fetch(PDO::FETCH_ASSOC)):
                            ?>
                                <li class="list-group-item d-flex">
                                    <div class="col-auto flex-grow-1">
                                        <?php echo $row['name'] ?>
                                    </div>
                                    <div class="col-auto d-flex justify-content-end">
                                        <a href="edit_component.php?id=<?php echo $row['component_id'] ?>"
                                            class="edit_component btn btn-sm btn-primary bg-gradient py-0 px-1 me-1"
                                            title="Edit Component Details"
                                            data-id="<?php echo $row['component_id'] ?>"
                                            data-name="<?php echo $row['name'] ?>"><span class="fa fa-edit"></span></a>
                                        <a href="delete_component.php?id=<?php echo $row['component_id'] ?>"
                                            class="delete_component btn btn-sm btn-danger bg-gradient py-0 px-1"
                                            title="Delete Component"
                                            data-id="<?php echo $row['component_id'] ?>"
                                            data-name="<?php echo $row['name'] ?>"><span class="fa fa-trash"></span></a>
                                    </div>
                                </li>
                                <?php endwhile; ?>
                                <?php if(!$dept_qry->fetch(PDO::FETCH_ASSOC)): ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 h-100 d-flex flex-column">
                        <div class="w-100 d-flex border-bottom border-dark py-1 mb-1">
                            <div class="fs-5 col-auto flex-grow-1"><b>Subject List</b></div>
                            <div class="col-auto flex-grow-0 d-flex justify-content-end">
                                <button id="manage_subject_btn" class="btn btn-dark btn-sm bg-gradient rounded-2"
                                    data-bs-toggle="modal" data-bs-target="#add_subject_modal"><span
                                        class="fa fa-plus"></span></button>
                            </div>
                        </div>
                        <div class="h-100 overflow-auto border rounded-1 border-dark">
                            <ul class="list-group">
                                <?php 
                            $dept_qry = $conn->query("SELECT * FROM `subjects` order by `name` asc");
                            while($row = $dept_qry->fetch(PDO::FETCH_ASSOC)):
                            ?>
                                <li class="list-group-item d-flex">
                                    <div class="col-auto flex-grow-1">
                                        <?php echo $row['name'] ?>
                                    </div>
                                    <div class="col-auto d-flex justify-content-end">
                                        <a href="add_percentage.php?id=<?php echo $row['subject_id']?>"
                                            class="manage_percentage btn btn-sm btn-primary bg-gradient py-0 px-1 me-1"
                                            title="Manage Subject's Component Percentage"
                                            data-id="<?php echo $row['subject_id'] ?>"
                                            data-name="<?php echo $row['name'] ?>"><span
                                                class="fa fa-th-list"></span></a>
                                        <a href="edit_subject.php?id=<?php echo $row['subject_id'] ?>"
                                            class="edit_component btn btn-sm btn-primary bg-gradient py-0 px-1 me-1"
                                            title="Edit Subject Details"
                                            data-id="<?php echo $row['subject_id'] ?>"
                                            data-name="<?php echo $row['name'] ?>"><span class="fa fa-edit"></span></a>
                                        <a href="delete_subject.php?id=<?php echo $row['subject_id'] ?>"
                                            class="delete_component btn btn-sm btn-danger bg-gradient py-0 px-1"
                                            title="Delete Subject"
                                            data-id="<?php echo $row['subject_id'] ?>"
                                            data-name="<?php echo $row['name'] ?>"><span class="fa fa-trash"></span></a>
                                    </div>
                                </li>
                                <?php endwhile; ?>
                                <?php if(!$dept_qry->fetch(PDO::FETCH_ASSOC)): ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

<?php require_once 'add_component.php'; ?>

    
    <?php require_once 'add_subject.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>