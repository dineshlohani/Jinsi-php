<?php require_once("includes/initialize.php"); 
  
if(isset($_POST['search']))
{
// $item_id=$_POST['item_id'];
    $item_stock_result =  ItemStock::find_by_sql("select * from item_stock where category=".$_POST['category']);
// print_r($item_stock_result);exit;find_item_stock($item_id,$_POST['category']);
}
if(isset($_POST['submit']))
{
//    echo "<pre>";print_r($_POST);echo "</pre>";exit;
    for($i=0;$i<count($_POST['item_check']);$i++)
    {
        
                $data=new Jinsiminha();
                $data->stock_id  = $_POST['stock_id'][$_POST['item_check'][$i]];
                $data->item_id   = $_POST['item_id'][$_POST['item_check'][$i]];
                $data->category  = $_POST['category'][$_POST['item_check'][$i]];
                $data->jinsi_minha_id=$_POST['jinsi_minha_id'];
        //        $data->reduce_stock=$_POST['reduce_stock'][$i];
                $data->prev_stock=$_POST['prev_stock'][$_POST['item_check'][$i]];
                $data->rate= $_POST['rate'][$_POST['item_check'][$i]];
        //        $data->current_analysed_rate= $_POST['current_analysed_rate'][$i];
                $data->stock_entry_date=$_POST['stock_entry_date'][$_POST['item_check'][$i]];
                $data->created_date =  $_POST['created_date'];
                $data->created_date_english = DateNepToEng($_POST['created_date']);
        //        $data->reason=$_POST['reason'][$i];
                $data->save();
        
    }
    echo alertBox("थप सफल ", "jinsiminha_newAdd.php");
}
$item_type = Itemtype::find_all();
$jinsi_minha_id=  Jinsiminha::get_max_jinsi_minha_id() +1;
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
                            <form method="post" >
                          <table class="table borderless table-responsive">
                          	<tr>
                            	<td> सामानको प्रकार</td>
                                <td>
                                    <select name="category" id="category">
                                        <option valu="">------</option>
                                        <option value="1">खर्च हुने </option>
                                        <option value="2">खर्च नहुने </option>
                                    </select>
                                </td>
                                 </tr>
<!--                                 <tbody id="item_name"></tbody>-->
                                 <tr>
                                    <td  class="myCenter"><input type="submit" name="search" value="खोज्नुहोस" class="btn"></a></td>
                                    
                               </tr>
                          </table>  
                            </form>
                            
                          <div class="myspacer"></div>
                          <?php if(isset($_POST['search'])):?>
                         <form method="post">
                          <table class="table table-bordered table-responsive myWidth100">
                                <tr>
                                    <td colspan="3">जिन्सी  मिन्हा फाराम नं :</td>
                                    <td colspan="5"><input type="text" readonly="true" name="jinsi_minha_id" value="<?=$jinsi_minha_id;?>"></td>
                              <td colspan="2">जिन्सी  मिन्हा मिती :</td>
                              <td colspan="5"><input type="text" readonly="true" name="created_date" id="nepaliDate3" required></td>
                                
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
                                <th class="myCenter">छान्नुहोस्</th>
                                                         
                            </tr>
                            <?php $i=1;foreach($item_stock_result as $data):
                              
                                $stock_result= ItemStock::find_by_sql("select * from item_stock where item_id = $data->id and category = $data->category and rate = $data->rate limit 1");
                              $final_stock_result = array_shift($stock_result);
//                              print_r($final_stock_result);exit;
                              $result=get_item_stock_details($data->item_id,$data->category);
                                 $amount=$data->stock * $data->rate; 
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
                                    if($data->stock==0 || $data->stock=="")
                                    {
                                        continue;
                                    }
                                         if($data->category==1)
                                    {
                                        $category = "५२ / खर्च हुने ";
                                    }
                                    else
                                    {
                                        $category = "४७ / खर्च नहुने ";
                                    }
                                 ?>
                            <tr>
                                <td><?php echo convertedcit($i)?></td>
                                <td><input type="text" readonly="true" name="khata_id[]" value="<?php echo $data->khata_id;?>"></td>
                               <td><?php echo $category;?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['specification'];?></td>
                                <td><input type="text" name="stock_entry_date[]" value="<?= $dakhila_date?>"</td>
                                <td><?php echo $total_year;?></td>
                                <td><input type="text" name="prev_stock[]" value="<?=$data->stock?>" readonly="true"></td>
                                <td><input type="text" name="rate[]"  readonly="true" value="<?=$data->rate?>"></td>
                                <td><?php echo convertedcit($amount);?></td>
                                <td><input type="checkbox" name="item_check[]" value="<?=$i?>"></td>
                                <input type="hidden" name="stock_id[]" value="<?php echo $final_stock_result->id;?>"/>
                                <input type="hidden" name="category[]" value="<?php echo $data->category;?>"/>
                                <input type="hidden" name="item_id[]" value="<?=$data->item_id?>"/>
                            </tr>     
                            <?php $i++; endforeach;?>
                          </table>
                          <table class="table table-bordered">
                          	<tr>
                                    <td  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></a></td>
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

