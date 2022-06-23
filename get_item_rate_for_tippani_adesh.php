<?php
require_once 'includes/initialize.php';
$res = array();
$org_id = $_POST['org_id'];
$item_id   =  $_POST['item_id'];
$category  =  $_POST['category'];
$kharid_id =  $_POST['kharid_id'];
$tippani_result = Jinsitippani::find_all_by_kharid_id_item_id_category_org_id($kharid_id,$item_id,$category,$org_id);
//$html = $tippani_result->rate_tippani;
$html = '<input type="text" readonly="true" name="rate_tippani[]" value="'.$tippani_result->rate_tippani.'"/>';
$res['html']= $html;
echo json_encode($res);exit;