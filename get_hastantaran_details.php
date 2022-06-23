<?php
require_once("includes/initialize.php");
 $res = array();
$counter=$_POST['counter'];
$item_id=$_POST['item_id'];
$category=$_POST['category'];
//$res['html']     =   $category;
//echo json_encode($res);exit;
if($category == 1)
{
    $result= Spentitem::find_by_id($item_id);
    $budget_title_id     = $result->budget_title_id;
    $specification       = $result->specification;
}
else
{
    $result=  Notspentitem::find_by_id($item_id);
    $budget_title_id=$result->budget_title_id;
     $specification=$result->specification;
}
if($category==1)
{
    $html="खर्च हुने ";
}
else
{
    $html= "खर्च नहुने";
}
$data= ItemStock::find_by_sql("select * from item_stock where item_id=".$item_id." and category=".$category." limit 1");
$a = array_shift($data);
$output     = $a->khata_id;
//$html       = $budget_title_id;
$spec       = $specification;
$res['stock_item_id']           =    $output;
$res['budget_title_id']   =    $html;
$res['specification']     =    $spec;
echo json_encode($res);exit;