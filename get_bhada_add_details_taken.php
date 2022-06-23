<?php
require_once("includes/initialize.php");
$item_type = Itemtype::find_all();
$res = array();
$counter=$_POST['counter'];
$counter1 = $counter+20;
$item_condition = Itemcondition::find_all();
// $res['html'] = $counter;
//       echo json_encode($res); exit;
 $html = '';
 $html .=                                 '   <tr class="remove_bhada_details_taken">
                                                  <td >'. convertedcit($counter).'</td>
                                                  <td >
                                                      <select class="form-control" id="item_type_id-'.$counter.'" name="item_type_id[]" required>
                                                          <option value=""></option>';
                                                  foreach($item_type as $data):
                                                          
 $html.='                                               <option value="'.$data->id.'">'.$data->name.'</option>';
                                                            endforeach;
 $html.='                                                     </select>
                                                  </td>
                                                <input type="hidden" value="2" id="category-'.$counter.'">
                                                
                                                
                                                  <td>
                                                      <select name="item_id[]" id="item_name-'.$counter.'" class="item_name[]" required>
                                                          <option value="">--</option>
                                                      </select>
                                                      
                                                      
                                                  </td>
                                                   <td><input type="text" name="rate[]"></td>
                                                  <td ><select class="" name="period_type[]" required>
                                                        <option value=""></option>
                                                        <option value="1">दैनिक</option>
                                                        <option value="2">मासिक</option>
                                                        <option value="3">बार्षिक</option>
                                                       
                                                       </select> </td>
                                                  <td > <input class="form-control fill_height" type="text" name="period_rate[]" id="period_rate_'.$counter.'" required></td>
                                                  <td ><input class="myWidth100input fill_height" type="text" name="period[]"  id="period_'.$counter.'" required/></td>
                                                  <td><input class="qty_check myWidth100input fill_height" type="text" name="qty[]" id="qty_'.$counter.'" required/></td>
                                                  <td><input class="qty_check myWidth100input fill_height" type="text" name="bhada_amount[]" id="bhada_amount_'.$counter.'" required/></td>
                                                 <td>
                                                 <select class="form-control" name="item_conditon_id[]" required>
                                                          <option value=""></option>';
                                                           foreach($item_condition as $data): 
                                          $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
                                                          endforeach; 
     $html.=                                    ' </select>
                                                 </td>
                                                <td><input type="text" name="start_date[]" id="nepaliDate'.$counter.'" class="form-control age_'.$counter.'">
                                                <button type="button" class="ndp-click-trigger btn btn-primary btn-sm" onclick="showNdpCalendarBox(&quot;nepaliDate'.$counter.'&quot;)">मिति</button>  
                                                </td>
                                                  <td><input type="text" name="end_date[]" id="nepaliDate'.$counter1.'" class="form-control age_'.$counter1.'" required>
                                                <button type="button" class="ndp-click-trigger btn btn-primary btn-sm" onclick="showNdpCalendarBox(&quot;nepaliDate'.$counter1.'&quot;)">मिति</button>  
                                                </td>
                                                  
                                                </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;