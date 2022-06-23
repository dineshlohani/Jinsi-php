<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
  $item_type = ItemStock::find_by_sql("select * from item_stock where category=2 and stock !=0 order by item_id Asc");
  $fiscal_id= Fiscalyear::find_current_id();
  $fiscal = Fiscalyear::find_by_id($fiscal_id);
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
                                                                                  
										     <table  class="table table-bordered table-responsive td1 ">
                                                   
                                                  <tr>
                                                    <th  class="myCenter">क्र.स.</th>
                                                    <th  class="myCenter">जिन्सी नं/खाता पाना नं</th>
                                                   <th class="myCenter">जिन्सी सामानको नाम</th>
                                                   <th class="myCenter">परिमाण</th>
                                                    <th class="myCenter">इकाई</th>
                                                    <th class="myCenter">दर</th>
                                                    <th class="myCenter">अन्य शाखा तथा व्यक्ति जिम्मा रहेको</th>
                                                    <th class="myCenter">जिन्सी शाखामा जिम्मा रहेको</th>
                                                   </tr>
                                                  
                                                  <?php $i=1;foreach ($item_type as $data):
                                                       
                                                      $sum1= Ledgerdetails::sum_qty_by_item_id_rate_category($data->item_id,$data->rate,$data->category);
                                                     if(empty($sum1))
                                                     {
                                                         $sum= "---";
                                                    $total1= $data->stock ;
                                                         }
                                                     else
                                                     {
                                                         $sum2 = Ledgerreturnhistory::sum_qty_by_item_id_rate_category($data->item_id,$data->rate,$data->category);
                                                         $sum = $sum1 - $sum2   ;
                                                         $total1= $data->stock - $sum;
                                                     }
                                                    
                                                    
                                                        $spent_data= Notspentitem::find_by_id($data->item_id); 
                                                  $stock_result= ItemStock::find_by_item_id_and_category($data->item_id, $data->category);
                                                  $total_amount=$data->stock * $data->rate;?>
                                                  <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($stock_result->khata_id);?></td>
                                                     <td><?php echo $spent_data->name;?></td>
                                                    <td><input class="none_input myCenter" type="text" name="prev_stock[]"  readonly="true" value="<?php echo convertedcit($data->stock+0);?>"</td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($data->rate+0);?></td>
                                                    <td><?=  convertedcit(placeholder($sum))?></td>
                                                     <td><?=  convertedcit(placeholder($total1+0))?></td>
                                                    </tr>
                                                    
                                                  <?php $i++;endforeach;?>
                                                  
                                                </table>
                                              
                                             

										</div>
<div class="banktextdetails">
    <br><br><br><br>
   <table class="table borderless myWidth100 sign_table">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td> </td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति</td>
	  <td></td>
	  <td> </td>
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
