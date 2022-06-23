<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
  $result=  Spentjinsinirakshan::find_by_nirikshan_id($_GET['nirikshan_id']);
  $nirikshan_id=$_GET['nirikshan_id'];
 $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
  $nirikshan_date_result = Spentjinsinirakshan::find_by_nirikshan_ids($_GET['nirikshan_id']);
// print_r($fiscal);exit;
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>



<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate"><b> म.ले.प. फाराम नं :- </b> ५३</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम </div>
									<div class="printContent">
										<div class="chalanino"><b> आर्थिक वर्ष:- </b> <?php echo convertedcit($fiscal->year);?>	</div>
										
                                        <div class="myspacer"></div>
									  <div class="bankdetails">
                                       <span><b> निरिक्षण फाराम नं :- </b> <?php echo convertedcit($nirikshan_id);?> </span><br>
                                         <span><b> निरिक्षण मिती :-  <?php echo convertedcit($nirikshan_date_result->created_date);?> </b></span>
									       <table  class="table table-bordered myWidth100">
                                                 
                                                  <tr>
                                                    <th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">खाता पाना नं</th>
                                                    <th rowspan="2" class="myCenter"> जिन्सी वर्गिकरण संकेत नं</th>
                                                    <th rowspan="2" class="myCenter">विवरण</th>
                                                    <th rowspan="2" class="myCenter">इकाई</th>
                                                    <th colspan="2" class="myCenter">जिन्सी खाता वमोजिम मौज्जाद</th>
                                                    <th colspan="2" class="myCenter">स्पेशिफिकेशन	</th>
                                                    <th colspan="3" class="myCenter">भौतिक परीक्षण गर्दा</th>
                                                    <th colspan="2" class="myCenter">चालु हालतमा</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                  </tr>
                                                  <tr>
                                                    <th class="myCenter">परिमाण</th>
                                                    <th class="myCenter">मुल्य</th>
                                                    <th class="myCenter">मिलान भएको</th>
                                                    <th class="myCenter">मिलान नभएको</th>
                                                    <th class="myCenter">घट</th>
                                                    <th class="myCenter">बढ</th>
                                                    <th class="myCenter">घट/बढको मुल्य</th>
                                                    <th class="myCenter">रहेको</th>
                                                    <th class="myCenter">नरहेको</th>
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
                                                    <th class="myCenter">१४</th>
                                                    <th class="myCenter">१५</th>
                                                  </tr>
                                                  <?php $i=1; foreach($result as $data):
//     print_r($data);exit;
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
                                                    
                                                     if($data->specification_type==1)
                                                    {
                                                         $output="<td>मिलान भएको</td><td></td>";
                                                    } 
                                                    else if($data->specification_type==2)
                                                    {
                                                         $output="<td></td><td>मिलान नभएको</td>";
                                                    }
                                                    else
                                                    {
                                                        $output ="<td></td><td></td>";
                                                    }
                                                      ?>
                                                  <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($item_result->khata_id); ?></td>
                                                        <td><?php echo "५२ / खर्च हुने "; ?></td>
                                                    <td><?php echo $spent_data->name;?></td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($data->prev_stock);?></td>
                                                    <td><?php echo convertedcit(placeholder($amount));?></td>
                                                   <?=$output?>
                                                    <td><?php echo convertedcit(placeholder($data->reduce_amount));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->increased_amount));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->total_amount));?></td>
                                                   <td><?php echo convertedcit($data->current_status_active); ?></td>
                                                    <td><?php echo convertedcit($data->current_status_inactive); ?></td>
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
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>निरिक्षकको दस्तखत: </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :- <?php echo convertedcit(generateCurrDate());?></td>
          <td></td>
	  <td>मिति :- <?php echo convertedcit(generateCurrDate());?></td>
	  <td></td>
      <td>नाम :- </td>
	  <td></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>पद :- </td>
	  <td></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>मिति :- <?php echo convertedcit(generateCurrDate());?></td>
	  <td></td>
	  </tr>
</table>
</div> 
                       								

</div>
				</div>				
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
