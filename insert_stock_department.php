<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
if(isset($_POST['submit']))
{
//   echo "<pre>";  print_r($_POST);echo "</pre>";exit;
	
	for($i=0;$i<count($_POST['category']);$i++)
        {
            $data= new ItemStockDepartment();
            $data->category = $_POST['category'][$i];
            $data->item_id = $_POST['item_id'][$i];
            $data->rate = $_POST['rate'][$i];
            $data->stock = $_POST['qty'][$i];
            $data->department_id =$_POST['department_id'];
            $data->stock_date =$_POST['miti'];
            $data->stock_date_english = DateNepToEng($_POST['miti']);
            $data->hastantaran_id   = $_POST['hastantaran_id'];
            if($data->save())
            {
                addItemStock_hastantaran($_POST['item_id'][$i], $_POST['category'][$i], $_POST['qty'][$i], $_POST['rate'][$i]);
            }
            
        }
        echo alertBox("थप सफल ","insert_stock_department.php");
}
  $new_hastantaran_id = ItemStockDepartment::get_new_hastantaran_id();
  $item_type = Itemtype::find_all();
  $deps = Office::find_all();
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
                    <h2 class="headinguserprofile">हस्तारन्तरण मार्फत STOCK मा समान हल्नुहोस | <a href="index.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       
                                        <table class="table table-bordered td1">
                                            <tr>
                                                <th colspan="2"><strong>हस्तान्तरण न:</strong></th>
                                                <td colspan="2"><input type="text" class="myWidth50" name="hastantaran_id" value="<?= $new_hastantaran_id ?>"></td>
                                                
                                                <th>बिभाग:</th>
                                                <td>
                                                    <select class="myWidth50" name="department_id" required>
                                                        <option value="">छान्नुहोस्</option>
                                                        <?php foreach($deps as $data): ?>
                                                        <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                  <th class="myWidth5 myCenter" >क्र.स.</th>
                                                  <th class="myCenter">सामानको किसिम</th>
                                                  <th class="myCenter">सामानको प्रकार</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myCenter">रेट </th>
                                                  <th class="myCenter">परिमाण</th>
                                                  
                                            </tr>
                                                
                                            <tr>
                                                  <td >१</td>
                                                  <td >
                                                      <select class="form-control fill_height" id="item_type_id-1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td >
                                                      <select class="form-control fill_height" id="category-1" name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td>
                                                  <select name="item_id[]" id="item_name-1">
                                                  <option value="">--</option>
                                                  </select>
                                                  </td>
                                                  <td ><input class="myWidth100input form-control fill_height" type="text" name="rate[]"  /></td>
                                                  <td><input class="myWidth100input form-control fill_height" type="text" name="qty[]"  id="qty-1"/></td>
                                                  
                                            </tr>
                                                <tbody class="table table-bordered table-responsive" id="detail_add_table_stock">
                                         
                                                </tbody>      
                                        </table>
                                   मिति: <input type="text" name="miti" id="nepaliDate5"/>
                                        <table class="table borderless table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_stock btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more_stock btn">हटाउनुहोस</div></td>
                                                    <td class="myCenter"><input type="submit" name="submit" class="btn" value="सेभ गर्नुहोस" onclick="confirm('तपाई STOCK थप गर्दै  हुनुहुन्छ.. के निश्चित हुनुहुन्छ..?');"/></td>
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

