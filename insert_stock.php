<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
if(isset($_POST['submit']))
{
	for($i=0;$i<count($_POST['category']);$i++)
        {
            $data= new ItemStock();
            $data->category = $_POST['category'][$i];
            $data->item_id = $_POST['item_id'][$i];
            $data->rate = $_POST['rate'][$i];
            $data->stock = $_POST['qty'][$i];
            $data->stock_date =$_POST['miti'];
            $data->stock_date_english = DateNepToEng($_POST['miti']);
            $data->khata_id = get_jinsi_khata_id($_POST['item_id'][$i],$_POST['category'][$i]);
            $data->prev_stock =  $_POST['qty'][$i];
            $data->dakhila_no = $_POST['dakhila_no'][$i];
            $data->save();
            
        }
        echo alertBox("थप सफल ","insert_stock.php");
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>मौज्दात स्टक हाल्नुहोस </title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">STOCK मा समान हल्नुहोस | <a href="index.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       
                                        <table class="table table-bordered td1">
                                                <tr >
                                                  <th class="myWidth5 myCenter" >क्र.स.</th>
                                                  <th class="myCenter">सामानको किसिम</th>
                                                  <th class="myCenter">सामानको प्रकार</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myWidth10">दाखिला / निकासी नं</th>
                                                  <th class="myCenter">रेट </th>
                                                  <th class="myCenter">परिमाण</th>
                                                  
                                                </tr>
                                                <tr >
                                                  <td >१</td>
                                                  <td >
                                                      <select class="form-control fill_height" id="item_type_id-1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td>
                                                      <select class="form-control fill_height" id="category-1" name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td>
                                                <label>
                                                  <select name="item_id[]" id="item_name-1" class="select2">
                                                    <option value="">-----Select Item Name-----</option>
                                                  </select>
                                                </label>
                                                  </td>
                                                  <td><input class="myWidth100input form-control fill_height" type="text" name="dakhila_no[]"  /></td>
                                                  <td><input class="myWidth100input form-control fill_height" type="text" name="rate[]"  /></td>
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
<script src="assets/select2/dist/js/select2.full.min.js"></script>
<?php include("menuincludes/footer.php"); ?>
<script>
    JQ(document).ready(function(){
       JQ('.select2').select2(); 
    });
</script>

