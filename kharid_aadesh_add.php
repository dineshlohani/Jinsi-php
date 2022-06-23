<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}

  $maag_id = '';
  $fiscal_id = '';
  $data_2 = '';
//  $_GET['org_id'] ="";
if(!empty($_GET['org_id']))
{
    $adesh_org_result = KharidAdeshProfile::find_by_sql("select * from kharid_adesh_profile where maag_id=".$_GET['maag_id']." and enlist_id=".$_GET['org_id']);
    if(!empty($adesh_org_result))
    {
        echo alertBox("निम्न खरिद माग फाराम नं अन्तर्गत रहेको निम्न संस्थाको खरिद आदेश भरि सकेको छ ...","kharid_adesh_new_add.php?maag_id=".$_GET['maag_id']);
    }
}
    if(isset($_POST['submit']))
{
   //echo "<pre>";print_r($_POST); echo "</pre>"; exit;
    $post_1                 = new KharidAdeshProfile;
    $post_1->maag_id        = $_GET['maag_id'];
    $post_1->date_nepali    = $_POST['date_nepali'];
    $post_1->date_english   = DateNepToEng($_POST['date_nepali']);
    $post_1->is_suchikrit   = $_POST['is_suchikrit'];
    
    if($_POST['is_suchikrit'] == 'yes')
    {
        $post_1->enlist_id = $_POST['enlist_id'];
    }
    elseif($_POST['is_suchikrit'] == 'no')
    {
        $post_1->non_enlist_name    = $_POST['non_enlist_name'];
        $post_1->non_enlist_address = $_POST['non_enlist_address'];
    }
        $post_1->nirnaya_no             = $_POST['nirnaya_no'];
        $post_1->nirnaya_nepali_date    = $_POST['nirnaya_nepali_date'];
        $post_1->nirnaya_english_date   = DateNepToEng($_POST['nirnaya_nepali_date']);
        
   $post_1->enlist_id           = $_POST['enlist_id'];
   $post_1->entry_date_nepali   = $_POST['entry_date_nepali'];
   $post_1->entry_date_english  = DateNepToEng($_POST['entry_date_nepali']);
   $post_1->total_amount        = $_POST['total_amount'];
   $post_1->total_vat_amount    = $_POST['total_vat_amount'];
   $post_1->total_with_vat      = $_POST['total_with_vat'];
//   $post_1->discount_amount = $_POST['discount_amount'];
        
   $adesh_id = $post_1->save();
   
   for($i=0; $i<count($_POST['item_id']); $i++)
   {
       $post_2              = new KharidAdeshItemDetails;
       $post_2->item_id     = $_POST['item_id'][$i];
       $post_2->category    = $_POST['category'][$i];
       $post_2->rate        = $_POST['rate'][$i];
       $post_2->qty         = $_POST['qty'][$i];
       $post_2->total       = $_POST['total'][$i];
       $post_2->remarks     = $_POST['remarks'][$i];
       $post_2->vat_status  = $_POST['vat_status'][$i];
       $post_2->vat_amount = $_POST['vat_amount'][$i];
       $post_2->vat_total = $_POST['vat_total'][$i];
       $post_2->adesh_id    = $adesh_id;
       $post_2->save();
   }
   
    echo alertBox("थप सफल ","kharid_adesh_new_add.php");
}
  if(isset($_GET['maag_id']))
{
        $maag_id            = (int) $_GET['maag_id'];
        $tippani_result     = TippaniAdesh::find_by_kharid_ids($maag_id);
        $kharid_adesh_result= KharidAdeshProfile::find_by_maag_id($maag_id);
        $data_1             = Kharid_mag_faram1::find_by_id($maag_id);
        $dep_selected       = Department::find_by_id($data_1->department_id);
        $fiscal_selected    = Fiscalyear::find_by_id($data_1->fiscal_id);
        $fiscal_id          = $fiscal_selected->id;
        $data_2             = Kharid_mag_faram2::find_by_maag_id((int) $_GET['maag_id']); 
}
if(isset($_GET['maag_id']) && isset($_GET['org_id']))
{
     $maag_id            = (int) $_GET['maag_id'];
     $org_id             = $_GET['org_id'];
     $tippani_result = Jinsitippani::find_by_sql("select * from jinsi_tippani where kharid_id=".$maag_id." and org_id=".$org_id." and status=1");
     
//     echo "<pre>";
//          print_r($tippani_result);
//          echo "</pre>"
//;exit;
          
}

