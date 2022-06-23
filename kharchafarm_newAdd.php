<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())

{
	redirect_to("logout.php");
}
error_reporting(0);
 $fiscal_curr = Fiscalyear::find_current_id();
 //print_r($fiscal_curr);
 
$last_kharcha_date= find_max_kharcha_or_dakhila_date();
//echo $last_kharcha_date;exit;
if(isset($_POST['submit']))
{
//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
    
	$data= new Kharcha_mag_faram1();
        $data->department_id 		= $_POST['department_id'];
        $data->maag_date 		= $_POST['maag_date'];
        $data->maag_date_english 	=  DateNepToEng($_POST['maag_date']);
	$data->fiscal_id		=  $_POST['fiscal_id'];
        $maag_id 			= $data->save();
       
        for($i=0;$i<count($_POST['item_type_id']);$i++)
        {
            $result 				= new Kharcha_mag_faram2;
	    $result->item_id       		= $_POST['item_id'][$i];
            $result->category 			= $_POST['category'][$i];
            $result->rate 			= $_POST['rate'][$i];
            $result->prev_stock 		= $_POST['prev_stock'][$i];
            $result->qty 			= $_POST['qty'][$i];
            $result->maag_id 			= $maag_id;
            $result->save();
            deductItemStock($_POST['item_id'][$i], $_POST['category'][$i], $_POST['qty'][$i], $_POST['rate'][$i]);
        }
            $session->message("थप सफल");
            redirect_to("kharchafarm_newAdd.php");
            
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च माग फारम :: <?php echo SITE_SUBHEADING;?></title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च माग फारम <span><a href="dashboard_kharcha.php"><button class="btn btn-primary">पछि जानुहोस</button></a></span></h2>
                   
                    <div class="OurContentFull">
                    	<h2>नया खर्च माग फारम भर्नुहोस	 </h2>
                        <?php echo $message; ?>
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       <div class="our_content inputWrap">
                                           <fieldset>
                                               <legend> खर्च माग फारम नं : <?php echo Kharcha_mag_faram1::getNextAutoIncrementValue(); ?>  </legend>
                                               
                                                <b> आर्थिक वर्ष : </b> 
                                                        <select class="form-control" name="fiscal_id" required>
                                                               <option value=""></option>
                                                                <?php foreach($fiscals as $fiscal): ?>
                                                                    <option <?php if($fiscal->id==$fiscal_curr){echo 'selected="selected"';} ?>value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                   
                                                  <b> शाखा : </b>
                                                            <select class="form-control" name="department_id" required>
                                                            <option value="">-छान्नुहोस-</option>
                                                            <?php foreach($deps as $dep): ?>
                                                                <option value="<?=$dep->id?>"><?=$dep->name?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    <div class="titleInput"><b> मिति : </b> </div>
                                                    <input class="date_check fill_height myWidth100"  type="text" name="maag_date" value="<?= DateEngToNep($last_kharcha_date)?>" id="nepaliDate5"  />
                                               
                                           </fieldset>
                                       </div>
                                        <br>
                                        <table class="table tr1 col_10 myWidth100 ">
                                                <tr >
                                                  <th class="myWidth5" >क्र.स.</th>
                                                  <th>सामानको किसिम</th>
                                                  <th>सामानको प्रकार</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myWidth10">स्पेशिफिकेशन</th>
                                                  <th>जिन्सी खाता पाना नं</th>
                                                  <th>मूल्य</th>
                                                  <th>मौज्जाद परिमाण</th>
                                                  <th>इकाई</th>
                                                  <th>खर्च परिमाण</th>
                                                  
                                                </tr>
                                                
                                                <tr >
                                                  <td >१</td>
                                                  <td >
                                                      <select class="form-control" id="item_type_id-1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td >
                                                      <select class="form-control" id="category-1" name="category[]">
                                                         <option value="1">खर्च हुने </option>
                                                     </select>
                                                  </td>
                                                  <td>
                                                      <select name="item_id[]" id="item_name-1" class="form-control item_id select2">
                                                          <option value="">--</option>
                                                      </select>
                                                  </td>
                                                  <td ><input class="myWidth100input fill_height" readonly="true"  type="text" value="" name="specification[]" id="specification-1" /></td>
                                                  <td ><input class="myWidth100input fill_height" readonly="true" type="text" value="" name="jinsi_id[]" id="jinsi_id-1" /></td>
                                                  <td id="rate-1">&nbsp;</td>
                                                  <td ><input class="myWidth100input fill_height" type="text" name="prev_stock[]" readonly="true" id="prev_stock-1"/></td>
                                                  <td ><input class="myWidth100input fill_height" type="text" name="unit_id[]" id="unit_id-1" /></td>
                                                  
                                                  <td><input class="qty_check myWidth100input fill_height" type="text" name="qty[]" id="qty-1"/></td>
                                                  
                                                </tr>
                                               
                                            </table>
                                         <table class="table col_10 myWidth100" id="detail_add_table">
                                         
                                         </table>
                                        <table class="table borderless table-responsive"    >
                                                <tr>
                                                    <td class="myCenter"><div class="add_more btn">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="submithere btn" value="सेभ गर्नुहोस"/></td>
                                                </tr>
                                           </table>
                                              <input type="hidden"  value="kharcha" id="forurl" />
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>
<script src="assets/select2/dist/js/select2.full.min.js"></script>
<script>
    JQ(document).ready(function(){
       JQ('.select2').select2(); 
    });
</script>
