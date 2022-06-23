<?php
require_once("includes/initialize.php");
$res=array();
$html="";
$stock_message="";
$counter=$_POST['counter'];
$index = $counter-1;
$item_id=$_POST['item_id'];
$category=$_POST['category'];
$item_stock_result =  ItemStock::find_by_item_id_and_category_for_hastantaran($item_id,$category);
$j=1;
$checked = '';
if(count($item_stock_result)==1)
{
    $checked = 'checked="checked"';
}
if(empty($item_stock_result))
{
    $stock_message="Store मा समान भेटिएन ....कृपया पुनः प्रयास गर्नुहोस ..!!";
    $res['html']=$html;
    $res['stock_message'] = $stock_message;
    echo json_encode($res);exit;
}
else
{
            foreach($item_stock_result as $data):
               
               $dakhila_id =  DakhilaItemDetails::find_by_item_id_rate_category_of_max_dakhila($data->item_id,$data->category,$data->rate);
               if(empty($dakhila_id))
               {
                   $dakhila_date="";
               }
               else
                {
                   $dakhila_profile_result =  Dakhilaprofile::find_by_id($dakhila_id);
                   $dakhila_date = $dakhila_profile_result->date_nepali;
               }

               $html.= '<tbody>'
                       . '<td style="width:13.6% !important"><input type="checkbox" '.$checked.' name="stock_id-'.$index.'[]" id="stock_id_'.$counter.'1'.$j.'" value="'.$data->id.'"></td>
                           <td style="width:7.7% !important"><input type="text" id="rate_'.$counter.'1'.$j.'" name="rate-'.$index.'[]" value="'.$data->rate.'"></td>
                           <td style="width:13.1% !important"><input type="text" name="quantity-'.$index.'[]" id="quantity_'.$counter.'1'.$j.'"></td>
                           <td style="width:15.2% !important;"><input type="text" name="total_amount-'.$index.'[]" readonly="true" id="total_amount_'.$counter.'1'.$j.'"></td>
                            <td style="width:15.5% !important;"><input type="text" name="created_date-'.$index.'[]" value="'.$dakhila_date.'" ></td>
                           <td style="width:;"><input type="text" name="current_status-'.$index.'[]"/></td><input type="hidden" name="count_rate-'.$index.'[]" value="'.$data->id.'"/></td>'
                       . '</tbody>';

               $j++;
        endforeach;
       $html.="<br>";
        $res['stock_message']=$stock_message;
        $res['html'] = $html;
        echo json_encode($res);exit;
}
