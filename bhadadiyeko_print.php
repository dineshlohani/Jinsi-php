<?php require_once("includes/initialize.php"); 
 Bhadadiyekobasicinfo::resetAutoIncrement();
 $a=0;

$enlist_id = $_GET['enlist_id'];
$enlist = Bhadaenlist::find_by_id($enlist_id);
$khata_number = $_GET['khata_number'];
$sql= "select * from bhada where enlist_id={$enlist_id}";
$bhada = Bhada::find_by_sql($sql);
$current_fiscal= Fiscalyear::find_current_id();
$fiscal = Fiscalyear::find_by_id($current_fiscal);

?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>भाडामा दिएको सम्पतिको अभिलेख खाता हेर्नुहोस</title>

<body>
  
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <div class="OurContentFull">
                    	<h2> भाडामा दिएको सम्पतिको अभिलेख खाता हेर्नुहोस		</h2>
                        <div class="userprofiletables">
                            
<!--                           <div class="myPrint"><a href="#">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>-->
                          <div class="our_content myWidth85 myCenter">
                        
                                  <fieldset >
                                  <legend>सामान भाडा विवरण</legend>
                                   <table class="table table-bordered">
                                      <tr>
                                        <td class="myWidth50">
                                         <b> सम्पतिको अभिलेख खाता नं :</b>
                                       <?= convertedcit($khata_number) ?>
                                       </td>
                                       <td></td>
                                    <td>
                                    <b>आर्थिक वर्ष :</b>
                                    <?= convertedcit($fiscal->year) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="mycenter"><legend> <b>भाडामा लिने व्यक्त्ती वा कार्यालयको:</b> </legend></td>
                            </tr>
                             <tr>
                                   
                                            <td class="myWidth50">
                                                
                                                <b>नाम:</b>
                                               <?= $enlist->name ?>
                                            </td>
                                            <td>
                                                <b>ठेगाना:</b>
                                               <?= $enlist->address ?>
                                            </td>
                                            <td>
                                                <b>सम्पर्क नं:</b>
                                                <?= convertedcit($enlist->number) ?>
                                            </td>
                                        </tr> 
                                   </table>      
                               
                                      
                                  <table class="table myWidth100 table-bordered">
                                      <tr>
                                <td colspan="15" class="mycenter"><legend> <b>भाडामा दिएको सामानको विवरण:</b> </legend></td>
                                 </tr>
                                 <tr>
                                     <th class="mycenter" colspan="11">
                                         सामान दिएको विवरण
                                     </th>
                                     <th colspan="3" class="mycenter">समान फिर्ताको विवरण</th>
                                
                                 </tr>
                                  <tr >
                                                  <th class="myWidth5" >क्र.स.</th>
                                                <th class="myWidth5">सामानको  नाम </th>
                                                   <th class="myWidth5">भाडामा दिएको सामानको मूल्य</th>
                                                  <th class="myWidth5">भाडाको इकाई</th>
                                                  <th class="myWidth5">प्रति इकाई अवधि भाडा दर</th>
                                                 <th class="myWidth5">भाडा अवधीको परिमाण</th>
                                                 <th class="myWidth5"> भाडामा दिईएको सामानको परिमाण</th>
                                                 <th class="myWidth5">जम्मा भाडा मूल्य रु</th>
                                                 <th class="myWidth5">सामानको स्थिती</th>
                                                  <th class="myWidth5">भाडा अवधि शुरु हुने मिति</th>
                                                  <th class="myWidth5">भाडा अवधि सम्पन्न हुने मिति</th>
                                                  <th class="myWidth5">फिर्ता परिमाण</th>
                                                  <th class="myWidth5">फिर्ता मिती</th>
                                                  <th class="myWidth5">सामानको स्थिती</th>
                                                  
                                                 
                                                 
                                                  
                                                </tr>
                                 <?php $i=1; foreach ($bhada as $data1):
                                     $bhada_details = Bhadadetails::find_by_bhada_id($data1->id);
                                     foreach($bhada_details as $data):
                                           $sql_return    = "select * from bhada_return_history where item_id ={$data->item_id} and category={$data->category} and rate={$data->item_rate} and bhada_id={$data1->id}";
                                          $return_result = Bhadareturnhistory::find_by_sql($sql_return);
                                          if(!empty($data->item_condition_id))
                                          {
                                              $item_condition_res = Itemcondition::find_by_id($data->item_condition_id);
                                              $item_condition= $item_condition_res->name;
                                          }
                                          else 
                                          {
                                              $item_condition = '';
                                          }
                                         $item = Notspentitem::find_by_id($data->item_id);
                                     if($data->period_type==1)
                                     {
                                         $period_type="दैनिक";
                                     }
                                     elseif($data->period_type==2)
                                     {
                                         $period_type="मासिक";
                                     }
                                     elseif($data->period_type==3)
                                     {
                                         $period_type="बार्षिक";
                                     }
                                     ?>         
                                                <tr>
                                                  <td ><?= convertedcit($i) ?></td>
                                               
                                                <input type="hidden" value="2" id="category-1">
                                                   <td >
                                                      <?= $item->name ?>
                                                      
                                                  </td>
                                                   <td id="rate-1"><?= convertedcit($data->item_rate) ?></td>
                                                  <td >
                                                      <?= $period_type ?>
                                                    </td>
                                                  <td ><?= convertedcit($data->period_rate) ?></td>
                                                  <td ><?= convertedcit($data->period) ?></td>
                                                  <td><?= convertedcit($data->qty) ?></td>
                                                  <td><?= convertedcit($data->bhada_amount) ?></td>
                                                  <td><?= $item_condition ?></td>
                                                  <td> <?= convertedcit(DateEngToNep($data->start_date)) ?></td>
                                                  <td><?= convertedcit(DateEngToNep($data->end_date)) ?></td>
                                                  <td>
                                                      <?php foreach($return_result as $return): 
                                                       echo $return->qty.'<hr>';
                                                       endforeach;
                                                      ?>
                                                  </td>
                                                  <td>
                                                      <?php foreach($return_result as $return): 
                                                       echo convertedcit(DateEngToNep($return->return_date)).'<hr>';
                                                       endforeach;
                                                      ?>
                                                  </td>
                                                  <td>
                                                       <?php foreach($return_result as $return): 
                                                           if(!empty($return->item_condition_id))
                                                           {
                                                                $item_cond = Itemcondition::find_by_id($return->item_condition_id);
                                                                $item_condition_return = $item_cond->name;
                                                           }
                                                           else
                                                           {
                                                                $item_condition_return  = '';
                                                           }
                                                          
                                                          
                                                       echo $item_condition_return.'<hr>';
                                                       endforeach;
                                                      ?>
                                                  </td>
                                               
                                                </tr>
                             <?php $i++; endforeach;
                             endforeach;
                             ?>
                                </table>
                                  
                            
                              
                              </fieldset>
                          </div>
      
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->


