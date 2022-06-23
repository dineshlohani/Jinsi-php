<?php require_once("includes/initialize.php"); 
 Gharjaggaadd::resetAutoIncrement();
if(isset($_POST['submit']))
{
    $kitta_result_data = Gharjaggakittaadd::find_by_ghar_jagga_id($_GET['land_id']);
    foreach($kitta_result_data as $a)
    {
        $a->delete();
    }
    $data= Gharjaggaadd::find_by_id($_POST['land_id']);
    $data->land_id                       = $_POST['land_id'];
    $data->fiscal_id                     = $_POST['fiscal_id'];
    $data->land_type                     = $_POST['land_type'];
    $data->current_land_type             = $_POST['current_land_type'];
    $data->land_taken_date               = $_POST['land_taken_date'];
    $data->land_taken_date_english       = DateNepToEng($_POST['land_taken_date']);
    $data->prev_land_value               = $_POST['prev_land_value'];
    $data->land_owner_name               = $_POST['land_owner_name'];
    $data->land_identity_no              = $_POST['land_identity_no'];
    $data->land_address                  = $_POST['land_address'];
    if(isset($_POST['check_ghar']))
    {
        $data->land_area                     = $_POST['land_area'];
        $data->house_type                    = $_POST['house_type'];
        $data->house_floor                   = $_POST['house_floor'];
        $data->house_count                   = $_POST['house_count'];
    
    }
    $ghar_jagga_id = $data->save();
    for($i=0;$i<count($_POST['land_kitta_id']);$i++)
    {
        $result=new Gharjaggakittaadd();
        $result->land_kitta_id                 = $_POST['land_kitta_id'][$i];
        $result->land_total_area               = $_POST['land_total_area'][$i];
        $result->land_unit_id                  = $_POST['land_unit_id'][$i];
        $result->ghar_jagga_id                 = $ghar_jagga_id;
        $result->save();
    }
    
    echo alertBox("थप सफल ","gharjagga_search.php");
}
 $fiscals = FiscalYear::find_all();
 $unit_result=  Landunit::find_all();
 $current_land_type_result=  Currentlandtype::find_all();
 $land_type=  Landtype::find_all();
 $land_result = Gharjaggaadd::find_by_id($_GET['land_id']);
 $kitta_result = Gharjaggakittaadd::find_by_ghar_jagga_id($_GET['land_id']);
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>घरजग्गा अभिलेख खाता भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">घरजग्गा अभिलेख खाता भर्नुहोस | <a href="dashboard_gharjagga.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>घरजग्गा अभिलेख खाता भर्नुहोस</h2>
                        <div class="userprofiletable">
                            
                            <form method="post">
                          <table class="table borderless table-responsive myWidth100">
                              <tr>
                            	<td>घरजग्गा अभिलेख खाता</td>
                                <td><input class="fill_height myWidth100" type="text" readonly="true" name="land_id" value="<?php echo $land_result->land_id?>"></td>
                            </tr> 
                          	<tr>
                            	<td class="myWidth50">आर्थिक वर्ष: </td>
                                <td>
                                    <select class="form-control" name="fiscal_id" required>
                                    <?php foreach($fiscals as $fiscal): ?>
                                    <option value="<?=$fiscal->id?>" <?php if($land_result->fiscal_id==$fiscal->id){ echo 'selected="selected"';}?>><?=$fiscal->year?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            	<td>जग्गाको किसिम</td>
                                <td>
                                     <select class="form-control" name="land_type" required> 
                                         <option value="">--------</option>
                                    <?php foreach($land_type as $fiscal): ?>
                                    <option value="<?=$fiscal->id?>"  <?php if($land_result->land_type==$fiscal->id){ echo 'selected="selected"';}?>><?=$fiscal->name?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                            	<td>जग्गा प्राप्त हुँदाको बखतको किसिम</td>
                                <td>
                                     <select class="form-control" name="current_land_type" required> 
                                         <option value="">--------</option>
                                    <?php foreach($current_land_type_result as $fiscal): ?>
                                    <option value="<?=$fiscal->id?>" <?php if($land_result->current_land_type==$fiscal->id){ echo 'selected="selected"';}?>><?=$fiscal->name?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr> 
                            <tr>
                            	<td>जग्गा प्राप्त भएको मिति</td>
                                <td><input class="fill_height" type="text" name="land_taken_date" id="nepaliDate3" value="<?=$land_result->land_taken_date?>"></td>
                            </tr> 
                            <tr>
                            	<td>जग्गा प्राप्त हुँदाको मुल्य	</td>
                                <td><input class="form-control fill_height" type="text" name="prev_land_value" value="<?=$land_result->prev_land_value?>"></td>
                            </tr> 
                            <tr>
                            	<td>जग्गा धनीको नाम	</td>
                                <td><input class="form-control fill_height" type="text" name="land_owner_name" value="<?=$land_result->land_owner_name?>"></td>
                            </tr> 
                            <tr>
                            	<td>जग्गा धनीको प्रमाण पत्र नं</td>
                                <td><input class="form-control fill_height" type="text" name="land_identity_no" value="<?=$land_result->land_identity_no?>"></td>
                            </tr> 
                            <tr>
                            	<td>घरजग्गा रहेको स्थान</td>
                                <td><input class="form-control fill_height" type="text" name="land_address" value="<?=$land_result->land_address?>"></td>
                            </tr> 
                            <tr>
                                <td> <b> घर भएमा भर्नुहोस :<b> </td>
                              <td><input type="checkbox"  id="check_ghar" name="check_ghar" value="yes" ></td>
                            </tr>
                             <tbody id="check_ghar_div">
                             <tr>
                            	<td>घरले चर्चेको क्षेत्रफल</td>
                                <td><input class="form-control fill_height" type="text" name="land_area" value="<?=$land_result->land_area?>"></td>
                            </tr> 
                             <tr>
                            	<td>घरको प्रकार</td>
                                <td><input class="form-control fill_height" type="text" name="house_type" value="<?=$land_result->house_type?>"></td>
                            </tr> 
                             <tr>
                            	<td>तला संख्या </td>
                                <td><input class="form-control fill_height" type="text" name="house_floor" value="<?=$land_result->house_floor?>"></td>
                            </tr> 
                             <tr>
                            	<td>घरको संख्या </td>
                                <td><input class="form-control fill_height" type="text" name="house_count" value="<?=$land_result->house_count?>"></td>
                            </tr> 
                             </tbody>
                             </table>
                            <table class="table borderless table-responsive">
                            
                                <tr>
                                    <th>सि नं .</th>
                                    <th>कित्ता नं</th>
                                    <th>जग्गाको कुल क्षेत्रफल</th>
                                    <th>जग्गाको इकाई</th>
                                </tr>
                                <?php if(empty($kitta_result)){?>
                                <tr>
                                    <td><?=convertedcit(1)?></td>
                                    <td><input class="form-control fill_height" type="text" name="land_kitta_id[]" ></td>
                                    <td><input class="form-control fill_height" type="text" name="land_total_area[]" ></td>
                                    <td>
                                     <select class="form-control fill_height" name="land_unit_id[]" required>
                                         <option value="">--------</option>
                                            <?php foreach($unit_result as $data): ?>
                                            <option value="<?=$data->id?>"><?=$data->name?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </td>
                                </tr>
                                <?php }else{
                                    $i=1;
                                    foreach($kitta_result as $data):
                                    ?>
                                <tr <?php if($i!=1){ ?> class="ghar_jagga_details" <?php } ?>>
                                    <td><?=convertedcit($i)?></td>
                                    <td><input class="form-control fill_height" type="text" name="land_kitta_id[]"  value="<?=$data->land_kitta_id?>" ></td>
                                    <td><input class="form-control fill_height" type="text" name="land_total_area[]" value="<?=$data->land_total_area?>" ></td>
                                    <td>
                                        <select class="form-control fill_height" name="land_unit_id[]" required>
                                            <option value="">--------</option>
                                               <?php foreach($unit_result as $unit): ?>
                                               <option value="<?=$unit->id?>" <?php if($data->land_unit_id==$unit->id){ echo 'selected="selected"';}?>><?=$unit->name?></option>
                                       <?php endforeach; ?>
                                       </select>
                                     </td>
                                </tr>
                                <?php $i++ ;endforeach; } ?>
                                <tbody id="add_more_kitta">
                                    
                                </tbody>
                              
                              </table>
                                <table class="table borderless table-responsive">
                                    <tr>
                            	     <td class="myCenter"><div class="add_ghar_jagga btn">थप्नुहोस</div> </td>
                                    <td class="myCenter"><div class="remove_ghar_jagga btn">हटाउनु होस</div> </td>
                                    <td  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></a></td>
                                    </tr> 
                                </table>       
                                <input type="hidden" value="<?=$_GET['land_id']?>" name="land_id"/>
                                     
                        
                          
                            </form>
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

