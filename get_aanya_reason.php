<?php
 require_once("includes/initialize.php"); 
$res=array();
$html="";
//$html.='<script type="text/javascript" src="calendar/js/nepalidate.js"></script>';
// $datas= Enlist::find_all();
$counter=$_POST['counter'];
$html.='
                                <tr class="remove_aanya_reason_detail">
                                    <td> &nbsp; </td>
                                    <td><textarea class="form-control" name="anya_prastabana_reason[]"></textarea>
                                </tr></td>
                         ';
    $res['html']=$html;
    echo json_encode($res);exit;