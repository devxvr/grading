<?php

require_once("./includes/database.php");
require_once("./percentage-class.php");
require_once("./actions.php");
$database = new Database(); 
$conn = $database->connect();
$errors = array();

if(isset($_GET['id'])){
    $stmt = $conn->prepare("SELECT * FROM `component_subject_percentage` where subject_id = :subject_id");
    $stmt->bindParam(':subject_id', $_GET['id']);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['save_percentage'])) {
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
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO component_subject_percentage (subject_id, component_id, percentage) VALUES (:subject_id, :component_id, :percentage)");
            foreach ($component_ids as $component_id) {
                $stmt->bindParam(':subject_id', $subject_id);
                $stmt->bindParam(':component_id', $component_id);
                $stmt->bindParam(':percentage', $percentage);
                $stmt->execute();
            }
            $conn->commit();
            $resp['status'] = 'success';
            $resp['msg'] = 'Percentage added successfully.';
        } catch (Exception $e) {
            $conn->rollBack();
            $errors[] = "An error occurred while saving data: " . $e->getMessage();
            $resp['status'] = 'error';
            $resp['msg'] = 'An error occurred while saving data: ' . $e->getMessage();
        }
    } else {
        $resp['status'] = 'error';
        $resp['msg'] = implode("\n", $errors);
    }

    header('Content-Type: application/json');
    echo json_encode($resp);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./ccs/dashboard.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>
<div class="container-fluid">
<form action="actions.php?a=save_percentage" id="percentage-form" method="post">
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
                    $total += isset($data[$row['component_id']]) ? floatval($data[$row['component_id']]) : 0;
                ?>
                <tr>
                    <td class="py-0 px-1"><input type="hidden" name="component_id[]" value='<?php echo $row['component_id'] ?>'><?php echo $row['name'] ?></td>
                    <td class="py-0 px-1">
                        <input type="number" step="any" class="form-control form-control-sm rounded-0 w-100 text-end" name="percentage[]" value="<?php echo (isset($data[$row['component_id']])) ? $data[$row['component_id']] : 0 ?>" required>
                    </td>
                </tr>
                <?php endwhile; ?>
                <tfoot>
                    <tr>
                        <th class="py-0 px-1 text-center">Total</th>
                        <th class="py-0 px-1 text-center text-end" id="total"><?php echo strval($total) ?>%</th>
                    </tr>
                </tfoot>
            </tbody>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    $('input[name="percentage[]"]').on('input', function(){
        var total = 0;
        $('input[name="percentage[]"]').each(function(){
            var perc = parseFloat($(this).val()) || 0;
            total += perc;
        });
        $('#total').text(total.toFixed(2) + "%");
    });

    $('#percentage-form').submit(function(e){
        e.preventDefault();
        var total = parseFloat($('#total').text().replace('%', ''));
        if(total !== 100){
            alert("Total Percentage must be 100%");
            return false;
        }
        var formData = $(this).serialize();
        $.ajax({
            url: './actions.php?a=save_percentage',
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function(resp) {
                if (resp.status == 'success') {
                    alert(resp.msg); 
                    window.location.reload(); 
                } else {
                    alert('Error: ' + resp.msg); 
                }
            },
            error: function(err) {
                console.log(err);
                alert('An error occurred.');
            }
        });
    });
});

</script>

