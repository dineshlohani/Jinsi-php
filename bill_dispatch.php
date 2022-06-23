<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
  $item_condition = Itemcondition::find_all();
$user        = getUser();
//$max =  BillAmdani::get_description_result(1);
//print_r($max);exit;
error_reporting(1);

//$a = BillDispatch::get_max_description_id(1);
$a=0;
if(isset($_POST['submit']))
{
    $new_khata_id = BillDispatch::get_new_khata_id($_POST['department_id']);
       $data= new BillDispatch();
        $data->english_date       = DateNepToEng($_POST['nepali_date']);
        $data->rashid_to          = $_POST['rashid_to'];
        $data->department_id = $_POST['department_id'];
        $data->khata_id      = $new_khata_id;
        $data->description_id = $_POST['description_id'];
        $data->user_id  = $user->id;
        $data->rashid_range = $_POST['rashid_no'];
        if($dis_id = $data->save())
        {
            foreach ($_POST['dispatch'] as $data1):
                $value_array = explode("-", $data1);
                $details = new BillDispatchDetails();
                $details->dispatch_id = $dis_id;
                $details->dispatched_rashid = $data1;
                $details->pressed_from = $value_array[0];
                $details->pressed_to = $value_array[1];
                $details->total =$value_array[1] - $value_array[0] +1;
                if($details->save())
                {
                    $a=1;
                }
            endforeach;
            
            
        }
  
if($a==1):
  echo alertBox("थप सफल ","bill_dispatch.php");    
endif;       
 
        
}
 $ld= find_max_dispatch_date();

  $item_type = Itemtype::find_all();
  $department= Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
   $description_data = Rashidtype::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>रशिद निकासा </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">रशिद निकासा | <a href="bill_control_dashboard.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" id="rashid_form" enctype="multipart/form-data">
                                       
                                        <table class="table table-bordered td1">
                                            
                                            <tr>
                                                <td colspan="11">
                                                    <div class="inputWrap">
                                                         <div class="our_content">
                                                            <fieldset> 
                                                                <legend>रशिद निकासा  </legend> 
                                                                <!--<input type="hidden" name="type" value="" id="check_type">-->
                                                                 <div class="titleInput"><b> रशिद वितरण गरिएको  शाखाको नाम :</b></div>
                                                                <select name="department_id" required class="check_to form-control">
                                                                    <option value="">छान्नुहोस्</option>
                                                               <?php    foreach ($department as $data):?>
                                                                    <option value="<?=$data->id?>"><?=$data->name?></option>
                                                                     <?php endforeach;?>
                                                                </select>
                                                               
                                                                 <div class="myspacer20">
                                                                     
                                                                 </div>
                                                                 <div class="titleInput"><b> रशिद बुझिलिनेको  नाम / थर  :</b></div>
                                                                 <input class="check_to form-control" type="text" required name="rashid_to" />
                                                                 <br><div class="titleInput"><b> मिती  :</b></div>
                                                                 <input class="form-control bill_date" type="text" name="nepali_date" value="<?= $ld ?>"  id="nepaliDate3" required/>
                                                                 <input type="hidden" value="<?= $ld ?>" id="max_date">
                                                            </fieldset>
                                                         </div> 
                                                    </div>
                                               </td>
                                            </tr>
                                            <tr>
                                                  <th  class="myCenter">रशिदको किसिम</th>
                                                  <th  class="myCenter">जम्मा रशिद  </th>
                                                  <th  class="myCenter">निकासा भएको रशिद संख्या </th>
                                                
                                                   <th  style="text-align: center;"> जम्मा वितरण हुने रशिद संख्या </th>
                                            </tr>
                                            
                                                  
                                           
                                                
                                            <tr>
                                                <td>
                                                     <select class="form-control fill_height" name='description_id' id="description_id">
                                                        <option value=''>छान्नुहोस</option>
                                                        <?php foreach($description_data as $data){?>
                                                        <option value='<?=$data->id?>'><?=$data->name?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><input class="form-control" name="rashid_no" type="text" id="rashid_no" readonly="true"></td>
                                                <td>
                                                    <div style="width: 100%; height: 100px; overflow-y: scroll" id="valhtml">
                                                      
                                                    </div>
                                                </td>
                                              
                                                <td class="fill_height" ><input class="form-control" readonly="true" type="text" name="total" id="dispatch_total"/> <b>ठेली</b> </td>
                                            </tr>
                                              <tr>
                                                  <td colspan="13" style="text-align: center;">  <input class="btn" type="submit" id="submitbilldispatch" name="submit" value="सेब गर्नुहोस"> </td>
                                            </tr>
                                            </table>
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>
    

