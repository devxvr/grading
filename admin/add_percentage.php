

<?php
require_once("../includes/database.php");
require_once("./percentage-class.php");

$database = new Database(); 
$conn = $database->connect();
$errors = array();

$subject_id = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch existing percentages for the subject
$data = [];
if($subject_id) {
    $stmt = $conn->prepare("SELECT * FROM component_subject_percentage WHERE subject_id = :subject_id");
    $stmt->execute(['subject_id' => $subject_id]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check if there are existing entries for the subject
$existing_entries = count($data) > 0;

if (isset($_POST['save_percentage'])) {
    try {
        $conn->beginTransaction();

        $percentage = $_POST['percentage'];
        $subject_id = $_POST['id'];
        $component_ids = $_POST['component_id'];

        if (empty($percentage)) {
            $errors[] = "Percentage is required.";
        }
        if (empty($subject_id)) {
            $errors[] = "Subject ID is required.";
        }

        foreach ($component_ids as $component_id) {
            $stmt_check_component = $conn->prepare("SELECT COUNT(*) FROM `grading_components` WHERE `component_id` = :component_id");
            $stmt_check_component->bindParam(':component_id', $component_id);
            $stmt_check_component->execute();
            $component_exists = $stmt_check_component->fetchColumn();

            if (!$component_exists) {
                $errors[] = "Component with ID $component_id does not exist.";
            }
        }

        if (empty($errors)) {
            
            if ($existing_entries) {
                $stmt_delete = $conn->prepare("DELETE FROM component_subject_percentage WHERE subject_id = :subject_id");
                $stmt_delete->execute(['subject_id' => $subject_id]);
            }

            $stmt = $conn->prepare("INSERT INTO component_subject_percentage (subject_id, component_id, percentage) VALUES (:subject_id, :component_id, :percentage)");
            foreach ($component_ids as $index => $component_id) {
                $percentage_value = $percentage[$index];
                $stmt->bindParam(':subject_id', $subject_id);
                $stmt->bindParam(':component_id', $component_id);
                $stmt->bindParam(':percentage', $percentage_value);
                $stmt->execute();
            }
            
            $conn->commit();
            $resp['status'] = 'success';
            $resp['msg'] = 'Percentage added successfully.';
            header("Location: maintenance.php");
            exit();
        } else {
            $resp['status'] = 'error';
            $resp['msg'] = implode("\n", $errors);
        }
    } catch (Exception $e) {
        
        $conn->rollBack();
        $errors[] = "An error occurred while saving data: " . $e->getMessage();
        $resp['status'] = 'error';
        $resp['msg'] = 'An error occurred while saving data: ' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($resp);
    exit();
}
?>

<?php
    $title = 'Maintenance';
    require_once('../includes/head.php');
?>
<body>
<?php
    require_once('../includes/sidebar.admin.php');
?>  
<div class="main p-3">
    
    <div class="card bg-gray-500 text-dark" style="box-shadow: 0 4px 2px -2px gray;">
        <div class="page-title mt-2 ">
            <h2>Manage Components</h2>
        </div>
    </div>
    
    <div class="card mb-3 mt-4">
        <div  div class="card-body">
            
        <div class="container-fluid">
    <form id="percentage-form" method="post" action="#">

        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
        <table class="table table-striped table-hover">
            <colgroup>
                <col width="75%">
                <col width="25%">
            </colgroup>
            <thead>
                <tr>
                    <th class="py-0 px-1 text-center">Component</th>
                    <th class="py-0 px-1 text-center">Percentage (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $component = $conn->query("SELECT * FROM `grading_components` order by component_id asc");
                $total = 0;
                while($row = $component->fetch(PDO::FETCH_ASSOC)):
                    $percentage_value = 0;
                    foreach ($data as $item) {
                        if ($item['component_id'] == $row['component_id']) {
                            $percentage_value = $item['percentage'];
                            break;
                        }
                    }
                    $total += isset($percentage_value) ? floatval($percentage_value) : 0;
                ?>
                <tr>
                    <td class="py-0 px-1"><input type="hidden" name="component_id[]" value='<?php echo $row['component_id'] ?>'><?php echo $row['name'] ?></td>
                    <td class="py-0 px-1">
                        <input type="number" step="any" class="form-control form-control-sm rounded-0 w-100 text-end percentage-input" name="percentage[]" value="<?php echo (isset($percentage_value)) ? $percentage_value : 0 ?>" required>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="py-0 px-1 text-center">Total</th>
                    <th class="py-0 px-1 text-center text-end" id="total"><?php echo strval($total) ?>%</th>
                </tr>
            </tfoot>
        </table>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="button-group">
            <button type="submit" name="save_percentage" class="btn btn-primary mt-2 mb-3 brand-bg-color" id="addStaffButton">Save Changes</button>
        </div>
    </form>
</div>

        </div>
    </div>
</div>
<script>
$(function(){
    // Update total percentage calculation on input change
    $('input[name="percentage[]"]').on('input', function(){
        var total = 0;
        $('input[name="percentage[]"]').each(function(){
            var perc = parseFloat($(this).val()) || 0;
            total += perc;
        });
        $('#total').text(total.toFixed(2) + "%");

        // Validation for total percentage equal to 100%
        if (total !== 100) {
            $('#total').addClass('text-danger');
        } else {
            $('#total').removeClass('text-danger');
        }
    });

    // Validate total percentage on form submission
    $('#percentage-form').submit(function() {
        var total = 0;
        $('input[name="percentage[]"]').each(function(){
            var perc = parseFloat($(this).val()) || 0;
            total += perc;
        });

        if (total !== 100) {
            alert('Total percentage must be 100%.');
            return false; // Prevent form submission
        }
    });
});
</script>
</body>
<?php
    
    require_once('../includes/script.js.php');
?>
</html>