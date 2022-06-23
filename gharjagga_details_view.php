<?php require_once("includes/initialize.php"); 
 Gharjaggaadd::resetAutoIncrement();
$floor_array     = array(1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10);
 $fiscals = FiscalYear::find_all();
 $unit_result=  Landunit::find_all();
 $current_land_type_result=  Currentlandtype::find_all();
 $land_type=  Landtype::find_all();
 $current_fiscal= Fiscalyear::find_current_id();
 $id= $_GET['id'];
 $land_owner_details = Landownerdetails::find_by_id($id);
 $land_description = Landdescription::find_all_by_owner_id($id);
 $structure_description = Structure::find_all_by_land_owner_id($id);
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>घरजग्गा अभिलेख खाता भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">घरजग्गा अभिलेख खाता हेर्नुहोस | <a href="index.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>घरजग्गा अभिलेख खाता </h2>
                        <div class="myPrint"><a href="gharjagga_details_view_print.php?id=<?php echo $id;?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                              <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                      
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5><br>
									
									
									<div class="subjectBold letter_subject"> घरजग्गा अभिलेख खाता  </div>
									<div class="printContent">
                        <div class="userprofiletable">
                            
                       
                          
                            	<div>जग्गाधनीको नाम	 : <?= $land_owner_details->name ?></div>
                             
                            	<div>जग्गाधनीको ठेगाना : <?= $land_owner_details->address ?><div>
                              
                            
                <?php  if(!empty($land_description))
                    
                    {  ?>        <h2>जग्गाको विवरण</h2>
                            <table class="table table-bordered  table-responsive table-hover myWidth100 td1 td2">
                            
                                <tr>
                                            <td colspan="2" class="mycenter">साबिक </td>
                                            <td colspan="2" class="mycenter">हाल </td>
                                         
                                            <td rowspan="2" class="mycenter">न.न</td>
                                            <td rowspan="2" class="mycenter">कि.नं</td>
                                            <td  colspan="3" class="mycenter">क्षेत्रफल</td>
                                            <td rowspan="2" class="mycenter">क्षेत्रफल ईकाई</td>
                                            <td rowspan="2" class="mycenter">खरिद भए मुल्य</td>
                                            <td rowspan="2" class="mycenter">जग्गा प्राप्त भएको मिति</td>
                                            
                                        </tr>
                                        <tr>
                                            <td class="mycenter">गा.पा/न.पा </td>
                                            <td class="mycenter">वडा नं</td>
                                            <td class="mycenter">गा.पा/न.पा</td>
                                            <td class="mycenter">वडा नं</td>
                                            <td>बिघाहा</td>
                                            <td>कट्ठा</td>
                                            <td>धुर</td>
                                          
                                        </tr>
                                        
                  <?php
                 
                  foreach($land_description as $data): ?>                      
                                        <tr>
                                            <td>
                                               <?= $data->old_vdc_mp_id ?>
                                               
                                            </td>
                                            <td>
                                                 <?= convertedcit($data->old_ward_id) ?> 
                                               
                                            </td>
                                            
                                             <td>
                                               <?= $data->new_vdc_mp_id ?>
                                            </td>
                                            <td>
                                               
                                              <?= convertedcit($data->new_ward_id) ?> 
                                            </td>
                                          
                                                                                 
                                            <td><?= convertedcit($data->nn) ?></td>
                                            <td><?= convertedcit($data->kn) ?></td>
                                            <td><?= convertedcit($data->area1) ?></td>
                                            <td><?= convertedcit($data->area2) ?></td>
                                            <td><?= convertedcit($data->area3) ?></td>
                                           
                                          
                                            <td>
                                              बिगाहा
                                            </td>
                                           
                                            <td><?= convertedcit($data->minimum_amount) ?></td>
                                            <td><?= convertedcit($data->land_taken_date) ?></td>
                                        </tr>
                                            
                           <?php endforeach;
                   }
                else
                    {
                      echo '<h2>जग्गाको विवरण हालीएको छैन</h2>';
                    }
                           ?>               
                           
                              
                    
                              </table>
                                   
                             
                 <?php if(!empty($structure_description))
                 { 
                   ?>        
                            <h2>संरचना को विवरण</h2>
                                <table id="check_ghar_div"  class="table table-bordered table-hover table_fixed td1 td2">
                                      <?php
                                    
                                      ?>
                                           <tr>
                                               <td rowspan="2" class="mycenter">संरचना रहेको कि.नं</td>
                                               <td rowspan="2" class="mycenter">संरचना रहेको न.नं</td>
                                               <td colspan="5" class="mycenter">संरचनाको </td>
                                               <td colspan="2" class="mycenter">भोतिक संरचनाको विवरण</td>
                                              
                                               <td rowspan="2" class="mycenter">संरचनाको अनुमानित मूल्य</td>
                                               
                                           </tr>
                                           <tr>
                                               <td class="mycenter">तला</td>
                                               <td class="mycenter">लम्बाई</td>
                                               <td class="mycenter">चौडाई</td>
                                               <td class="mycenter">क्षेत्रफल वर्गफुट</td>
                                               <td class="mycenter">बनेको साल</td>
                                               <td class="mycenter">संरचनाको बनौटको किसिम</td>
                                               <td class="mycenter">संरचनाको प्रयोगको किसिम</td>
                                           </tr>
                            <?php foreach ($structure_description as $data1): ?>               
                                           <tr>
                                              <td>
                                                 <?= convertedcit($data1->land_kn) ?>
                                              </td>
                                              <td id="kn_td_1">
                                                 <?= convertedcit($data1->structure_land_nn) ?>
                                              </td>
                                              <td>
                                                <?= convertedcit($data1->floor) ?>
                                              </td>        
                                              <td>   <?= convertedcit($data1->length) ?></td>
                                              <td>   <?= convertedcit($data1->breadth) ?></td>
                                              <td>   <?= convertedcit($data1->b_area) ?></td>
                                              <td>
                                                     <?= convertedcit($data1->constructed_year) ?>
                                              </td>
                                               <td>
                                                     <?= ($data1->structure_made_type) ?>
                                               </td>
                                               <td>
                                                    <?= ($data1->structure_use) ?>
                                               </td>
                                              <td>   <?= convertedcit(placeholder($data1->structure_minimum_amount)) ?></td>
                                           </tr>
                                           
                                            
                                   
                 <?php endforeach; } 
                 else 
                 {
                     echo '<h2>संरचना को विवरण हालीएको छैन</h2>';
                 }
                 ?>
                             </table>               
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

