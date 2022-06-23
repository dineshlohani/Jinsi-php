<?php require_once("includes/initialize.php"); 
error_reporting(0);
if(isset($_POST['submit']))
{
    ini_set('max_input_vars', 3000);
    // -echo "<pre>";print_r($_POST);echo "</pre>";exit;
    for($i=0;$i<count($_POST['spent_item_id']);$i++)
    {
        $j=$i+1;
        $data=new Spentjinsinirakshan();
        $data->nirikshan_id     = $_POST['nirikshan_id']; 
        $data->prev_stock=$_POST['prev_stock'][$i];
        $data->spent_item_id    =$_POST['spent_item_id'][$i];
        $data->specification_type=$_POST['specification_type_'.$j];
        $data->reduce_amount=$_POST['reduce_amount'][$i];
        $data->increased_amount=$_POST['increased_amount'][$i];
        $data->total_amount=$_POST['total_amount'][$i];
        $data->current_status_active = $_POST['current_status_active'][$i];
        $data->current_status_inactive = $_POST['current_status_inactive'][$i];
        $data->remarks=$_POST['remarks'][$i];
        $data->created_date_english=  DateNepToEng($_POST['created_date']);
        $data->created_date= $_POST['created_date'];
        $data->save();
        
    }
    
    echo alertBox("थप सफल...!!","jinsinirakshan_kharchaform.php");
}

  $spent_result= ItemStock::find_by_sql("select * from item_stock where category=1 order by item_id Asc");
$fiscals = FiscalYear::find_all();
$nirikshan_id=  Spentjinsinirakshan::get_max_nisikshan_id() +1;
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम / <a class="btn" href="dashboard_jinsinirakshankharcha.php">फिर्ता जानुहोस  </a> </h2>
                    <div class="OurContentFull">
                    	<h2>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम </h2>
                        <div class="userprofiletable">
                        	
                                         <!--<div class="myPrint"><a href="#">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>-->
                                          <div class="printPage">
                                        <div class="mydate">म.ले.प. फाराम नं : ४९</div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम</div>
									<div class="printContent">
                                                                             
                                        <div class="chalanino">आर्थिक वर्ष : </div>
                                        
                                        
                                        
                                                		
										
                                                                                
                                <div class="bankdetails">
                                        <form method="post">
                                            <span class="chalanino"> निरिक्षण फाराम नं : <input style="width: 10% !important;" type="text"  class="" readonly="true" name="nirikshan_id" value="<?=$nirikshan_id?>"></span>
                                            <span class="chalanino mydate"> निरिक्षण मिती : <input class="right_side_date" type="text" readonly="true" name="created_date" id="nepaliDate9" ></span><br>
                                                <table  class="table table-bordered table-responsive myWidth100 td1 td2 center_all">
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
                                                    <th>परिमाण</th>
                                                    <th>मुल्य</th>
                                                    <th>मिलान भएको</th>
                                                    <th>मिलान नभएको</th>
                                                    <th>घट</th>
                                                    <th>बढ</th>
                                                    <th>घट/बढको मुल्य</th>
                                                    <th>रहेको</th>
                                                    <th>नरहेको</th>
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
                                                  <?php $i=1; foreach($spent_result as $data):
                                                     $spent_data=  Spentitem::find_by_id($data->item_id); 
                                                    if(!empty($data))
                                                    {
                                                        $stock=$data->stock;
                                                        $rate=$data->rate;
                                                        $amount=$stock * $rate;
                                                    }
                                                    else
                                                    {
                                                        $stock="";
                                                        $rate="";
                                                        $amount="";
                                                    }
                                                    if($data->stock==0)
                                                    {
                                                        continue;
                                                    }
                ?>
                                                
                                                  <tr>
                                                      <td class="myCenter"><?php echo convertedcit($i);?></td>
                                                    <td class="myCenter"><?php echo convertedcit($data->khata_id); ?></td>
                                                    <td class="myCenter"><?php echo "५२ / खर्च हुने "; ?></td>
                                                    <td class="myCenter"><?php echo $spent_data->name;?></td>
                                                    <td class="myCenter"><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                     <td><input class="myCenter none_input" type="text" name="prev_stock[]"  readonly="true" value="<?php echo $data->stock+0;?>" id="prev_stock_<?=$i?>"</td>
                                                    <td><?php echo convertedcit(placeholder($amount));?></td>
                                                    <td class="myCenter"><input type="radio" name="specification_type_<?=$i?>" class="radioBtnClass" value="1"></td>
                                                    <td class="myCenter"><input type="radio" name="specification_type_<?=$i?>" class="radioBtnClass" value="2"></td>
                                                    <td><input class="" type="text" name="reduce_amount[]"id="reduce_amount_<?=$i?>" style="display: none;"></td>
                                                    <td><input class="" type="text" name="increased_amount[]" id="increased_amount_<?=$i?>" style="display: none;"></td>
                                                    <td><input class="" type="text" name="total_amount[]" id="total_amount_<?=$i?>" style="display: none;"></td>
                                                   <td><input class="" type="text" name="current_status_active[]"  id="current_status_active_<?=$i?>"></td>
                                                    <td><input class="" type="text" name="current_status_inactive[]"  id="current_status_inactive_<?=$i?>"></td>
                                                    <td><input class="" type="text" name="remarks[]" ></td>
                                                  <input type="hidden" id="spent_item_id_<?=$i?>" name="spent_item_id[]" value="<?php echo $data->id;?>"/>
                                                  </tr>
                                                  <?php $i++; endforeach;?>
                                                  
                                                </table>
                                                                                       <input type="submit" value="सेभ गर्नुहोस" name="submit" class="btn mydate search_btn" />
                                        </form>
                                             

										</div>
<!--<div class="banktextdetails">
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
	  <td>मिति : </td>
          <td> </td>
	  <td>मिति : </td>
	  <td> </td>
      <td>नाम : </td>
	  <td></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>पद</td>
	  <td></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>&nbsp;</td>
	  <td></td>
	  <td>मिति :  <?php echo convertedcit(generateCurrDate()); ?></td>
	  <td></td>
	  </tr>
</table>
</div> -->
										
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

