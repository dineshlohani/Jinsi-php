<?php require_once("includes/initialize.php"); 
  $adesh_id = '';
  global $database;
$sql_maag    = "SELECT GROUP_CONCAT(adesh_id) FROM dakhila_profile";
$result_maag = $database->query($sql_maag);
$datass= $database->fetch_assoc($result_maag);
$ids = array_pop($datass);
if(!empty($ids))
{
$sql = "select * from kharid_adesh_profile as a where a.id not in (".$ids.")";
}
else
{
    $sql = "select * from kharid_adesh_profile";
}
$result = $database->query($sql);
  if(isset($_POST['submit']))
  {
      
     //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
     $dakhila_profile                   = new Dakhilaprofile;
     $dakhila_profile->date_nepali      = $_POST['date_nepali'];
     $dakhila_profile->date_english     = DateNepToEng($_POST['date_nepali']);
     $dakhila_profile->adesh_id         = $_POST['adesh_id'];
     $dakhila_profile->bill_type        = $_POST['bill_type'];
     $dakhila_profile->item_source      = $_POST['item_source'];
     $dakhila_profile->bill_type        = $_POST['bill_type'];
     $dakhila_profile->sub_total        = $_POST['sub_total'];
     if($_POST['bill_type']==1)
     {
         $dakhila_profile->vat_total    = 0;
     }
     else
     {
        $dakhila_profile->vat_total     = $_POST['vat_total'];
     }
     
     $dakhila_profile->discount         = $_POST['discount'];
     $dakhila_profile->grand_total      = $_POST['grand_total'];
     $dakhila_id                        = $dakhila_profile->save();
     for($i=0;$i<count($_POST['item_id']); $i++)
     {
         $dakhila_item = new DakhilaItemDetails;
         $dakhila_item->qty             = $_POST['qty'][$i];
         $dakhila_item->rate            = $_POST['rate'][$i];
          if($_POST['bill_type']==1)
            {
              $dakhila_item->rate_vat        = 0;
              $check_rate = $_POST['rate'][$i];
            }
          else 
            {
                $dakhila_item->rate_vat        = $_POST['rate_vat'][$i];
                $check_rate = $_POST['rate_vat'][$i];
            }
         $dakhila_item->extra_amount    = $_POST['extra_amount'][$i];
         $dakhila_item->total           = $_POST['total'][$i];
         $dakhila_item->category        = $_POST['category'][$i];
         $dakhila_item->item_id         = $_POST['item_id'][$i];
         $dakhila_item->dakhila_id      = $dakhila_id;
       
         $dakhila_item->save();
         // updating the stock according to item_id, rate and category
        
         if(isset($_POST['qty'][$i]))
           {  
           
             addItemStock($_POST['item_id'][$i], $_POST['category'][$i], $_POST['qty'][$i], $check_rate);
           } 
      }
     echo alertBox("थप सफल ","dakhila_newAdd1.php");
  }
  if(isset($_GET['adesh_id']))
{
    $adesh_id = (int) $_GET['adesh_id'];
     $dakhila_result = Dakhilaprofile::find_by_adesh_id($adesh_id);
      if(!empty($dakhila_result))
        {
          echo alertBox(" निम्न खरिद माग फाराम नं दाखिला भैसकेको छ ...!!","dakhila_newAdd1.php");
        }
      else
      {
            $data_1 = KharidAdeshProfile::find_by_id($adesh_id);
            $data_2 = KharidAdeshItemDetails::find_by_adesh_id($adesh_id);
      }
}


