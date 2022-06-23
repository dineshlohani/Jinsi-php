<?php require_once("includes/initialize.php"); 
$fiscal_id= Fiscalyear::find_current_id();
$fiscal = Fiscalyear::find_by_id($fiscal_id);
$item_type_id_result = Notspentitem::find_by_sql("select distinct item_type_id from settings_not_spent_item");
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता हेर्नुहोस / <a class="btn" href="index.php">पछाडी  जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता विवरण</h2>
                        <div class="userprofiletable">
                        	
                            <div class="myPrint"><a href="jimmewari_khata_detail_report_print.php" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">

                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता</div>
									<div class="printContent">
										<div class="mydate chalanino">आर्थिक वर्ष : <?= convertedcit($fiscal->year) ?> </div>
                                                                                <div  class="chalanino">मिती : <?= convertedcit(generateCurrDate()); ?>  </div>
										
                                                                               
										<div class="bankdetails">
                                    <?php foreach($item_type_id_result as $result)
                                                   {    
                                                   $sql ="select distinct item_id, rate from item_stock as a left JOIN settings_not_spent_item as b on a.item_id=b.id where b.item_type_id='".$result->item_type_id."' and a.category=2 ORDER BY a.item_id ASC";
                                                  $result_set = $database->query($sql);
                                                  
                                                   ?>                      
                                                                                    <h1><strong><mark><?=Itemtype::getName($result->item_type_id)?></mark></strong></h1>
                                        <?php while($data= mysqli_fetch_object($result_set))
                                                { 
                                            $stock_result= ItemStock::find_stock($data->item_id,2,$data->rate);
                                            ?>
                                             <table  class="table table-bordered table-responsive td1">
                                                 <tr>
                                                     <td colspan="8" style="text-align: center;"><?=  Notspentitem::getName($data->item_id)." => ".convertedcit(placeholder($data->rate+0))?> ,  <b>स्टोरमा जम्मा बाँकी परिमाण</b> => <?php echo convertedcit($stock_result->stock+0);?></td>
                                                 </tr>
                                                 <tr>
                                                   <th  class="myCenter">क्र.स.</th>
                                                   <th  class="myCenter">मिति</th>
                                                   <th class="myCenter">सामानको बुझ्नेको नाम</th>
                                                  <th class="myCenter">अन्य शाखा तथा व्यक्ति जिम्मा रहेको</th>
                                                   <th class="myCenter">इकाई</th>
                                                    
                                                </tr>
                                                  <?php 
                                                  $sql1 = "select * from ledger as a left join ledger_details as b on a.id=b.ledger_id where b.item_id=".$data->item_id." and b.category=2 and b.rate=".$data->rate." order by date ASC";
                                                 $result_set1 = $database->query($sql1);
                                                 $i=1;
                                                 $total = 0;
                                                 while($datas =  mysqli_fetch_object($result_set1)):
                                                    $name = get_name_by_type_and_enlist_id($datas->type,$datas->enlist_id);
                                                   $spent_data= Notspentitem::find_by_id($data->item_id);   
                                                 ?>
                                                <tr>
                                                    <td><?=convertedcit($i)?></td>
                                                    <td><?=convertedcit(DateEngToNep($datas->date))?></td>
                                                    <td><?=$name?></td>
                                                  <td><?=convertedcit($datas->qty)?></td>  
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>   
                                                </tr>
                                                  <?php $i++;
                                                  $total+= $datas->qty;
                                                  endwhile;
                                                  ?>
                                                 <?php
                                                  $stock_results= ItemStock::find_stock($data->item_id,2,$data->rate);
                                                    $sum1= Ledgerdetails::sum_qty_by_item_id_rate_category($data->item_id,$data->rate,2);
                                                   $item_spent= Notspentitem::find_by_id($data->item_id);
                                                    if(empty($sum1))
                                                     {
                                                         $sum= "---";
                                                    $total1= $stock_results->stock ;
                                                         }
                                                     else
                                                     {
                                                         $sum2 = Ledgerreturnhistory::sum_qty_by_item_id_rate_category($data->item_id,$data->rate,2);
                                                         $sum = $sum1 - $sum2   ;
                                                         $total1= $stock_results->stock - $sum;
                                                     }?>
                                                 <tr>
                                                      <td colspan="3"><b>अन्य शाखा तथा व्यक्ति जिम्मा रहेको जम्मा</b></td>
                                                      <td><b><?=convertedcit($total)?></b></td>
                                                      <td><b><?php echo Unit::getName($item_spent->unit_id);?></b></td> 
                                                  </tr>
                                                  <tr>
                                                      <td colspan="3"> <b>जिन्सी शाखामा जिम्मामा रहेको जम्मा</b></td>
                                                      <td><b><?=convertedcit($total1+0)?></b></td>
                                                      <td><b><?php echo Unit::getName($item_spent->unit_id);?></b></td>
                                                  </tr>
                                                 
                                            </table><br>
                                            
                                        <?php
                                                }
                                        
                                        } ?>
										</div>
<div class="banktextdetails">
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत : </td>
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
                                        

                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

