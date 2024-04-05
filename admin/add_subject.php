<?php
$title = 'Section';
require_once '../includes/head.php';
?>

<body>
<?php
require_once('../includes/sidebar.admin.php');
?>  

<div class="main p-3">
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>New Subject</h2>
        </div>
    </div>
    <div class="card mb-3 mt-4">
        <div class="card-header">
            <strong class="card-title"><h2 align="center">Add New Subject</h2></strong>
        </div>
        <div class="card-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <form action="" id="subject-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($subject_id) ? $subject_id : '' ?>">
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="control-label">Subject Name</label>
            <input type="text" name="name" autofocus id="name" required class="form-control form-control-sm rounded-0"
              value="<?php echo isset($name) ? $name : '' ?>">
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" value="Save Subject" id="save_subject" name="save_subject" class="btn btn-success" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
        </div>
    </div>
</div>
</body>

<?php
require_once('../includes/script.js.php');
?>
<!--
   
<div class="modal fade" id="add_subject_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add New Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="" id="subject-form" method="post">
        <input type="hidden" name="id" value="<?php echo isset($subject_id) ? $subject_id : '' ?>">
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="control-label">Subject Name</label>
            <input type="text" name="name" autofocus id="name" required class="form-control form-control-sm rounded-0"
              value="<?php echo isset($name) ? $name : '' ?>">
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" value="Save Subject" id="save_subject" name="save_subject" class="btn btn-success" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
-->
<script src="../assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
