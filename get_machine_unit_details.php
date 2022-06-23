<?php
require_once 'includes/initialize.php';
$res=array();
$category = $_POST['category'];
$item_id = $_POST['item_id'];
if($category==1)
{
    $result=  Spentitem::find_by_id($item_id);
    $html = Unit::getName($result->unit_id);
}
else
{
    $result= Notspentitem::find_by_id($item_id);
    $html = Unit::getName($result->unit_id);
}

$res['html'] = $html;
echo json_encode($res);exit;