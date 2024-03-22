<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}
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
            <h2>Classes</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div class="card-header">
             <strong class="card-title"><h2 align="center">Class List</h2></strong>
        </div>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="button">New Attendance</button>
                <button class="btn btn-primary me-md-2" type="button">Class Record</button>
            </div>
            
    <div class="cont">
    <table class="table table-striped table-hover text-center table-bordered mt-3" style="border: 1px black;">
            <thead>
                <tr>
                <th scope="col">Id No.</th>
                <th scope="col">Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Age</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">
                    <a href="#">
                        <i class="lni lni-pencil" aria-hidden="true" style="color: black;">
                        </i>
                    </a>
                </td>
                </tr>
                
                
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

</div>
    <main>
        
    </main>
</body>

<?php
    
    require_once('../includes/script.js.php');
?>
</html>
