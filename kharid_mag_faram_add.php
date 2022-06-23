<?php require_once("includes/initialize.php"); 
  
if(isset($_POST['submit']))
{
	
	$data= new Kharid_mag_faram1();
        $data->department_id=$_POST['department_id'];
        $data->maag_date=$_POST['maag_date'];
        $data->maag_date_english=  DateNepToEng($_POST['maag_date']);
        $maag_id=$data->save();
       
        for($i=0;$i<count($_POST['name']);$i++)
        {
            $result = new Kharid_mag_faram2;
            $result->saman_prakar=$_POST['saman_prakar'][$i];
            $result->name=$_POST['name'][$i];
            $result->prev_stock=$_POST['prev_stock'][$i];
            $result->qty=$_POST['qty'][$i];
            $result->maag_id=$maag_id;
            if($result->save())
            {
                $session->message("थप सफल");
                redirect_to("kharid_mag_faram_add.php");
            }
        }
        
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सुची दर्ता थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">सुची दर्ता हेर्नुहोस / <a href="settings_enlist_view.php">हेर्नुहोस</a> </h2>
                  
                    <div class="OurContentFull">
                    	<h2>खरिद माग फाराम भर्नुहोस</h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    <table class="table table-bordered table-responsive">
                                        <tr>
                                          <td> शाखा:</td>
                                           <td><select name="department_id">
                                           			<option value="">-छान्नुहोस-</option>
                                                    <?php foreach($deps as $dep): ?>
                                                    	<option value="<?=$dep->id?>"><?=$dep->name?></option>
                                                    <?php endforeach; ?>
                                            	</select>
                                           </td>
                                        </tr>
                                        <tr>
                                        <td>मिति:</td>
                                           <td class="myButton1"><input  type="text" name="maag_date" value="<?=generateCurrDate();?>" id="nepaliDate5"/></td>
                                        </tr>
                                    </table>
                                    
                                    	<table class="table table-bordered table-responsive">
                                                <tr >
                                                  <td class="myWidth5" >क्र.स.</td>
                                                  <td>सामानको किसिम</td>
                                                  <td>सामानको  प्रकार </td>
                                                  <td class="myWidth10">सामानको नाम  </td>
                                                  <td class="myWidth10">स्पेशिफिकेशन</td>
                                                  <td>जिन्सी खाता पाना नं</td>
                                                  <td> मौज्जाद परिमाण</td>
                                                  <td>इकाई</td>
                                                  <td> खरिद गर्नुपर्ने परिमाण</td>
                                                  
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
                                                      <select id="saman_prakar-1" name="saman_prakar[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td id="item_name-1"></td>
                                                  <td ><input class="myWidth100input"  type="text" value="" name="specification[]" id="specification-1" /></td>
                                                  <td ><input class="myWidth100input" type="text" value="" name="jinsi_id[]" id="jinsi_id-1" /></td>
                                                  <td ><input class="myWidth100input" type="text" name="prev_stock[]"  id="prev_stock-1"/></td>
                                                  <td ><input class="myWidth100input" type="text" name="unit_id[]" id="unit_id-1" /></td>
                                                  <td ><input class="myWidth100input" type="text" name="qty[]"  id="qty-1"/></td>
                                                  
                                                </tr>
                                            </table>
                                            <table id="detail_add_table"  class="detail_post table table-bordered table-responsive">
                                
                                            </table>
                                            <table class="table table-bordered table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="submithere btn" value="सेभ गर्नुहोस"/></td>
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

