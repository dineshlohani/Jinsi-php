<?php require_once("includes/initialize.php"); 
if(isset($_GET['submit']) || isset($_GET['kharid_id']))
{
    $prastabana_result=  Prastabanaadd::find_by_kharid_id($_GET['kharid_id']);
    // print_r($prastabana_result);exit;
    if(empty($prastabana_result))
    {
        echo alertBox("निम्न खरिद फारम नं को प्रस्तावना फारम भरिएको छैन ....","prastabana_search.php");
    }
}
 $fiscal_id= Fiscalyear::find_current_id();
 $fiscal_year = Fiscalyear::find_by_id($fiscal_id);
 $prastabana_view_result = Prastabanaadd::find_by_sql("select distinct kharid_id from prastabana_add");
?>
 
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>प्रस्ताब फाराम पेश गर्ने बारे </title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">प्रस्ताब फाराम पेश गर्ने बारे  |  <a href="dashboard_prastabana.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>प्रस्ताब फाराम पेश गर्ने बारे </h2>
                        <div class="userprofiletable">
                            <form method="get">
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                              <td>प्रस्ताब फाराम पेश गर्ने खोज्नुहोस: <input class="fill_height" type="text" name="kharid_id" placeholder="खरिद नं हल्नुहोस "/> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(!isset($_GET['submit']) && !isset($_GET['kharid_id'])):?>
                             <table  class="table table-bordered table-responsive td1">
                                <tr>
                                    <th>सि नं</th>
                                    <th>खरिद फारम नं </th>
                                     <th>प्रस्तावनाको प्रकार </th>
                                      <th> प्रस्ताव माग गरेको मिती</th>
                                   <th>फर्म/कम्पनी</th>
                                    <th>हेर्नुहोस</th>
                                </tr>
                                    <?php $i=1; foreach($prastabana_view_result as $data):
                                      $tippani_result = Jinsitippani::find_by_kharid_ids($data->kharid_id);
                                       $miti_result = Prastabanaadd::find_by_kharid_ids($data->kharid_id);
                                        $orgs_ids = Prastabanaadd::find_all_org_id($data->kharid_id);
                                        ?>
                                <tr>
                                   <td><?=convertedcit($i)?></td> 
                                    <td><?=convertedcit($data->kharid_id);?></td> 
                                    <td><?=  Prastabanaprakaradd::getName($miti_result->prastabana_prakar_id);?></td> 
                                    <td><?=convertedcit(DateEngToNep($miti_result->prastabana_entry_date_english));?></td> 
                                    <td><?php foreach($orgs_ids as $org_id): $organization =  Enlist::find_by_id($org_id); echo $organization->name.'<hr>'; endforeach; ?></td>
                                    <td><a href="prastabana_print.php?kharid_id=<?=$data->kharid_id?>" class="btn">पुरा विवरण हेर्नुहोस</a> <?php if(empty($tippani_result)){ ?><a href="prastabana_delete.php?kharid_id=<?=$data->kharid_id?>" class="btn">हटाउनुहोस</a><?php } ?></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </table>
                           
                            <?php endif;?>
                                         
                                     <?php if(isset($_GET['submit']) || isset($_GET['kharid_id'])):foreach($prastabana_result as $prastabana){
                            ?>
                            <div class="myPrint"><a href="prastabana_print.php?kharid_id=<?php echo $_GET['kharid_id'];?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                            <?php
                                         $enlist_result=  Enlist::find_by_id($prastabana->organization_id);
                                                $kharid_result = Kharid_mag_faram2::find_by_maag_id($prastabana->kharid_id);?>
                                         <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									
									
									<div class="printContent">
                                                                            <div class="mydate"><b> मिति :-</b><?php echo convertedcit(DateEngToNep($prastabana->prastabana_entry_date_english));?></div>
										
                                        <div class="chalanino"><b> पत्र संख्या :- <?= convertedcit($fiscal_year->year) ?> </b> </div>
                                        <div class="chalanino"><b> चलानी नम्बर :- </b> </div>
										
                                        <div class="myspacer"></div>
                                        <div class="subjectBold letter_subject">बिषय – प्रस्ताब फाराम पेश गर्ने बारे </div>
                                        <div class="chalanino">
                                        	 श्री <?php echo $enlist_result->name;?>   , <br><?php echo $enlist_result->address;?> । 
                                        </div>
                                        <div class="bankdetails">
                                        	उपरोक्त बिषयमा तपाइको फर्म यस कार्यालयमा सुचिकृत  भएकाले  गाँउपालिकाको लागी तपशिल बमाजिमका सामानहरु आबश्यक भएकाले के कति दररेटमा उपलब्ध गराउन सकिन्छ र समान सप्लाइ गर्न इच्छुक भएमा <?= convertedcit($prastabana->prastabana_entry_date)  ?> दिन भित्रमा यस पत्रमा  उल्लेखित सामानहरुको दर रेट उपलब्ध गरिदिनु हुन  अनुरोध छ ।
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
                                      <div><strong>तपशिल : </strong></div>
									       
                          <table class="table table-bordered table-responsive myWidth100">
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
                                 <?php $i++; endforeach;?>
                          </table>

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


