<?php
require_once("includes/initialize.php");
 
$item_type = Itemtype::find_all();
$res = array();
$counter=$_POST['counter'];

 $html = '';
 $html .='
                                       <tr class="remove_post_detail">
                                                  <td class="myWidth5 myCenter" >'.convertedcit($counter).'</td>
                                                  <td >
                                                      <select class="form-control fill_height" id="item_type_id-'.$counter.'"  class="item_type_id-'.$counter.'" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>';
                                                          foreach($item_type as $data):
                                                          
                                                           $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
                                                           endforeach;
                                                     $html .=' </select>
                                                  </td>
                                                  <td >
                                                      <select class="form-control fill_height" id="category-'.$counter.'" class="data-'.$counter.'" name="category[]">
                                                        <option value="1">खर्च हुने </option>
                                                      </select>
                                                  </td>
                                                   <td ><select name="item_id[]" id="item_name-'.$counter.'" class="form-control item_name select2">
                                                    <option value="">--</option>  
                                                    </select>
                                                  </td>
                                                  <td class="myWidth10"><input type="text" value="" name="specification[]" id="specification-'.$counter.'" class="myWidth100input data-'.$counter.' fill_height" /></td>
                                                  <td ><input type="text" value="" name="jinsi_id[]"  id="jinsi_id-'.$counter.'" class="myWidth100input data-'.$counter.' fill_height" /></td>
                                                  <td id="rate-'.$counter.'"></td>
                                                   <td ><input type="text" value="" name="prev_stock[]" id="prev_stock-'.$counter.'" class="myWidth100input data-'.$counter.' fill_height" /></td>
                                                  <td ><input type="text"  value="" name="unit_id[]" id="unit_id-'.$counter.'" class="myWidth100input data-'.$counter.' fill_height"/></td>
                                                  <td ><input type="text" required  id="qty-'.$counter.'"  name="qty[]" class="qty_check myWidth100input data-'.$counter.' fill_height"/></td>
                                                  
                                                </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;