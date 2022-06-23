<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
//   $prastabana_result=  Prastabanaadd::find_by_kharid_id($_GET['kharid_id']);
$prastabana = Aanyaprastabana::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
//$prastabana_org = Aanyaorganization::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
$prastabana_reason = Aanyareason::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
$current_id = Fiscalyear::find_current_id();
$fiscal = Fiscalyear::find_by_id($current_id);
        
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>अन्य प्रस्ताब फाराम पेश गर्ने बारे  :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <?php // foreach($prastabana_result as $prastabana){
                                         $enlist_result=  Enlist::find_by_id($_GET['org_id']);
//                                                $kharid_result = Kharid_mag_faram2::find_by_maag_id($prastabana->kharid_id);?>
                                         <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									
									<div class="myspacer"></div>
									<div class="printContent">
                                        <div class="mydate"><b> मिति :- </b><?php echo convertedcit($prastabana->miti);?></div>
					 <div class="chalanino"><b> पत्र संख्या :<?=  convertedcit($fiscal->year)?> </b> </div>
					<div class="chalanino"><b> चलानी नम्बर :- </b> </div>
                                                                                 <div class="myspacer"></div>
                                        <div class="subjectBold letter_subject">बिषय – दररेट उपलब्ध गराउने बारे  </div>
                                        <div class="chalanino">
                                        	<b> श्री </b> <?php echo  $enlist_result->name;?> , <?php echo $enlist_result->address;?> । 
                                        </div>
                                        <div class="bankdetails">
                                            उपरोक्त बिषयमा तपाइको फर्म यस कार्यालयमा सुचिकृत भएकाले गाँउपालिकाको लागी तपशिल बमाजिमका  <?=  Prastabanaprakaradd::getName($prastabana->prastabana_prakar_id);?> आबश्यक भएकाले के कति दररेटमा उपलब्ध गराउन सकिन्छ र <?php if($prastabana->prastabana_prakar_id == 2){ ?> परामर्श सेवा उपलब्ध <?php } else { ?>सामान सप्लाइ <?php } ?>गर्न इच्छुक भएमा <?=convertedcit($prastabana->anya_prastabana_entry_date);?>   दिन भित्रमा यस पत्रमा उल्लेखित <?php if($prastabana->prastabana_prakar_id == 2){ ?> परामर्श सेवा<?php } else { ?>सामान<?php } ?>हरुको दररेट उपलब्ध गराईदिन हुन अनुरोध छ ।
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
									      <br>
									      <br>
									      <br>
                                     <div style="float: left !important;"><strong>तपशिल : </strong></div>
                                     <div class="oursignature" style="    border-top: 2px dashed #000000 !important; line-height: 100%;">&nbsp;</div>
                                     <div class="myspacer"></div>
									   <br>
                            <!--<table class="table table-bordered table-responsive myWidth100">-->
<!--                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">विवरण </th>
                                <th>कैफियत</th>                               
                            </tr>-->
                            <?php $i=1; foreach($prastabana_reason as $data):
                                 echo $data->aanya_prastabana_reason;
                                ?>
<!--                            <tr>
                            	<td></td>
                                <td><?=$data->aanya_prastabana_reason?></td>
                                <td>&nbsp;</td>
                                
                            </tr> 
                            -->
                                 <?php  $i++; endforeach;?>
                          <!--</table>-->

</div> 
										


                       								

</div>
				</div>
                                  		
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