$enlist_orgs = Enlist::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद आदेश भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner">
        <div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद आदेश भर्नुहोस / <a href="dashboard_kharid.php" class="btn">खरिद आदेशमा जानु होस् </a> </h2>

                    <div class="OurContentFull">
                        <h2>खरिद आदेश भर्नुहोस</h2>
                        <div class="userprofiletables">


                            <?php
                               if(isset($_GET['maag_id']) && isset($_GET['org_id'])){
                                   
                               ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="inputWrap width25">
                                    <div class="our_content mytableinput">
                                        <fieldset>
                                            <legend> खरिद आदेश नं. <?=KharidAdeshProfile::getNextAutoIncrementValue()?></legend>
                                            <div class="titleInput mt-2">खरिद आदेश मिति : </div>
                                            <div class=""><input class="form-control" type="text" name="date_nepali" value="<?=generateCurrDate();?>" id="nepaliDate9" required/></div>
                                            <div class="titleInput mt-2">खरिद सम्वन्धि निर्णय नं :</div>
                                            <input type="number" class="form-control" name="nirnaya_no" required>
                                            <div class="titleInput mt-2">निर्णय मिति </div>
                                            <div class="form-group"><input class="fill_height myWidth100" type="text" name="nirnaya_nepali_date" value="<?=generateCurrDate();?>" id="nepaliDate5" required/></div>
                                        </fieldset>
                                    </div>

                                </div>

                                <table class="table table-bordered td1 td2 center_all">


<!--
                                    <tr>
                                        <td colspan="2">खरिद आदेश नं. hello</td>
                                        <td colspan="2"><input class="none_input myBold" type="text" name="kharid_aadesh_id" value="<?=KharidAdeshProfile::getNextAutoIncrementValue()?>" readonly="true" /></td>
                                        <td colspan="2">मिति </td>
                                        <td colspan="2" class="myButton1"> <input class="form-control fill_height" type="text" name="date_nepali" value="<?=generateCurrDate();?>" id="nepaliDate9" /></td>

                                    </tr>
-->
                                    <tr>
                                        <th rowspan="2">क्र.स.</th>
                                        <th rowspan="2">सामानको नाम</th>
                                        <th rowspan="2">जिन्सी बर्गिकरण संकेत नं</th>
                                        <th rowspan="2">स्पेशिफिकेशन</th>
                                        <th rowspan="2">सामानको परिमाण</th>
                                        <th rowspan="2">इकाई</th>
                                        <th colspan="2" style="text-align:center;">मूल्य</th>
                                        <th>कैफियत</th>
                                    </tr>
                                    <tr>
                                        <th>प्रति इकाइ दर रु</th>
                                        <th>जम्मा रु</th>
                                    </tr>
                                    <?php $total_rate=0; $sn=1; foreach ($tippani_result as $list): ?>
                                    <?php 
                                        if($list->category == 1)
                                        {
                                            $category = '४०७';
                                        }else if($list->category == 2)
                                        {
                                            $category = '४०८';
                                        }
                                         $iteminst = getItemInstance($list->category);
                                        $item_selected = $iteminst->find_by_id($list->item_id);
                                        $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                        $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                        $quantity_selected= Kharid_mag_faram2::find_by_maag_id_item_id_category($list->kharid_id,$list->item_id,$list->category);
                                        $total= $list->rate_tippani * $quantity_selected->qty; 
                                        $org_minimum_rate= Jinsitippani::get_sum_by_kharid_id_org_id($list->kharid_id,$list->org_id);
                                     ?>
                                    <tr>
                                        <td><?=$sn?></td>
                                        <td><?=$item_selected->name?></td>
                                        <td><?=$category?></td>
                                        <td><?=$item_selected->specification?></td>
                                        <td><input class="form-control fill_height" type="text" name="qty[]" value="<?=$quantity_selected->qty?>" /></td>
                                        <td><?=$unit_selected->name?></td>
                                        <td><input class="form-control fill_height" type="text" name="rate[]" value="<?=$list->rate_tippani?>" /></td>
                                        <td><input class="form-control fill_height" type="text" name="total[]" value="<?=$total?>" /></td>
                                        <td><textarea name="remarks[]" class="remarks"></textarea></td>
                                    </tr>
                                    <input type="hidden" name="category[]" value="<?=$list->category?>" />
                                    <input type="hidden" name="item_id[]" value="<?=$list->item_id?>" />
                                    <?php $total_rate+=$total;$sn++; endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b> कुल जम्मा </b></td>
                                        <td><input class="form-control fill_height" type="text" id="total_amount" name="total_amount" value="<?=$total_rate?>" /></td>
                                    </tr>

                                </table>
                                <div class="row">
                                    <div class="col">
                                        सुचिकृत : हो <input type="radio" name="is_suchikrit" value='yes' checked> होईन <input type="radio" name="is_suchikrit" value='no'> 
                                    </div>
                                </div>
                                <div class="row mt-3">
                                   <div class="col-4">
                                        <div class=""  id='suchikrit_no'>
                                            <label for=""> फर्म / ब्यक्तिको नाम : </label>
                                            <input type='text' autocomplete="off" list="main" id="org" class="form-control"  />
                                            <select name="enlist_id">
                                                <option class="form-control fill_height" value="<?php echo $org_id?>"><?php echo Enlist::getName($org_id);?></option>
                                            </select>
                                            <input type="hidden" name="enlist_id" id="show_org">
                                       </div>
                                       <div class="myhide"  id='suchikrit_yes'>
                                            
                                            <label for=""> फर्म / ब्यक्तिको नाम : </label>
                                            <input type="text" class='form-control' name='non_enlist_name'><br/>
                                            <label for=""> ठेगाना </label>
                                            <input type="text" class='form-control' name='non_enlist_address'>
                                       </div>
                                   </div>
                                   <div class="col-6">
                                       
                                   </div>
                                   <div class="col-2 ">
                                       <label for=""> सामान दाखिला गर्नुपर्ने मिति : </label>
                                       <input class="form-control" required type="text" name="entry_date_nepali" id="nepaliDate1" />
                                   </div>
                                    
                                </div>
                                
                                <td class="myCenter pull-right"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="add_more btn " /> </td>
                                <!--<td class="myCenter"> <div class="remove_more btn">प्रिन्ट गर्नुहोस</div></td>-->


                            </form>
                            <?php   
                               }
                               else
                               {
                                    if(!empty($data_2)): ?>

                            <form method="post" enctype="multipart/form-data">
                                <div class="inputWrap width25">
                                    <div class="our_content mytableinput">
                                        <fieldset>
                                            <legend> खरिद आदेश नं. <?=KharidAdeshProfile::getNextAutoIncrementValue()?></legend>
                                            <div class="titleInput mt-2">खरिद आदेश मिति : </div>
                                            <div class=""><input class="form-control" type="text" name="date_nepali" value="<?=generateCurrDate();?>" id="nepaliDate9" required/></div>
                                            <div class="titleInput mt-2">खरिद सम्वन्धि निर्णय नं :</div>
                                            <input type="number" class="form-control" name="nirnaya_no" required>
                                            <div class="titleInput mt-2">निर्णय मिति </div>
                                            <div class="form-group"><input class="fill_height myWidth100" type="text" name="nirnaya_nepali_date" value="<?=generateCurrDate();?>" id="nepaliDate5" required /></div>



                                        </fieldset>
                                    </div>

                                </div>
                                <br>

                                <table class="table table-bordered mytableinput td1 td2">
                                
                                    <tr>
                                        <th rowspan="2">क्र.स.</th>
                                        <th rowspan="2">सामानको नाम</th>
                                        <th rowspan="2" style="width:3%;">जिन्सी बर्गिकरण संकेत नं</th>
                                        <th rowspan="2">स्पेशिफिकेशन</th>
                                        <th rowspan="2" style="width:6%;">सामानको परिमाण</th>
                                        <th rowspan="2">इकाई</th>
                                        <th colspan="5" style="text-align:center;">मूल्य</th>
                                        <th  rowspan="2">कैफियत</th>
                                        
                                    </tr>
                                    <tr>
                                        <th style="width:6%;">प्रति इकाइ दर रु</th>
                                        <td> जम्मा </td>
                                        <th> मू.अ.कर </th>
                                        <th style="width:6%;">मू.अ.कर रु</th>
                                        <th> जम्मा रु  </th>
                                    </tr>
                                    <?php $sn=1; foreach ($data_2 as $list): ?>
                                    <?php 
                                        if($list->category == 1)
                                        {
                                            $category = '४०७';
                                        }else if($list->category == 2)
                                        {
                                            $category = '४०८';
                                        }
                                        $iteminst = getItemInstance($list->category);
                                        $item_selected = $iteminst->find_by_id($list->item_id);
                                        $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                        $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                     ?>
                                    <tr>
                                        <td><?=$sn?></td>
                                        <td><?=$item_selected->name?></td>
                                        <td><?=$category?></td>
                                        <td><?=$item_selected->specification?></td>
                                        <td><input type="text" name="qty[]" value="<?=$list->qty?>" id="qty-<?=$sn?>" /></td>
                                        <td><?=$unit_selected->name?></td>
                                        <td><input type="text" name="rate[]" value="" id="rate-<?=$sn?>" /></td>
                                        <td><input type="text" name="total[]" value="" id="total-<?=$sn?>" class="total" /> </td>
                                        <td>  <select name="vat_status[]" id="vat_status-<?=$sn?>">  
                                                    <option value="1">मू.अ.कर लाग्ने </option>  
                                                    <option value="2">मू.अ.कर नलाग्ने </option>
                                                </select> 
                                       </td>
                                        <td><input type="text" readonly="true" name="vat_amount[]" id="vat_amount-<?=$sn?>" class="vat_amount" /></td>
                                        <td><input type="text" readonly="true" name="vat_total[]"  id="vat_total-<?=$sn?>" class="vat_total"></td>
                                        <td><textarea name="remarks[]" class="remarks"></textarea></td>
                                       
                                    </tr>
                                    <input type="hidden" name="category[]" value="<?=$list->category?>" />
                                    <input type="hidden" name="item_id[]" value="<?=$list->item_id?>" />
                                    <?php $sn++; endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>जम्मा </td>
                                        <td><input type="text" name="total_amount" id="total_without_vat" readonly="true" /></td>
                                        <td>जम्मा</td>
                                        <td><input type="text" name="total_vat_amount" readonly="true" id="total_vat_amount"></td>
                                        <td><input type="text" name="total_with_vat"  readonly="true" id="total_with_vat"> </td>
                                        <td colspan="2"></td>
                                    </tr>

                                </table>
                                <div class="row myfont b px-2">
                                    <div class="col-md-12">
                                       <span style="margin-right:15px;">  सुचिकृत : </span> हो <input style="margin-right:20px;" type="radio" name="is_suchikrit" value='yes' checked> होईन <input type="radio" name="is_suchikrit" value='no'> 
                                    </div>
                                </div>
                                <div class="row mt-3 mytableinput b mb-4 px-2">
                                   <div class="col-2">
                                       <div class=""  id='suchikrit_yes'>
                                            <label for=""> फर्म / ब्यक्तिको नाम : </label>
                                            <input type='text' autocomplete="off" list="main" id="org" class="width100"  />
                                            <datalist id="main">
                                                <?php foreach($enlist_orgs as $enlist_org): ?>
                                                <option data-id='<?= $enlist_org->id ?>' value='<?=$enlist_org->name;?>'></option>
                                                <?php endforeach;  ?>
                                            </datalist>
                                            <input type="hidden" name="enlist_id" id="show_org">
                                       </div>
                                       <div class="myhide"  id='suchikrit_no' >
                                            
                                            <label for=""> फर्म / ब्यक्तिको नाम : </label>
                                            <input type="text" class='width100' name='non_enlist_name'><br/>
                                            <label for=""> ठेगाना </label>
                                            <input type="text" class='width100' name='non_enlist_address'>
                                       </div>
                                   </div>
                                   <div class="col-8"> </div>
                                   <div class="col-2 ">
                                       <label for=""> सामान दाखिला गर्नुपर्ने मिति : </label>
                                       <input class="form-control" required type="text" name="entry_date_nepali" id="nepaliDate1" />
                                   </div>
                                    
                                </div>
<!--
                                <table class="table table-borderless">
                                    <tr>
                                        <td>फर्मको नाम :

                                            <input type='text' autocomplete="off" list="main" id="org" class="form-control" required />
                                            <datalist id="main">
                                                <?php foreach($enlist_orgs as $enlist_org): ?>
                                                <option data-id='<?= $enlist_org->id ?>' value='<?=$enlist_org->name;?>'></option>
                                                <?php endforeach;  ?>
                                            </datalist>
                                            <input type="hidden" name="enlist_id" id="show_org">
                                        </td>
                                        <td class="myButton1">सामान दाखिला गर्नुपर्ने मिति : <input type="text" name="entry_date_nepali" required id="nepaliDate1" />
                                        </td>
                                    </tr>
                                </table>
-->
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="add_more btn " /> </td>
                                        <!--<td class="myCenter"> <div class="remove_more btn">प्रिन्ट गर्नुहोस</div></td>-->

                                    </tr>
                                </table>
                            </form>
                            <?php endif; ?>
                            <?php }?>

                        </div>
                    </div>
                </div><!-- main menu ends -->
            </div>
        </div>
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>
    <script>
        jQuery(document).on('click','input[name="is_suchikrit"]',function(){
            jQuery('#suchikrit_no').toggle('myhide');
            jQuery('#suchikrit_yes').toggle('myhide');
            
        });
    </script>