<?php
require_once 'includes/initialize.php';
$res = array();
$max_date = DateNepToEng($_POST['max_date']);
$selected_date = DateNepToEng($_POST['selected_date']);
if(strtotime($selected_date) < strtotime($max_date))
{
    $a = 'no';
}
else
{
    $a= 'yes';
}
$res['a'] = $a;
echo json_encode($res);exit;
?>