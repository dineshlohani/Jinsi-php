<?php
require_once("includes/initialize.php");
 $res = array();
 $html="";
 $counter 		= $_POST['counter'];
 $category		=$_POST['category'];
 $item_type_id          =$_POST['item_type_id'];

       if($category==1)
        {
             
            $data          = Spentitem::find_by_item_type_id($item_type_id);
          
           
        }
        else
        {
            $data = Notspentitem::find_by_item_type_id($item_type_id);
           
        }
       
        $a=1;
        $html.='<option value="">छान्नुहोस</option>';
          foreach($data as $result):
             if($category==1)
             {
               $check_id= ItemStock::check_item($result->id, $category); 
             }
             if($category==2)
             {
                  $check_id= ItemStock::check_item($result->id, $category);
             }
             
        
      
            $html.='<option ';
                   if($check_id==1)
                   {
                   
             $html.= 'style= "color:red"';            
                   }
            $html.= ' value="'.$result->id.'">'.$result->name.'</option>';
        endforeach; 
        $res['html'] = $html;
        $res['check'] = $a;
        echo json_encode($res); exit;