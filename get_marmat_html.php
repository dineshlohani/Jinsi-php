<?php
require_once("includes/initialize.php");
$res=array();
$counter = $_POST['counter'];
$item_result = Notspentitem::find_all();
$unit_result = Unit::find_all();
$item_type = Itemtype::find_all();
$html ="";
$html .= '<tr class="remove_marmat_detail">';
$html .= '<td >'.$counter.'</td>
    <td >
    <select class="" id="item_type_id-'.$counter.'" name="item_type_id[]">
    <option value="">छान्नुहोस</option>';
    foreach($item_type as $data):
    $html .='<option value='.$data->id.'>'.$data->name.'</option>';
    endforeach;
    $html .= '</select>
    </td>
    <td >
    <select class="" id="category-'.$counter.'" name="category[]">
    <option value="1">खर्च हुने </option>
    <option value="2">खर्च नहुने </option>
    </select>
    </td>
    <td >
    <select name="item_id[]" id="item_name-'.$counter.'" class="item_name">
    <option value="">--</option>
    </select>
    </td>
    <td id="unit_machinary_'.$counter.'"></td>
    <td><input type="text" name="quantity[]"/></td>
    <td><textarea name="marmat_details[]"></textarea></td>
     <td><input type="text" name="amount[]"/></td>
     <td><textarea name="remarks[]"></textarea></td>';
$html .='</tr>';
 $res['html'] = $html;
 echo json_encode($res);exit;