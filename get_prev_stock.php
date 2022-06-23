<?php
require_once("includes/initialize.php");
 $res = array();
 $html="";
 $counter 		= $_POST['counter'];
 $category		= $_POST['category'];
 $item_id               = $_POST['item_id'];
 $rate                  = $_POST['rate'];
$res['html'] = $html;
$stock = ItemStock::find_stock($item_id, $category, $rate);
$prev_stock = $stock->stock;
$res['prev_stock'] = $prev_stock;
echo json_encode($res); exit;