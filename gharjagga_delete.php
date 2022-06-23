<?php
require_once 'includes/initialize.php';
$id= $_GET['id'];
$a=0;
$land_owner_details = Landownerdetails::find_by_id($id);
if($land_owner_details->delete())
{
    $a=1;
    $land_details = Landdescription::find_all_by_owner_id($id);
    if(!empty($land_details))
     {
            foreach($land_details as $data):
                if($data->delete())
                {
                    $a=1;
                }
                else
                {
                    $a=0;
                }
            endforeach;
     }
   $structure_details = Structure::find_all_by_land_owner_id($id);
   if(!empty($structure_details))
   {
       foreach ($structure_details as $data1):
            if($data1->delete())
            {
                $a=1;
            }
            else
            {
                $a=0;
            }
       endforeach;
   }
}
if($a==1)
{
    echo alertBox("हटाऊन सफल","gharjagga_view.php");
}