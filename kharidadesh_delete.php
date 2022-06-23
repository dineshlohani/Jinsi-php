<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $b=0;
  $id= $_GET['id'];
  $kharid_adesh_result= KharidAdeshProfile::find_by_id($id);
  if($kharid_adesh_result->delete())
  {
    $kharid_adesh_result_items= KharidAdeshItemDetails::find_by_adesh_id($id);
   foreach ($kharid_adesh_result_items as $a)
        {
          $b=0; 
          if($a->delete())
           {
               $b=1;
           }
        }
    if($b==1)
    {
        echo alertBox("हटाऊन सफल","kharidadesh_search.php");
    }
  }
  
   
  ?>