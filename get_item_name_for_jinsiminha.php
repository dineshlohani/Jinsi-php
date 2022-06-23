<?php
require_once("includes/initialize.php"); 
$res=array();
$html="";
$item_type_id = $_POST['item_type_id'];
$category     = $_POST['category'];
if($category=="")
{
    $html="";
}
else
{
        if($category==1)
            {
                $sql="select distinct item_id from item_stock as a left join settings_spent_item as b on a.item_id=b.id where a.category=1 and b.item_type_id=".$item_type_id; 
                $result= $database->query($sql);
            }
            else
            {
               $sql="select distinct item_id from item_stock as a left join settings_not_spent_item as b on a.item_id=b.id where a.category=2 and b.item_type_id=".$item_type_id; 
               $result= $database->query($sql);
            }

    $html.='<td>समानको नाम </td><td><select  name="item_id">';
    $html.='<option value="">छान्नुहोस</option>';
      while($data = mysqli_fetch_object($result)): 
           if($category==1)
        {
            $item = Spentitem::find_by_id($data->item_id);
        }
        else
        {
              $item = Notspentitem::find_by_id($data->item_id);
        }
     
         $html.='<option value="'.$data->item_id.'">'.$item->name.'</option>';
    endwhile;    
      $html.='</select></td>';
}
$res['html'] = $html;
echo json_encode($res); exit;