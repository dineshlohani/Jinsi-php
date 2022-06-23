<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$user        = getUser();
$id= $_GET['id'];
$a=0;
$ledger_details  = Bhadadetails::find_by_id($id);
$ledger= Bhada::find_by_id($ledger_details->bhada_id);
if($ledger_details->delete())
{   
    $a=1;
    $sql_return    = "select * from bhada_return_history where item_id ={$ledger_details->item_id} and category={$ledger_details->category} and rate={$ledger_details->item_rate} and bhada_id={$ledger_details->bhada_id}";
    $return_result = Bhadareturnhistory::find_by_sql($sql_return);
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
   echo alertBox("हटाउन सफल","bhadadiyeko_view_dashboard.php");
}
?>
