<?php
require_once 'includes/initialize.php';
$res=array();

$spent_item_id=$_POST['spent_item_id'];

$reduce_amount=$_POST['reduce_amount'];

$data=  ItemStock::find_by_id($spent_item_id);

$total_amount = $data->rate * $reduce_amount;

$res['html']=$total_amount;

echo json_encode($res);exit;