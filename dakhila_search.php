<?php require_once("includes/initialize.php"); 
    $dakhila_id = '';
    $print_url = '#';
    $max= Dakhilaprofile::getMax_adesh_id();
    if(isset($_GET['dakhila_id']))
    {

                    $dakhila_id = (int) $_GET['dakhila_id'];
                    //print_r($dakhila_id);
                    $data_1 = Dakhilaprofile::find_by_id($dakhila_id);
                    //print_r($data_1);
                    if($data_1->item_source==1)
                    {
                        $source1_text = '<span style="font-weight:bold;">खरिद आदेश नं</span>';
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
                    $firm_selected = Enlist::find_by_id($adesh_selected->enlist_id);
                    $data_2 = DakhilaItemDetails::find_by_dakhila_id($dakhila_id);
                    // echo "<pre>";
                    // print_r($data_2);
                    endif;

    }
    else
    {
        $sql_one ="select * from dakhila_profile order by id desc";
        $data_1 = Dakhilaprofile::find_by_sql($sql_one);
        // echo "<pre>";
        // print_r($data_1);
    }
?> 
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>दाखिला रिर्पोट खोज्नुहोस:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">दाखिला रिर्पोट खोज्नुहोस / <a href="dashboard_dakhila.php" class="btn">दाखिला रिर्पोटमा जानुहोस </a></h2>
                  
                    <div class="OurContentFull">
                    	<h2>दाखिला रिर्पोट खोज्नुहोस	 </h2>
                        <div class="userprofiletable">
                            <form method="get">
                        	<table class="table table-responsive left_margin search_table">
                                          <tr>
                                              <td>दाखिला रिर्पोट खोज्नुहोस: <input type="text" name="dakhila_id" value="<?=$dakhila_id?>" /> <input type="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(isset($_GET['dakhila_id'])){// show if maag_id is selected ?>
                                <?php if(!empty($data_1)){ ?>
                            
                            <div class="myPrint"><a href="<?=$print_url?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
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
                                    <div class="chalanino"><b> दाखिला प्रतिवेदन फाराम नं:- <?= convertedcit($dakhila_id); ?></b> </div>
								    <div class="chalanino"><b> आर्थिक बर्ष: <?= convertedcit(2077.2078) ?>  </b> </div>
									                                            
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
//   echo"<pre>";
//   print_r($item_selected);
   $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
   $unit_selected = Unit::find_by_id($item_selected->unit_id);
   
//   foreach($dakhila_item as $dakhila_item):
//       endforeach;
//   echo "<pre>";
//   print_r($dakhila_item);
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
	  <td><?=convertedcit($list->rate)?></td>
	  <td>रु. <?=convertedcit($vat_amount)?></td>
	  <td><?php echo convertedcit(round($list->rate_vat, 2, PHP_ROUND_HALF_UP));?></td>
	  <td><?=convertedcit($list->extra_amount)?></td>
	  <td><?=convertedcit($tot_vat_amt)?></td>
	  <td></td>
  </tr>
<?php $sn++; endforeach; ?>
<?php 
$sum=0;
$vat_tot=0;
foreach ($data_2 as $list): 
	$sum+=($list->qty);
    $vat_tot+=($list->vat_amount);
endforeach;?>
   <tr>
 	<td colspan="6" style="text-align : right;">Total QTY</td> 
 	<td><?php echo convertedcit($sum);?></td> 
   </tr>
  <tr>
      <td colspan="11" style="text-align: right;">जम्मा</td>
      <td><?=convertedcit($data_1->sub_total)?></td>
      <td></td>
  </tr>
  <tr>
      <td colspan="11" style="text-align: right;">छुट</td>
      <td><?=convertedcit($data_1->discount)?></td>
      <td></td>
  </tr>
  <tr>
      <td colspan="11" style="text-align: right;">कुल जम्मा</td>
      <td><?php echo convertedcit(round($data_1->grand_total, 2, PHP_ROUND_HALF_UP));?> </td>
      <td></td>
  </tr>
</table>										     
</div>
<div class="banktextdetails1">
माथी उल्लेखित सामानहरु <b> खरिद आदेश नं  </b> <b> <?=convertedcit($adesh_selected->id)?> </b>   मिति  </b> <?=convertedcit($data_1->date_nepali)?> </b>अनुसार  श्री <b> <?=$firm_selected->name?> </b> बाट प्राप्त भएकाले उक्त सामानहरु जाँची गन्ती गरी हेर्दा ठिक दुरुस्त भएकाले खातामा आम्दानी बाँधेको प्रमाणित गर्दछु ।												

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
                            <?php }else
                                {?>
                                       <h3>maag not found</h3>
                                <?php }
                                ?>
      <?php }else{// show if maag_id is selected ?>
                                                                                    
                                                                                    <table class="table table-bordered">
                                                                                             <tr>
                                                                                                 <th>सि.नं</th>
                                                                                                 <th>दाखिला फारम  नं </th>
                                                                                                 <th>दाखिला भएको  मिति</th>
                                                                                                 <th>फर्म / कम्पनिको नाम</th>
                                                                                                 <th>पुरा विवरण </th>
                                                                                            </tr>
                                                                                            <?php $i=1; foreach($data_1 as $data):
                                                                                           $adesh_selected = KharidAdeshProfile::find_by_id($data->adesh_id);
                                                                                           $firm_selected = Enlist::find_by_id($adesh_selected->enlist_id);
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?= convertedcit($i) ?></td>
                                                                                                <td><?=convertedcit($data->id)?></td>
                                                                                                <td><?=convertedcit($data->date_nepali)?></td>
                                                                                                <td><?=$firm_selected->name?></td>
                                                                                                <td><a class="btn" href="dakhila_search.php?dakhila_id=<?=$data->id?>">पुरा विवरण हेर्नुहोस </a> 
                                                                                                  <?php if($max==$data->adesh_id): ?>  
                                                                                                    <a class="btn" href="dakhila_profile_edit.php?id=<?=$data->id?>">सच्याउनु होस् </a>
                                                                                                  <?php endif; ?> 
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php $i++; endforeach;?>
                                                                                    </table>  
        <?php } ?>
										
				</div>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


