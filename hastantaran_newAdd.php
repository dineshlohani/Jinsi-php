<?php require_once("includes/initialize.php"); 
 error_reporting(0);
 Hastantaranone::resetAutoIncrement(); 
if(isset($_POST['submit']))
{
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";exit;
      $data=  new Hastantaranone();
      $data->hastantaran_id                 = $_POST['hastantaran_id'];
      $data->hastantaran_date               = $_POST['hastantaran_date'];
      $data->hastantaran_date_english       = DateNepToEng($_POST['hastantaran_date']);
      $data->office_id                      = $_POST['office_id'];
      $data->worker_id                      = $_POST['worker_id'];
      
      $hastantaran_id=$data->save();
      
      for($i=0;$i<count($_POST['item_id']);$i++)
      {
        
            
                $result = new Hastantaransecond();
                $result->hastantaran_id           = $hastantaran_id;
                $result->rate                     = $_POST['rate_hastantaran'][$i];
                $result->prev_stock                 = $_POST['total_quantity'][$i];
                $result->item_id                  = $_POST['item_id'][$i];
                 $result->category                  = $_POST['category'][$i];
                $result->quantity                 = $_POST['quantity'][$i];
                $result->total_amount             = $_POST['total_amount'][$i];
                $result->created_date             = $_POST['created_date'][$i];
                $result->created_date_english     = DateNepToEng($_POST['created_date'][$i]);
                $result->current_status           = $_POST['current_status'][$i];
                if($result->save())
                  {
                      $stock_data=  ItemStock::find_stock($_POST['item_id'][$i],$_POST['category'][$i],$_POST['rate_hastantaran'][$i]);
//                      print_r($stock_data);exit;
                      $net_stock = $stock_data->stock - $_POST['quantity'][$i];
                      $stock_data->stock = $net_stock;
                      $stock_data->save();
                  }
      }
                    echo alertBox("थप सफल ","hastantaran_newAdd.php");
     
}
$office_result=  Office::find_all();
$item_result=  ItemStock::find_all();
$worker_result=  Workers::find_all();
$item_type = Itemtype::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>हस्तानतरण फाराम भर्नुहोस </title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">हस्तानतरण फाराम भर्नुहोस / <a href="dashboard_hastantaran.php" class="btn">पछी जानुहोस् </a> </h2>
                    <div class="OurContentFull">
                    	<h2>हस्तानतरण फाराम भर्नुहोस</h2>
                        <div class="userprofiletable">
                            <form method="post">
                            <div class="inputWrap">
                                            <div class="our_content">
                                                <fieldset>
                                                <legend> हस्तानतरण फाराम नं. : <input class="none_input" type="text" name="hastantaran_id" value="<?php echo Hastantaranone::getNextAutoIncrementValue();?>"/></legend>
                                                <div class="titleInput"><b> सामान हस्तानतरण गरिएको कार्यालयको नाम:</b> </div>
                                            <div class="newInput">
                                                <select class="form-control" name="office_id">
                                                   <option value="">-------</option>
                                                   <?php foreach($office_result as $data):?>
                                                   <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                     <?php endforeach;?>
                                               </select>
                                            </div>
                                            <div class="titleInput"><b> सामान हस्तानतरण गर्न पठाईएको कर्मचारीको नाम :</b></div>
											<div class="newInput">
											    <select class="form-control" name="worker_id" id="worker_id">
                                                       <option value="">-------</option>
                                                       <?php foreach($worker_result as $data):?>
                                                       <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                       <?php endforeach;?>
                                                   </select>
											
                                                </div>
                                                <div class="titleInput"><b> पद:</b> </div>
												<div class="newInput form-control fill_height"><i> <span id="post"> </span> </i></div>
                                               
                                                <div class="titleInput"><b> सामान हस्तानतरण गर्ने निर्णय भएको मिति: </b> </div>
												<div class="newInput"><input class="form-control fill_height"  type="text" name="hastantaran_date" value="<?=generateCurrDate();?>" id="nepaliDate9"/></div>
                                            </fieldset>
                                            </div>
											
                                        </div> 
                                        <br>

                                   <table class="table table-bordered myWidth100 fix_tr">
                                        <tr>
                                            <th class="myCenter">क्र.स.</th>
                                            <th class="myCenter">सामानको किसिम</th>
                                            <th class="myCenter">सामानको प्रकार</th>
                                            <th class="myCenter">सामानको नाम</th>
                                            <th class="myCenter">जिन्सी खाता पाना नं</th>
                                            <th class="myCenter">जिन्सी संकेत नं</th>
                                            <th class="myCenter" >दर</th>
                                             <th class="myCenter" >जम्मा परिमाण</th>
                                            <th class="myCenter" >हस्तान्तरण गर्ने परिमाण</th>
                                            <th class="myCenter" >परल मुल्य</th>
                                            <th class="myCenter" >प्राप्त मिति</th>
                                            <th class="myCenter" >मालसामनको भौतिक अबस्था</th>
                                        </tr>
                                   	    <tr>
                                   	       <td><?php echo convertedcit(1);?></td>
                                               <td >
                                                      <select class="" id="item_type_id_1" name="item_type_id[]">
                                                          <option value="">छान्नुहोस</option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                  <td>
                                                      <select class="" id="category_1" name="category[]">
                                                          <option>छान्नुहोस</option>
                                                          <option value="1">खर्च हुने </option>
                                                          <option value="2">खर्च नहुने </option>
                                                      </select>
                                                  </td>
                                              <td id='item_name-1'>
                                                
                                            </td>
                                   	      <td id="stock_item_id_1"></td>
                                   	      <td id="budget_title_id_1"></td>
                                   	       <td id="rate-1">&nbsp;</td>
                                               <td id="safal-1"></td>
                                               <td id="amulya-1"></td>
                                               <td id="dhiraj-1"></td>
                                               <td id="sanjay-1"></td>
                                               <td id="pravin-1"></td>
<!--                                              <td colspan="7" id="rate_stock_1" style="padding: 0 !important; margin: 0 !important;">

                                              </td>-->
                                              
                           	         </tr>
                                         <tbody id="add_hastantaran">
                                             
                                         </tbody>
                                   </table>
                                   
                                   <table class="table borderless table-responsive ">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_hastantaran btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"><div class="remove_more_hastantaran btn ">हटाउनु होस</div> </td>
                                                    <td class="myCenter"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"> </td>
                                                    <!--<td class="myCenter"> <div class="remove_more btn">प्रिन्ट गर्नुहोस</div></td>-->
                                                    
                                                </tr>
                                  </table>
                                          <input type="hidden" value="1" id="forurl">    
                            </form>      
                          
                                    
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
               
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

