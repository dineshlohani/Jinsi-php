<?php require_once("includes/initialize.php"); 
  $kharid_id='';
  $org_result='';
  
if(isset($_POST['search']))
{
        $kharid_id=$_POST['kharid_id'];
        $resultt= Jinsitippani::find_by_sql("select distinct item_id  from jinsi_tippani where kharid_id=".$kharid_id);
     
        $adesh_result= TippaniAdesh::find_by_kharid_ids($kharid_id);
//        print_r($result);exit;
        if(empty($resultt))
        {
            echo alertBox("निम्न खरिद माग फारम नं को टिप्पणी पेस भएको छैन....", "approve_jinsi_tippani.php");
        }
       if(!empty($adesh_result))
       {
             echo alertBox("निम्न खरिद माग फारम नं को टिप्पणी आदेश पेस भैसकेको छ ....", "approve_jinsi_tippani.php");
       }
          

   $org_result= Prastabanaadd::find_org($_POST['kharid_id']);
//   print_r($org_result);exit;
   $org_results=  Jinsitippani::find_org($_POST['kharid_id']);
   $org_counts=count($org_results);
    $kharcha_item_ids = Jinsitippani::get_item_id_by_category_kharid_id_org_id(1,$_POST['kharid_id'],$org_results[0]->org_id);
    $khapne_item_ids = Jinsitippani::get_item_id_by_category_kharid_id_org_id(2,$_POST['kharid_id'],$org_results[0]->org_id);
    
}
$org_count=count($org_result);
if(isset($_POST['submit']))
{
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";exit;
       
                              for($j=0;$j<count($_POST['item_id']);$j++):
                                        $data= new TippaniAdesh();
                                        $data->kharid_id             = $_POST['kharid_id'][$j];
                                        $data->category              = $_POST['category'][$j];
                                        $data->item_id               = $_POST['item_id'][$j];
                                        $data->rate_tippani          = $_POST['rate_tippani'][$j];
                                        $data->org_id                = $_POST['orgs_id'][$j];
                                        $data->save();
                                endfor;
                        
                  
       
   
    echo alertBox("थप सफल ","approve_jinsi_tippani.php");
}
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>जिन्सी टिप्पणी भर्नुहोस</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> जिन्सी टिप्पणी आदेश  भर्नुहोस| <a href="dashboard_jinsitippani.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> जिन्सी टिप्पणी आदेश भर्नुहोस	</h2>
                        <div class="userprofiletable">
                            
                            <form method="post">
                          <table class="table table-responsive bordereless search_table">
                              <tr>
                                  <td class="myWidth50">
                                  खरिद माग फाराम नं	:
                                  <input class="fill_height" type="text" name="kharid_id" id="jinsi_kharid_id" value="<?=$kharid_id?>">
                                  <input type="submit" name="search" value="खोज्नुहोस" class="btn search_btn">
                                  </td>
                                  
                              </tr>
                              
                          </table>
                                
                        </form>
                          <?php if(isset($_POST['search'])):
                            ?>
                             <table class="table table-bordered table-responsive myWidth100 td1">
                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">परिणाम</th>
                                  <th class="myCenter">इकाई</th>
                                <?php foreach($org_results as $data):
                                    $enlist_result=  Enlist::find_by_id($data->org_id);
                                    ?>
                                <th class="myCenter"><?=$enlist_result->name?></th>
                                <?php endforeach;?>
                                                              
                            </tr>
                           <?php $i=1; foreach($kharcha_item_ids as $kharcha_item_id):
                                $iteminst = getItemInstance(1);
                                $item_selected = $iteminst->find_by_id($kharcha_item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                $row_data = Jinsitippani::find_by_kharid_id_item_id_category($kharid_id,$kharcha_item_id,1);
                                $quantity_selected= Kharid_mag_faram2::find_by_maag_id_item_id_category($_POST['kharid_id'],$kharcha_item_id,1);
                                ?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td><?=convertedcit($quantity_selected->qty)?></td>
                                 <td><?=$unit_selected->name?></td>
                               <?php foreach($org_results as $result):?>
                                <?php $data = Jinsitippani::find_by_kharid_id_org_id_item_id_category($kharid_id,$result->org_id,$kharcha_item_id,1); ?>
                                <td><?php echo convertedcit($data->rate_tippani);?></td>
                                 <?php endforeach;?>
                                
                            </tr> 
                            <?php $i++;endforeach;?>
                            <?php $i=1; foreach($khapne_item_ids as $khapne_item_id):
                                $iteminst = getItemInstance(2);
                                $item_selected = $iteminst->find_by_id($khapne_item_id);
                                 $unit_selected = Unit::find_by_id($item_selected->unit_id);
                            $row_data = Jinsitippani::find_by_kharid_id_item_id_category($kharid_id,$khapne_item_id,2);
                            $quantity_selected= Kharid_mag_faram2::find_by_maag_id_item_id_category($_POST['kharid_id'],$khapne_item_id,2);
?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                               <td><?=$item_selected->name?></td>
                                <td><?=convertedcit($quantity_selected->qty)?></td>
                                 <td><?=$unit_selected->name?></td>
                               <?php foreach($org_results as $result):?>
                                <?php $data = Jinsitippani::find_by_kharid_id_org_id_item_id_category($kharid_id,$result->org_id,$khapne_item_id,2); ?>
                                <td><?php echo convertedcit($data->rate_tippani);?></td>
                                 <?php endforeach;?>
                                
                            </tr> 
                            <?php $i++;endforeach;?>
                          
                          </table>
                            <form method="post">
                             <table class="table table-bordered table-responsive myWidth100">
                                 
                            <tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th  class="myCenter">सामानको नाम</th>
                                <th  class="myCenter">सामानको परिमाण</th>
                                <th  class="myCenter">इकाई</th>
                                <th  class="myCenter" >फर्म छान्नुहोस्</th>
                                 <th class="myCenter" >प्रति इकाई दर</th>
                            </tr>
                            <?php $i=1; foreach($resultt as $dataa):
//     print_r($dataa);exit;
                                $datas = Jinsitippani::find_by_sql("select category from jinsi_tippani where item_id='".$dataa->item_id."' and kharid_id=".$kharid_id);
                                $data= array_shift($datas);
                                $iteminst = getItemInstance($data->category);
                                $item_selected = $iteminst->find_by_id($dataa->item_id);
                                $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                $kharid_item = Kharid_mag_faram2::find_by_maag_id_item_id_category($kharid_id,$dataa->item_id,$data->category);
                                ?>
                            <tr>
                            	<td><?=convertedcit($i)?></td>
                                <td><?=$item_selected->name?></td>
                                  <td><input type="text" name="qty_tippani[]" readonly="true" value="<?=$kharid_item->qty?>"></td>
                                  <td><?=$unit_selected->name?></td>
                                  <td>
                                      <select name="orgs_id[]" id="tippani_org-<?=$i?>">
                                          <option value="">------</option>
                                     <?php foreach($org_result as $org):?>
                                          <option value="<?=$org->organization_id?>"><?=  Enlist::getName($org->organization_id)?></option>
                                     <?php endforeach;?>
                                      </select>
                                  </td>
                                  <td id="tippani_rate-<?=$i?>"></td>
                                  
                                <input type="hidden" name="item_id[]" id="item_id-<?=$i?>" value="<?=$dataa->item_id?>" />
                                <input type="hidden" name="category[]"  id="category-<?=$i?>" value="<?=$data->category?>"/>
                                <input type="hidden" name="kharid_id[]" id="kharid_id-<?=$i?>" value ="<?=$kharid_id?>"/>
                            </tr> 
                            <?php $i++; endforeach;?>
                             <tr>
                                 <td class="myCenter" colspan="4" style="text-align: center;"><input type="submit" name="submit" value=" सेभ गर्नुहोस" class="btn"></div> </td>
                            </tr>
                            </table>
                            </form>
                                    <?php endif;?>      
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

