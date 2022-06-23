<?php require_once("includes/initialize.php"); 
$maag_id = $_GET['kharid_id'];
$data=  Jinsitippani::find_by_kharid_ids($maag_id);
foreach($data as $a)
{
    $a->delete();
}
echo alertBox("हटाउन सफल ...","jinsi_tippani_search.php");
?>
