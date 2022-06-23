<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
$jinsi_lilam_result= Jinsiminhaapprove::find_by_jinsi_minha_id($_GET['jinsi_minha_id']);
$jinsi_minha_id=$_GET['jinsi_minha_id'];
$fiscal_id= Fiscalyear::find_current_id();
$fiscal_year = Fiscalyear::find_by_id($fiscal_id);
 $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $lilam_result = Jinsiminhaapprove::find_by_sql("select distinct jinsi_minha_id from jinsi_minha_approve");
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>jinsi Lilam :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
                 <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate"><b> म.ले.प. फाराम नं :- </b>  ४८</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">जिन्सी मिन्हा टिप्पणी आदेश</div>
									<div class="printContent">
                                    
										<!--<div class="chalanino">जिन्सी निर्सग / मिन्हा फाराम नं: </div>-->
						<div class="chalanino"><b> पत्र संख्या :- <?=convertedcit($fiscal_year->year) ?> </b> </div>
                                                <div class="chalanino"><b>जिन्सी मिन्हा फारम नं  :-<?=  convertedcit($jinsi_minha_id)?></b> </div>					
                                        <div class="myspacer"></div>
                                         <div class="chalanino"><br>
                                                    श्रीमान । 
                                            </div>
                                            <div class="bankdetails">
                                                    उपरोक्त बिषयमा यस कार्यालयमा रहेका देहायका सामानहरु जिन्सी निरीक्षण बाट जिन्सी मिन्हा गर्नुपर्ने भनि सिफारिश भएकाले उक्त समानहरुको मिन्हाको लागि यो टिप्पणी पेस गर्दछु |
                                            <div class="myspacer"></div>
                                        </div>
									  <div class="bankdetails">
                                                                                
									        
                          
                        <table class="table table-bordered table-responsive myWidth100 td1">

                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">जिन्सी खाता पाना नं</th>
                                <th class="myCenter">जिन्सी बर्गीकरण संकेत नं</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">स्पेशिफिकेशन</th>
                                <th class="myCenter">शुरु प्राप्त मिति</th>
                                <th class="myCenter">प्रयोग भएको वर्ष</th>
                                <th class="myCenter">परिमाण</th>
                                <th class="myCenter">परल मूल्य</th>
                                  <th class="myCenter">लिलाम गर्ने परिणाम</th>
                                <th class="myCenter">हालको अनुमानित मूल्य</th>
                                <th class="myCenter">जिन्सी निर्सग / मिन्हाको कारण</th>                                
                            </tr>
                           <?php $i=1;foreach($jinsi_lilam_result as $data):
                                $stock_result=  ItemStock::find_by_id($data->stock_id);
                                $result= get_item_stock_details($data->item_id,$data->category);
                                $amount=$data->prev_stock * $data->rate; 
                                $dakhila_id =  DakhilaItemDetails::find_by_item_id_rate_category_of_max_dakhila($data->item_id,$data->category,$data->rate);
                                if(empty($dakhila_id))
                                {
                                    $dakhila_result=  ItemStock::find_stock($stock_result->item_id,$stock_result->category,$data->rate);
                                    $dakhila_date = $dakhila_result->stock_date;
                                    $total_year=calculate_total_days_year($dakhila_date);
                                }
                                else
                                 {
                                    $dakhila_profile_result =  Dakhilaprofile::find_by_id($dakhila_id);
                                    $dakhila_date = $dakhila_profile_result->date_nepali;
                                    $total_year=calculate_total_days_year($dakhila_date);
//                                        echo $total_year;exit;
                                }
                                   if($data->category==1)
                                 {
                                     $category= "खर्च हुने";
                                 }
                                 else
                                 {
                                     $category="खर्च नहुने";
                                 }     
                                 ?>
                            <tr>    
                            	 <td><?php echo convertedcit($i)?></td>
                                <td><?php echo convertedcit($stock_result->khata_id);?></td>
                                 <td><?php echo $category;?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['specification'];?></td>
                                <td><?php echo convertedcit($data->stock_entry_date);?></td>
                                <td><?php echo $total_year;?></td>
                                 <td><?php echo convertedcit($data->prev_stock);?></td>
                                 <td><?php echo convertedcit($amount);?></td>
                                 <td><?php echo convertedcit($data->reduce_stock);?></td>
                                <td><?php echo convertedcit($data->current_analysed_rate);?></td>
                                <td><?php echo convertedcit($data->reason);?></td>
                            </tr>   
                            <?php $i++; endforeach;?>
                          </table>
<!--                          <span> उपरोक्त लेखिए वमोजिम ठीक दुरुस्त हुँदा लिलाम गरी बिक्री गर्ने आदेशको लागि पेश गरेको छु । </span>-->

</div> 
										
<div class="myspacer"></div>

<div class="myspacer"></div>

<br>
<div class="oursignature">
सदर गर्ने </div>
	<div class="oursignatureleft">पेस गर्ने </div>
	<div class="myspacer"></div>
</div>
				</div>
                                         		
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
