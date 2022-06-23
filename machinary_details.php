<?php require_once("includes/initialize.php"); 
 error_reporting(0);
if(isset($_POST['submit']))
{
//   echo "<pre>"; print_r($_POST);echo "</pre>";exit;
//    echo count($_POST['item_details']);
$data= new MachinarydetailsProfile();
$_POST['miti_english'] = DateNepToEng($_POST['miti']);
 $machinary_id = $data->savePostData($_POST);

for($i=0;$i<count($_POST['item_id']);$i++)
{
//    echo $i."<br>";
    $result = new Machinarydetails();
    $result->item_type_id = $_POST['item_type_id'][$i];
    $result->category = $_POST['category'][$i];
    $result->miti = $_POST['miti'];
    $result->miti_english = DateNepToEng($_POST['miti']);
    $result->machinary_id = $machinary_id;
    $result->item_id = $_POST['item_id'][$i];
    $result->item_amount = $_POST['item_amount'][$i];
    $result->item_rate = $_POST['item_rate'][$i];
    $result->total_amount = $_POST['total_amount'][$i];
    $result->grand_total = $_POST['grand_total'];
    $result->vat_amount = $_POST['vat_amount'];
    $result->sum_amount = $_POST['sum_amount'];
    $result->save();
}

echo alertBox("थप सफल","machinary_details.php");
}
$machinary_result = Machinary::find_all();
$item_type = Itemtype::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>चल्ती मेशिन वा सवारीको किताब :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">चल्ती मेशिन वा सवारीको किताब | <a href="machinary_details_view.php" class="btn">चल्ती मेशिन वा सवारीको किताब हेर्नुहोस</a>  | <a href="index.php" class="btn">पछि जानुहोस </a></h2>
                  
                    <div class="OurContentFull">
                    	
                    	
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                        	    <div inputWrap100>
                        		<div class="inputWrap1">
                    				<h1>चल्ती मेशिन वा सवारीको किताब भर्नुहोस </h1>
                    				<div class="inputWrap50 inputWrap50">
                    				    <div class="titleInput">चल्ती मेशिन वा सबारीको नाम:</div>
                                                    <div class="newInput">
                                                        <select name="machine_id" id="machine_id">
                                                            <option value="">-----</option>
                                                            <?php foreach($machinary_result as $data):?>
                                                            <option value="<?=$data->id?>"><?=$data->name?></option>
                                                                <?php endforeach;?>
                                                        </select>
                                                    </div>
                                        <div class="titleInput">किसम:</div>
					    <div class="newInput"><input type="text"  name="type" readonly="true" id="type"></div>
                                                            <div class="titleInput">मोडल नं:</div>
										<div class="newInput"><input type="text" id="model" name="model"  readonly="true"></div>
                                         <div class="titleInput">सवारी दर्ता नं:</div>
                                         <div class="newInput"><input type="text" id="darta_no" name="darta_no" value="" readonly="true"></div>
                                       <div class="titleInput">मिती :</div>
										<div class="newInput"><input type="text" id="nepaliDate3" name="miti" ></div>
                                       
                                                </div>
                                                </div>
<!--                                                <h1>पेट्रोल मोबिल ग्रिज आदीको मोल तथा परिमाण</h1>
                                                <table class="table table-bordered myWidth100 table-responsive">
                                                    <tr>
                                                        <th>चलेको माईल</th>
                                                        <th>ईन्धन खर्च परिमाण</th>
                                                        <th>मोल (रकम रु )</th>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="total_distance"/></td>
                                                        <td><input type="text" name="quantity"/></td>
                                                        <td><input type="text" name="total_amount"/></td>
                                                    </tr>
                                                </table><br>-->
                                                <br>
                                           <center> <h4>मर्मतको विवरण तथा मोल<h4> </center>
                                                <table class="table table-bordered myWidth100 table-responsive">
                                                    <tr>
                                                        <th>क्र.स.</th>
                                                        <th>सामानको किसिम</th>
                                                       <th>सामानको प्रकार</th>
                                                       <th>सामानको  नाम </th>
                                                       <th>इकाइ</th>
                                                       <th>परिमाण</th>
                                                       <th>दर</th>
                                                       <th>जम्मा</th>
                                                       </tr>
                                                    <tr>
                                                        <td >1</td>
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
                                                         <option value="2">खर्च नहुने </option>
                                                     </select>
                                                  </td>
                                                  <td >
                                                      <select name="item_id[]" id="item_name-1" class="item_name">
                                                          <option value="">--</option>
                                                      </select>
                                                      
                                                      
                                                  </td>
                                                        <td id="unit_machinary_1"></td>
                                                        <td><input type="text" name="item_amount[]" id="item_amount_1"/></td>
                                                        <td><input type="grand_totaltext" name="item_rate[]" id="item_rate_1"/></td>
                                                        <td><input type="text" name="total_amount[]" id="total_amount_1" class="total_amount_machinary"/></td>
                                                    </tr>
                                                    <tbody id="machinary_add">
                                                        
                                                    </tbody>
                                                    <tr>
                                                        <td colspan="7">जम्मा रु</td>
                                                        <td><input type="text" name="grand_total" id="grand_total_machinary" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7">भ्याट  रकम रु &nbsp;&nbsp;<input type="checkbox" name="check_vat" id="check_vat_machinary"/></td>
                                                        <td><input type="text" name="vat_amount" id="vat_amount_machinary"/></td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="7">कुल जम्मा रु</td>
                                                        <td><input type="text" name="sum_amount" id="sum_amount_machinary"/></td>
                                                    </tr>
                                                    
                                                </table>
                                   <table class="table borderless table-responsive"    >
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_machine btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more_machine btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="submithere btn" value="सेभ गर्नुहोस"/></td>
                                                </tr>
                                           </table></div>
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

