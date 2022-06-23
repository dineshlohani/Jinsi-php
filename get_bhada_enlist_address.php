<?php
require_once("includes/initialize.php");
$res = array();
$id = $_POST['id'];
$bhada_enlist = Bhadaenlist::find_by_id($id);
$res['address'] = $bhada_enlist->address;
$res['number']  = $bhada_enlist->number;
$khata_id = Bhada::get_new_khata_id($id);
$res['khata_id'] = $khata_id;
echo json_encode($res);exit;

