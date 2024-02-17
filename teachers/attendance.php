<!DOCTYPE html>
<html lang="en">

<?php
    $title = 'Home';
    require_once('../includes/head.php');
?>

<body>
<?php
    require_once('../includes/sidebar.php');
?>  

<div class="main p-3">
    <div class="text">
        <h1>
            Grade 10
        </h1>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="button">New Attendance</button>
            </div>
            
    
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                <th scope="col">ID NO.</th>
                <th scope="col">Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Age</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td class="text-center">
                    <a href="#">
                        <i class="lni lni-pencil" aria-hidden="true">
                        </i>
                    </a>
                </td>
                </tr> 
            </tbody>
        </table>
    
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
    <main>
        
    </main>
</body>

<?php
    
    require_once('../includes/sidebarjs.php');
?>
</html>