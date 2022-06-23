<?php
require_once("includes/initialize.php");
 $res = array();
$counter=$_POST['counter'];
$item_id=$_POST['item_id'];
$quantity=$_POST['quantity'];
$item_result=  ItemStock::find_by_id($item_id);
if($quantity > $item_result->stock)
{
    $html="Quanitity is Greater than Stock..!!";
}
$res['output']     =    $html;
echo json_encode($res);exit;

