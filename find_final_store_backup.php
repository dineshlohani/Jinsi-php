<?php
include 'includes/initialize.php';
$res= array();
$item_id = $_POST['item_id'];
$category= $_POST['category'];
$rate    = $_POST['rate'];
$date    = $_POST['date'];
$check_stock = get_item_rate($item_id, $category, $rate, $date);
$res['check']= $check_stock[0];
$res['msg']  = $check_stock[1];
$res['stock']= $check_stock[2];
$res['sql']= $check_stock[4];
echo json_encode($res);exit;
?>