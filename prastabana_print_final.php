<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
//   $prastabana_result=  Prastabanaadd::find_by_kharid_id($_GET['kharid_id']);
$prastabana = Prastabanaadd::find_by_kharid_id_org_id($_GET['kharid_id'],$_GET['org_id']);
 //print_r($prastabana);exit;
$date_selected = $_GET['date_selected'];
//print_r($date_selected1);
$fiscal_id= Fiscalyear::find_current_id();
 $fiscal_year = Fiscalyear::find_by_id($fiscal_id);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>प्रस्ताब फाराम पेश गर्ने बारे  :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <?php // foreach($prastabana_result as $prastabana){
                                         $enlist_result=  Enlist::find_by_id($prastabana->organization_id);
                                                $kharid_result = Kharid_mag_faram2::find_by_maag_id($prastabana->kharid_id);?>
                                         <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									
									
				<div class="printContent">
                                        <div class="mydate"><b> मिति :- </b><?php echo convertedcit($_GET['date_selected']);?></div>
										
                                        <div class="chalanino"><b> पत्र संख्या :- <?= convertedcit($fiscal_year->year) ?> </b> </div>
					<div class="chalanino"><b> चलानी नम्बर :-</b> </div>					
                                        <div class="myspacer"></div>
                                        <div class="subjectBold letter_subject">बिषय – कोटेशन पेश गर्ने बारे । </div>
                                        <div class="chalanino"><br>
                                        	श्री <?php echo  $enlist_result->name;?> , <br><?php echo $enlist_result->address;?> । 
                                        </div>
                                        <div class="bankdetails">
                                        	उपरोक्त बिषयमा तपाइको फर्म यस कार्यालयमा सुचिकृत भएकाले नगरपालिकाको लागी तपशिल बमाजिमका सामानहरु आबश्यक भएकाले के कति दररेटमा उपलब्ध गराउन सकिन्छ र समान सप्लाइ गर्न इच्छुक भएमा <?= convertedcit($prastabana->prastabana_entry_date) ?> दिन भित्र भ्याट रकम समेत यस पत्रमा उल्लेख गरि  सामानहरुको कोटेशन पेश गर्नुहुन अनुरोध छ  ।
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
									      <br>
									      <br>
									      <br>
                                      <div style="float: left !important;"><strong>तपशिल : </strong></div>
                                      <div class="myspace"> </div>
									   <br>
                          <table class="table table-bordered  myWidth100">
                          	<tr>
                            	<th >क्र.स.</th>
                                <th >सामानको नाम</th>
                              <th >सामानको प्रति इकाई मूल्य </th>
                                <th >कैफियत</th>
                                                              
                            </tr>
                            <?php $i=1; foreach($kharid_result as $data):
                                 $iteminst = getItemInstance($data->category);
                                $item_selected = $iteminst->find_by_id($data->item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                ?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td></td>
                                 <td></td>
                                
                            </tr> 
                            
                                 <?php  $i++; endforeach;?>
                          </table>
                          <div class="myspacer20"></div>
                          <div class="oursignature" style="    border-top: 2px dashed #000000 !important; line-height: 100%;">&nbsp;</div>
                          
                          <div class="myspacer30"></div>
										
										<div class="myspacer"></div>

</div> 
										


                       								

</div>
				</div>
                                          <?php // }?>			
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
