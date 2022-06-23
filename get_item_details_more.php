<?php
require_once("includes/initialize.php");
 $res = array();
 $html="";
 $html1="";
 $html2="";
 $html3="";

 $category      = $_POST['category']; 
 $item_id       = $_POST['item_id'];

 $item_stock    = ItemStock::find_item_stock($item_id, $category);
 if(!empty($item_stock))
  {
      
       $html3 .= ItemStock::getTotalStock($item_id, $category);
       $item_stock1= ItemStock::find_stock_item($item_id, $category);
       $html1= $item_stock1->khata_id;
      
  }
  else
  {
       $html1 = '';
  }
        if($category==1)
        {
           $data = Spentitem::find_by_id($item_id);
			
        }
        else
        {
             
            $data = Notspentitem::find_by_id($item_id);
        }
        $html = $data->specification;
       
        $html2 = Unit::getName($data->unit_id);
        $res['html'] = $html;
        $res['html1'] = $html1;
        $res['html2'] = $html2;
        $res['html3'] = $html3;
        echo json_encode($res); exit;