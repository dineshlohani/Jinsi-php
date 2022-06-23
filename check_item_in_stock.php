<?php
 require_once("includes/initialize.php");
 $res = array();
 $counter 		= $_POST['counter'];
 $category		= $_POST['category'];
 $item_id               = $_POST['item_id'];
 $rate                  = $_POST['rate'];
 $date                  = DateNepToEng($_POST['date']);
 $stock                 = $_POST['stock'];
 $mymsg = $item_id." | ".$category." | ".$stock." | ".$rate." | ".$date;
 $res['mymsg'] = $mymsg; echo json_encode($res); exit;
 $check_result = check_item($item_id, $category, $stock, $rate, $date);
$res['check']= $check_result[0];
 $res['msg']  = $check_result[1];
 echo json_encode($res);exit;
?> 
