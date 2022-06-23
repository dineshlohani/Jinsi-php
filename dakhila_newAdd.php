<?php require_once("includes/initialize.php"); 
$adesh_id = '';
global $database;
// $sql_maag    = "SELECT GROUP_CONCAT(adesh_id) FROM dakhila_profile";
// $result_maag = mysqli_fetch_object($sql_maag);
// $datass= mysqli_fetch_object($result_maag);
// $ids = mysqli_fetch_object($datass);

// if(empty($datass))
// {
//     $sql = "select * from kharid_adesh_profile ";
// }
// else
// {
    $sql = "select * from kharid_adesh_profile  where id not in ( select distinct adesh_id from dakhila_profile )";  
// }

$result = $database->query($sql);
  if(isset($_POST['submit']))
  {
     
     $dakhila_profile                   = new Dakhilaprofile;
     $dakhila_profile->date_nepali      = $_POST['date_nepali'];
     $dakhila_profile->date_english     = DateNepToEng($_POST['date_nepali']);
     $dakhila_profile->adesh_id         = $_POST['adesh_id'];
     $dakhila_profile->sub_total        = $_POST['sub_total'];
     $dakhila_profile->discount         = $_POST['discount'];
     $dakhila_profile->vat_total        =$_POST['vat_total'];
     $dakhila_profile->grand_total      = $_POST['grand_total'];
     $dakhila_id                        = $dakhila_profile->save();
     $count = count($_POST['item_id']);
    
     for($i=0; $i < $count; $i++)
     {
      
        if(empty($_POST['qty'][$i])){ continue;}
        $dakhila_item = new DakhilaItemDetails;
        $dakhila_item->item_id         = $_POST['item_id'][$i];
        $dakhila_item->category        = $_POST['category'][$i];
        $dakhila_item->qty             = $_POST['qty'][$i];
        $dakhila_item->rate            = $_POST['rate'][$i];
        $dakhila_item->total           = $_POST['total'][$i];
        $dakhila_item->vat_status      = $_POST['vat_status'][$i];
        $dakhila_item->vat_amount      = $_POST['vat_amount'][$i];
        $dakhila_item->vat_total       = $_POST['vat_total'][$i];
        $dakhila_item->extra_amount    = $_POST['extra_amount'][$i];
        $dakhila_item->gross_total     = $_POST['gross_total'][$i];
        $dakhila_item->rate_vat        = $_POST['rate_vat'][$i];
        
        if($_POST['vat_status'][$i] == 1)
        {
            $check_rate = $_POST['rate'][$i] * 1.13;
            $dakhila_item->rate_vat = $check_rate;
        }
        else
        {
            $check_rate = $_POST['rate'][$i];
        }
         
         $dakhila_item->dakhila_id      = $dakhila_id;
         $dakhila_item->save();
        
         // updating the stock according to item_id, rate and category
        
         if(isset($_POST['qty'][$i]))
          {  
           
             addItemStock($_POST['item_id'][$i], $_POST['category'][$i], $_POST['qty'][$i], $check_rate,"");
          } 
      }
     echo alertBox("थप सफल ","dakhila_newAdd.php");
  }
  if(isset($_GET['adesh_id']))
  {
          $adesh_id = (int) $_GET['adesh_id'];
         
          $dakhila_result = Dakhilaprofile::find_by_adesh_id($adesh_id);
          
         
          if(!empty($dakhila_result))
            {
              echo alertBox(" निम्न खरिद माग फाराम नं दाखिला भैसकेको छ ...!!","dakhila_newAdd.php");
            }
          else
          {
                $data_1 = KharidAdeshProfile::find_by_id($adesh_id);
                
                $data_2 = KharidAdeshItemDetails::find_by_adesh_id($adesh_id);
                // echo"<pre>";
                //  print_r($data_2);
                //  exit;
               
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
                    <h2 class="headinguserprofile">दाखिला रिर्पोट भर्नुहोस / <a href="dashboard_dakhila.php" class="btn">दाखिला रिर्पोटमा जानुहोस </a> </h2>

                    <div class="OurContentFull">
                        <h2>दाखिला रिर्पोट भर्नुहोस</h2>
                        <div class="userprofiletable">
                            <div class="inputWrap mb-3">
                                <div class="our_content myfont">
                                    <fieldset>
                                        <legend> दाखिला प्रतिवेदन फाराम नं : <?php echo Dakhilaprofile::getNextAutoIncrementValue(); ?></legend>

                                        <!-- <div class="b">दाखिला नभएका खरिद आदेश नं : </div> -->
                                        <label style="font-size:18px;"> दाखिला नभएका खरिद आदेश नं : <span style="background: red; color: #fff; padding: 0 7px; border-radius: 50%; font-stretch: 13px;"> <?=convertedcit(mysqli_num_rows($result))?> </span> </label>
                                        <form method="get">
                                        <select class="myWidth100 form-control" name="adesh_id" onchange="form.submit()" required>
                                                    <option value="">---------------- छान्नुहोस ----------------</option>
                                                  <?php while($data_result = mysqli_fetch_assoc($result)): ?>
                                                        <option value="<?=$data_result['id']?>" <?php if($data_result['id']==$adesh_id){?> selected="selected" <?php } ?> ><?=$data_result['id']?></option>
                                            
                                                  <?php endwhile; ?>
                                                </select>
                                                </form>
                                   
                                   
                                    <?php if(isset($_GET['adesh_id'])): ?>
                                    <form class="" method="POST" enctype="multipart/form-data">

                                        <!--<b> बिलको प्रकार : </b>
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
                                        </select>-->
                                        <b> मिति : </b><br>
                                        <input class="fill_height myWidth100" type="text" required name="date_nepali" id="nepaliDate3" /><br>

                                </div>
                                 </fieldset>
                            </div>
                            <br>
                            <table id="dakhilaTable" class="table table-responsive table-bordered margintop5 td1 td2">
                                           <tr>
                                                <th rowspan="2" class=""  style="width:2%;">क्र.स.</th>
                                               <!-- <th rowspan="2" class="" style="width:3%;">खरिद आदेश /हस्तान्तरण फारम नं </th>
                                                <th rowspan="2" class="" style="width:3%;">जिन्सी बर्गीकरण संकेत नं</th>
                                                <th rowspan="2" class="" style="width:3%;">जिन्सी खाता पाना नं</th>-->
                                                <th rowspan="2" class="" style="width:20%;">सामानको नाम</th>
                                                <!--<th rowspan="2" class="">स्पेशिफिकेशन</th>
                                                <th rowspan="2" class=""  style="width:3%;"> सामानको पहिचान नं </th>
                                                <th rowspan="2" class=""> मोडल नं </th>-->
                                                <th colspan="7" class="text-center">मूल्य (विल विजक अनुसार )</th>
                                                <th rowspan="2" class="width6">अन्य खर्च </th>
<!--                                                <th class="myCenter" rowspan="2"> अन्य खर्च </th>-->
                                                <th rowspan=" 2" class="myCenter width8"> अन्य खर्च समेत जम्मा रकम </th>
                                                <th rowspan="2" class="myCenter">कैफियत</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th class="myCenter">इकाइ</th>
                                                <th class="myCenter" style="width:2%;">परिमाण</th>
                                                <th class="myCenter"> दर</th>
                                                <th class="myCenter"> जम्मा मु.अ.कर बाहेक </th>
                                                <th class="myCenter"> मु.अ.कर </th>
                                                <th class="myCenter width6"> मु.अ.कर </th>
                                                <th class="myCenter"> सामानको जम्मा मूल्य </th>


                                            </tr>
                                
                                <?php if(!empty($data_2)): // adesh id not mentioned starts?>
                                <?php $list_count = 1; 
                                      foreach($data_2 as $list): 
                                      if($list->vat_status == 1)
                                      {
                                        $hidden_vat_rate = '<input type="hidden" id="rate_vat-'.$list_count.'"  name="rate_vat[]" value="'.($list->rate * 1.13).'" />';
                                      }
                                      else
                                      {
                                         $hidden_vat_rate = '<input type="hidden" id="rate_vat-'.$list_count.'"  name="rate_vat[]" value="'.$list->rate.'" />';
                                      }
                                            ($list->category==1)? $category_name = "खर्च हुने" : $category_name = "खर्च नहुने"; 
                                            $iteminst         = getItemInstance($list->category);
                                            $item_selected    = $iteminst->find_by_id($list->item_id);
                                            $budget_selected  = Budgettitle::find_by_id($item_selected->budget_title_id);
                                            $unit_selected    = Unit::find_by_id($item_selected->unit_id);
                                            $stock_result     = ItemStock::find_by_item_id_and_category($list->item_id, $list->category);
                                        ?>
                                <tr class="dakhila_item_row">
                                    <td><?=convertedcit($list_count)?></td>
                                   <!-- <td></td>
                                    <td></td>
                                    <td><?=convertedcit($stock_result->khata_id)?></td>-->
                                   
                                    <td><?=$item_selected->name?></td>
                                    <!--<td><?=$item_selected->specification?></td>
                                    <td></td>
                                    <td></td>-->
                                    <td><?=$unit_selected->name?></td>
                                    <td align="left" class="calc"><input type="text" class="refresh-qty" required id="qty-<?=$list_count?>" min="1" max="<?=$list->qty?>" name="qty[]" value="<?=$list->qty?>" /></td>
                                    <td><input type="text"  value="<?=$list->rate?>" name="rate[]" id="rate-<?=$list_count?>" /></td>
                                    <td><input type="text" id="total-<?=$list_count?>" class="input100percent total_amount_without_vat" name="total[]" value="<?=$list->total?>" /></td>
                                    <td>
                                       <select name="vat_status[]" id="vat_status-<?=$list_count?>"> 
                                                    <option value="0">----</option> 
                                                    <option value="1" <?php if($list->vat_status==1){?> selected="selected" <?php }?>>मू.अ.कर लाग्ने </option>  
                                                    <option value="2"  <?php if($list->vat_status==2){?> selected="selected" <?php }?>>मू.अ.कर नलाग्ने </option>
                                                </select> 
                                    </td>
                                    <td><input type="text" id="vat-<?=$list_count?>" class="input100percent total_vat" name="vat_amount[]" value="<?=$list->vat_amount?>" /></td>
                                    <td><input type="text" id="vat_total-<?=$list_count?>" class="input100percent total_amount_with_vat" name="vat_total[]" value="<?=$list->vat_total?>" />
                                  <!-- hidden field for rate+ vat -->
                                   
                                    </td>
                                    <td><input type="text" id="extra_amount-<?=$list_count?>" class="input100percent" name="extra_amount[]" value="" /></td>
                                    <td><input type="text" class="gross_total" id="gross_total-<?=$list_count?>"  name="gross_total[]" value="<?=$list->vat_total?>" /> </td>
                                    
                                    <td></td>
                                    <td><img src="images/wrong.png" class="cross_row_dakhila" width="20px" height="20px" /></td>
                                </tr>
                                <input type="hidden" name="category[]" value="<?=$list->category?>" />
                                <input type="hidden" name="item_id[]" value="<?=$list->item_id?>" />
                                <?php echo $hidden_vat_rate; ?>
                                <?php $list_count++; endforeach; ?>
                                <tr> 
                                    <td colspan="5" style="text-align:right;"></td>
                                    <td id="total_amount_without_vat"> जम्मा : <?=$data_1->total_amount?></td>
                                    <td></td>
                                    <td id="total_vat"> जम्मा : <?=$data_1->total_vat_amount?></td>
                                    <td id="total_amount_with_vat"> जम्मा : <?=$data_1->total_with_vat?> </td>
                                    <td  style="text-align:right;" >जम्मा</td>
                                    <td><input type="text"  value="<?=$data_1->total_with_vat?>" id="sub_total" name="sub_total" class="input100percent" /></td>
                                    <td>
                                      <td></td>
                                </tr>
                               
                                <tr>
                                    <td colspan="10" style="text-align:right;">छुट रकम</td>
                                    <td><input type="text" name="discount" value="0" id="discount" value="" class="input100percent" /></td>
                                    <td>
                                      <td></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:right;">कुल जम्मा</td>
                                    <td><input type="text" value="<?=$data_1->total_with_vat?>" id="grand_total" name="grand_total" class="input100percent" /></td>
                                    <td>
                                      <td></td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align:center;"><input type="submit" name="submit" class="submithere" value="सेभ गर्नुहोस" /> </td> 
                                </tr>
                                <td></td>
                                 <?php endif; // adesh id not mentioned ends?> </table> <input type="hidden" value="<?= $_GET['adesh_id'] ?>" name="adesh_id">
                                    <input type="hidden" value="dakhila" id="forurl" name="forurl">

                                        </form>
                              <?php endif; ?>
                        </div>
                    </div>
                </div><!-- main menu ends -->
            </div>
        </div>
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>
