<?php require_once("includes/initialize.php"); 
 Bhadadiyekobasicinfo::resetAutoIncrement();
 $a=0;
if(isset($_POST['submit']))
{

   $bhada=new Bhada();
   $bhada->khata_number = $_POST['khata_number'];
   $bhada->taken_date   = DateNepToEng($_POST['taken_date']);
   $bhada->enlist_id    = $_POST['enlist_id'];
   $bhada->fiscal_id    = $_POST['fiscal_id'];
   $bhada_clone         = $bhada;
   if($bhada->save())
   {
       for($i=0;$i<(count($_POST['period']));$i++)
       {
           $a=0;
           $bhada_details = new Bhadadetails();
           $bhada_details->category =2;
           $bhada_details->bhada_id = $bhada_clone->id;
           $bhada_details->item_id= $_POST['item_id'][$i];
           $bhada_details->item_rate= $_POST['rate'][$i];
           $bhada_details->period_type= $_POST['period_type'][$i];
           $bhada_details->period_rate= $_POST['period_rate'][$i];
           $bhada_details->period= $_POST['period'][$i];
           $bhada_details->qty= $_POST['qty'][$i];
           $bhada_details->bhada_amount= $_POST['bhada_amount'][$i];
           $bhada_details->item_condition_id= $_POST['item_conditon_id'][$i];
           $bhada_details->start_date= DateNepToEng($_POST['start_date'][$i]);
           $bhada_details->end_date= DateNepToEng($_POST['end_date'][$i]);
           if($bhada_details->save())
           {
               $a=1;
           }
       }
   }
   
   
  if($a==1)
  {  
          echo alertBox("थप सफल ", "bhadadiyeko_newAdd.php");
  }
  
}
$item_condition= Itemcondition::find_all();
$item_type= Itemtype::find_all();
$bhada_enlist = Bhadaenlist::find_all();
$fiscals = FiscalYear::find_all();
$rent_units=  Rentunit::find_all();
$current_fiscal = Fiscalyear::find_current_id();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडामा दिएको सम्पतिको अभिलेख खाता भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> भाडामा दिएको सम्पतिको अभिलेख खाता भर्नुहोस	| <a href="dashboard_bhadadiyeko.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> भाडामा दिएको सम्पतिको अभिलेख खाता भर्नुहोस		</h2>
                        <div class="userprofiletables">
                            
