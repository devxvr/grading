<?php
session_start();
     
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'teacher_list'){
   header('location: ./login.php');
}

$title = 'Section';
require_once('../includes/head.php');
require_once('../includes/database.php'); 

?>

<body>
    <?php require_once('../includes/sidebar.admin.php'); ?>
    <div class="main p-3">
        <div class="content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><h2 align="center">All Section</h2></strong>
                    </div>
                    <?php
                    require_once './section-class.php';
        
                    $section = new section();

                    $sectionArray = $section->show();
                    $counter = 1;
                        
                ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="bootstrap-data-table" class="table text-center table-hover table-striped table-bordered">
                                <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Grade Level</th>
                                <th scope="col">Section</th>
                                <th scope="col" width="5%">Action</th>
                            </tr>
                                </thead>
                                <tbody>
                                <?php
                        if ($sectionArray) {
                            foreach ($sectionArray as $item) {
                    ?>
                            <tr>
                                <td>
                                    <?= $counter ?>
                                </td>
                                <td>
                                    <?= $item['gradelvl'] ?>
                                </td>
                                <td>
                                    <?= $item['section'] ?>
                                </td>
                                <td class="text-center">
                                    <a href="edit_section.php?id=<?= $item['section_id'] ?>"><i class="lni lni-pencil" aria-hidden="true" style="color: black;">
                                                        </i></a>
                                                        <a href="deletesection.php?section_id=<?= $item['section_id'] ?>"><i class="lni lni-trash-can" aria-hidden="true" style="color: black;"></i></a>

                                </td>

                                <?php
                                $counter++;
                            }
                        }
                    ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .content -->
</div>
</body>
<?php require_once('../includes/script.js.php'); ?>
</html>
