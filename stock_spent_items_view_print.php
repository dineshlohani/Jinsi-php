<?php require_once("includes/initialize.php"); 
  $item_type = ItemStock::find_by_sql("select * from item_stock where category=1 and stock !=0 order by item_id Asc");
  $fiscal_id= Fiscalyear::find_current_id();
  $fiscal = Fiscalyear::find_by_id($fiscal_id);
    $fiscal_all = Fiscalyear::find_all();
 $fiscal_months = array("04"=>"श्रावन", "05"=>"भाद्र", "06"=>"असोज","07"=>"कार्तिक","08"=> "मङ्सिर", "09"=>"पौष", "10"=>"माघ", "11"=>"फाल्गुन", "12"=>"चैत्र","01"=>"बैशाख","02"=>"जेष्ठ", "03"=>"असार");

  $month      = $_GET['month_id'];
  $fiscal_id  = $_GET['fiscal_id'];
  $date_array = getStartEndDates($fiscal_id, $month);
 // print_r($date_array);exit;

  $end_date   = $date_array[1];
  //$range      = createDateRange($start_date, $end_date);
 // print_r($range);exit;
 
 $amdani_total=0;
 $kharcha_total=0;
 $baki_total=0;
         
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण :: <?php echo SITE_SUBHEADING;?></title>

<body>
  
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
               
                        <div class="userprofiletable">
                  <?php if(isset($_GET['month_id'])): ?>                  
                                        <div class="printPage">

                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी सामानको <?= $fiscal_months[$_GET['month_id']] ?> महिना को आम्दानी खर्च विवरण</div>
									<div class="printContent">
										<div class="chalanino">आर्थिक वर्ष : <?= convertedcit($fiscal->year) ?> </div>
                                                                                <div  class="chalanino">मिती : <?= convertedcit(generateCurrDate()); ?>  </div>
										
                                                                               
										<div class="bankdetails">
                                                                                  
										     <table  class="table table-bordered table-responsive td1 td2">
                                                   
                                                  <tr>
                                                    <th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी नं/खाता पाना नं</th>
                                                    <th rowspan="2" class="myCenter"> जिन्सी वर्गिकरण संकेत नं</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी सामानको नाम</th>
                                                    <th rowspan="2" class="myCenter">इकाई</th>
                                                    <th rowspan="2" class="myCenter">दर</th>
                                                    <th colspan="2" class="myCenter">आम्दानी</th>
                                                    <th colspan="2" class="myCenter">खर्च</th>
                                                    <th colspan="2" class="myCenter">मौज्जाद बाँकी</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                    
                                                  </tr>
                                                  <tr>
                                                    <th class="myCenter">परिमाण</th>
                                                 
                                                    <th class="myCenter">जम्मा मुल्य</th>
                                                     <th class="myCenter">परिमाण</th>
                                                 
                                                    <th class="myCenter">जम्मा मुल्य</th> 
                                                    <th class="myCenter">परिमाण</th>
                                                 
                                                    <th class="myCenter">जम्मा मुल्य</th>
                                                  </tr>
                                               
                                                  <?php $i=1;foreach ($item_type as $data):
//                                                  //    print_r($data);exit;
                                                      $amdani_total=0;
                                                      $kharcha_total=0;
                                                      $baki_total=0;
                                                       $amount_amdani = 0;
                                                     $amount_kharcha = 0;
                                                     $amount_baki = 0;
                                                   
                                                        $spent_data=  Spentitem::find_by_id($data->item_id); 
                                                  $total_amount=$data->stock * $data->rate;
                                                  // echo $date;exit;
                                                        $item_details = get_item_rate1($data->item_id,1,$data->rate,$end_date);
                                                        // print_r($item_details);
                                                        $amdani_total+= $item_details[5];
                                                        $kharcha_total+=$item_details[4];
                                                        $baki_total+=$item_details[6];
                                                 
                                                    
                                                    $amdani_total+=$data->prev_stock;
                                                    $baki_total+=$data->prev_stock;
                                                     $amount_amdani = $amdani_total * $data->rate;
                                                     $amount_kharcha = $kharcha_total * $data->rate;
                                                     $amount_baki = $baki_total * $data->rate;
                                                  
                                                  ?>
                                       <?php if($amdani_total!=0): ?>           
                                                   <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($data->item_id);?></td>
                                                    <td> ५२/खर्च हुने</td>
                                                    <td><?php echo $spent_data->name;?></td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($data->rate+0);?></td>
                                                     <td><?= convertedcit($amdani_total) ?></td>
                                                     <td><?= convertedcit(placeholder($amount_amdani)) ?></td>
                                                     <td><?= convertedcit($kharcha_total) ?></td>
                                                     <td><?= convertedcit(placeholder($amount_kharcha)) ?></td>
                                                     <td><?= convertedcit($baki_total) ?></td>
                                                     <td><?= convertedcit(placeholder($amount_baki)) ?></td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                     <?php endif; ?>             
                                                    
                                                  <?php $i++;endforeach;?>
                                                  
                                                </table>
                                              
                                             

										</div>
<div class="banktextdetails">
    <br><br><br>
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति</td>
	  <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	  <td>मिति</td>
	  <td></td>
      <td>मिति</td>
	  <td></td>
  </tr>
</table>
</div> 
  <?php endif;?>  
										
										<div class="myspacer"></div>
									</div>
                                
                            </div><!-- print page ends -->
                                        

                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
  

