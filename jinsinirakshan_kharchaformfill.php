<?php require_once("includes/initialize.php"); 
  
if(isset($_GET['submit'])|| isset($_GET['nirikshan_id']))
{
        $nirikshan_id=$_GET['nirikshan_id'];
        $result=  Spentjinsinirakshan::find_by_nirikshan_id($_GET['nirikshan_id']);
       
       if(empty($result))
          {
              echo alertBox("निम्न निरिक्षण फाराम नं भेटिएन...","jinsinirakshan_kharchaformfill.php" );
          }
}
else
{
    $result = Spentjinsinirakshan::find_by_sql("select distinct nirikshan_id from spent_jinsinirakshan");
//    print_r($result);exit;
}
    
  
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम खोज्नुहोस  :: <?php echo SITE_SUBHEADING;?></title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम खोज्नुहोस  / <a class="btn" href="dashboard_jinsinirakshankharcha.php">जिन्सी खातामा जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम खोज्नुहोस </h2>
                        <form method="get">
                             <table  class="table table-responsive bordereless search_table">
                                                   <tr>
                                                        <td colspan="5">निरिक्षण फाराम नं : <input class="fill_height" type="text"  name="nirikshan_id" > <input type="submit" value="खोज्नुहोस" name="submit" class="btn search_btn"/></td>
                                                      
                                                   </tr>
                                              
                            </table>
                        </form>
                        <?php if(isset($_GET['nirikshan_id'])){
                             $nirikshan_date_result = Spentjinsinirakshan::find_by_nirikshan_ids($_GET['nirikshan_id']);
                            ?>
                        
                        <div class="userprofiletable">
                        	
                            <div class="myPrint"><a href="jinsinirakshan_kharchaformfill_print.php?nirikshan_id=<?php echo $nirikshan_id;?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
                        <div class="mydate"><b> म.ले.प. फाराम नं :- </b> ४९</div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
                                    <div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम </div>
									<div class="printContent">
										<div class="chalanino"><b> आर्थिक वर्ष :- </b> </div>
										
                                          <div class="chalanino"><b> मौज्जादमा रहेका खर्च भएर जाने जिन्सी सामान	:- </b> </div>                                      
										<div class="bankdetails">
                                                                                    <span><b> निरिक्षण फाराम नं :-  <?php echo convertedcit($nirikshan_id);?> </b></span><br>
                                         <span><b> निरिक्षण मिती :-  <?php echo convertedcit($nirikshan_date_result->created_date);?> </b></span>
										     <table  class="table table-bordered table-responsive td1 td2 center_all">
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
                                                    <td><?php echo convertedcit($item_result->khata_id);?></td>
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
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>निरिक्षकको दस्तखत: </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :-</td>
	  <td></td>
	  <td>मिति :- </td>
	  <td></td>
     <td>मिति :- </td>
	  <td></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td> </td>
	  <td></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td> </td>
	  <td></td>
	  </tr>
</table>
   
</div> 
										
										
									</div>
                                
                            </div><!-- print page ends -->
                                         
                                        
                                          <?php }else{// show if maag_id is selected ?>
                                                                                    
                                                                                    <table class="table table-bordered td1 table-responsive">
                                                                                             <tr>
                                                                                                 <th>निरिक्षण फाराम नं :</th>
                                                                                                 <th>निरिक्षण भएको मिति</th>
                                                                                                 <th>पुरा विवरण </th>
                                                                                            </tr>
                                                                                            <?php foreach($result as $data):
                                                                                                $nirikshan_result = Spentjinsinirakshan::find_by_nirikshan_ids($data->nirikshan_id);?>
                                                                                            <tr>
                                                                                                <td><?=convertedcit($data->nirikshan_id)?></td>
                                                                                                <td><?=convertedcit($nirikshan_result->created_date)?></td>
                                                                                                <td><a href="jinsinirakshan_kharchaformfill.php?nirikshan_id=<?=$data->nirikshan_id?>" class="btn">पुरा विवरण हेर्नुहोस </a></td>
                                                                                            </tr>
                                                                                            <?php endforeach;?>
                                                                                    </table>  
        <?php } ?>
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            <div class="myspacer"></div>
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

