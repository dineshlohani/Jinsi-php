<?php require_once("includes/initialize.php"); 
 error_reporting(0);
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$id= $_GET['id'];
	$data= Kharid_mag_faram1::find_by_id($id);
        $data->delete();
        $delete_items= Kharid_mag_faram2::find_by_maag_id($id);
        foreach ($delete_items as $datas)
        {
            $a=0;
            if($datas->delete())
            {
                $a=1;
            }
        }
    if($a==1)
    {
        echo alertBox("हटाऊन सफल","maagfarm_search.php");
    }
?>        
      

