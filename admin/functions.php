<?php
function save_component($db) {
    extract($_POST);
    if (empty($id)) {
        $sql = "INSERT INTO `grading_components` (`name`) VALUES (:name)";
        $stmt = $db->connect()->prepare($sql);
        $stmt->bindParam(':name', $name);
    } else {
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id'))) {
                if (!empty($data)) $data .= ", ";
                $data .= "`{$k}` = :{$k}";
            }
        }
        $sql = "UPDATE `grading_components` SET {$data} WHERE `component_id` = :id";
        $stmt = $db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
    }

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $resp['status'] = "success";
        $resp['msg'] = empty($id) ? "Component successfully saved." : "Component successfully updated.";
    } else {
        $resp['status'] = "failed";
        $resp['msg'] = empty($id) ? "Saving New Component Failed." : "Updating Component Failed.";
        $resp['error'] = $stmt->errorInfo(); // Capture error info
    }

    return json_encode($resp);
}

function delete_component($db) {
    extract($_POST);

    $sql = "DELETE FROM `grading_components` WHERE component_id = :id";
    $stmt = $db->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $resp['status'] = 'success';
        $_SESSION['flashdata']['type'] = 'success';
        $_SESSION['flashdata']['msg'] = 'Component successfully deleted.';
    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $stmt->errorInfo(); // Capture error info
    }

    return json_encode($resp);
}
?>