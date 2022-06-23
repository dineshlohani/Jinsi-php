<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $maujad_id=$_GET['maujad_id'];
 $result= Spentmaujadbarsikkharcha::find_by_maujad_id($_GET['maujad_id']);
 $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
   $maujad_date_result = Spentmaujadbarsikkharcha::find_by_maujad_ids($_GET['maujad_id']);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण फाराम खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinals" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
<div class="mydate"><b> म.ले.प. फाराम नं :- </b> ५३</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण फाराम</div>
									<div class="printContent">
										<div class="chalanino"><b> आर्थिक वर्ष:- </b> <?php echo convertedcit($fiscal->year);?>	</div>
										
                                        <div class="myspacer"></div>
									  <div class="bankdetails">
                                        <span><b> जिन्सी मौज्जाद फाराम नं :- </b> <?php echo convertedcit($maujad_id);?></span>
                                         <div class="chalanino">जिन्सी मौज्जाद मुल्यांकन मिती : <b><?php echo convertedcit($maujad_date_result->created_date);?></b></div>
						
									        <table  class="table table-bordered myWidth100">
                                               
                                                  <tr>
                                                    <th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी नं/खाता पाना नं</th>
                                                    <th rowspan="2" class="myCenter"> जिन्सी वर्गिकरण संकेत नं</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी सामानको नाम</th>
                                                    <th colspan="4" class="myCenter">मौज्जाद बाँकी</th>
                                                    <th colspan="4" class="myCenter">जिन्सी सामानको भौतिक अवस्था</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                  </tr>
                                                  <tr>
                                                    <th class="myCenter">परिमाण</th>
                                                    <th class="myCenter">इकाई</th>
                                                    <th class="myCenter">दर</th>
                                                    <th class="myCenter">जम्मा मुल्य</th>
                                                    <th class="myCenter">प्रयोगमा रहेको</th>
                                                    <th class="myCenter">प्रयोगमा नरहेको</th>
                                                    <th class="myCenter">मर्मत गर्नुपर्ने</th>
                                                    <th class="myCenter">मर्मत हुन नसक्ने</th>
                                                  </tr>
                                                  <tr>
                                                   <th class="myCenter">१</th>
                                                    <th class="myCenter">२</th>
                                                    <th class="myCenter">३</th>
                                                    <th class="myCenter">४</th>
                                                    <th class="myCenter">५</th>
                                                    <th class="myCenter">६</th>
                                                    <th class="myCenter">७</th>
                                                    <th class="myCenter">८</th>
                                                    <th class="myCenter">९</th>
                                                    <th class="myCenter">१०</th>
                                                    <th class="myCenter">११</th>
                                                    <th class="myCenter">१२</th>
                                                    <th class="myCenter">१३</th>
                                                  </tr>
                                                    <?php $i=1; foreach($result as $data):
                                                      $item_result=  ItemStock::find_by_id($data->spent_item_id);
                                                      $spent_data=  Spentitem::find_by_id($item_result->item_id); 
                                                    if(!empty($data))
                                                    {
                                                        $stock=$data->prev_stock;
                                                        $rate=$item_result->rate;
                                                        $amount=$stock * $rate;
                                                    }
                                                    else
                                                    {
                                                        $stock="";
                                                        $rate="";
                                                        $amount="";
                                                    } 
                                                    
                                                    
                                                      ?>
                                                  <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($spent_data->id); ?></td>
                                                    <td><?php echo convertedcit($spent_data->budget_title_id); ?></td>
                                                    <td><?php echo $spent_data->name;?></td>
                                                     <td><?php echo convertedcit($data->prev_stock);?></td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($item_result->rate);?></td>
                                                   <td><?php echo convertedcit(placeholder($amount));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->in_use));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->not_in_use));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->to_repair));?></td>
                                                    <td><?php echo convertedcit($data->not_to_repair); ?></td>
                                                    <td><?php echo $data->remarks;?></td>
                                                  </tr>
                                                  <?php $i++; endforeach;?>
                                                </table>

                                             

										</div>
<div class="banktextdetails">
   <table class="table borderless myWidth100">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :-</td>
	  <td></td>
	  <td>मिति :- </td>
          <td></td>
      <td>मिति</td>
	  <td> </td>
  </tr>
</table>
</div> 
                       								

</div>
				</div>				
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
