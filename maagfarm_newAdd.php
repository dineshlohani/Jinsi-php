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
	$data->maag_date			    = $_POST['maag_date'];
	$data->maag_date_english 		=  DateNepToEng($_POST['maag_date']);
	$data->fiscal_id			    =  $_POST['fiscal_id'];
	$data->kharid_maag_process      = $_POST['kharid_maag_process'];
	$maag_id 				        = $data->save();

	for($i=0;$i<count($_POST['item_type_id']);$i++)
	{
		$result				= new Kharid_mag_faram2;
		$result->item_id       		= $_POST['item_id'][$i];
		$result->category 			= $_POST['category'][$i];
		$result->prev_stock 		= $_POST['prev_stock'][$i];
		$result->qty			    = $_POST['qty'][$i];
		$result->maag_id 			= $maag_id;
		$result->remarks           = $_POST['remarks'][$i];
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

<title>माग फारम </title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body>
	<?php include("menuincludes/topwrap.php"); ?>
	<div id="body_wrap_inner">
		<div class="">
			<div class="">
				<div class="maincontent">
					<h2 class="headinguserprofile"> माग फारम | नया  माग फारम भर्नुहोस | <a href="dashboard_maag1.php" class="btn">पछि जानुहोस</a> </h2>
					<div class="OurContenFull">
						<div class="userprofiletables">
							<form method="POST" enctype="multipart/form-data">

								<div class="inputWrap width25">
									<div class="our_content mytableinput">
										<fieldset>
											<legend> माग फारम नं : <?php echo Kharid_mag_faram1::getNextAutoIncrementValue(); ?></legend>
											<div class="titleInput">आर्थिक वर्ष : </div>
											<div class="newInput"><select class="" name="fiscal_id" required>
												<?php foreach($fiscals as $fiscal): ?>
													<option value="<?=$fiscal->id?>" <?php if($fiscal->is_current==1){?> selected="selected" <?php }?>><?=$fiscal->year?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="titleInput">शाखा :</div>
										<div class="newInput"><select class="" name="department_id" required>
											<option value="">-छान्नुहोस-</option>
											<?php foreach($deps as $dep): ?>
												<option value="<?=$dep->id?>"><?=$dep->name?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="titleInput">माग फारमको प्रकार :</div>
									<div class="newInput"><select class="" name="kharid_maag_process" required>
										<option value="">-छान्नुहोस-</option>
										<option value="1">बजारबाट खरिद</option>
										<option value="2">मौज्दातबाट वितरण</option>
									</select>
								</div>
								<div class="titleInput">मिति : </div>
								<div class=""><input class=" " type="text" name="maag_date" value="<?=generateCurrDate();?>" id="nepaliDate5" /></div>
							</fieldset>
						</div>
					</div>
					<br>
					<table id="maagTable" class="table tr1 myWidth100 table-responsive table-responsive mytableinput">
						<thead>
							<tr>
								<th class="myWidth2 myCenter">क्र.स.</th>
								<th class="myCenter">सामानको किसिम</th>
								<th class="myWidth10">सामानको प्रकार</th>
								<th class="myWidth10">सामानको नाम </th>
								<th class="myWidth10">स्पेशिफिकेशन</th>
								<th class="myCenter">जिन्सी खाता पाना नं</th>
								<th class="myCenter">मौज्जाद परिमाण</th>
								<th class="myCenter">इकाई</th>
								<th class="myCenter">परिमाण</th>
								<th class="myCenter">कैफियत</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="myCenter">१</td>
								<td>
									<select class="type_selected" id="item_type_id-1" name="item_type_id[]">
										<option value="">छान्नुहोस</option>
										<?php foreach($item_type as $data):?>
											<option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
										<?php endforeach;?>
									</select>
								</td>
								<td>
									<select class="" id="category-1" name="category[]">
										<option>छान्नुहोस</option>
										<option value="1">खर्च हुने </option>
										<option value="2">खर्च नहुने </option>
									</select>
								</td>
							
								<td>
									<select name="item_id[]" id="item_name-1" class="item_id select2">
										<option value="">--</option>
									</select>
								</td>
								<td><input class="" readonly="true" type="text" value="" name="specification[]" id="specification-1" /></td>
								<td><input class="" type="text" value="" name="jinsi_id[]" id="jinsi_id-1" /></td>
								<td style="font-size: 14px; font-weight: 500; line-height: 28px;" id="prev_stock-1"></td>
								<td><input class="" type="text" name="unit_id[]" id="unit_id-1" /></td>

								<td><input class="" type="text" name="qty[]" id="qty-1" /></td>
								<td><textarea name="remarks[]" id="remarks-1" cols="30" rows="4"></textarea></td>
								<td></td>
							</tr>
						</tbody>
						<tbody class="table myWidth100 table-responsive table-responsive table-input" id="detail_add_table">
						</tbody>
					</table>
					<div class="row m-2">
						<div class="col-4">
							<div class="add_more btn ">थप्नुहोस</div>
						</div>
						<div class="col-4">
							<div class="remove_more btn">हटाउनुहोस</div>
						</div>
						<div class="col-4">
							<div class="save-btn"> <input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस" /> </div>
						</div>
					</div>
					<input type="hidden" value="kharid" id="forurl" />
				</form>
			</div>
		</div>
	</div><!-- main menu ends -->
</div>
</div>
</div><!-- top wrap ends -->
<?php include("menuincludes/footer.php"); ?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script src="assets/select2/dist/js/select2.full.min.js"></script>
<script>
    JQ(document).ready(function(){
       JQ('.select2').select2(); 
    });
</script>
