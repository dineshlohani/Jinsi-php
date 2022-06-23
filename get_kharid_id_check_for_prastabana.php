<?php
require_once 'includes/initialize.php';
$res=array();
$html="";
$kharid_id=$_POST['kharid_id'];
$result=  Prastabanaadd::find_by_kharid_id($kharid_id);
if(!empty($result))
{
    $html="निम्न खरिद नं को प्रस्तावना माग फारम भरि सकिएको छ ...";
}
else
{
  $html="";  
}
$res['html']=$html;
echo json_encode($res);exit;