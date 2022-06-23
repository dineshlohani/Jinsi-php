<?php
require_once 'includes/initialize.php';
$res= array();
$to = $_POST['to'];
$html='';
$department= Department::find_all();
$workers   = Workers::find_all();
$authorities_result = Authorities::find_all();
$office = Office::find_all();
$html.='<select style="width: 100%; height: 33px; margin-top: -20px;"  name="enlist_id" required><option value="">छान्नुहोस्</option>';
$type=0;
if($to==1)
{
    foreach ($department as $data):
  $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
    endforeach;
  $type=1;
}
elseif($to==2)
{
    foreach ($office as $data):
  $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
    endforeach;
    $type=2;
}
elseif($to==3)
{
    foreach ($workers as $data):
  $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
    endforeach;
    $type=3;
}
elseif($to==4)
{
    foreach ($authorities_result as $data):
  $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
    endforeach;
    $type=4; 
}
else
{
    $html.='';
}
$res['html']= $html;
$res['type']=$type;
echo json_encode($res);
?>

