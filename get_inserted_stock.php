<?php
require_once("includes/initialize.php");
$item_type = Itemtype::find_all();
$res = array();
$counter=$_POST['counter'];
$html = '';
$html .='
                                       <tr class="remove_stock_detail">
                                                  <td class="myWidth5" >'.convertedcit($counter).'</td>
                                                  <td >
                                                      <select id="item_type_id-'.$counter.'"  class="item_type_id-'.$counter.'" name="item_type_id[]">
                                                        <option value="">छान्नुहोस</option>';
                                                        foreach($item_type as $data):
                                                        $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
                                                        endforeach;
                                                     $html .=' </select>
                                                  </td>
                                                  <td>
                                                <select id="category-'.$counter.'" class="data-'.$counter.'" name="category[]">
                                                    <option>छान्नुहोस</option>
                                                    <option value="1">खर्च हुने </option>
                                                    <option value="2">खर्च नहुने </option>
                                                </select>
                                                  </td>
                                                  <td  class="myWidth10">
                                                  <select name="item_id[]" id="item_name-'.$counter.'" class="select2">
                                                  <option value="">----Select Item Name----</option>
                                                  </select>
                                                  </td>
                                                  <td><input type="text" value="" name="dakhila_no[]" class="myWidth100input "/></td>
                                                 <td ><input type="text"  value="" name="rate[]" class="myWidth100input "/></td>
                                                  <td ><input type="text" name="qty[]"  class="myWidth100input"/></td>
                                                </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;