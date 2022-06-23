<?php
function get_name_by_type_and_enlist_id($type,$enlist)
{
    if($type==1)
    {
        $name=Department::getName($enlist);
    }
    if($type==2)
    {
        $name=Office::getName($enlist);
    }
    if($type==3)
    {
        $name=Workers::getName($enlist);
    }
    if($type==4)
    {
        $name=Authorities::getName($enlist);
    }
    return $name;
}
function get_distinct_org_id_and_kharid_id_for_kharid_adesh_view()
{
    $tippani_result= Jinsitippani::find_by_sql("select distinct kharid_id from jinsi_tippani");
    $array= array();
    foreach($tippani_result as $data)
    {
        $org_result = Jinsitippani::find_by_sql("select distinct org_id from jinsi_tippani where status=1 and kharid_id=".$data->kharid_id);
        foreach($org_result as $result)
        {
           $adesh_org_result = KharidAdeshProfile::find_by_sql("select * from kharid_adesh_profile where maag_id=".$data->kharid_id." and enlist_id=".$result->org_id);
           if(empty($adesh_org_result))
           {
               array_push($array,$data->kharid_id);
           }
        }
    }
    return $array;
}
function get_jinsi_stock_result($item_type,$category)
{
    global $database;
    if($category==1)
    {
        $sql = "select * from item_stock as a left join settings_spent_item as b on a.item_id=b.id where b.item_type_id=".$item_type;
        $result = $database->query($sql);
//        $data= mysqli_fetch_object($result);
    }
    else
    {
        $sql = "select * from item_stock as a left join settings_not_spent_item as b on a.item_id=b.id where b.item_type_id=".$item_type;
        $result = $database->query($sql);
//        $data= mysqli_fetch_object($result);
    }
//    echo "<pre>";
//    print_r($data);
//    echo "</pre>";exit;
    return $result;
}
function get_jinsi_tippani_minimum_rate_org($kharid_id)
{
    global $database;
    $tippani_item = Jinsitippani::find_by_sql("select distinct item_id from jinsi_tippani where kharid_id=".$kharid_id);
    
    $tippani_org = Jinsitippani::find_by_sql("select distinct org_id from jinsi_tippani where kharid_id=".$kharid_id);
//    $array=array
//   foreach($tippani_org as $org)
//    {
//        
//    }
   
   foreach($tippani_item as $data)
   {
       
       $minimum_result =  Jinsitippani::get_min_rate_tippani($kharid_id,$data->item_id);
       
       $minimum_result->status = 1;
        $minimum_result->save();
//       array_push($array, $minimum_result);
   }
//foreach($array as $data)
//   {
//    
//        $results= Jinsitippani::find_all_by_kharid_id_rate_tippani($kharid_id,$data);
//        $results->status = 1;
//        $results->save();
//   }
}
function get_all_item_id_by_category($category)
{
    // echo $category;exit;
    $stock_array = array();
    $dakhila_array= array();
    $kharcha_array =array();
    $hastantaran_array = array();
    $minha_array = array();
    $lilam_array = array();
    $kharcha_result     = Kharcha_mag_faram2::find_by_sql("select * from kharcha_mag_faram_2 where category=".$category);
//    print_r($kharcha_result);exit;
    $dakhila_result     =  DakhilaItemDetails::find_by_sql("select * from dakhila_item_details where category=".$category);
    $hastantaran_result = Hastantaransecond::find_by_sql("select * from hastantaran_second where category=".$category);
    $minha_result = Jinsiminha::find_by_sql("select * from jinsi_minha where category=".$category);
    $lilam_result = Jinsililam::find_by_sql("select * from jinsi_lilam where category=".$category);
    $stock_result = ItemStock::find_by_sql("select * from item_stock where category=".$category);
    
    foreach($stock_result as $s)
    {
        array_push($stock_array, $s->item_id);
    }
    
    foreach($kharcha_result as $d)
    {
        array_push($kharcha_array,$d->item_id);
    }
    
    foreach($dakhila_result as $da)
    {
        array_push($dakhila_array,$da->item_id);
    }
    
    foreach($hastantaran_result as $dat)
    {
        array_push($hastantaran_array,$dat->item_id);
    }
    
    foreach($minha_result as $ta)
    {
        array_push($minha_array,$ta->item_id);
    }
    
    foreach($lilam_result as $daa)
    {
        array_push($lilam_array,$daa->item_id);
    }
    
    $result= array_unique(array_merge($dakhila_array, $kharcha_array,$hastantaran_array,$minha_array,$lilam_array,$stock_array));
    return $result;
}

function find_minimum_total_amount_tippani($kharid_id)
{
     $org_result=  Jinsitippani::find_org($kharid_id);
      $array=array();
   foreach($org_result as $org)
   {
       $org_id=$org->org_id;
       $sum_amount=Jinsitippani::get_sum_by_kharid_id_org_id_item_id($kharid_id,$org->org_id);
       $array[$org_id]=$sum_amount;
   }
   $min_value = min($array);
   $minimum_rate_key=array_pop(array_keys($array,$min_value));
   $org_minimum_rate= Jinsitippani::get_sum_by_kharid_id_org_id_item_id($kharid_id,$minimum_rate_key);
   $result= Jinsitippani::find_all_by_kharid_id_org_id($kharid_id,$minimum_rate_key);
   $result=array("tippani_result"=>$result,"org_id"=>$minimum_rate_key);
   return $result;
}
function get_enlist_org_name($kharid_id)
{
    $name='';
    $org_result=  Jinsitippani::find_org($kharid_id);
    $count=count($org_result);
   $i=1; foreach($org_result as $data)
    {
        $enlist=  Enlist::find_by_id($data->org_id);
        if($count==$i)
        {
            $name .=$enlist->name;
        }
        else
        {
            $name .= $enlist->name." , ";
        }
    
        $i++;
    }
    return $name;
    
    
}
function calculate_total_days_year($date)
{
    $eng_date=  DateNepToEng($date);
    $prev_timestamp= strtotime($eng_date);
    $current_timestamp=  strtotime(date("Y-m-d"));
    $final_timestamp = $current_timestamp - $prev_timestamp;
    $total_days = $final_timestamp /86400;
    if($total_days > 365)
    {
        $total_count=  convertedcit(ceil($total_days/365))." वर्ष";
    }
    else
    {
        $total_count= convertedcit(ceil($total_days))." दिन ";
    }
    return $total_count;
}
function getBlankTdForMultipleKitta()
{
       $html = ' <td colspan="9"></td>';
       return $html;
}