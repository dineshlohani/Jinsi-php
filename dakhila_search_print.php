<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
  $dakhila_id = '';
    $print_url = '#';
   $dakhila_id = (int) $_GET['dakhila_id'];
                    $data_1 = Dakhilaprofile::find_by_id($dakhila_id);
                    if($data_1->item_source==1)
                    {
                        $source_text = '<span style="font-weight:bold;">खरिद आदेश नं</span>';
                    }
                    else 
                    {
                        $source_text = '<span style="font-weight:bold;">हस्तान्तरण फाराम नं</span>';
                    }
                    if($data_1->bill_type==1)
                    {
                        $vat = "-";
                        $vat_row_style = 'style="display:none;"';
                        
                    }
                    else
                    {
                        $vat = "13 %";
                        $vat_row_style = "";
                    }
                    if(!empty($data_1)): 
                    $print_url = generatePrintUrl();
                    $adesh_selected = KharidAdeshProfile::find_by_id($data_1->adesh_id);
                    //$dep_selected = Department::find_by_id($data_1->department_id);
                   // $fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
                    $firm_selected = Enlist::find_by_id($adesh_selected->enlist_id);
                    $data_2 = DakhilaItemDetails::find_by_dakhila_id($dakhila_id);
                    endif;

?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>दाखिला रिर्पोट खोज्नुहोस:: <?php echo SITE_SUBHEADING;?></title>

<body>
    <div class="myPrintFinal print_Page" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/janani.png" alt="Logo"></div>
<div class="mydate">म.ले.प. फाराम नं: ४६</div>

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectbold1 letter_subject">दाखिला प्रतिवेदन फाराम</div>
									<div class="printContent">
										<div class="mydate"><b> मिति :- </b> <?=convertedcit($data_1->date_nepali)?></div>
                                        <div class="chalanino"><b> दाखिला प्रतिवेदन फाराम नं:-<?= convertedcit($dakhila_id); ?> </b> </div>
										<div class="chalanino"><b> आर्थिक बर्ष :<?= convertedcit(2077.2078) ?> </b> </div>
<br><br><br>										                                        
<div class="mySpacer30"></div>                                                                                
<div class="banktextdetailss">
    <table class="table myWidth100 tableBorder">
	<tr>
    	<th rowspan="2">क्र.स.</th>
        <th rowspan="2">जिन्सी खाता पाना नं</th>
        <th rowspan="2">जिन्सी बर्गीकरण संकेत नं</th>
        <th rowspan="2">सामानको नाम</th>
        <th rowspan="2">स्पेशिफिकेशन</th>
        <th rowspan="2">इकाइ</th>
        <th rowspan="2">परिमाण</th>
        <th class="myCenter" colspan="5">मूल्य इन्भाइस अनुसार</th>
        <th rowspan="2">कैफियत</th>
    </tr>
	<tr>
	  <th class="myCenter">प्रति इकाइ दर</th>
	  <th class="myCenter">मु.अ. कर प्रति इकाइ</th>
	  <th class="myCenter">इकाइ मूल्य</th>
	  <th class="myCenter">अन्य खर्च</th>
	  <th class="myCenter">जम्मा</th>
  </tr>
	
  <?php $sn=1; foreach ($data_2 as $list): ?>
  
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
   $dakhila_item = DakhilaItemDetails::find_by_dakhila_id($_GET['dakhila_id']);
?>
<?php if($list->vat_status==1){
$vat_amount = $list->rate*13/100;
$tot_vat_amt = $list->vat_total;
}else{
$vat_amount = 0;    
$tot_vat_amt = $list->total;
}
?>
 <tr>
	  <td><?=convertedcit($sn)?></td>
	   <td><?=convertedcit($khata_result->khata_id)?></td>
	  <td><?= $type ?></td>
	  <td><?=$item_selected->name?></td>
	  <td><?=$item_selected->specification?></td>
	  <td><?=$unit_selected->name?></td>
	  <td><?=convertedcit($list->qty)?></td>
	  <td><?=convertedcit((float)$list->rate)?></td>
	  <td>रु. <?=convertedcit((float)$vat_amount)?></td>
	  <td><?php echo convertedcit((float)round($list->rate_vat, 2, PHP_ROUND_HALF_UP));?></td>
	  <td><?=convertedcit((float)$list->extra_amount)?></td>
	  <td><?=convertedcit((float)$tot_vat_amt)?></td>
	  <td></td>
  </tr>
  <?php 
$sum=0;
$vat_tot=0;
foreach ($data_2 as $list): 
	$sum+=($list->qty);
    $vat_tot+=($list->vat_amount);
endforeach;?>
<?php $sn++; endforeach; ?>

<!--<tr <?=$vat_row_style?>>-->
<!--      <td colspan="11" style="text-align: right;">भ्याट (<?=convertedcit($vat)?>)</td>-->
<!--      <td><?php echo convertedcit($vat_tot);?> </td>-->
<!--      <td></td>-->
<!--  </tr>-->
  <tr>
      <td colspan="11" style="text-align: right;">जम्मा</td>
      <td><?=convertedcit((float)$data_1->sub_total)?></td>
      <td></td>
  </tr>
  
  <tr>
      <td colspan="11" style="text-align: right;">छुट</td>
      <td><?=convertedcit((float)$data_1->discount)?></td>
      <td></td>
  </tr>
  <tr>
      <td colspan="11" style="text-align: right;">कुल जम्मा</td>
      <td><?php echo convertedcit((float)round($data_1->grand_total, 2, PHP_ROUND_HALF_UP));?> </td>
      <td></td>
  </tr>
</table>										     

										</div>
										<div class="mySpacer30"></div>
<div class="banktextdetails1">
माथी उल्लेखित सामानहरु <b> खरिद आदेश नं  </b> <b> <?=convertedcit($adesh_selected->id)?> </b>   मिति <b> <?=convertedcit($adesh_selected->date_nepali)?> </b>अनुसार श्री <b> <?=$firm_selected->name?> </b> बाट प्राप्त भएकाले उक्त सामानहरु जाँची गन्ती गरी हेर्दा ठिक दुरुस्त भएकाले खातामा आम्दानी बाँधेको प्रमाणित गर्दछु ।												

</div>
<div class="banktextdetails1">

<table class="table borderless myWidth100">
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
