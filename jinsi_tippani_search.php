<?php require_once("includes/initialize.php"); 
 error_reporting(1);
$kharid_id="";
$result_tippani=  Jinsitippani::find_by_sql("select distinct kharid_id from jinsi_tippani");
if(isset($_GET['submit']) || isset($_GET['kharid_id']))
{
    $kharid_id=$_GET['kharid_id'];
    $tippani_result =  Jinsitippani::find_by_kharid_id($_GET['kharid_id']);
   // print_r($tippani_result);exit;
    if(empty($tippani_result))
    {
    echo alertBox("खरिद माग फारम भेटिएन","jinsi_tippani_search.php");
    exit;
        
    }
   $org_result=  Jinsitippani::find_org($_GET['kharid_id']);
   $org_count=count($org_result);
    $kharcha_item_ids = Jinsitippani::get_item_id_by_category_kharid_id_org_id(1,$_GET['kharid_id'],$org_result[0]->org_id);
    $khapne_item_ids  =  Jinsitippani::get_item_id_by_category_kharid_id_org_id(2,$_GET['kharid_id'],$org_result[0]->org_id);
    
    
    
    $name=get_enlist_org_name($kharid_id);
    $fiscal_id=  Fiscalyear::find_current_id();
   $fiscal=  Fiscalyear::find_by_id($fiscal_id);
   $array=array();
   foreach($org_result as $org)
   {
       $org_id=$org->org_id;
       $sum_amount=Jinsitippani::get_sum_by_kharid_id_org_id_item_id($kharid_id,$org->org_id);
       $array[$org_id]=$sum_amount;
   }
//   print_r($array); exit;
   $min_value = min($array);
   $minimum_rate_key=array_pop(array_keys($array,$min_value));
   $org_name=  Enlist::find_by_id($minimum_rate_key);
   $org_minimum_rate= Jinsitippani::get_sum_by_kharid_id_org_id_item_id($kharid_id,$minimum_rate_key);
   $tippani_adesh_result= TippaniAdesh::find_by_kharid_ids($kharid_id);
   $date_result = Jinsitippani::find_by_kharid_id_date($kharid_id);
   $prastabana_result= Prastabanaadd::find_by_kharid_ids($kharid_id);
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सामान खरिद सम्बन्धमा </title>



<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> सामान खरिद सम्बन्धमा  |  <a href="dashboard_jinsitippani.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>सामान खरिद सम्बन्धमा</h2>
                        <div class="userprofiletable">
                             <form method="get">
                          <table class="table table-responsive bordereless search_table">
                              <tr>
                                  <td>खरिद माग फाराम नं	: <input class="fill_height" type="text" name="kharid_id"  value="<?=$kharid_id?>" required> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"></td>
                                  
                              </tr>
                              
                          </table>
                             </form>
                            <?php if(!isset($_GET['submit'])):?>
                            <table class="table table-responsive bordereless search_table">
                                <tr>
                                    <th>सि नं</th>
                                    <th>माग फारम नं</th>
                                    <th>टिप्पणी मिती</th>
                                </tr>
                                <?php 
                                $i=1 ;foreach($result_tippani as $data):
                                    $miti = Jinsitippani::find_by_kharid_id_date($data->kharid_id);
                                    $link_result = KharidAdeshProfile::find_by_maag_id($data->kharid_id)
                                    ?>
                                <tr>
                                    <td><?=convertedcit($i)?></td>
                                    <td><?=convertedcit($data->kharid_id)?></td>
                                    <td><?=convertedcit($miti->tippani_miti)?></td>
                                    <td><a href="jinsi_tippani_search.php?kharid_id=<?=$data->kharid_id?>" class="btn"> खोज्नुहोस </a>
                                        <a href="jinsi_tippani_edit.php?kharid_id=<?=$data->kharid_id?>" class="btn">सच्याउनुहोस</a> <?php if(empty($link_result)){ ?>&nbsp;<a href="jinsi_tippani_delete.php?kharid_id=<?=$data->kharid_id?>" class="btn">हटाउनुहोस</a><?php } ?></td>
                                </tr>
                                <?php $i++; endforeach;?>
                            </table>
                            <?php endif;?>
                            <?php if(isset($_GET['submit']) || isset($_GET['kharid_id'])):?>
                            <div class="myPrint"><a href="jinsi_tippani_search_print.php?kharid_id=<?=$kharid_id?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                     <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">टिप्पणी आदेश </div>
									<div class="myspacer"></div>
									
									
									
									<div class="printContent">
                                        <div class="mydate"><b> मिति :-</b><?php echo convertedcit($date_result->tippani_miti);?></div>
					
															
                                      
                                       
                                        <div class="myspacer"></div>
                                        <div class="subjectBold letter_subject">बिषय – सामान खरिद सम्बन्धमा </div>
                                        <div class="chalanino">
                                        	              श्रीमान्
                                        </div>
                                        <div class="bankdetails">
                                            यस कार्यालयको आ.ब <?php echo convertedcit($fiscal->year); ?> को स्वीकृत बार्षिक कार्यक्रम अनुसार तपशिलमा उल्लेखित समान खरिदका लागि कार्यालयमा सुचिकृत भएका  फर्महरु क्रमश <?php echo $name;?> सँग दररेट माग गरिएकोमा निजहरुबाट देहाय बमोजिमका सामानका भ्याट बाहेकको प्रतिगोटा  मुल्य  पेश भएकाले निजहरुले पेश गरेको मुल्य सुची अनुसार यो लागत अनुमान तयार गरिएको छ। 
                                                <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
                                      <div><strong>तपशिल : </strong></div>
									       
                          <table class="table table-bordered table-responsive myWidth100 td1">
                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">परिणाम</th>
                                  <th class="myCenter">इकाई</th>
                                <?php foreach($org_result as $data):
                                    $enlist_result=  Enlist::find_by_id($data->org_id);
                                 ?>
                                <th class="myCenter"><?=$enlist_result->name?></th>
                                <?php endforeach;?>
                            
                                 <td>खरिदका लागी छनौट फर्म</td>
                                 
                             </tr>                            
                            </tr>
                           <?php $i=1; $len = count($array); foreach($kharcha_item_ids as $kharcha_item_id):
                                $iteminst = getItemInstance(1);
                                $selected_result= Jinsitippani::find_minimum_rate_organization(1,$kharid_id,$kharcha_item_id);
                                $orgs= Enlist::find_by_id($selected_result->org_id);
                                $item_selected = $iteminst->find_by_id($kharcha_item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                $row_data = Jinsitippani::find_by_kharid_id_item_id_category($kharid_id,$kharcha_item_id,1);
                                $quantity_selected= Kharid_mag_faram2::find_by_maag_id_item_id_category($_GET['kharid_id'],$kharcha_item_id,1);
                                ?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td><?=convertedcit($quantity_selected->qty)?></td>
                                 <td><?=$unit_selected->name?></td>
                               <?php foreach($org_result as $result):?>
                                <?php $data = Jinsitippani::find_by_kharid_id_org_id_item_id_category($kharid_id,$result->org_id,$kharcha_item_id,1); ?>
                                <td><?php echo convertedcit($data->rate_tippani);?></td>
                                 <?php endforeach;?>
                                <td><?= $orgs->name ?></td>
                            </tr> 
                            
                            <?php $i++;endforeach;?>
                            <?php $i == $len - 1; foreach($khapne_item_ids as $khapne_item_id):
                                $iteminst = getItemInstance(2);
                               $selected_result= Jinsitippani::find_minimum_rate_organization(2,$kharid_id,$khapne_item_id);
                                $orgs= Enlist::find_by_id($selected_result->org_id);
                                $item_selected = $iteminst->find_by_id($khapne_item_id);
                                 $unit_selected = Unit::find_by_id($item_selected->unit_id);
                            $row_data = Jinsitippani::find_by_kharid_id_item_id_category($kharid_id,$khapne_item_id,2);
                            $quantity_selected= Kharid_mag_faram2::find_by_maag_id_item_id_category($_GET['kharid_id'],$khapne_item_id,2);
?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td><?=convertedcit($quantity_selected->qty)?></td>
                                 <td><?=$unit_selected->name?></td>
                               <?php foreach($org_result as $result):?>
                                <?php $data = Jinsitippani::find_by_kharid_id_org_id_item_id_category($kharid_id,$result->org_id,$khapne_item_id,2); ?>
                                <td><?php echo convertedcit($data->rate_tippani);?></td>
                                 <?php endforeach;?>
                                 <td><?= $orgs->name ?></td>
                            </tr> 
                            <?php $i++;endforeach;?>
                            <tr>
                                <td colspan="4">जम्मा परिणामको  मूल्य  </td>
                                 <?php foreach($org_result as $result):?>
                                <?php $data = Jinsitippani::find_all_by_kharid_id_org_id($kharid_id,$result->org_id);
                                $total_rate = $data[0]->total_rate;                                ?>
                                <td>रु. <?php echo convertedcit(placeholder($total_rate));?></td>
                                <?php endforeach;?>
                                <td></td>
                                
                            </tr>
                          
                          </table>
                     <div class="bankdetails">
                         
                             
                                            यस सन्दर्भमा माथि उल्लेखीत सामान खरिदका लागि लागत अनुमान हेर्दा ५ लाख भन्दा कम देखिएकोले सार्बजनिक खरिद नियमावलि २०६४  नियम ८५ को उपनियम १ को खण्ड क बमोजिम सोझै खरिद गर्न सकिने ब्यवास्था भएको र नियम ८५ कै उपनियम ४ बमोजिम १ लाख भन्दा बढी रकमको सामान सोझै खरिद गर्दा मौजुदा सुचिमा रहेका कम्तिमा ३ ओटा आपूर्ति कर्ता संग लिखित रुपमा दरभाउ पत्र माग गरि खरिद गर्न सकिने छ भनि व्यवस्था रहेको हुँदा देहायको सुचिमा उल्लेखित सामानहरु यस कार्यालयमा सुचिकृत फर्महरुसंग कोटेशन माग गरि खरिद गर्न मनासिब देखि निर्णयार्थ पेश गरेको छु।
                   <div class="myspacer"></div>
                     </div>
</div> 
										


                       								

</div>
				</div>
                                         
                                          
                                
                            </div><!-- print page ends --><?php endif;?>
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


