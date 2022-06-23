<?php require_once("includes/initialize.php"); 
 Aanyaprastabana::resetAutoIncrement();
if(isset($_GET['submit']) || isset($_GET['anya_prastabana_id']))
{
    $prastabana_result= Aanyaprastabana::find_by_anya_prastabana_id($_GET['anya_prastabana_id']);
  //  print_r($prastabana_result);exit;
    if(empty($prastabana_result))
    {
        echo alertBox("निम्न प्रस्तावना फारम भरिएको छैन ....","aanya_prastabana_search.php");
    }
    $prastabana_org = Aanyaorganization::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
    $prastabana_reason = Aanyareason::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
    $prakar_result = Aanyaprastabana::find_by_aanya_prastabana_id($_GET['anya_prastabana_id']);
}

 $aanya_final_result = Aanyaprastabana::find_all();
?>
 
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>प्रस्ताब फाराम पेश गर्ने बारे </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">प्रस्ताब फाराम पेश गर्ने बारे  |  <a href="aanya_prastabana_dashboard.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>प्रस्ताब फाराम पेश गर्ने बारे </h2>
                        <div class="userprofiletable">
                            
                                   <?php if(!isset($_GET['submit']) && !isset($_GET['anya_prastabana_id'])):?>
                                        <table class="table table-bordered table-responsive myWidth100 td1">
                                           <tr>
                                           <th class="myCenter">क्र.स.</th>
                                           <th class="myCenter">अन्य प्रस्तावना दर्ता नं </th>
                                           <th>प्रस्तावनाको प्रकार </th>
                                           <th>प्रस्तावना माग गरेको  मिती </th>
                                           <th>खोज्नुहोस / हटाउनुहोस </th>
                                       </tr>
                                       <?php $i=1; foreach($aanya_final_result as $data):

                                           ?>
                                       <tr>
                                           <td><?=convertedcit($i)?></td>
                                           <td><?=convertedcit($data->anya_prastabana_id)?></td>
                                           <td><?=  Prastabanaprakaradd::getName($data->prastabana_prakar_id)?></td>
                                           <td><?=convertedcit($data->miti)?></td>
                                           <td><a href="aanya_prastabana_search.php?anya_prastabana_id=<?=$data->id?>" class="btn">खोज्नुहोस</a>
                                           <a href="aanya_prastabana_delete.php?anya_prastabana_id=<?=$data->id?>" class="btn">हटाउनुहोस</a></td>
                                       </tr> 

                                            <?php  $i++; endforeach;?>
                                     </table>
                            <?php endif;?>
                                     <?php if(isset($_GET['submit']) || isset($_GET['anya_prastabana_id'])):
                                         ?>
                              <div class="myPrint"><a href="aanya_prastabana_print.php?anya_prastabana_id=<?php echo $_GET['anya_prastabana_id'];?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                
                                <?php         foreach($prastabana_org as $prastabana){
                                               $enlist_result=  Enlist::find_by_id($prastabana->organization_id);
                                              ?>
                                          <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									
									
									<div class="printContent">
                                                                            <div class="mydate"><b> मिति :- </b><?php echo convertedcit(generateCurrDate());?></div><br>
										<div class="chalanino"><b> चलानी नम्बर :- </b> </div>
                                        <div class="chalanino"><b> पत्र संख्या :- </b> </div>
										
                                        <div class="myspacer"></div>
                                        <div class="subjectBold letter_subject">बिषय – दररेट उपलब्ध गराउने बारे  </div>
                                        <div class="chalanino">
                                        	<b>श्री  </b><?php echo  $enlist_result->name;?> , <?php echo $enlist_result->address;?> । 
                                        </div>
                                        <div class="bankdetails">
                                          उपरोक्त बिषयमा तपाइको फर्म यस कार्यालयमा सुचिकृत भएकाले गाँउपालिकाको लागी तपशिल बमाजिमका  <?=  Prastabanaprakaradd::getName($prakar_result->prastabana_prakar_id);?> आबश्यक भएकाले के कति दररेटमा उपलब्ध गराउन सकिन्छ र <?php if($prakar_result->prastabana_prakar_id == 2){ ?> परामर्श सेवा उपलब्ध <?php } else { ?>सामान सप्लाइ <?php } ?>गर्न इच्छुक भएमा <?=convertedcit($prakar_result->anya_prastabana_entry_date);?> दिन भित्रमा यस पत्रमा उल्लेखित <?php if($prakar_result->prastabana_prakar_id == 2){ ?> परामर्श सेवा<?php } else { ?>सामान<?php } ?>हरुको दररेट उपलब्ध गराईदिन हुन अनुरोध छ ।
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
                                     <div><strong>तपशिल : </strong></div>
									       
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
                                          <?php 
                                     } endif;?>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


