<?php require_once("includes/initialize.php"); 
$kharid_id = ($_GET['kharid_id']);
$prastabana_result=  Prastabanaadd::find_by_kharid_id($_GET['kharid_id']);
foreach($prastabana_result as $data)
{
    $data->delete();
}
echo alertBox("हटाउन सफल  ....","prastabana_search.php");
