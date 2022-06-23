<?php
require_once("includes/initialize.php");
 $res = array();
$counter=$_POST['counter'];
$item_id=$_POST['item_id'];
$quantity=$_POST['quantity'];
$item_result=  ItemStock::find_by_id($item_id);
$rate=$item_result->rate * $quantity;
$html       = $rate;
$res['html']     =    $html;
echo json_encode($res);exit;

