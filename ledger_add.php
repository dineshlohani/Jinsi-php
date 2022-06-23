<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
	redirect_to("logout.php");
}
  $item_condition = Itemcondition::find_all();
$user        = getUser();
if(isset($_POST['submit']))
{
        $khata_id = Ledger::get_new_khata_id($_POST['enlist_id'], $_POST['type']);
	    $ledger           = new Ledger();
        $ledger->date     = DateNepToEng($_POST['miti']);
        $ledger->enlist_id= $_POST['enlist_id'];
        $ledger->type     = $_POST['type'];
        $ledger->khata_id = $khata_id;
        $ledger->user_id  = $user->id;
        $ledger->save();
        
	for($i=0;$i<count($_POST['item_id']);$i++)
        {
            $a=0;
            $data= new Ledgerdetails();
            $data->category  = $_POST['category'][$i];
            $data->item_id   = $_POST['item_id'][$i];
            $data->qty       = $_POST['qty'][$i];
            $data->rate      = $_POST['rate'][$i];
            $data->given_condition_id  = $_POST['given_condition_id'][$i];
            $data->ledger_id = $ledger_id;
            if($data->save())
            {
               $a=1;
            }
            
        }
        if($a==1)
        {
          echo alertBox("थप सफल ","ledger_add.php");  
        } 
}
  $item_type = Itemtype::find_all();
  $deps = Department::find_all();
  $staff_result = Workers::find_all();
  $fiscals = FiscalYear::find_all();
  ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सहायक जिन्सी खाता </title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">लेजेर मार्फत समान  हल्नुहोस | <a href="dashboard_ledger.php" class="btn">पछि जानुहोस</a> </h2>
                    
                    <div class="OurContenFull">
                    	
                        <div class="userprofiletables">
                        	<form method="POST" enctype="multipart/form-data">
                                       
                                        <table class="table table-bordered td1">
                                            
                                            <tr>
                                                <td colspan="11">
                                                    <div class="inputWrap">
                                                         <div class="our_content">
                                                            <fieldset> 
                                                                <legend>समान लग्ने छान्नुहोस् </legend>
                                                                <input type="hidden" name="type" value="" id="check_type">
                                                                 <div class="titleInput"><b> सामान लिने  :</b></div>
                                                                <select name="to" class="check_to form-control">
                                                                    <option value="">छान्नुहोस्</option>
                                                                    <option value="1">शाखा </option></option>
                                                                    <option value="2">कार्यालय</option>
                                                                    <option value="3">कर्मचारी</option>
                                                                    <option value="4">पदाधिकारी</option>
                                                                </select>
                                                               
                                                                 <div class="myspacer20">
                                                                     
                                                                 </div>
                                                                 <div style="text-align: center;"colspan="2" id="show_to">

                                                             </div>
                                                                 <br><div class="titleInput"><b> मिती  :</b></div>
                                                               <input class="form-control" type="text" name="miti" id="nepaliDate3" required/>
                                                            </fieldset>
                                                         </div> 
                                                    </div>
                                               </td>
                                            </tr>
                                            <tr>
                                                  <th class="myWidth5 myCenter" >क्र.स.</th>
                                                  <th class="myCenter">सामानको किसिम</th>
                                                  <th class="myCenter">सामानको प्रकार</th>
                                                  <th class="myWidth10">सामानको  नाम </th>
                                                  <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                  <th class="myCenter">जिन्सी संकेत नं</th>
                                                  <th class="myCenter">स्पेसीफिकेसन</th>
                                                  <th class="myWidth10">दर</th>
                                                  <th class="myCenter" >जम्मा परिमाण</th>
                                                  <th class="myCenter">परिमाण</th>
                                                  <th class="myWidth10">सामानको अवस्था</th>
                                                  
                                            </tr>
                                                
                                            <tr>
                                                  <td >१</td>
                                                  <td>
                                                      <select class="form-control fill_height" id="item_type_id-1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td >
                                                      <select class="form-control fill_height" id="category-1" name="category[]">
                                                      
                                                        
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                                  <td>
                                                      
                                                  <select name="item_id[]" id="item_name-1" class="form-control item_id select2">
                                                  <label><option value="">--</option></label>
                                                  </select>
                                                  </td>
                                                  
                                                  <td id="stock_item_id_1"></td>
                                   	          <td id="budget_title_id_1"></td>
                                                  <td id="specification_1"></td>
                                                  <td id="rate-1">&nbsp;</td>
                                                  <td id="safal-1"></td>
                                                  <td><input class="qty_ledger_check myWidth100input form-control fill_height" type="text" name="qty[]"  id="qty-1"/></td>
                                                  <td>
                                                     <select name="given_condition_id[]" required>
                                                              <option value="">छान्नुहोस्</option>
                                                              <?php foreach ($item_condition as $condition): ?>
                                                              <option value="<?= $condition->id ?>"><?= $condition->name ?></option>
                                                              <?php endforeach;  ?>
                                                     </select>
                                                 </td>
                                                  
                                            </tr>
                                                <tbody class="table table-bordered table-responsive" id="detail_add_table_ledger">
                                         
                                                </tbody>      
                                        </table>
                                    
                                        <table class="table borderless table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_ledger btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more_ledger btn">हटाउनुहोस</div></td>
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
<script src="assets/select2/dist/js/select2.full.min.js"></script>
<script>
    JQ(document).ready(function(){
       JQ('.select2').select2(); 
    });
</script>


