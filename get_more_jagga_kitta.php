<?php
require_once("includes/initialize.php"); 
$res=array();
$html="";
$counter=$_POST['counter'];
$sel = $_POST['sel'];
$unit_result=  Landunit::find_all();
$floor_array     = array(1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10);
$html='<tr class="ghar_details">
                                             <td>'.$sel.'</td>
                                              <td id="kn_td_1">
                                                  <input type="text" name="structure_land_nn[]" id="nn_structure_1">
                                              </td>
                                              <td>
                                                  <select name="floor[]" id="floor_'.$counter.'" >
                                                      <option value="">छान्नुहोस्</option>';
                                                 foreach ($floor_array as $floor) :
$html.=                                            '<option value="'.$floor.'">'.$floor.'</option>';
                                                endforeach;
$html.=                                      '</select>
                                              </td>        
                                              <td><input type="text" name="length[]" id="length_'.$counter.'" required></td>
                                              <td><input type="text" name="breadth[]" id="breadth_'.$counter.'" required></td>
                                              <td><input type="text" name="b_area[]" id="b_area_'.$counter.'" required></td>
                                              <td>
                                                  <input type="text" name="constructed_year[]"> 
                                              </td>
                                               <td>
                                                   <select name="structure_made_type[]">
                                                       <option value="">छान्नुहोस्</option>
                                                       <option value="कच्ची">कच्ची</option>
                                                       <option value="पक्कि">पक्कि</option>
                                                   </select>
                                               
                                               </td>
                                               <td>
                                                   <select name="structure_use[]" id="structure_use_1" required>
                                                       <option value=""></option>
                                                       <option value="निजी">निजी</option>
                                                       <option value="भाडा">भाडा</option>
                                                       <option value="अन्य">अन्य</option>
                                                   </select>
                                                   
                                               </td>
                                             
                                               
                                               <td><input type="text" name="structure_minimum_amount[]" id="structure_land_kn_minimum_amount_1" ></td>
                                           </tr>';
$res['html']=$html;
echo json_encode($res);exit;
