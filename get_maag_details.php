<?php
require_once("includes/initialize.php");
 
$item_type = Itemtype::find_all();
$res = array();
$counter=$_POST['counter'];

 $html = '';
 $html .='
                                       <tr class="remove_post_detail">
                                                  <td class="myCenter">'.convertedcit($counter).'</td>
                                                  <td >
                                                      <select id="item_type_id-'.$counter.'"  class="item_type_id-'.$counter.' " name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>';
                                                          foreach($item_type as $data):
                                                          
                                                           $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
                                                           endforeach;
                                                     $html .=' </select>
                                                  </td>
                                                  <td >
                                                      <select id="category-'.$counter.'" class="data-'.$counter.' " name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td ><select class="select2" name="item_id[]"  id="item_name-'.$counter.'">
                                                    <option value="">--</option>  
                                                    </select>
                                                  </td>
                                                  <td class=""><input type="text" value="" name="specification[]" id="specification-'.$counter.'" class=" data-'.$counter.' " id="specification"/></td>
                                                  <td ><input type="text" value="" name="jinsi_id[]"  id="jinsi_id-'.$counter.'" class=" data-'.$counter.' " id="jinsi_id"/></td>
                                                  <td style="font-size: 14px; font-weight: 500; line-height: 28px;" id="prev_stock-'.$counter.'" ></td>
                                                  <td ><input type="text"  value="" name="unit_id[]" id="unit_id-'.$counter.'" class=" data-'.$counter.' "/></td>
                                                  <td ><input type="text" name="qty[]" id="qty-'.$counter.'" class=" data-'.$counter.'  "/></td>
                                                  <td><textarea  name="remarks[]" id="remarks-'.$counter.'" cols="30" rows="4"></textarea></td>
                                                  <td><img src="images/wrong.png" width="15px" height="15px" class="cross_row" /></td>
                                                </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;