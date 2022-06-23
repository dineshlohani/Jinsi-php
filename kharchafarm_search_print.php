<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $maag_id = '';
    $print_url = '#';
    $maag_id = (int) $_GET['maag_id'];
     $data_1 = Kharcha_mag_faram1::find_by_id($maag_id);
     if(!empty($data_1)): 
     $print_url = generatePrintUrl();
     $dep_selected = Department::find_by_id($data_1->department_id);
     $fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
     $data_2 = Kharcha_mag_faram2::find_by_maag_id($maag_id);
     endif;
    $item_type = Itemtype::find_all();
    $deps = Department::find_all();
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खर्च माग फारम खोज्नुहोस  :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/janani.png" alt="Logo"></div>
<div class="mydate">म.ले.प. फाराम नं: ५१</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">माग फाराम</div>
									<div class="printContent">
										<div class="chalanino">श्री प्रमुख : </div>
										<div class="patrano">भण्डार शाखा :</div>
										<div class="chalanino">निकासी नं : <?= convertedcit($_GET['maag_id']) ?></div>
                                        <div class="mydate in_block">आर्थिक वर्ष  : <?php echo convertedcit($fiscal_selected->year); ?> </div><br>
                                        <div class="mydate in_block"> मिति :  <?= convertedcit($data_1->maag_date) ?> </div>
                                                                                   
										<div class="banktextdetailss">
										     <table class="table table-bordered myWidth100">
	                                                                                 <tr>
    	                                                                                     <th>क्र.स.</th>
                                                                                             <th>सामानको नाम</th>
                                                                                             <th>स्पेशिफिकेशन</th>
                                                                                             <th>सामानको परिमाण</th>
                                                                                             <th>इकाई</th>
                                                                                             <th>निकासी सामानको परिमाण</th>
                                                                                             <th>जिन्सी खाता पाना नं</th>
                                                                                             <th>कैफियत</th>
                                                                                          </tr>
                                                                                          <tr>
                                                                                            <th>१</th>
                                                                                            <th>२</th>
                                                                                            <th>३</th>
                                                                                            <th>४</th>
                                                                                            <th>५</th>
                                                                                            <th>६</th>
                                                                                            <th>७</th>
                                                                                            <th>८</th>
                                                                                        </tr>
                                                                                        <?php $sn=1; foreach ($data_2 as $list): ?>
                                                                                            <?php 
                                                                                                $iteminst = getItemInstance($list->category);
                                                                                               $item_selected = $iteminst->find_by_id($list->item_id);
                                                                                               $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                                                                               $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                                                                                 $stock = ItemStock::find_by_item_id_and_category($item_selected->id,1);
                                                                                            ?>
                                                                                        <tr>
                                                                                            <td><?=convertedcit($sn)?></td>
                                                                                            <td><?=$item_selected->name?></td>
                                                                                            <td><?=$item_selected->specification?></td>
                                                                                            <td><?=convertedcit($list->qty)?></td>
                                                                                            <td><?=$unit_selected->name?></td>
                                                                                            <td><?=convertedcit((float)$list->qty)?></td>
                                                                                            <td><?=convertedcit($stock->khata_id)?></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <?php $sn++; endforeach;?>
                                                                                      </table>
										</div>
<div class="banktextdetails">
   <table class="table borderless t_height_on">
	<tr>
    	<td>माग गर्नेको दस्तखत : <br> <br> </td>
        <td>&nbsp;</td>
        <td>क. बजारबाट खरिद गरिदिनु ।	</td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>नाम</td>
	  <td></td>
	  <td> <span>&#10003;</span>  ख. मौज्दातबाट दिनु ।</td>
	  <td></td>
  </tr>
	<tr>
	  <td>मिति</td>
	  <td><?php // echo convertedcit(generateCurrDate());?></td>
	  <td>आदेश दिनेको दस्तखत</td>
	  <td></td>
  </tr>
	<tr>
	  <td>प्रयोजन-  <?= $dep_selected->name ?>को ला </td>
	  <td></td>
	  <td>मिति</td>
	  <td><?php // echo convertedcit(generateCurrDate());?></td>
  </tr>
	<tr>
	  <td>जिन्सी खातामा चढाउनेको दस्तखत</td>
	  <td></td>
	  
  <td >मालसामान बुझिलिनेको दस्तखत</td>
      
	  <td></td>
  </tr>
	<tr>
	  <td>मिति</td>
	  <td><?php // echo convertedcit(generateCurrDate());?></td>
	  <td>मिति</td>
	  <td><?php // echo convertedcit(generateCurrDate());?></td>
  </tr>
</table>
</div> 
                       
										
										<div class="myspacer"></div>
									</div>
                                
                            </div><!-- print page ends -->
                                        	
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
