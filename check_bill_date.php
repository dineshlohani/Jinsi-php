<?php
require_once 'includes/initialize.php';
$res= array();
$a=1;
$bill_date= DateNepToEng($_POST['bill_date']);
$last_date = get_last_date_rashid($_POST['description_id']);
if(strtotime($bill_date)< strtotime($last_date))
{
    $a = 2;
}
$res['check'] = $a;
echo json_encode($res);exit;
?>
