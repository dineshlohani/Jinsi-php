<?php require_once("includes/initialize.php"); 
  Bhadaliyekodetails::resetAutoIncrement();
if(isset($_POST['submit']))
{
    $data=new Bhadaliyekodetails();
    $_POST['miti_english'] = DateNepToEng($_POST['miti']);
    $_POST['approved_date_english'] = DateNepToEng($_POST['approved_date']);
    $_POST['start_date_english'] = DateNepToEng($_POST['start_date']);
    $_POST['end_date_english'] = DateNepToEng($_POST['end_date']);
    $_POST['rent_period_english'] = DateNepToEng($_POST['rent_period']);
    $_POST['item_return_order_date_english'] = DateNepToEng($_POST['item_return_order_date']);
    $_POST['return_date_english'] = DateNepToEng($_POST['return_date']);
    $data->savePostData($_POST);
    echo alertBox("थप सफल ", "bhadaliyeko_newAdd.php");
}
$fiscals = FiscalYear::find_all();
$rent_units=  Rentunit::find_all();
//$datas= Enlist::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडामा लिएको मेसिन औजारको अभिलेख किताब भर्नुहोस	</title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> भाडामा लिएको मेसिन औजारको अभिलेख किताब भर्नुहोस	| <a href="dashboard_bhadaliyeko.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> भाडामा लिएको मेसिन औजारको अभिलेख किताब भर्नुहोस	</h2>
                        <div class="userprofiletables">
                            
<!--                           <div class="myPrint"><a href="#">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div> -->
                           <form method="post">
                          <table class="table borderless table-responsive myWidth80 box_center">
                          	<tr>
                            	<td class="myWidth50">सम्पतिको अभिलेख खाता नं :</td>
                                <td><input class="form-control fill_height" type="text" name="property_id" value="<?= Bhadaliyekodetails::getNextAutoIncrementValue();?>"></td>
                            </tr>
                              <tr>
                                    
                            	<td class="myWidth50">आर्थिक वर्ष :</td>
                                <td>
                                     <select class="form-control fill_height" name="fiscal_id" required>
                                                		<?php foreach($fiscals as $fiscal): ?>
                                                        	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                        <?php endforeach; ?>
                                                </select>  
                                </td>
                            </tr>
                            <tr>
                            	<td class="myWidth50">भाडामा लिएको मेसिन औजारको नाम: </td>
                                <td><input class="form-control fill_height" type="text" name="rent_item_name"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">मिति:</td>
                                <td><input class="form-control fill_height" type="text" name="miti" id="nepaliDate3"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50"><b> भाडामा दिने व्यक्ति  वा कार्यालयको: </b> </td>
                                <td>
                                </td>
                            </tr> 
                            
                            <tr>
                            	<td class="myWidth50">नाम:</td>
                                <td><input class="form-control fill_height" type="text" name="org_name"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">ठेगाना:</td>
                                <td><input class="form-control fill_height" type="text" name="org_address"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडामा लिएको मेसिन औजारको संख्या	:</td>
                                <td><input class="form-control fill_height" type="text" name="item_count"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडामा लिने आदेश स्वीकृत भएको मिति	:</td>
                                <td><input class="form-control fill_height" type="text" name="approved_date" id="nepaliDate10"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडामा लिन शुरु हुने मिति	:</td>
                                    <td><input class="form-control fill_height" type="text" name="start_date" id="nepaliDate9"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडामा लिने समय समाप्त हुने मिति: </td>
                                <td><input class="form-control fill_height" type="text" name="end_date" id="nepaliDate11"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडाको इकाई:</td>
                                <td>
                                    <select class="form-control fill_height" name="rent_unit_id" >
                                       <option value="">-------</option>
                                                		<?php foreach($rent_units as $fiscal): ?>
                                                        	<option value="<?=$fiscal->id?>"><?=$fiscal->name?></option>
                                                        <?php endforeach; ?>
                                                </select>   
                                </td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">भाडाको अवधि:</td>
                                <td><input class="form-control fill_height" type="text" name="rent_period" id="nepaliDate12"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">प्रति इकाई भाडा दर	:</td>
                                <td><input class="form-control fill_height" type="text" name="per_unit_rent" ></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">जम्मा भाडा रकम:</td>
                                <td><input class="form-control fill_height" type="text" name="total_rent_amount" ></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">मेसिन औजार फिर्ता गर्ने आदेश मिति: </td>
                                <td><input class="form-control fill_height" type="text" name="item_return_order_date" id="nepaliDate15"></td>
                            </tr> 
                            <tr>
                            	<td class="myWidth50">मेसिन औजार फिर्ता गरेको मिति	:</td>
                                <td><input class="form-control fill_height" type="text" name="return_date" id="nepaliDate1"></td>
                            </tr> 
                                                      
                            <tr>
                                <!--<td  class="myCenter"><a href="#" class="btn">नया थप्नुहोस</a></td>-->
                                <td  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></td>
                            </tr>          
                          </table>
                      </form>
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

