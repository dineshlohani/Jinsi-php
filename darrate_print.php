<?php require_once("includes/initialize.php"); 
    $prastabana_result=  Prastabanaadd::find_by_kharid_id($_GET['kharid_id']);
    $org_ids = Prastabanaadd::find_all_org_id($_GET['kharid_id']);
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>दर रेट पेश गर्ने बारे </title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">दर रेट पेश सम्बन्धमा   |  <a href="dashboard_prastabana.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>दर रेट पेश गर्ने बारे </h2>
                        <div class="userprofiletable">
                            
                                        
                                         <table class="table table-bordered table-responsive myWidth100">
                                             <tr>
                                                 <th>फर्मको नाम: </th>
                                                 <th>फर्मको ठेगाना : </th>
                                                 <th>प्रिन्ट गर्नुहोस</th>
                                             </tr>
                                        <?php  foreach($org_ids as $org_id): ?>
                                         <?php $organization =  Enlist::find_by_id($org_id); ?>
                                         
                                         
                                             <tr>
                                                 <td><?=$organization->name?> </td>
                                                 <td><?=$organization->address?> </td>
                                                 <td><form method="get" action="darrate_print_final.php" target="_blank" ><input type="text" name="date_selected1" placeholder="YYYY-MM-DD" /></td>
                                                 <td><input type="submit" class="btn btn-primary" value="प्रिन्ट  गर्नुहोस" name="submit" /></td>
                                             </tr>
                                             <input type="hidden" name="kharid_id" value="<?=$_GET['kharid_id']?>" />
                                         <input type="hidden" name="org_id" value="<?=$org_id?>" />
                                         </form>
                                         <?php endforeach; ?>
                                        
                                         </table>
                                         
                                             <?php exit; ?>
                                     <?php foreach($prastabana_result as $prastabana){
                                         $enlist_result=  Enlist::find_by_id($prastabana->organization_id);
                                                $kharid_result = Kharid_mag_faram2::find_by_maag_id($prastabana->kharid_id);?>
                                         <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									
									
									<div class="printContent">
                                                                            <div class="mydate">मिति 	:<?php echo convertedcit(generateCurrDate());?></div>
										<div class="chalanino">चलानी नम्बर : </div>
                                        <div class="chalanino">पत्र संख्या : </div>
										
                                        <div class="myspacer"></div>
                                        <div class="subjectBold">बिषय – प्रस्ताब फाराम पेश गर्ने बारे </div>
                                        <div class="chalanino">
                                        	श्री <?php $enlist_result->name;?> , <?php echo $enlist_result->address;?> । 
                                        </div>
                                        <div class="bankdetails">
                                        	उपरोक्त बिषयमा तपाइको फर्म यस कार्यालयमा सुचिकृत  भएकाले  गाँउपालिकाको लागी तपशिल बमाजिमका सामानहरु आबश्यक भएकाले के कति दररेटमा उपलब्ध गराउन सकिन्छ र समान सप्लाइ गर्न इच्छुक भएमा ७ दिन भित्रमा यस कार्यालयमा प्रस्ताब फाराम पठाइदिन हुन अनुरोध छ ।
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
                                      <div><strong>तपशिल : </strong></div>
									       
                          <table class="table table-bordered table-responsive myWidth100">
                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">सामानको परिमाण</th>
                                <th class="myCenter">इकाई</th>
                                                              
                            </tr>
                            <?php $i=1; foreach($kharid_result as $data):
                                 $iteminst = getItemInstance($data->category);
                                $item_selected = $iteminst->find_by_id($data->item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                ?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td><?=$data->qty?></td>
                                 <td><?=$unit_selected->name?></td>
                                
                            </tr> 
                                 <?php $i++; endforeach;?>
                             <tr>
                                    <td class="myCenter"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"></div> </td>
                            </tr>
                          </table>

</div> 
										


                       								

</div>
				</div>
                                         
                                          <?php  }?>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


