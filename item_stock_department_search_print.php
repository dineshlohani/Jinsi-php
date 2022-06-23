<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
$hastantaran_id = $_GET['hastantaran_id'];
$has = ItemStockDepartment::find_by_adesh_id($hastantaran_id);
$data2 = ItemStockDepartment::find_by_has_id($hastantaran_id);
$fiscal_id=  Fiscalyear::find_current_id();
//print_r($fiscal_id);
$fiscal=  Fiscalyear::find_by_id($fiscal_id);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>हस्तान्तरण फाराम  खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate">म.ले.प. फाराम नं: ४६</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectbold1 letter_subject">हस्तान्तरण मार्फत दाखिला प्रतिवेदन फाराम</div>
									<div class="printContent">
								    <div class="mydate"><b> मिति :- </b> <?=convertedcit($has->stock_date)?></div>
                                    <div class="chalanino"><b>हस्तान्तरण मार्फत दाखिला प्रतिवेदन फाराम नं:- <?= convertedcit($hastantaran_id); ?></b> </div>
                                    
								    <div class="chalanino"><b> आर्थिक बर्ष: <?= convertedcit($fiscal->year) ?>  </b> </div>
									
                                                                                
                                                                                
                                                                                
										<div class="banktextdetailss">
                                        <table class="table table-responsive table-bordered">
                                                    <tr>
                                                    <th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी खाता पाना नं</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी बर्गीकरण संकेत नं</th>
                                                    <th rowspan="2" class="myCenter">सामानको नाम</th>
                                                    <th rowspan="2" class="myCenter">स्पेशिफिकेशन</th>
                                                    <th rowspan="2" class="myCenter">इकाइ</th>
                                                    <th rowspan="2" class="myCenter">परिमाण</th>
                                                    <th colspan="5" class="myCenter">मूल्य इन्भाइस अनुसार</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                </tr>
                                                    <tr>
                                                      <th class="myCenter">प्रति इकाइ दर</th>
                                                      <th class="myCenter">मु.अ. कर प्रति इकाइ</th>
                                                      <th class="myCenter">इकाइ मूल्य</th>
                                                      <th class="myCenter">अन्य खर्च</th>
                                                      <th class="myCenter">जम्मा</th>
                                              </tr>
                                              
                                              <?php $sn=1; 
                                              $total=0;
                                              foreach ($data2 as $list): ?>
                                            <?php 
                                                $khata_result = ItemStock::find_by_item_id_and_category($list->item_id, $list->category);
                                                $iteminst = getItemInstance($list->category);
                                                if($list->category==1)
                                                {
                                                  $type="खर्च हुने";
                                                }
                                                else
                                                {
                                                  $type="खर्च नहुने";
                                                }
                                               $item_selected = $iteminst->find_by_id($list->item_id);
                                               $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                               $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                               $firm_selected = Office::find_by_id($list->department_id)
                                            ?>
                                             <tr>
                                                      <td><?=convertedcit($sn)?></td>
                                                      <td><?=convertedcit($khata_result->khata_id)?></td>
                                                      <td><?= $type ?></td>
                                                      <td><?=$item_selected->name?></td>
                                                      <td><?=$item_selected->specification?></td>
                                                      <td><?=$unit_selected->name?></td>
                                                      <td><?=convertedcit($list->stock)?></td>
                                                      <td><?=convertedcit((float)$list->rate)?></td>
                                                      <td>0</td>
                                                      <td>0</td>
                                                      <td>0</td>
                                                      <td><?=convertedcit((float)$list->stock * $list->rate)?></td>
                                                      <td></td>
                                              </tr>
                                            <?php $sn++; 
                                            $total+= $list->stock * $list->rate;
                                            endforeach; 
                                            
                                            ?>
                                              <tr>
                                                  <td colspan="11" style="text-align: right;">जम्मा</td>
                                                  <td><?=convertedcit((float)$total)?></td>
                                                  <td></td>
                                              </tr>
                                              
                                            </table>										     

                                                                                                                            </div>
                                            <div class="banktextdetails1">
                                            माथी उल्लेखित सामानहरु <b> हस्तान्तरण मार्फत </b>  श्री <b> <?=$firm_selected->name?> </b> बाट प्राप्त हुन जाँची गन्ती गरी हेर्दा ठिक दुरुस्त भएकाले खातामा आम्दानी बाँधेको प्रमाणित गर्दछु ।												

                                            </div>
                                            <div class="banktextdetails1">

                                            <table class="table borderless table-responsive">
                                              <tr>
                                                <td>फाँटवालाको दस्तखत: </td>
                                                <td>&nbsp;</td>
                                                <td>प्रमाणित गर्ने शाखा प्रमुखको दस्तखत	: </td>
                                                <td>&nbsp;</td>
                                                <td>कार्यालय प्रमुखको दस्तखत : </td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td>नाम: </td>
                                                <td>&nbsp;</td>
                                                <td>नाम: </td>
                                                <td>&nbsp;</td>
                                                <td>नाम: </td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td>पद: </td>
                                                <td>&nbsp;</td>
                                                <td>पद: </td>
                                                <td>&nbsp;</td>
                                                <td>पद: </td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td>मिति :- </td>
                                                <td></td>
                                                <td>मिति :- </td>
                                                <td></td>
                                                <td>मिति :- </td>
                                                <td></td>
                                              </tr>
                                            </table>
                                            </div>

      
										
				</div>
                                
                            </div><!-- print page ends -->			
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
