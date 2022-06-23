<?php
require_once("includes/initialize.php"); 
$res=array();
$html="";
$counter=$_POST['counter'];
$unit_result=  Landunit::find_all();
$html='<tr class="ghar_jagga_details">
   
                                            <td>
                                                <input class="form-control" type="text" name="old_vdc_mp_id[]"> 
                                               
                                            </td>
                                            <td>
                                                <input class="form-control" name="old_ward_id[]" type="text"> 
                                            </td>
                                            
                                             <td>
                                               <input class="form-control" name="new_vdc_mp_id[]" type="text"> 
                                            </td>
                                            <td>
                                               <input class="form-control" name="new_ward_id[]" type="text"> 
                                                
                                            </td>
                                            <td><input type="text" style="width: 100% !important;" name="nn[]" class="nn" required></td>
                                            <td><input type="text" style="width: 100% !important;" name="kn[]" class="kn" required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area1[]" id="area1_1"   required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area2[]" id="area2_1"   required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area3[]" id="area3_1"   required></td>
                                           
                                          
                                            <td>
                                                <select name="unit_id[]" class="unit_id_1" style="width: 60px;" required>
                                                  
                                                    <option  value="1">बिगाहा</option>
                                               
                                                </select> 
                                                
                                            </td>
                                           
                                            <td><input type="text" name="minimum_amount[]" id="accepted_amount_1" required ></td>
                                           <td><input type="text" name="land_taken_date[]" id="nepaliDate'.$counter.'" class="form-control age_'.$counter.'" required>
                                                <button type="button" class="ndp-click-trigger btn btn-primary btn-sm" onclick="showNdpCalendarBox(&quot;nepaliDate'.$counter.'&quot;)">मिति</button>  
                                        </tr>';
$res['html']=$html;
echo json_encode($res);exit;
