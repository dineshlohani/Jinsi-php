<?php require_once("includes/initialize.php"); 
 error_reporting(0);
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
 
  	
if(isset($_POST['submit']))
{
	//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
	$data= new Kharid_mag_faram1();
        $data->department_id 			= $_POST['department_id'];
        $data->maag_date			= $_POST['maag_date'];
        $data->maag_date_english 		=  DateNepToEng($_POST['maag_date']);
	$data->fiscal_id			=  $_POST['fiscal_id'];
        $maag_id 				= $data->save();
       
        for($i=0;$i<count($_POST['item_type_id']);$i++)
        {
            $result				= new Kharid_mag_faram2;
            $result->item_id       		= $_POST['item_id'][$i];
            $result->category 			= $_POST['category'][$i];
            $result->prev_stock 		= $_POST['prev_stock'][$i];
            $result->qty			= $_POST['qty'][$i];
            $result->maag_id 			= $maag_id;
            $result->save();
            
        }
        echo alertBox("थप सफल", "maagfarm_newAdd.php");
            
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद माग फारम </title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद माग फारम | नया खरिद माग फारम भर्नुहोस | <a href="dashboard_maag1.php" class="btn">पछि जानुहोस</a> </h2>
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                        
<!--                                        <div class="inputWrap">-->
                                           <div class="our_content center_box">
                                            <fieldset>
                                                <legend> <b> खरिद माग फारम नं : <?php echo Kharid_mag_faram1::getNextAutoIncrementValue(); ?> </b></legend>
                                            
                                        	<div></div>
											<div><b> आर्थिक वर्ष 	: </b> </div>
                                            <select class="select_f" name="fiscal_id" required>
                                                		<?php foreach($fiscals as $fiscal): ?>
                                                        	<option value="<?=$fiscal->id?>" <?php if($fiscal->is_current==1){?> selected="selected" <?php }?>><?=$fiscal->year?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                          
                                            <div ><b> शाखा :</b></div>
											<div><select class="select_f" name="department_id" required>
                                           			<option value="">-छान्नुहोस-</option>
                                                    <?php foreach($deps as $dep): ?>
                                                    	<option value="<?=$dep->id?>"><?=$dep->name?></option>
                                                    <?php endforeach; ?>
                                            	</select>
                                                </div>
                                                <div class=""><b> मिति : </b> </div>
												<div><input class="select_f" type="text" name="maag_date" value="<?=generateCurrDate();?>" id="nepaliDate5"/></div>
                                               </fieldset>
                                            </div>
                                       
<!--                                        </div>-->
                                        <table class="table table-bordered table-hover table-striped">
                                                <tr >
                                                  <th class="myWidth5 myCenter" >क्र.स.</th>
                                                  <th class="myCenter">सामानको किसिम</th>
                                                  <th class="myCenter">सामानको प्रकार</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myWidth10">स्पेशिफिकेशन</th>
                                                  <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                  <th class="myCenter"> मौज्जाद परिमाण</th>
                                                  <th class="myCenter">इकाई</th>
                                                  <th class="myCenter"> खरिद गर्नुपर्ने परिमाण</th>
                                                  
                                                </tr>
                                                
                                                <tr >
                                                  <td >१</td>
                                                  <td >
                                                      <select id="item_type_id-1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td >
                                                      <select id="category-1" name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td id="item_name-1"></td>
                                                  <td ><input class="myWidth100input"  type="text" value="" name="specification[]" id="specification-1" /></td>
                                                  <td ><input class="myWidth100input" type="text" value="" name="jinsi_id[]" id="jinsi_id-1" /></td>
                                                  <td  id="prev_stock-1"></td>
                                                  <td ><input class="myWidth100input" type="text" name="unit_id[]" id="unit_id-1" /></td>
                                                  
                                                  <td ><input class="myWidth100input" type="text" name="qty[]"  id="qty-1"/></td>
                                                  
                                                </tr>
                                                <tbody class="table table-bordered table-responsive" id="detail_add_table">
                                         
                                                </tbody>      
                                            </table>
                                         
                                        <table class="table table-bordered table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस"/></td>
                                                </tr>
                                           </table>
                                    <input type="hidden"  value="kharid" id="forurl" />        
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

