<?php require_once("includes/initialize.php"); 
if(isset($_GET['kharid_id']))
{
    $kharid_id= $_GET['kharid_id'];
   $org_result= Prastabanaadd::find_org($_GET['kharid_id']);
   $kharid_result = Kharid_mag_faram2::find_by_maag_id($kharid_id);
   $date_result = Jinsitippani::find_by_kharid_id_date($kharid_id);
}
$org_count=count($org_result);
if(isset($_POST['submit']))
{
$dataa=  Jinsitippani::find_by_kharid_ids($_POST['kharid_id']);
//print_r($dataa);exit;
foreach($dataa as $data)
{
    $data->delete();
}
$organization_result = Prastabanaadd::find_org($_POST['kharid_id']);
            foreach($organization_result as $org)
                    {
                        
                            for($i=0;$i<count(['rate_tippani-'.$org->organization_id]);$i++)
                            {
                                for($j=0;$j<count($_POST['item_id']);$j++):
                                        $data= new Jinsitippani();
                                        $data->kharid_id             = $_POST['kharid_id'];
                                        $data->category              = $_POST['category'][$j];
                                        $data->item_id               = $_POST['item_id'][$j];
                                        $data->rate_tippani          = $_POST['rate_tippani-'.$org->organization_id][$j];
                                        $data->org_id                = $org->organization_id;
                                        $data->total_rate            = $_POST['total_rate-'.$org->organization_id];
                                        $data->tippani_miti          = $_POST['tippani_miti'];
                                        $data->tippani_miti_english  = DateNepToEng($_POST['tippani_miti']);
                                        $data->save();
                                endfor;
                        }
                        
                    }
       
   
    echo alertBox("थप सफल ","jinsi_tippani_search.php");
}
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>जिन्सी टिप्पणी भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> जिन्सी टिप्पणी भर्नुहोस| <a href="dashboard_jinsitippani.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> जिन्सी टिप्पणी भर्नुहोस	</h2>
                        <div class="userprofiletable">
                            <form method="post">
                             <table class="table table-bordered table-responsive myWidth100">
                                 
                            <tr>
                            	<th rowspan="2" class="myCenter">क्र.स.</th>
                                <th rowspan="2" class="myCenter">सामानको नाम</th>
                                <th rowspan="2" class="myCenter">सामानको परिमाण</th>
                                <th  rowspan="2" class="myCenter">इकाई</th>
                                <th colspan="<?=$org_count?>" class="myCenter">प्रति इकाई दर </th>
<!--                                <th  rowspan="2" class="myCenter">खरिद छनौट फर्म </th>-->
                            </tr>
                            <tr>
                               <?php foreach($org_result as $org):?>
                                <td><?=  Enlist::getName($org->organization_id);?></td>
                                  <?php endforeach;?>
                                
                            </tr>
                            <?php $i=1; foreach($kharid_result as $data):
                                $iteminst = getItemInstance($data->category);
                                $item_selected = $iteminst->find_by_id($data->item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                ?>
                            <tr class="item_row">
                            	<td><?=convertedcit($i)?></td>
                                <td><?=$item_selected->name?></td>
                                  <td><input type="text" name="qty_tippani[]" readonly="true" id="qty_tippani-<?=$i?>" value="<?=$data->qty?>"></td>
                                  <td><?=$unit_selected->name?></td>
                                  <?php $k=1; foreach($org_result as $org):
                                      $rate_result = Jinsitippani::find_by_kharid_id_org_id_item_id_category($kharid_id,$org->organization_id,$data->item_id,$data->category);
                                      ?>
                                    <td><input type="text" name="rate_tippani-<?=$org->organization_id?>[]" class="rate_tippani-<?=$org->organization_id?>"  id="rate_tippani-<?=$i?>-<?=$org->organization_id?>" value="<?=$rate_result->rate_tippani;?>" />
                                  <input type="hidden" name="org_id[]" value="<?=$org->organization_id?>"> </td>
                                  <?php $k++; endforeach;?>
                               <input type="hidden" name="qty_tippani[]" value="<?=$data->qty?>" />
                                <input type="hidden" name="item_id[]" value="<?=$data->item_id?>" />
                                <input type="hidden" name="category[]" value="<?=$data->category?>">
<!--                                <td id="show_org-<?=$i?>"></td>-->
                            </tr> 
                            
                                 <?php $i++; endforeach;?>
                            
                            <tr>
                                <td  colspan="4">जम्मा दर </td>
                                <?php foreach($org_result as $org):
                                    $amount = Jinsitippani::get_sum_by_kharid_id_org_id($kharid_id, $org->organization_id);
                                    ?>
                                <td><input type="text" name="total_rate-<?=$org->organization_id?>" readonly="true" id="total_rate-<?=$org->organization_id?>" value="<?=$amount?>"></td>
                               <?php  endforeach;?>
                               </tr>
                             <tr>
                                <td  colspan="">टिप्पणी मिति  </td>
                                <td><input type="text" name="tippani_miti" id="nepaliDate3" value="<?=$date_result->tippani_miti;?>"></td>
                            </tr>
                            <tr>
                                 <td class="myCenter" colspan="4" style="text-align: center;"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"></div> </td>
                            </tr>
                            <input type="hidden" name="kharid_id" value="<?=$kharid_id?>">
                           
                          </table>
                            </form>
                                    
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

