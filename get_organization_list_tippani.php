<?php
require_once 'includes/initialize.php';
$res = array();
$html="";
$kharid_id = $_POST['kharid_id'];
$result=  Prastabanaadd::find_by_kharid_id($kharid_id);
if(!empty($result))
{
        $html.='<select name="org_id">
               <option value="">------</option>';
       foreach($result as $data):
          $name=  Enlist::find_by_id($data->organization_id);
       $html.='<option value="'.$data->organization_id.'">'.$name->name.'</option>';
       endforeach;
       $html.='</select>';
}
else
{
    $html="";
}
$res['html']=$html;
echo json_encode($res);exit;