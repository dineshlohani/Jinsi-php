<?php
require_once('includes/initialize.php');
$res= array();
$description_id = $_POST['description_id'];
$html=' ';
$one_max = BillAmdani::get_max_description_id($description_id)-1;
$one_min = BillAmdani::get_min_description_id($description_id);
$res['mmhtml']     = $one_min.'-'.$one_max;
$amdani = BillAmdani::find_by_des_id($description_id);
//$dispatch = BillDispatch::find_by_des_id($description_id);
$result = find_datas_by_description_id($description_id);
if(!empty($amdani))
{
    
foreach ($amdani as $data):
 $start = $data->pressed_from;
 $end   = $data->pressed_to;
 $count = $data->pressed_total/$data->quantity;
 for($i=$start;$i<=$end; $i=$i+$count)
 {
     $end_count = $i+($count-1);
     if(in_array( $i ,$result['from']) || in_array($end_count,$result['to']))
    {
         
    }
    else
    {
           $html.=$i." - ".$end_count."<input type='checkbox' class='dispatch_checkbox' name=dispatch[] value='".$i."-".$end_count."'><hr>";
    }

 }
endforeach;
}
$res['html'] = $html;
$res['count'] = $count;

echo json_encode($res);exit;