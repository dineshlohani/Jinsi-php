<?php require_once("includes/initialize.php"); 
if(isset($_GET['submit']) || isset($_GET['jinsi_minha_id']))
{
        $minha_final = Jinsiminhafinal::find_by_jinsi_minha_id($_GET['jinsi_minha_id']);
        if(!empty($minha_final))
        {
            echo alertBox("निम्न जिन्सी मिन्हा फारम नं भरि सकेको छ ...","jinsi_minha_final.php");
        }
	$jinsi_minha_result=  Jinsiminhaapprove::find_by_jinsi_minha_id($_GET['jinsi_minha_id']);
        $jinsi_minha_id=$_GET['jinsi_minha_id'];
}
if(isset($_POST['submit']))
{
//     echo "<pre>";print_r($_POST);echo "</pre>";exit;
    for($i=0;$i<count($_POST['stock_id']);$i++)
    {
        
        $data=new Jinsiminhafinal();
        $data->stock_id  = $_POST['stock_id'][$i];
        $data->item_id   = $_POST['item_id'][$i];
        $data->category  = $_POST['category'][$i];
        $data->jinsi_minha_id=$_POST['jinsi_minha_id'];
        $data->reduce_stock=$_POST['reduce_stock'][$i];
        $data->prev_stock=$_POST['prev_stock'][$i];
        $data->rate= $_POST['rate'][$i];
        $data->current_analysed_rate= $_POST['current_analysed_rate'][$i];
        $data->stock_entry_date=$_POST['stock_entry_date'][$i];
        $data->created_date=  DateEngToNep(date("Y-m-d",time()));
        $data->created_date_english = DateNepToEng($_POST['created_date']);
          $data->actual_reduced_stock = $_POST['actual_reduced_stock'][$i];
        $data->reason=$_POST['reason'][$i];
        if($data->save())
        {
            $stock_data=  ItemStock::find_by_id($_POST['stock_id'][$i]);
            $net_stock = $stock_data->stock - $_POST['actual_reduced_stock'][$i];
            $stock_data->stock=$net_stock;
            $stock_data->save();
        }
        
    }
    echo alertBox("थप सफल ", "jinsi_minha_final.php");
}
$item_type = Itemtype::find_all();

$lilam_result = Jinsiminhaapprove::find_by_sql("select distinct jinsi_minha_id from jinsi_minha_approve");
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>जिन्सी मिन्हा फाराम भर्नुहोस</title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
            <h2 class="headinguserprofile">जिन्सी  मिन्हा फाराम भर्नुहोस | <a href="jinsi_minha_dashboard.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>जिन्सी  मिन्हा फाराम भर्नुहोस</h2>
                        <div class="userprofiletable">
                          <div class="myspacer"></div>
                           <form method="get">
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                              <td>जिन्सी निर्सग / मिन्हा फाराम	खोज्नुहोस:  <input class="fill_height" type="text" name="jinsi_minha_id"/> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                          <?php if(!isset($_GET['submit']) && !isset($_GET['jinsi_minha_id'])):?>
                            <table class="table table-responsive bordereless search_table">
                                <tr>
                                    <th>जिन्सी मिन्हा  फाराम नं</th>
                                    <th>जिन्सी मिन्हा मिती </th>
                                </tr>
                                <?php foreach($lilam_result as $data):
                                    $result= Jinsiminhaapprove::find_by_jinsi_minha_ids($data->jinsi_minha_id);?>
                                <tr>
                                    <td><?=convertedcit($data->jinsi_minha_id);?></td>
                                    <td><?=convertedcit($result->created_date);?></td>
                                    <td><a href="jinsi_minha_final.php?jinsi_minha_id=<?=$data->jinsi_minha_id?>" class="btn">खोज्नुहोस</a></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                            <?php if(isset($_GET['submit']) || isset($_GET['jinsi_minha_id'])):?>
                          <form method="post">
                          <table class="table table-bordered table-responsive myWidth100">
                                <tr>
                                    <td colspan="3">जिन्सी  मिन्हा फाराम नं :</td>
                                    <td colspan="4"><input type="text" readonly="true" name="jinsi_minha_id" value="<?=$jinsi_minha_id;?>"></td>
                              <td colspan="2">जिन्सी  मिन्हा मिती :</td>
                                    <td colspan="5"><input type="text" readonly="true" name="created_date" id="nepaliDate3"></td>
                                
                                </tr>
                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">जिन्सी खाता पाना नं</th>
                                <th class="myCenter">जिन्सी बर्गीकरण संकेत नं</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">स्पेशिफिकेशन</th>
                                <th class="myCenter">शुरु प्राप्त मिति</th>
                                <th class="myCenter">प्रयोग भएको वर्ष</th>
                                <th class="myCenter">परिमाण</th>
                                <th class="myCenter">दर</th>
                                <th class="myCenter">परल मूल्य</th>
                                <th class="myCenter">घट्ने परिणाम</th>
                                <th class="myCenter">हालको अनुमानित मूल्य</th>
                                <th class="myCenter">जिन्सी  मिन्हा भएको परिणाम </th>                                
                            </tr>
                            <?php $i=1;foreach($jinsi_minha_result as $data):
                              
                                $stock_result= ItemStock::find_by_sql("select * from item_stock where item_id = $data->item_id and category = $data->category and rate = $data->rate limit 1");
                              $final_stock_result = array_shift($stock_result);
