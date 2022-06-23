<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}

if(isset($_POST['submit']))
{
  $data= new Machinarylogprofile();
  $_POST['miti_english'] = DateNepToEng($_POST['miti']);
  $log_id = $data->savePostData($_POST);
  
  for($i=0;$i<count($_POST['log_miti']);$i++)
  {
      $result= new Machinarylogdetails();
      $result->log_id= $log_id;
      $result->log_miti = $_POST['log_miti'][$i];
      $result->log_miti_english = DateNepToEng($_POST['log_miti'][$i]);
      $result->place_to = $_POST['place_to'][$i];
      $result->place_from = $_POST['place_from'][$i];
      $result->km_to = $_POST['km_to'][$i];
      $result->km_from = $_POST['km_from'][$i];
      $result->total = $_POST['total'][$i];
      $result->petrol = $_POST['petrol'][$i];
      $result->mobil = $_POST['mobil'][$i];
      $result->grease = $_POST['grease'][$i];
      $result->oil = $_POST['oil'][$i];
      $result->save();
  }
echo alertBox("थप सफल ","machinary_logbook.php");  
 
}
 
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सवारीको लगबुक </title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">सवारीको लगबुक| <a href="machinary_logbook_details.php" class="btn">विवरण हेर्नुहोस</a> | <a href="machinary_dashboard.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       
                                          <div class="inputWrap">
                                                         <div class="our_content">
                                                            <fieldset> 
                                                                <legend>सवारीको लगबुक</legend>
                                                                <input type="hidden" name="type" value="" id="check_type">
                                                                 <div class="titleInput"><b> ड्राइभरको नाम   :</b></div>
                                                                <select name="type" class="check_to form-control">
                                                                    <option value="">छान्नुहोस्</option>
                                                                    <option value="1">बिभाग</option>
                                                                    <option value="2">कार्यालय</option>
                                                                    <option value="3">कर्मचारी</option>
                                                                </select>
                                                               
                                                                 <div class="myspacer20">
                                                                     
                                                                 </div>
                                                                 <div style="text-align: center;"colspan="2" id="show_to">

                                                             </div>
                                                                  <br><div class="titleInput"><b> सवारी नं:</b></div>
                                                               <input class="form-control" type="text" name="machine_no" required/>
                                                                <br><div class="titleInput"><b>सवारीको किसिम:</b></div>
                                                               <input class="form-control" type="text" name="machine_type" required/>
                                                                 <br><div class="titleInput"><b> मिती  :</b></div>
                                                               <input class="form-control" type="text" name="miti" id="nepaliDate1" required/>
                                                            </fieldset>
                                                         </div> 
                                                    </div>
                                        <table class="table table-bordered td1 td2 td3 tinput">
                                            <tr>
                                                <th class="myWidth5 myCenter" rowspan="2">मिती </th>
                                                  <th class="myCenter" colspan="2">ठाउँ</th>
                                                  <th class="myCenter" colspan="2" >किलो मिटर</th>
                                                  <th class="myCenter" rowspan="2">जम्मा </th>
                                                  <th class="myCenter" rowspan="2">पेट्रोल/डिजल (लिटर)</th>
                                                  <th class="myCenter" rowspan="2">मोबिल (लिटर)</th>
                                                  <th class="myCenter" rowspan="2">ग्रीज </th>
                                                  <th class="myCenter" rowspan="2">गेयर आयल</th>
                                            </tr>
                                            <tr>
                                                <td>बाट </td>
                                                <td>सम्म</td>
                                                 <td>देखि</td>
                                                <td>सम्म</td>
                                            </tr>    
                                            <tr>
                                                <td><input style="width:100px !important;" type="text" name="log_miti[]" id="nepaliDate2"/></td>
                                                  <td><input type="text" name="place_to[]"/></td>
                                                  <td><input type="text" name="place_from[]" /></td>
                                                  <td><input type="text" name="km_to[]" id="km_to_1"/></td>
                                                  <td><input type="text" name="km_from[]" id="km_from_1"/></td>
                                                  <td><input type="text" name="total[]" id="total_km_1"/></td>
                                                  <td><input type="text" name="petrol[]" /></td>
                                                  <td><input type="text" name="mobil[]" /></td>
                                                  <td><input type="text" name="grease[]" /></td>
                                                  <td><input type="text" name="oil[]" /></td>
                                            </tr>
                                            <tbody id="add_logbook">
                                                
                                            </tbody>
                                        </table>
                                    
                                        <table class="table borderless table-responsive">
                                            <tr>
                                                <td class="myCenter"><div class="add_more_log btn ">थप्नुहोस</div> </td>
                                                <td class="myCenter"> <div class="remove_more_log btn">हटाउनुहोस</div></td>
                                                <td class="myCenter"><input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस"/></td>
                                            </tr>
                                        </table>
                                    <input type="hidden" id="url" value="ledger">
                                </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


