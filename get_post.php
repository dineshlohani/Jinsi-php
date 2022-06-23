<?php 
require_once("includes/initialize.php"); 
$res=array();
$worker_id=$_POST['worker_id'];
$data= Workers::find_by_id($worker_id);
$html = $data->post;
$res['html']=$html;
echo json_encode($res);exit;
?>