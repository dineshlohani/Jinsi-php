<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $fiscal_id= Fiscalyear::find_current_id();
  $fiscal = Fiscalyear::find_by_id($fiscal_id);
$sql = "select * from ledger as a left join ledger_details as b on a.id=b.ledger_id where b.item_id=".$_GET['item_id']." and b.category=".$_GET['category']." and b.rate=".$_GET['rate']." order by date ASC";
$result_set = $database->query($sql);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
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
                                                                                    <h1>मौज्जाद</h1>
                                            <table  class="table table-bordered myWidth100 td1">
                                                   
                                                  <tr>
                                                    <th  class="myCenter">क्र.स.</th>
                                                    <th  class="myCenter">जिन्सी नं/खाता पाना नं</th>
                                                   <th class="myCenter">जिन्सी सामानको नाम</th>
                                                   <th class="myCenter">स्टोर जिम्मा बाँकी परिमाण</th>
                                                    <th class="myCenter">इकाई</th>
                                                    <th class="myCenter">दर</th>
                                                  </tr>
                                                  
                                                  <?php
                                                  $stock_result= ItemStock::find_stock($_GET['item_id'],$_GET['category'],$_GET['rate']);
                                                   $spent_data= Notspentitem::find_by_id($_GET['item_id']); 
                                                  ?>
                                                  <tr>
                                                    <td><?php echo convertedcit(1);?></td>
                                                    <td><?php echo convertedcit($stock_result->khata_id);?></td>
                                                     <td><?php echo $spent_data->name;?></td>
                                                    <td><input class="none_input myCenter" type="text" name="prev_stock[]"  readonly="true" value="<?php echo convertedcit($stock_result->stock+0);?>"</td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($stock_result->rate+0);?></td>
                                                   </tr>
                                            </table><br>                           
                                              <h1> जिम्मेबारी</h1>
                                             <table  class="table table-bordered myWidth100 td1">
                                                   
                                                  <tr>
                                                    <th  class="myCenter">क्र.स.</th>
                                                    <th  class="myCenter">मिति</th>
                                                   <th class="myCenter">सामानको बुझ्नेको नाम</th>
                                                   <th class="myCenter">परिमाण</th>
                                                    <th class="myCenter">इकाई</th>
                                                    
                                                  </tr>
                                                  <?php $i=1; $total = 0;while($data =  mysqli_fetch_object($result_set)):
                                                    $name = get_name_by_type_and_enlist_id($data->type,$data->enlist_id);
                                                    $spent_data= Notspentitem::find_by_id($_GET['item_id']); 
                                                    
                                                     ?>
                                                  <tr>
                                                      <td><?=convertedcit($i)?></td>
                                                      <td><?=convertedcit(DateEngToNep($data->date))?></td>
                                                      <td><?=$name?></td>
                                                      <td><?=convertedcit($data->qty)?></td>
                                                       <td><?php echo Unit::getName($spent_data->unit_id);?></td>   
                                                     
                                                  </tr>
                                                  <?php $i++; $total+= $data->qty;endwhile;?>
                                                   <?php
                                                  $stock_result= ItemStock::find_stock($_GET['item_id'],$_GET['category'],$_GET['rate']);
                                                    $sum1= Ledgerdetails::sum_qty_by_item_id_rate_category($_GET['item_id'],$_GET['rate'],$_GET['category']);
                                                   $item_spent= Notspentitem::find_by_id($_GET['item_id']);
                                                    if(empty($sum1))
                                                     {
                                                         $sum= "---";
                                                    $total1= $stock_result->stock ;
                                                         }
                                                     else
                                                     {
                                                         $sum2 = Ledgerreturnhistory::sum_qty_by_item_id_rate_category($_GET['item_id'],$_GET['rate'],$_GET['category']);
                                                         $sum = $sum1 - $sum2   ;
                                                         $total1= $stock_result->stock - $sum;
                                                     }?>
                                                  <tr>
                                                      <td colspan="3"><b>अन्य शाखा तथा व्यक्ति जिम्मा रहेको जम्मा</b></td>
                                                      <td><b><?=convertedcit($total)?></b></td>
                                                      <td><b><?php echo Unit::getName($item_spent->unit_id);?></b></td> 
                                                  </tr>
                                                  <tr>
                                                      <td colspan="3"> <b>जिन्सी शाखामा जिम्मामा रहेको जम्मा</b></td>
                                                      <td><b><?=convertedcit($total1)?></b></td>
                                                      <td><b><?php echo Unit::getName($item_spent->unit_id);?></b></td>
                                                  </tr>
                                                 
                                            </table><br>     
										</div>
										<br><br><br>
<div class="banktextdetails">
   <table class="table borderless myWidth100">
	<tr>
    	<td>फाँटवालाको दस्तखत : <br><br> </td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	: <br> <br> </td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत :  <br> <br> </td>
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
                                          <?php // }?>			
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
