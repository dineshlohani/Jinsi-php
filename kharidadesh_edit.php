<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
  $maag_id = '';
  $fiscal_id = '';
  $grand_total=0;
  $b=0;
//  $_GET['org_id'] ="";
 $id= $_GET['id'];
 $kharid_adesh_result= KharidAdeshProfile::find_by_id($id);
 
if(isset($_POST['submit'])):
   $post_1 =  KharidAdeshProfile::find_by_id($_POST['update_id']);
   $post_1->maag_id = $_GET['maag_id'];
   $post_1->date_nepali = $_POST['date_nepali'];
   $post_1->date_english = DateNepToEng($_POST['date_nepali']);
   $post_1->enlist_id = $_POST['enlist_id'];
   $post_1->entry_date_nepali = $_POST['entry_date_nepali'];
   $post_1->entry_date_english = DateNepToEng($_POST['entry_date_nepali']);
//   $post_1->discount_amount = $_POST['discount_amount'];
   $post_1->save();
   $kharid_adesh_result_items= KharidAdeshItemDetails::find_by_adesh_id($_POST['update_id']);
   foreach ($kharid_adesh_result_items as $a)
        {
           $a->delete();
        }
   
   for($i=0; $i<count($_POST['item_id']); $i++)
   {
       $post_2 = new KharidAdeshItemDetails;
       $post_2->item_id = $_POST['item_id'][$i];
       $post_2->category = $_POST['category'][$i];
       $post_2->rate = $_POST['rate'][$i];
       $post_2->qty = $_POST['qty'][$i];
       $post_2->total = $_POST['total'][$i];
       $post_2->adesh_id = $_POST['update_id'];
       if($post_2->save())
       {
           $b=1;
       }
   }
   if($b==1)
   {
     echo alertBox("सच्याउन सफल ","kharidadesh_search.php");  
   }
     
  endif; 
   

  if(isset($_GET['maag_id']))
{
            $maag_id             = (int) $_GET['maag_id'];
            $tippani_result      = TippaniAdesh::find_by_kharid_ids($maag_id);
            $kharid_adesh_result = KharidAdeshProfile::find_by_id($_GET['id']);
            $data_1              = Kharid_mag_faram1::find_by_id($maag_id);
            $dep_selected        = Department::find_by_id($data_1->department_id);
            $fiscal_selected     = Fiscalyear::find_by_id($data_1->fiscal_id);
            $fiscal_id           = $fiscal_selected->id;
            $data_2              = KharidAdeshItemDetails::find_by_adesh_id($_GET['id']);
//            echo "<pre>";
//            print_r($data_2);
//            echo "</pre>";exit;
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
                            
                                     <form method="post" enctype="multipart/form-data">

                                        <table class="table table-bordered">
                                         <tr>
                                           <td colspan="2">खरिद आदेश नं. </td>
                                           <td colspan="2"><input type="text" name="kharid_aadesh_id"  value="<?=$kharid_adesh_result->id?>" readonly="true" /></td>
                                           <td colspan="2">मिति</td>
                                             <td class="myButton1" colspan="2"><input  type="text" name="date_nepali" value="<?= $kharid_adesh_result->date_nepali?>" id="nepaliDate9"/></td>
                                        
                                         </tr>
                                                 <tr>
                                                     <th rowspan="2">क्र.स.</th>
                                                 <th rowspan="2" >सामानको नाम</th>
                                                 <th rowspan="2" >बजेट शिर्षक नं</th>
                                                 <th rowspan="2" >स्पेशिफिकेशन</th>
                                                 <th rowspan="2" >सामानको परिमाण</th>
                                                 <th rowspan="2" >इकाई</th>
                                                 <th colspan="2" style="text-align:center;">मूल्य</th>
                                             </tr>
                                                 <tr>
                                                   <th >प्रति इकाइ दर रु</th>
                                               <th >जम्मा रु</th>
                                              </tr>
                                     <?php $sn=1; foreach ($data_2 as $list):
                                         $sql="select * from kharid_adesh_item_details where adesh_id='".$id."' and item_id='".$list->item_id."' and category='".$list->category."' limit 1";
                                         $items_result= KharidAdeshItemDetails::find_by_sql($sql);
                                         $result_item= array_shift($items_result);
                                         $grand_total+=$result_item->total;
                                         ?>
                                     <?php 
                                         $iteminst = getItemInstance($list->category);
                                        $item_selected = $iteminst->find_by_id($list->item_id);
                                        $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                        $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                     ?>
                                            <tr>
                                                   <td><?=$sn?></td>
                                                   <td><?=$item_selected->name?></td>
                                                   <td><?=$budget_selected->name?></td>
                                                   <td><?=$item_selected->specification?></td>
                                                   <td><input type="text" name="qty[]" value="<?=$list->qty?>" id="qty-<?=$sn?>" /></td>
                                                   <td><?=$unit_selected->name?></td>
                                                   <td><input type="text" name="rate[]" value="<?= $result_item->rate ?>" id="rate-<?=$sn?>" /></td>
                                                   <td><input type="text" name="total[]" value="<?= $result_item->total ?>" id="total-<?=$sn?>" class="total" /></td>
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
                                                   <td>कुल जम्मा</td>
                                                   <td><input type="text" value="<?= $grand_total ?>" name="total_amount" id="total_amount" /></td>
                                              </tr>
                                              <!-- <tr>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td>छुट रकम </td>-->
                                              <!--     <td><input type="text" name="discount_amount" id="discount_amount" value="<?=$kharid_adesh_result->discount_amount?>"/></td>-->
                                              <!--</tr>-->
                                              <!--<tr>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td></td>-->
                                              <!--     <td>कुल जम्मा</td>-->
                                              <!--     <td><input type="text" name="net_total_amount" id="net_total_amount" /></td>-->
                                              <!--</tr>-->
                                        </table>
                                        <table class="table table-borderless">
                                             <tr>
                                             <td>फर्मको नाम : 
                                               <select name="enlist_id">
                                                 <option value="">छान्नुहोस</option>
                                                 <?php foreach($enlist_orgs as $enlist_org):?>
                                                 <option <?php if($kharid_adesh_result->enlist_id==$enlist_org->id){echo 'selected="selected"';} ?> value="<?php echo $enlist_org->id;?>"><?php echo $enlist_org->name;?></option>
                                                 <?php endforeach;?>
                                               </select></td>
                                               <td class="myButton1">सामान दाखिला गर्नुपर्ने मिति : <input value="<?= $kharid_adesh_result->entry_date_nepali?>"  type="text" name="entry_date_nepali"  id="nepaliDate1"/>
                                             </td>
                                         </tr>
                                        </table>
                                        <table  class="table table-bordered table-responsive">
                                                     <tr>
                                                         <td class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस"  class="add_more btn " /> </td>
                                                         <!--<td class="myCenter"> <div class="remove_more btn">प्रिन्ट गर्नुहोस</div></td>-->

                                                     </tr>
                                                </table>
                                         <input type="hidden" value="<?= $id ?>" name="update_id">     
                                 </form>
                              
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

