<?php
require_once("includes/initialize.php");
 $item_condition = Itemcondition::find_all();
$item_type = Itemtype::find_all();
$res = array();
$counter=$_POST['counter'];

 $html = '';
 $html .='
                                       <tr class="remove_ledger_detail">
                                                  <td class="myWidth5" >'.convertedcit($counter).'</td>
                                                  <td >
                                                      <select id="item_type_id-'.$counter.'"  class="item_type_id-'.$counter.'" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>';
                                                          foreach($item_type as $data):
                                                          
                                                           $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
                                                           endforeach;
                                                     $html .=' </select>
                                                  </td>
                                                  <td >
                                                      <select id="category-'.$counter.'" class="data-'.$counter.'" name="category[]">
                                                      
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td  class="myWidth10">
                                                  <select name="item_id[]" class="form-control select2" id="item_name-'.$counter.'">
                                                  <option value="">--</option>
                                                  </select>
                                                  </td>
                                                  <td id="stock_item_id_'.$counter.'"></td>
                                   	          <td id="budget_title_id_'.$counter.'"></td>
                                                  <td id="specification_'.$counter.'"></td>
                                                  <td id="rate-'.$counter.'">&nbsp;</td>
                                                  <td id="safal-'.$counter.'"></td>
                                                  <td ><input type="text" name="qty[]"  class="qty_ledger_check myWidth100input" id="qty-'.$counter.'"/></td>
                                                  <td>
                                                     <select name="given_condition_id[]" required>
                                                              <option value="">छान्नुहोस्</option>';
                                                            foreach ($item_condition as $condition):
                                       $html.=   '<option value="'.$condition->id.'">'.$condition->name.'</option>';
                                                             endforeach;  
                                       $html.=   '</select>
                                                 </td>
                                                </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;