<!--                           <div class="myPrint"><a href="#">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>-->
                          <div class="our_content myWidth85 myCenter">
                              <form method="post">
                                  <fieldset >
                                  <legend></legend>
                                   <table class="table table-bordered">
                                      <tr>
                                        <td class="myWidth50">
                                         <b> सम्पतिको अभिलेख खाता नं :</b>
                                         <input required class="form-control fill_height" type="text" name="khata_number" id="khata_id" value="" required readonly="true">
                                       </td>
                                        <td>
                                         <b>मिती:</b>
                                         <input class="form-control fill_height" required type="text" name="taken_date" id="nepaliDate49" />
                                       </td>
                                    <td>
                                    <b>आर्थिक वर्ष :</b>
                                    <select class="form-control" name="fiscal_id" required>
                                                		<?php foreach($fiscals as $fiscal): ?>
                                                        	<option <?php if($fiscal->id=$current_fiscal){echo 'selected="selected"';} ?> value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="mycenter"><legend> <b>भाडामा लिने व्यक्त्ती वा कार्यालयको:</b> </legend></td>
                            </tr>
                             <tr>
                                   
                                            <td class="myWidth50">
                                                
                                                <b>नाम:</b>
                                                <select class="form-control fill_height" type="text" required id="bhada_enlist_name" name="enlist_id">
                                                    <option value="">छान्नुहोस्</option>
                                                    <?php foreach($bhada_enlist as $data): ?>
                                                    <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>    
                                            </td>
                                            <td>
                                                <b>ठेगाना:</b>
                                                <input class="form-control fill_height" type="text" name=""  id="bhada_enlist_address">
                                            </td>
                                            <td>
                                                <b>सम्पर्क नं:</b>
                                                <input class="form-control fill_height" type="text" name=""  id="bhada_enlist_number">
                                            </td>
                                        </tr> 
                                   </table>      
                               
                                      
                                  <table class="table myWidth100 table-bordered">
                                      <tr>
                                <td colspan="12" class="mycenter"><legend> <b>भाडामा दिएको सामानको विवरण:</b> </legend></td>
                                 </tr>
                                  <tr >
                                                  <th class="myWidth5" >क्र.स.</th>
                                                  <th class="mycenter">सामानको किसिम</th>
                                                    <th class="myWidth5">सामानको  नाम </th>
                                                   <th class="myWidth5">भाडामा दिएको सामानको मूल्य</th>
                                                  <th class="mycenter">भाडाको इकाई</th>
                                                  <th>प्रति इकाई अवधि भाडा दर</th>
                                                 <th>भाडा अवधीको परिमाण</th>
                                                 <th> भाडामा दिने सामानको परिमाण</th>
                                                 <th>जम्मा भाडा मूल्य रु</th>
                                                 <th class="mycenter">सामानको स्थिती</th>
                                                  <th>भाडा अवधि शुरु हुने मिति</th>
                                                  <th>भाडा अवधि सम्पन्न हुने मिति</th>
                                                 
                                                  
                                                </tr>
                                                
                                                <tr>
                                                  <td >१</td>
                                                  <td>
                                                      <select class="form-control" id="item_type_id-1" name="item_type_id[]" required>
                                                          <option value=""></option>
                                                          <?php foreach($item_type as $data):?>
                                                          
                                                           <option value="<?php echo $data->id;?>"><?php echo $data->name;?></option>
                                                           <?php endforeach;?>
                                                      </select>
                                                  </td>
                                                <input type="hidden" value="2" id="category-1">
                                                
                                                
                                                  <td >
                                                      <select name="item_id[]" id="item_name-1" class="item_name" required>
                                                          <option value="">--</option>
                                                      </select>
                                                      
                                                      
                                                  </td>
                                                   <td id="rate-1">&nbsp;</td>
                                                   <td class="mycenter">
                                                      <select class="" name="period_type[]" required>
                                                        <option value=""></option>
                                                        <option value="1">दैनिक</option>
                                                        <option value="2">मासिक</option>
                                                        <option value="3">बार्षिक</option>
                                                    </select> 
                                                   </td>
                                                  <td><input class="form-control fill_height" type="text" name="period_rate[]" id="period_rate_1" required></td>
                                                  <td><input class="myWidth100input fill_height" type="text" name="period[]"  id="period_1" required/></td>
                                                  <td><input class="qty_check myWidth100input fill_height" type="text" name="qty[]" id="qty_1" required/></td>
                                                  <td><input class="qty_check myWidth100input fill_height" type="text" name="bhada_amount[]" id="bhada_amount_1" required/></td>
                                                  <td>
                                                      <select class="form-control" name="item_conditon_id[]" required>
                                                          <option value=""></option>
                                                          <?php foreach($item_condition as $data): ?>
                                                          <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                                          <?php endforeach; ?>
                                                      </select>
                                                  </td>
                                                  <td> <input class="form-control fill_height" type="text" name="start_date[]" id="nepaliDate1" required></td>
                                                  <td> <input class="form-control fill_height" type="text" name="end_date[]" id="nepaliDate3" required></td>
                                                  
                                                </tr>
                         
                                                <tbody id="get_bhada_div">
                                                    
                                                </tbody>
                                </table>
                                    <table class="table borderless table-responsive">
                                                <tr>
                                                    <td class="myCenter"><div class="add_more_bhada btn ">थप्नुहोस</div> </td>
                                                    <td class="myCenter"> <div class="remove_more_bhada btn">हटाउनुहोस</div></td>
                                                </tr>
                                           </table>
                            
                                
                                    <div  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                             
                              </fieldset>
                          </div>
        <input type="hidden" id="forurl" value="kharcha">
                           </form>    
                          
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

