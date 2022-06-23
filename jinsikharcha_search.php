<?php require_once("includes/initialize.php"); 
$khata_id = '';
$print_url = '#';
$array_result= ItemStock::find_by_sql("select distinct item_id from item_stock where category=1 order by khata_id ASC");
// echo "<pre>";
// print_r($array_result);
// echo "</pre>";exit;
 if(isset($_GET['khata_id']))
 {
    $khata_id = $_GET['khata_id'];
        $khata_result = ItemStock::find_by_khata_id($khata_id,1);
     //print_r($khata_result);exit;
       $item_id = $khata_result->item_id;
    $all_dates = getAllDatesByItemId($item_id,1);
    $iteminst = getItemInstance(1);
    $item_selected = $iteminst->find_by_id($item_id);
    if(!empty($item_selected))
    {
        $unit_selected = Unit::find_by_id($item_selected->unit_id);
    }
    else
    {
        $unit_selected = Unit::setEmptyObjects();
    }
    $print_url = generatePrintUrl();
    
 }
  
  $deps = Department::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मालसामानको खाता खोज्नुहोस:: <?= getSiteTitle()?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च भएर जाने जिन्सी मालसामानको खाता खोज्नुहोस / <a class="btn" href="dashboard_jinsikhata.php">जिन्सी खातामा जानुहोस </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>खर्च भएर जाने जिन्सी मालसामानको खाता खोज्नुहोस	 </h2>
                        <div class="userprofiletable">
                            <form method="get">
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                              <td>खर्च भएर जाने जिन्सी मालसामानको खाता	खोज्नुहोस: <input class="fill_height" type="text" name="khata_id" value="<?=$khata_id?>" /> <input type="submit" value="खोज्नुहोस" value="<?=$item_id?>" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(isset($_GET['khata_id'])){  ?>
                            <?php if(empty($item_selected)) {echo '<h3>सम्बन्धित खाता भेटिएन पुन: प्रयास गर्नुहोस</h3>'; exit;}?>
                            <div class="myPrint"><a href="<?=$print_url?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
                                              <div class="mydate">म.ले.प. फाराम नं : ५२</div><br>
                                              <div class="mydate">जिन्सी खाता  नं : <?=convertedcit($_GET['khata_id'])?></div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मालसामानको खाता	</div>
									<div class="printContent">
										<div class="chalanino"><b>खर्च भएर जाने जिन्सी मालसामानको  नाम :- </b> <?=$item_selected->name?> </div>
										<div class="patrano"><b> इकाई :- </b> <?=$unit_selected->name?></div>
										<div class="chalanino"><b> स्पेशिफिकेशन :- </b> <?=$item_selected->specification?> </div>
                                                                                
										<div class="banktextdetails">
										     <table  class="table table-bordered table-responsive td1 td2">
                                                  <tr>
                                                    <th rowspan="2">मिति</th>
                                                    <th rowspan="2">दाखिला नं/ निकासी नं</th>
                                                    <th rowspan="2">मार्फत</th>
                                                    <th colspan="3">आम्दानी</th>
                                                    <th colspan="3">खर्च</th>
                                                    <th colspan="3">बाँकी</th>
                                                    <th rowspan="2">कैफियत

</th>
                                                  </tr>
                                                  <tr>
                                                    <th>परिमाण</th>
                                                    <th>दर</th>
                                                    <th>रकम</th>
                                                    <th>परिमाण</th>
                                                    <th>दर</th>
                                                    <th>रकम</th>
                                                    <th>परिमाण</th>
                                                    <th>दर</th>
                                                    <th>रकम</th>
                                                  </tr>
                                                
                                  <?php
                                  $total_qty = 0; $total_rate = ''; $total_amount = 0;
                                  //$maag_kharcha_total_qty = 0; $maag_kharcha_total_rate = ''; $maag_kharcha_total_amount = 0;
                                  foreach ($all_dates as $date_selected):
                                    // echo $date_selected; 
                        $dakhila_sql = "select  dakhilaitem.*  , dakhilaprofile.* "
                        . " from dakhila_item_details as dakhilaitem "
                        . "  left join dakhila_profile as dakhilaprofile  "
                        . "on dakhilaitem.dakhila_id=dakhilaprofile.id"
                        . " where dakhilaprofile.date_english='".$date_selected."' and dakhilaitem.item_id=$item_id and dakhilaitem.category=1";
                         $dakhila_result = $database->query($dakhila_sql);
                        $dakhila_rows = $database->num_rows($dakhila_result);
                        $maag_sql = "select  kharcha2.*  , kharcha1.* "
                        . " from kharcha_mag_faram_2 as kharcha2 "
                        . "  left join kharcha_mag_faram_1 as kharcha1  "
                        . "on kharcha2.maag_id=kharcha1.id"
                        . " where kharcha1.maag_date_english='".$date_selected."' and kharcha2.item_id=$item_id and kharcha2.category=1";
                      // echo $maag_sql; exit;
                        $maag_result = $database->query($maag_sql);
                        $maag_rows = $database->num_rows($maag_result);
                        
                        $hastantaran_sql="select  has2.*  , has1.* "
                        . " from hastantaran_second as has2 "
                        . "  left join hastantaran_one as has1 "
                        . "on has2.hastantaran_id=has1.hastantaran_id"
                        . " where has1.hastantaran_date_english='".$date_selected."' and has2.item_id=$item_id and has2.category=1";
                        $hastantaran_result = $database->query($hastantaran_sql);
                        $hastantaran_rows = $database->num_rows($hastantaran_result);
                        
                         $jinsiminha_sql="select * from jinsi_minha_final where item_id=$item_id and category=1 and created_date_english='".$date_selected."'";
//                        echo $jinsiminha_sql;
                         $jinsiminha_result = $database->query($jinsiminha_sql);
                        $jinsiminha_rows = $database->num_rows($jinsiminha_result);
                        
                         $jinsililam_sql="select * from jinsi_lilam_final where item_id=$item_id and category=1 and created_date_english='".$date_selected."'";
//                       echo "<br>".$jinsililam_sql;exit;
                         $jinsililam_result = $database->query($jinsililam_sql);
                        $jinsililam_rows = $database->num_rows($jinsililam_result);
//                        echo $date_selected;exit;
                         $stock_sql= "select * from item_stock where item_id=$item_id and category=1 and stock_date_english='".$date_selected."'";
//                         echo $stock_sql;exit;
                        $stock_result = $database->query($stock_sql);
                        $stock_row = $database->num_rows($stock_result);
                        
                        $hastantaran_department_sql= "select * from item_stock_department where item_id=$item_id and category=1 and stock_date_english='".$date_selected."'";
                        $hastantaran_department_result = $database->query($hastantaran_department_sql);
                        $hastantaran_department_row = $database->num_rows($hastantaran_department_result);
                        ?>
                                                  <?php if($stock_row>0):
                             while($dakhila_fetch = mysqli_fetch_object($stock_result)):
                                                   if(strtotime($dakhila_fetch->stock_date_english)<=0)   
                                                       
                                                   {
                                                       continue;
                                                   }
                                                      ?>
                                      <?php 
                                              $rate_applied= $dakhila_fetch->rate; 
                                              $dakhila_amount = $dakhila_fetch->prev_stock * $rate_applied;
                                              $total_qty +=$dakhila_fetch->prev_stock;
                                              $total_amount += $dakhila_amount;
                                      ?>
                                                  
                                                  <tr>
                                                    <td><?=convertedcit($dakhila_fetch->stock_date)?></td>
                                                    <td></td>
                                                     <td>गत मौज्दात</td>
                                                    <td><?=convertedcit($dakhila_fetch->prev_stock+0)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$rate_applied)+0)?></td>
                                                    <td><?= convertedcit(sprintf("%0.2f",$dakhila_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                    <?php endwhile; ?>
                            <?php endif; ?>
                         <?php if($dakhila_rows>0):
                             while($dakhila_fetch = mysqli_fetch_object($dakhila_result)):?>
                                      <?php ($dakhila_fetch->bill_type==2)? $rate_applied = $dakhila_fetch->rate_vat :
                                              $rate_applied= $dakhila_fetch->rate_vat; 
                                              $dakhila_amount = $dakhila_fetch->qty*$rate_applied;
                                              $total_qty +=$dakhila_fetch->qty;
                                              $total_amount += $dakhila_amount;
                                      ?>
                                           
                                                  <tr>
                                                    <td><?=convertedcit($dakhila_fetch->date_nepali)?></td>
                                                    <td><?=convertedcit($dakhila_fetch->id)?></td>
                                                     <td>दाखिला मार्फत</td>
                                                    <td><?=convertedcit($dakhila_fetch->qty)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$rate_applied)+0)?></td>
                                                    <td><?= convertedcit(sprintf("%0.2f",$dakhila_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  
                                    <?php endwhile; ?>
                            <?php endif; ?>
                        <?php if($hastantaran_department_row>0):
                             while($hastantaran_dakhila_fetch = mysqli_fetch_object($hastantaran_department_result)):?>
                                      <?php 
                                              $rate_applied= $hastantaran_dakhila_fetch->rate; 
                                              $dakhila_amount = $hastantaran_dakhila_fetch->stock*$rate_applied;
                                              $total_qty +=$hastantaran_dakhila_fetch->stock;
                                              $total_amount += $dakhila_amount;
                                      ?>
                                                  
                                                  <tr>
                                                    <td><?=convertedcit($hastantaran_dakhila_fetch->stock_date)?></td>
                                                    <td></td>
                                                     <td>हस्तान्तरण मार्फत दाखिला </td>
                                                    <td><?=convertedcit($hastantaran_dakhila_fetch->stock)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$rate_applied)+0)?></td>
                                                    <td><?= convertedcit(sprintf("%0.2f",$dakhila_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                    <?php endwhile; ?>
                            <?php endif; ?>
                           <?php if($maag_rows>0):
                                    while($maag_fetch = mysqli_fetch_object($maag_result)):
                                    $maag_amount = $maag_fetch->qty*$maag_fetch->rate;
                                    $total_qty -=$maag_fetch->qty;
                                    $total_amount -= $maag_amount;
                               ?>
                        
                                                  
                                                  <tr>
                                                    <td><?=convertedcit($maag_fetch->maag_date)?></td>
                                                    <td><?=convertedcit($maag_fetch->maag_id)?></td>
                                                     <td>खर्च माग फारम  मार्फत</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($maag_fetch->qty)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$maag_fetch->rate)+0)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$maag_amount)+0)?></td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                      </tr>
                        
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if($hastantaran_rows>0):
                                    while($has_fetch = mysqli_fetch_object($hastantaran_result)):
                                    $has_amount = $has_fetch->quantity * $has_fetch->rate;
                                    $total_qty -=$has_fetch->quantity;
                                    $total_amount -= $has_amount;
                               ?>
                        
                                                 
                                                <tr>
                                                    <td><?=convertedcit($has_fetch->hastantaran_date)?></td>
                                                    <td><?=convertedcit($has_fetch->hastantaran_id)?></td>
                                                    <td>हस्तान्तरण मार्फत</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($has_fetch->quantity)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$has_fetch->rate)+0)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$has_amount)+0)?></td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if($jinsiminha_rows > 0):
                                    while($minha_fetch = mysqli_fetch_object($jinsiminha_result)):
                                    if($minha_fetch->actual_reduced_stock==0 || $minha_fetch->actual_reduced_stock=="")
                                    {
                                        continue;
                                    }
                                    $minha_amount = $minha_fetch->actual_reduced_stock * $minha_fetch->rate;
                                    $total_qty -=$minha_fetch->actual_reduced_stock;
                                    $total_amount -= $minha_amount;
                               ?>
                        
                                                  
                                                  <tr>
                                                    <td><?=convertedcit($minha_fetch->created_date)?></td>
                                                    <td><?=convertedcit($minha_fetch->jinsi_minha_id)?></td>
                                                    <td>जिन्सी मिन्हा मार्फत</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($minha_fetch->actual_reduced_stock)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$minha_fetch->rate)+0)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$minha_amount)+0)?></td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                      </tr>
                        
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if($jinsililam_rows > 0):
                                    
                                    while($lilam_fetch = mysqli_fetch_object($jinsililam_result)):
                                      if($lilam_fetch->actual_reduced_stock==0 || $minha_fetch->actual_reduced_stock=="")
                                    {
                                        continue;
                                    }
                                    $lilam_amount = $lilam_fetch->actual_reduced_stock * $lilam_fetch->rate;
                                    $total_qty -=$lilam_fetch->actual_reduced_stock;
                                    $total_amount -= $lilam_amount;
                               ?>
                        
                                                  
                                                  <tr>
                                                    <td><?=convertedcit($lilam_fetch->created_date)?></td>
                                                    <td><?=convertedcit($lilam_fetch->jinsi_lilam_id)?></td>
                                                    <td>जिन्सी लिलाम  मार्फत</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit($lilam_fetch->actual_reduced_stock)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$lilam_fetch->rate)+0)?></td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$lilam_amount)+0)?></td>
                                                    <td><?=convertedcit($total_qty)?></td>
                                                    <td>&nbsp;</td>
                                                    <td><?=convertedcit(sprintf("%0.2f",$total_amount)+0)?></td>
                                                    <td>&nbsp;</td>
                                                      </tr>
                        
                                    <?php endwhile; ?>
                                <?php endif; ?>
                        <?php endforeach; ?>
                                                </table>

                                             

										</div>
<div class="banktextdetails">
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत:</td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति</td>
	  <td></td>
	  <td>मिति</td>
	  <td></td>
      <td>मिति</td>
	  <td></td>
  </tr>
</table>
</div> 
                
										
										<div class="myspacer"></div>
									</div>
                                
                            </div><!-- print page ends -->
                            <?php } else
                            {
                                
                                ?>
                            
                            <table  class="table table-bordered table-responsive td1">
                                <tr>
                                    <th>जिन्सी खाता पाना नं.</th>
                                    <th>सामानको नाम </th>
                                    <th>हेर्नुहोस</th>
                                </tr>
                                    <?php foreach($array_result as $data):
                                         $stock = ItemStock::find_by_item_id_and_category($data->item_id,1);
                                        //  print_r($stock);echo "<br>";
                                        $spent_result =  Spentitem::find_by_id($data->item_id);?>
                                <tr>
                                   <td><?=convertedcit($stock->khata_id)?></td> 
                                    <td><?=$spent_result->name;?></td> 
                                    <td><a href="jinsikharcha_search.php?khata_id=<?=$stock->khata_id?>" class="btn">पुरा विवरण हेर्नुहोस</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            
                            <?php } ?>
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