//                              print_r($final_stock_result);exit;
                              $result=get_item_stock_details($data->item_id,$data->category);
                                 $amount=$data->prev_stock * $data->rate; 
                                 $dakhila_id =  DakhilaItemDetails::find_by_item_id_rate_category_of_max_dakhila($data->item_id,$data->category,$data->rate);
                                    if(empty($dakhila_id))
                                    {
                                        $dakhila_result=  ItemStock::find_stock($data->item_id,$data->category,$data->rate);
                                        $dakhila_date = $dakhila_result->stock_date;
                                        $total_year=calculate_total_days_year($dakhila_date);
                                    }
                                    else
                                     {
                                        $dakhila_profile_result =  Dakhilaprofile::find_by_id($dakhila_id);
                                        $dakhila_date = $dakhila_profile_result->date_nepali;
                                        $total_year=calculate_total_days_year($dakhila_date);
//                                        echo $total_year;exit;
                                    }
                                 ?>
                            <tr>
                                <td><?php echo convertedcit($i)?></td>
                                <td><input type="text" readonly="true" name="khata_id[]" value="<?php echo $final_stock_result->khata_id;?>"></td>
                                <td><?php echo convertedcit($result['budget_title_id']);?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['specification'];?></td>
                                <td><input type="text" name="stock_entry_date[]" value="<?= $dakhila_date?>"</td>
                                <td><?php echo $total_year;?></td>
                                <td><input type="text" name="prev_stock[]" value="<?=$data->prev_stock?>" readonly="true" id="prev_stock_<?=$i?>"></td>
                                <td><input type="text" name="rate[]"  readonly="true" value="<?=$data->rate?>"></td>
                                <td><?php echo convertedcit($amount);?></td>
                                <td><input type="text" name="reduce_stock[]" id="reduce_lilam_stock_<?=$i?>" value="<?=$data->reduce_stock?>" readonly="true"></td>
                                <td><input type="text" name="current_analysed_rate[]" value="<?=$data->current_analysed_rate?>" readonly="true"></td>
                                <td><input name="actual_reduced_stock[]" type="text" id="actual_reduced_stock_<?=$i?>"></td>
                                <input type="hidden" name="stock_id[]" value="<?php echo $final_stock_result->id;?>"/>
                                <input type="hidden" name="category[]" value="<?php echo $data->category;?>"/>
                                <input type="hidden" name="item_id[]" value="<?=$data->item_id?>"/>
                                <input type="hidden" name="reason[]" value="<?=$data->reason?>"></textarea>
                            </tr>     
                            <?php $i++; endforeach;?>
                          </table>
                          <table class="table table-bordered">
                          	<tr>
                                    <td  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn" onclick="confirm('के तपाई निश्चित हुनुहुन्छ....यस बाट STOCK घट्ने छ..');"></a></td>
<!--                                    <td class="myCenter"><a href="" class="btn">प्रिन्ट गर्नुहोस</a></td>-->
                               </tr>
                          </table>
                             
                         </form>
                          <?php endif;?>
                            </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

