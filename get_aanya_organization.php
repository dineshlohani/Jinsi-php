<?php
 require_once("includes/initialize.php"); 
$res=array();
$html="";
//$html.='<script type="text/javascript" src="calendar/js/nepalidate.js"></script>';
 $datas= Enlist::find_all();
$counter=$_POST['counter'];
$html.='
                                <tr class="remove_aanya_organization_detail">
                                <td> &nbsp; </td>
                                   <td> <select class="form-control" name="organization_id[]">
                                           <option value="">छान्नुहोस</option>';
                                           foreach($datas as $data):
        $html.='                                   <option value="'.$data->id.'">'.$data->name.'</option>';
                                           endforeach;
                                 $html.='  </select>
                                </td></tr>
                         ';
    $res['html']=$html;
    echo json_encode($res);exit;