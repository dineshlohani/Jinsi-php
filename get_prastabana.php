<?php
 require_once("includes/initialize.php"); 
$res=array();
$html="";
$datas= Enlist::find_all();
$prakar_result=  Prastabanaprakaradd::find_all();
$counter=$_POST['counter'];
$html.=' <tr class="remove_prastabana_detail">  
                                <td>
                                    <select style="width:100%;" class="form-control fill_height" name="organization_id[]">
                                           <option value="">छान्नुहोस</option>';
                                           foreach($datas as $data):
        $html.='                                   <option value="'.$data->id.'">'.$data->name.'</option>';
                                           endforeach;
                                 $html.='</select>
                                
                                  
                                  
                            </tr>';
    $res['html']=$html;
    echo json_encode($res);exit; 