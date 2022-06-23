<?php require_once("includes/initialize.php"); 
 if(isset($_POST['submit']) || isset($_GET['land_id']))
 {
     $result=  Gharjaggaadd::find_by_sql("select * from gharjagga_add where land_id='".$_GET['land_id']."' limit 1");
    $data=  array_shift($result);
    if(empty($data))
    {
        echo alertBox("निम्न अभिलेख खाता भेटिएन ...","gharjagga_search.php");
    }
    $kitta_result=  Gharjaggakittaadd::find_by_ghar_jagga_id($_GET['land_id']);
    $kitta_count = count($kitta_result);
 }
 $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
$land_result =  Gharjaggaadd::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>घर जग्गा अभिलेख खाता</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">घर जग्गा अभिलेख खाता | <a href="dashboard_gharjagga.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>घर जग्गा अभिलेख खाता </h2>
                        <div class="userprofiletable">
                            <form method="get">
                        	<table class="table table-responsive bordereless  search_table">
                                          <tr>
                                              <td>घर जग्गा अभिलेख खाता खोज्नुहोस: <input type="text" name="land_id" /> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(!isset($_GET['submit']) && !isset($_GET['land_id'])):?>
                            <table class="table table-responsive bordereless search_table">
                                <tr>
                                    <th>घर जग्गा अभिलेख खाता नं</th>
                                    <th>जग्गा प्राप्त भएको मिति</th>
                                </tr>
                                <?php foreach($land_result as $data):?>
                                <tr>
                                    <td><?=convertedcit($data->land_id)?></td>
                                    <td><?=convertedcit($data->land_taken_date)?></td>
                                    <td><a href="gharjagga_search.php?land_id=<?=$data->land_id?>" class="btn">खोज्नुहोस </a> &nbsp;&nbsp;<a href="gharjagga_edit.php?land_id=<?=$data->land_id?>" class="btn">सच्याउनुहोस</a></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                            <?php if(isset($_GET['submit']) || isset($_GET['land_id'])):?>
                            <div class="myPrint"><a href="gharjagga_search_print.php?land_id=<?php echo $_GET['land_id'];?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate"><b> म.ले.प. फाराम नं :-</b> ५३</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">घर जग्गाको लगत किताब</div>
									<div class="printContent">
										<div class="chalanino"><b> आर्थिक वर्ष:- </b> <?php echo convertedcit($fiscal->year);?>	</div>
										
                                        <div class="myspacer"></div>
									  <div class="bankdetails">
									       <table class="table table-bordered table-responsive myWidth100">
                                                <tr>
                                                  <th rowspan="2" class="myCenter">क्र.स.</th>
                                                  <th rowspan="2" class="myCenter">जग्गाको किसिम</th>
                                                  <th colspan="3" class="myCenter">जग्गा प्राप्त हुँदाको	</th>
                                                  <th colspan="2" class="myCenter">जग्गा धनीको</th>
                                                  <th rowspan="2" class="myCenter">घरजग्गा रहेको स्थान</th>
                                                  <th rowspan="2" class="myCenter">घरले चर्चेको</th>
                                                  <th rowspan="2" class="myCenter">कित्ता नं</th>
                                                  <th rowspan="2" class="myCenter">जग्गाको कुल क्षेत्रफल</th>
                                                  <th rowspan="2" class="myCenter">इकाई</th>
                                                  <th rowspan="2" class="myCenter">कैफियत</th>
                                                </tr>
                                                <tr>
                                                  <td class="myCenter">किसिम</td>
                                                  <td class="myCenter">मिति</td>
                                                  <td class="myCenter">मूल्य</td>
                                                  <td class="myCenter">नाम</td>
                                                  <td class="myCenter">प्रमाण पत्र नं</td>
                                                 
                                                  </tr>
                                                  <?php if($kitta_count==1){ ?>
                                                <tr>
                                                  <td><?php echo convertedcit(1);?></td>
                                                  <td><?php echo Landtype::getName($data->land_type);?></td>
                                                  <td><?php echo Currentlandtype::getName($data->current_land_type);?></td>
                                                  <td><?php echo convertedcit($data->land_taken_date);?></td>
                                                  <td><?php echo convertedcit(placeholder($data->prev_land_value));?></td>
                                                  <td><?php echo $data->land_owner_name;?></td>
                                                  <td><?php echo convertedcit($data->land_identity_no);?></td>
                                                  <td><?php echo $data->land_address;?></td>
                                                  <td><?php echo convertedcit($data->land_area);?></td>
                                                  <td><?php echo convertedcit($kitta_result[0]->land_kitta_id);?></td>
                                                  <td><?php echo convertedcit($kitta_result[0]->land_total_area);?></td>
                                                  <td><?php echo Landunit::getName($kitta_result[0]->land_unit_id);?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                  <?php } else{ ?>
                                                <?php $j=1; foreach($kitta_result as $kitta_selected): ?>      
                                                 <tr>
                                                   <?php if($j>1){
                                                            echo getBlankTdForMultipleKitta();
                                                              }else{?>
                                                    <td><?php echo convertedcit(1); ?></td>
                                                  <td><?php echo Landtype::getName($data->land_type);?></td>
                                                  <td><?php echo Currentlandtype::getName($data->current_land_type);?></td>
                                                  <td><?php echo convertedcit($data->land_taken_date);?></td>
                                                  <td><?php echo convertedcit(placeholder($data->prev_land_value));?></td>
                                                  <td><?php echo $data->land_owner_name;?></td>
                                                  <td><?php echo convertedcit($data->land_identity_no);?></td>
                                                  <td><?php echo $data->land_address;?></td>
                                                  <td><?php echo convertedcit($data->land_area);?></td>
                                                  
                                                            <?php }
                                                     ?>
                                                   <td><?php echo convertedcit($kitta_selected->land_kitta_id);?></td>
                                                  <td><?php echo convertedcit($kitta_selected->land_total_area);?></td>
                                                  <td><?php echo Landunit::getName($kitta_selected->land_unit_id);?></td>
                                                 <td>&nbsp;</td>
                                                </tr>   
                                                <?php $j++; endforeach; ?>
                                                 <?php }?>
                                        </table>
                                      
                                                                            
</div> 
										
<div class="myspacer"></div>

<div class="bankdetails">
   <table class="table borderless table-responsive myWidth100">
		<tr>
        	<td><br>फाँटवालाको दस्तखत: <br></td>
            <td></td>
            <td><br>शाखा प्रमुखको दस्तखत: <br></td>
            <td></td>
            <td><br>कार्यालय प्रमुखको दस्तखत: <br></td>
            <td></td>
        </tr>
        <tr>
        	<td>मिति:- <?=  convertedcit(generateCurrDate())?> </td>
                <td></td>
            <td>मिति:- <?=  convertedcit(generateCurrDate())?> </td>
            <td></td>
            <td>मिति:- <?=  convertedcit(generateCurrDate())?> </td>
            <td></td>
        </tr>
   </table> <?php endif;?>
    
</div> 
                       								

</div>
				</div>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


