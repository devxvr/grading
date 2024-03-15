<?php
    $title = 'Home';
    require_once('../includes/head.php');
    require_once('../includes/student-class.php'); 

    
    $student = new Student();

    
    $students = $student->fetchAllStudents();

    function calculateAge($birthdate) {
        
        $today = new DateTime(date('Y-m-d'));
        $birthDate = new DateTime($birthdate);
    
        $diff = $today->diff($birthDate);
    
        return $diff->y;
    }

?>

<body>
<?php
    require_once('../includes/sidebar.php');
?>  

<div class="main p-3">
    
<div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Master List</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div class="card-header">
             <strong class="card-title"><h2 align="center">Master List</h2></strong>
        </div>
    <div class="card-body">
    <div class="cont">
        <table class="table table-striped table-hover text-center table-bordered" style="border: 1px black;">
            <thead>
                <tr>
                <th scope="col">Id No.</th>
                <th scope="col">Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                <th scope="row"><?= $student['student_id'] ?></th>
                <td><?= $student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname'] . ' ' . $student['suffix'] ?></td>
                <td><?= $student['sex'] ?></td>
                <td><?= calculateAge($student['birthday']) ?></td> <!-- You need to define the calculateAge function -->
                <td><?= $student['address'] ?></td>
                <td><?= $student['contact'] ?></td>
                <td class="text-center">
                    <a href="#">
                        <i class="lni lni-pencil" aria-hidden="true" style="color: black;"></i>
                    </a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
    </div>
                                                                             
    </div>
</div>

</body>

<?php
    require_once('../includes/script.js.php');
?>
</html>