?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>दाखिला रिर्पोट भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">दाखिला रिर्पोट भर्नुहोस / <a href="dashboard_dakhila.php" class="btn">दाखिला रिर्पोटमा जानुहोस  </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>दाखिला रिर्पोट भर्नुहोस</h2>
                        <div class="userprofiletable">
                             <div class="inputWrap">
                                 <div class="our_content">
                                     
                                      <legend> दाखिला प्रतिवेदन फाराम नं: <?php echo Dakhilaprofile::getNextAutoIncrementValue(); ?></legend>
                                      <br> <b> खरिद आदेश नं: </b>
                                    <input class="fill_height myWidth72" type="text" name="adesh_id" placeholder="" required value="<?=$adesh_id?>" id="adesh_id_input" />
                                    <input type="button" name="adesh_button" value="खोज्नुहोस" id="adesh_id_find" class="btn search_btn"/><a href="dakhila_newAdd1.php"><br>
                                            <fieldset> 
                                                 <table class="table table-bordered">
                                                    <tr>
                                                        <th>दाखिला नभरेका खरिद माग फारम नं</th>
                                                        <th>खरिद माग गरेको मिति</th>
                                                    </tr>
                                                   <?php while($data_result = $database->fetch_assoc($result)): ?> 
                                                    <tr>
                                                        <td><?= convertedcit($data_result['id']) ?></td>
                                                        <td><?= convertedcit($data_result['date_nepali']) ?></td>
                                                    </tr>
                                                   <?php endwhile; ?> 
                                                </table>
                                            </fieldset>
                                          
                                      <?php if(isset($_GET['adesh_id'])): ?>  
                                        <form method="POST" enctype="multipart/form-data">       
                                              
                                   
                                             <fieldset>
                                                       
                                            <b>  बिलको प्रकार:</b>
                                             <select class="form-control" id="bill_type" name="bill_type" required>
                                                     <option value="">--छान्नुहोस्--</option>
                                                     <option value="1">प्यान</option>
                                                     <option value="2">भ्याट</option>
                                            </select>
                                            
                                            <b> सामान प्राप्त भएको श्रोत: </b>
                                            <select class="form-control" name="item_source" required>
                                                <option value="">----</option>
                                                <option value="1">खरिद मार्फत</option>
                                                <option value="2">हस्तानतरण मार्फत</option>
                                            </select>
                                            
                                            <b> मिति : </b><br>
                                             <input class="fill_height myWidth100" type="text" required name="date_nepali" id="nepaliDate3"/><br>
                                       
                                         
                                            </fieldset>
                                           
                                            </div>
                                          </div>
                                    <br>
                                   <table class="table table-bordered table-responsive td1 td2 center_all">
                                        <tr >
                                        
                                          <td rowspan="3" >सामानको नाम</td>
                                          <td rowspan="3" >जिन्सी खाता पाना नं</td>
                                          <td rowspan="3" >जिन्सी बर्गीकरण संकेत नं</td>
                                          <td rowspan="3" >स्पेशिफिकेशन</td>
                                          <td rowspan="3" >परिमाण</td>
                                          <td rowspan="3" >इकाई</td>
                                          <td colspan="5" >मूल्य इन्भाइस अनुसार</td>
                                        </tr>
                                        <tr height="20">
                                          <td rowspan="2" >प्रति इकाइ दर</td>
                                          <td rowspan="2" >मु.अ. कर    प्रति इकाइ</td>
                                          <td rowspan="2" >इकाइ    मूल्य</td>
                                          <td rowspan="2" >अन्य    खर्च</td>
                                          <td rowspan="2" >जम्मा</td>
                                        </tr>
                                        <tr > 
                                        </tr>
                                        <?php if(!empty($data_2)): // adesh id not mentioned starts?>
                                        <?php $list_count = 1; foreach($data_2 as $list): ?>
                                        <?php
                                            ($list->category==1)? $category_name = "खर्च हुने" : $category_name = "खर्च नहुने"; 
                                            $iteminst = getItemInstance($list->category);
                                            $item_selected = $iteminst->find_by_id($list->item_id);
                                            $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                            $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                            $stock_result = ItemStock::find_by_item_id_and_category($list->item_id, $list->category);
                                        ?>
                                        <tr >
                                          
                                            <td ><?=$item_name?></td>
                                            <td ><?=$stock_result->khata_id?></td>
                                          <td ><?=$category_name?></td>
                                          <td ><?=$item_selected->specification?></td>
                                          <td align="left"  class="calc"><input type="text" class="refresh-qty" required id="qty-<?=$list_count?>" min="1" max="<?=$list->qty?>" name="qty[]" value="<?=$list->qty?>" /></td>
                                          <td ><?=$unit_selected->name?></td>
                                          <td><input type="text" readonly="true" value="<?=$list->rate?>" name="rate[]" id="rate-<?=$list_count?>" /></td>
                                          <td ><input type="text"  readonly="true" id="vat-<?=$list_count?>"  class="input100percent" name="vat[]" value=""/></td>
                                          <td ><input type="text"  readonly="true" id="rate_vat-<?=$list_count?>" class="input100percent" name="rate_vat[]" value=""/></td>
                                          <td ><input type="text"   id="extra_amount-<?=$list_count?>" class="input100percent" name="extra_amount[]" value="0"/></td>
                                          <td ><input type="text"  readonly="true" id="total-<?=$list_count?>" class="input100percent" name="total[]" value=""/></td>
                                        </tr>
                                        <input type="hidden" name="category[]" value="<?=$list->category?>" />
                                        <input type="hidden" name="item_id[]" value="<?=$list->item_id?>"  />
                                        <?php $list_count++; endforeach; ?>
                                        <tr>
                                          
                                            <td colspan="10" style="text-align:right;">जम्मा</td>
                                            <td><input type="text" value="" id="sub_total" name="sub_total" class="input100percent" /></td>
                                        </tr>
                                        <tr id="vat_row" style="display:none;">
                                          
                                            <td colspan="10" style="text-align:right;">vat (13%)</td>
                                            <td><input type="text" value="0" id="vat_total" name="vat_total" readonly="true" class="input100percent" /></td>
                                        </tr>
                                        <tr>
                                          
                                            <td colspan="10" style="text-align:right;">छुट रकम</td>
                                            <td><input type="text" name="discount" value="0" id="discount" class="input100percent" /></td>
                                        </tr>
                                        <tr >
                                          
                                            <td colspan="10" style="text-align:right;">कुल जम्मा</td>
                                            <td><input type="text" value="" id="grand_total" name="grand_total" readonly="true" class="input100percent" /></td>
                                        </tr>
                                        <tr>
                                            
                                            <td colspan="11" style="text-align:center;"><input type="submit" name="submit" class="submithere" value="सेभ गर्नुहोस"</td>
                                        </tr>
                                      <?php endif; // adesh id not mentioned ends?>
                                      </table>
                                    <input type="hidden" value="<?= $_GET['adesh_id'] ?>" name="adesh_id">
                                </form>
                                    <?php endif; ?>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

