<?php
require_once 'includes/initialize.php';
$res = array();
$description_id = $_POST['description_id'];
$new_id = BillAmdani::get_max_description_id($description_id);
$res['new_id'] = $new_id;
echo json_encode($res);exit;
?>