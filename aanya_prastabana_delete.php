<?php require_once("includes/initialize.php"); 
$anya_prastabana_id = $_GET['anya_prastabana_id'];
$datas= Aanyaprastabana::find_by_anya_prastabana_id($_GET['anya_prastabana_id']);
$data1= Aanyaorganization::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
$data2 = Aanyareason::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
foreach($datas as $data)
{
    $data->delete();
}
foreach($data1 as $dat)
{
    $dat->delete();
}
foreach($data2 as $da)
{
    $da->delete();
}
echo alertBox("हटाउन सफल..","aanya_prastabana_search.php");