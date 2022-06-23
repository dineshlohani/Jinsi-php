<?php 
    require_once("includes/initialize.php"); 
 
    //$description_data = Description::find_all();    
    $description_id = $_GET['id'];
    $alldates = getAllDatesByDescriptionId($description_id);
   //print_r($alldates);exit;
    $rashid_type = Rashidtype::find_by_id($description_id);
   
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>रसिद नियन्त्रण खाता</title>
<body>

    <div id="body_wrap_inners"> 
    	
              <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
                            <div class="subjectBold letter_subject"><h2><b><?= $rashid_type->name ?></b></h2></div>
                                
                              
                           <table class="table table-bordered table-responsive td1 td2 ">
                                <tr>
                                    <th rowspan="2">सि.नं.</th>
                                    <th rowspan="2"> मिति </th>
                                   
                                
                                    <th colspan="4"> छापिएर आएको रसिद  </th>
                                    <th colspan="5"> निकासा भएको रसिद </th>
                                    <th colspan="1"> मौज्दात रहेको रसिद </th>
                                    <th rowspan="2"> प्रपाणित गर्ने </th>
                                  
                                </tr>
                                <tr>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    <th> ठेलि संख्या </th>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    <th> रशिद वितरण गरिएको शाखा</th>
                                    <th> रशिद बुझिलिनेको नाम / थर </th>
                                    
                                    <th> जम्मा रसिद </th>
                                    
                                </tr>
                                
                                <?php 
                                    $i = 1;
                                   $amdani_total_bill   = 0;
                                   $dispatch_total_bill = 0;
                                   
                                    foreach($alldates as $date) 
                                    {
                                        $from_amdani = ' ';
                                    $to_amdani = ' ';
                                    $from_dispatch = ' ';
                                    $to_dispatch = ' '; 
                                    $amdani_total =  ' ';
                                    $dispatch_total= ' ';
                                    $rashid_to_org = ' ';
                                    $rashid_to = ' ';
                                    $theli = ' ';
                                        $sql_amdani = "select * from bill_amdani where english_date='".$date."' and description_id={$description_id}";
                                        $result_amdani = BillAmdani::find_by_sql($sql_amdani);
                                        $sql_dispatch = "select * from bill_dispatch where english_date='".$date."' and description_id={$description_id}";
                                        $result_dispatch = BillDispatch::find_by_sql($sql_dispatch);
                                     
                                      //  print_r($result_dispatch);
                                       // print_r($result_amdani);exit;
                                       foreach($result_amdani as $adata):
                                           $amdani_total_bill += $adata->pressed_total;
                                          $from_amdani.= ($adata->pressed_from).'<hr>';
                                          $to_amdani.= ($adata->pressed_to).'<hr>';
                                          $amdani_total.= ($adata->pressed_to-$adata->pressed_from + 1).'<hr>';
                                          $theli.=($adata->pressed_total/$adata->quantity).'<hr>';
                                        endforeach;    
                                       foreach($result_dispatch as $bdata):
                                           $department= Department::find_by_id($bdata->department_id);;
                                          $result_dispatch_details = BillDispatchDetails::find_by_dispatch_id($bdata->id);
                                                foreach($result_dispatch_details as $cdata):
                                                    $dispatch_total_bill += $cdata->total;
                                                    $from_dispatch.= ($cdata->pressed_from).'<hr>';
                                                    $to_dispatch.= ($cdata->pressed_to).'<hr>';
                                                   $dispatch_total.= ($cdata->pressed_to-$cdata->pressed_from + 1 ).'<hr>';
                                                    $rashid_to.= $bdata->rashid_to.'<hr>';      
                                                    $rashid_to_org.=$department->name.'<hr>';
                                                endforeach;
                                          
                                        endforeach;
                                   $remaining_result = $amdani_total_bill - $dispatch_total_bill;
                                        
                                        
                                ?>
                                <tr>
                                    <td><?= convertedcit($i)?></td> 
                                    <td><?= convertedcit(DateEngToNep($date))?></td>
                                
                                    <td><?= convertedcit($from_amdani) ?></td>
                                    <td><?= convertedcit($to_amdani) ?></td>
                                     <td><?= convertedcit($amdani_total)?></td>
                                     <td><?= convertedcit($theli) ?></td>
                                     <td><?= convertedcit($from_dispatch) ?></td>
                                    <td><?= convertedcit($to_dispatch) ?></td>
                                    <td><?= convertedcit($dispatch_total)?></td>
                                    <td><?= $rashid_to_org ?></td>
                                    <td><?= $rashid_to ?></td>
                                    <td><?= convertedcit($remaining_result)?></td>
                                    <td>&nbsp;</td>
                                </tr>
                               
                                <?php $i++; }?>
                                
                            </table>              
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
  

