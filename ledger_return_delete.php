<?php
require_once 'includes/initialize.php';
$id=$_GET['id'];
$detail_id = $_GET['detail_id'];
$return_ledger = Ledgerreturnhistory::find_by_id($id);
if($return_ledger->delete())
{
   $details = Ledgerdetails::find_by_id($detail_id);
   $details->return_qty = $details->return_qty - $return_ledger->qty;
   if($details->save())
   {
       echo alertBox("हटाऊन सफल","ledger_return_edit.php?id=".$details->id);
   }
}
?>
