<?php
require_once("includes/initialize.php");
$res = array();
$machine_id = $_POST['machine_id'];
$result = Machinary::find_by_id($machine_id);
$res['type'] = $result->type;
$res['model'] = $result->model;
$res['darta_no'] = $result->darta_no;
echo json_encode($res);exit;