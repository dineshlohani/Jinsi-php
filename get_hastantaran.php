<?php
require_once("includes/initialize.php");
 $item_type = Itemtype::find_all();
$item_result=  ItemStock::find_all();
$res = array();
$counter=$_POST['counter'];
// $res['html'] = $counter;
//       echo json_encode($res); exit;
 $html = '';
 $html .='
                                       <tr class="remove_hastantaran_detail">
                                         <th>'.convertedcit($counter).'</th>
                                        <th >
                                                      <select id="item_type_id_'.$counter.'" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>';
                                                           foreach($item_type as $data):
                                                          
                                                    $html .='<option value="'.$data->id.'">'.$data->name.'</option>';
                                                           endforeach;
                                                      $html.='</select>
                                                  </th>
                                                  <th>
                                                      <select id="category_'.$counter.'" name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </th>
                                   	    
                                              <th id="item_name-'.$counter.'">
                                                  
                                            </th>
                                   	      <th id="stock_item_id_'.$counter.'"></th>
                                   	      <th id="budget_title_id_'.$counter.'"></th>
                                              <td id="rate-'.$counter.'">&nbsp;</td>
                                              <td id="safal-'.$counter.'"></td>
                                               <td id="amulya-'.$counter.'"></td>
                                               <td id="dhiraj-'.$counter.'"></td>
                                               <td id="sanjay-'.$counter.'"></td>
                                               <td id="pravin-'.$counter.'"></td>
                                            </tr>';
       $res['html'] = $html;
       echo json_encode($res); exit;