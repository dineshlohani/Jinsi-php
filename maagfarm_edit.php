<?php require_once("includes/initialize.php"); 
 error_reporting(0);
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
$id= $_GET['id'];
$maag_form = Kharid_mag_faram1::find_by_id($id);
$item_details= Kharid_mag_faram2::find_by_maag_id($maag_form->id);


$count = count($item_details);
  	
if(isset($_POST['submit']))
{
	//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
       //echo $_POST['update_id'];exit;
	$data= Kharid_mag_faram1::find_by_id($_POST['update_id']);

        $data->department_id 			 = $_POST['department_id'];
        $data->maag_date			     = $_POST['maag_date'];
        $data->maag_date_english 		 =  DateNepToEng($_POST['maag_date']);
	    $data->fiscal_id			     =  $_POST['fiscal_id'];
        $data->kharid_maag_process       =  $_POST['kharid_maag_process'];
        $data->save();
       
        $delete_items= Kharid_mag_faram2::find_by_maag_id($_POST['update_id']);
        //print_r($delete_items);exit;
        foreach ($delete_items as $datas)
        {
            $datas->delete();
        }
        
        for($i=0;$i<count($_POST['item_type_id']);$i++)
        {
            $a=0;
            $result				         = new Kharid_mag_faram2;
            $result->item_id       		   = $_POST['item_id'][$i];
            $result->category 			   = $_POST['category'][$i];
            $result->prev_stock 		   = $_POST['prev_stock'][$i];
            $result->qty			       = $_POST['qty'][$i];
            $result->remarks               = $_POST['remarks'][$i];
            $result->maag_id 			   = $_POST['update_id'];
            if($result->save())
            {
                $a=1;
            }
            
        }
        if($a==1)
        {
          echo alertBox("सच्याउन सफल", "maagfarm_search.php");    
        }
        
            
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> माग फारम </title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile"> माग फारम | नया माग फारम भर्नुहोस | <a href="dashboard_maag1.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                        
                                        <div class="inputWrap width25">
                                            <div class="our_content mytableinput">
                                                <fieldset>
                                                <legend> माग फारम नं : <?php echo Kharid_mag_faram1::getNextAutoIncrementValue(); ?></legend>
                                                <div class="titleInput">आर्थिक वर्ष 	: </div>
                                            <div class="newInput"><select class="" name="fiscal_id" required>
                                                		<?php foreach($fiscals as $fiscal): ?>
                                                        	<option value="<?=$fiscal->id?>" <?php if($fiscal->is_current==$maag_form->fiscal_id){?> selected="selected" <?php }?>><?=$fiscal->year?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="titleInput">शाखा :</div>
											<div class="newInput"><select class="" name="department_id" required>
                                           			<option value="">-छान्नुहोस-</option>
                                                    <?php foreach($deps as $dep): ?>
                                                        <option <?php if($dep->id==$maag_form->department_id){echo 'selected="selected"';} ?> value="<?=$dep->id?>"><?=$dep->name?></option>
                                                    <?php endforeach; ?>
                                            	</select>
                                                </div>
                                                <div class="titleInput">माग फारमको प्रकार :</div>
                                            <div class="newInput"><select class="" name="kharid_maag_process" required>
                                                    <option value="">-छान्नुहोस-</option>
                                                    <option value="1" <?php if($maag_form->kharid_maag_process==1){ ?> selected="selected" <?php } ?> >बजारबाट खरिद</option>
                                                    <option value="2" <?php if($maag_form->kharid_maag_process==2){ ?> selected="selected" <?php } ?> >मौज्दातबाट वितरण</option>
                                                    
                                                </select>
                                            </div>
                                                <div class="titleInput">मिति : </div>
												<div class=""><input class=""  type="text" name="maag_date" value="<?= $maag_form->maag_date ?>" id="nepaliDate5"/></div>
                                            </fieldset>
                                            </div>
											
                                        </div>
                                        <br>
                                        <table id="kharidMaagEditTable" class="table tr1 myWidth100 table-responsive table-responsive mytableinput">
                                                <tr >
                                                  <th class="myCenter" >क्र.स.</th>
                                                  <th class="myCenter">सामानको किसिम</th>
                                                  <th class="">सामानको प्रकार</th>
                                                  <th class="">सामानको  नाम </th>
                                                  <th class="">स्पेशिफिकेशन</th>
                                                  <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                  <th class="myCenter"> मौज्जाद परिमाण</th>
                                                  <th class="myCenter">इकाई</th>
                                                  <th class="myCenter"> खरिद गर्नुपर्ने परिमाण</th>
                                                  <th class="myCenter">कैफियत</th>
                                                  <th class="myCenter"></th>
                                                </tr>
                             <?php $i=1; foreach($item_details as $details):
                                        $cross_row = '<img src="images/wrong.png" class="cross_row_kharid_edit" height="20px" width="20px" />';
                                                if($details->category==1)
                                                    {
                                                      $items= Spentitem::find_by_id($details->item_id);
                                                      $items_all= Spentitem::find_all();
                                                    }
                                                elseif($details->category==2)
                                                    {
                                                       $items= Notspentitem::find_by_id($details->item_id);
                                                       $items_all= Notspentitem::find_all();
                                                    }
                                                    $unit= Unit::find_by_id($items->unit_id);
                                                    
                                             
                                             ?>    
                                                <tr class="remove_post_detail">
                                                    <td ><?= convertedcit($i) ?></td>
                                                    <td >
                                                        <select class="" id="item_type_id-<?=$i?>" name="item_type_id[]">
                                                            <option value="">छान्नुहोस</option>
                                                            <?php foreach($item_type as $data):?>

                                                             <option <?php if($data->id==$items->item_type_id){echo 'selected="selected"';} ?> value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                             <?php endforeach;?>
                                                        </select>
                                                    </td>
                                                    <td >
                                                        <select class="" id="category-<?=$i?>" name="category[]">
                                                            <option>छान्नुहोस</option>
                                                            <option <?php if($details->category==1){echo 'selected="selected"';} ?>value="1">खर्च हुने </option>
                                                            <option <?php if($details->category==2){echo 'selected="selected"';} ?> value="2">खर्च नहुने </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item_id[]" id="item_name-<?=$i?>">
                                                            <?php foreach($items_all as $data): ?>
                                                            <option <?php if($data->id==$items->id){echo 'selected=="selected"';} ?> value="<?= $data->id ?>"><?= $data->name ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                   
                                                    <td ><input class="" readonly="true"  type="text" value="<?= $items->specification ?>"  name="specification[]" id="specification-<?=$i?>" /></td>
                                                    <td ><input class="" type="text" value="<?= $items->id ?>" name="jinsi_id[]" id="jinsi_id-<?=$i?>" /></td>
                                                    <td  id="prev_stock-<?=$i?>"></td>
                                                    <td ><input class="" type="text" value="<?= $unit->name ?>" name="unit_id[]" id="unit_id-<?=$i?>" /></td>

                                                    <td ><input class="" type="text" value="<?= $details->qty ?>" name="qty[]"  id="qty-<?=$i?>"/></td>
                                                    <td ><input class="" type="text" value="<?= $details->remarks ?>" name="remarks[]"  id="remarks-<?=$i?>"/></td>
                                                    <td><span><img src="images/wrong.png" class="cross_row_kharid_edit" height="20px" width="20px" /></span></td>
                                                </tr>
                                <?php $i++; endforeach; ?>       
                                                <tbody class="table  myWidth100" id="detail_add_table">
                                         
                                                </tbody>      
                                            </table>
                                         
                                        <table class="table borderless table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_edit btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस"/></td>
                                                </tr>
                                           </table>
                                    <input type="hidden"  value="kharid" id="forurl" />    
                                    <input type="hidden" value="<?= $id ?>" name="update_id">
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

