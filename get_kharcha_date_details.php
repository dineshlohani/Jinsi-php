<?php
require_once 'includes/initialize.php';
$res = array();
$item_id  = $_POST['item_id'];
$category = $_POST['category'];
$date     = $_POST['date'];    
$check_date = strtotime(DateNepToEng($date));
$a=0;$b=0;
$sql    = "select * from item_stock where item_id='".$item_id."' and category='".$category."' ORDER BY stock_date_english ASC limit 1";
//$res['sql'] = $sql;
//echo json_encode($res); exit;
$result = ItemStock::find_by_sql($sql);
if(empty($result))
{
    $a=1;
   $aaa=000;
}
else
{
    $result_final = array_shift($result);
    $date_stock         = strtotime(DateNepToEng($result_final->stock_date));
    if($check_date < $date_stock)
    {
        $b=1;
    }
    $aaa=123;
    $a=0;
}
    $res['a']= $a;
    echo json_encode($res);exit;
    
$res['check_date']= $b;
$res['check_empty']= $a;
echo json_encode($res);exit;
?>
