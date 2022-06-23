<?php
require_once("includes/initialize.php");
$res = array();
$counter=$_POST['counter'];
$item_id=$_POST['item_id'];
$category=$_POST['category'];
$rate = $_POST['rate'];
$html3="";
$stock_before = 0;
$item_condition =Itemcondition::find_all();
$dakhila_id =  DakhilaItemDetails::find_by_item_id_rate_category_of_max_dakhila($item_id,$category,$rate);
if(empty($dakhila_id))
{
    $dakhila_result=  ItemStock::find_stock($item_id,$category,$rate);
    $dakhila_date = $dakhila_result->stock_date;
}
else
 {
    $dakhila_profile_result =  Dakhilaprofile::find_by_id($dakhila_id);
    $dakhila_date = $dakhila_profile_result->date_nepali;
}
$stock = ItemStock::getTotalStockbyrate($item_id,$category,$rate);
$sql = "select * from ledger_details where item_id={$item_id} and rate={$rate} and category=2 and (qty-return_qty)!=0";
$result = Ledgerdetails::find_by_sql($sql);
if(!empty($result)):
 foreach($result as $data):
   $stock_before+=($data->qty-$data->return_qty);
 endforeach;
endif;
$stock = $stock-$stock_before;
$output ='<input type="text" name="total_quantity[]" value="'.$stock.'" id="total_quantity_'.$counter.'" readonly="true">';
$html ='<input type="text" name="quantity[]" id="quanitity_'.$counter.'">';
$html1='<input type="text" name="total_amount[]" id="total_amount_'.$counter.'">';
$html2 ='<input type="text" name="created_date[]" value="'.$dakhila_date.'">';
$html3.='<select name="current_status[]"> 
        <option value="">----</option> ';
foreach($item_condition as $data)
{
    $html3.='<option value="'.$data->id.'">'.$data->name.'</option>';
}
        '</select>';

$res['total_quanitity'] = $output;
$res['quantity'] = $html;
$res['total_amount'] = $html1;
$res['created_date'] = $html2;
$res['current_status'] = $html3;
echo json_encode($res);exit;