<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$id= $_GET['id'];
$a=0;
$ledger_details  = Ledgerdetails::find_by_id($id);
$ledger= Ledger::find_by_id($ledger_details->ledger_id);
if($ledger_details->delete())
{   
    $a=1;
    $sql_return    = "select * from ledger_return_history where item_id ={$ledger_details->item_id} and category={$ledger_details->category} and rate={$ledger_details->rate} and ledger_id={$ledger_details->ledger_id}";
    $return_result = Ledgerreturnhistory::find_by_sql($sql_return);
    if(!empty($return_result))
    {
        foreach ($return_result as $data):
        $a=0;
        if($data->delete())
        {
            $a=1;
        }
    endforeach;
    }
    
}
if($a==1)
{
   echo alertBox("हटाउन सफल","ledger_view_dashboard.php");
}
?>
