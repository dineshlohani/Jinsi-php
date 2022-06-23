<?php require_once("includes/initialize.php"); 
if(isset($_GET['jinsi_lilam_id']))
{
    $approve_result = Jinsililamapprove::find_by_sql("select * from jinsi_lilam_approve where jinsi_lilam_id=".$_GET['jinsi_lilam_id']);
    if(!empty($approve_result))
    {
        echo alertBox("निम्न लिलाम फारम स्वीकृत भै सकेको छ ...","jinsi_lilam_approve.php");
    }
    $lilam_result = Jinsililam::find_by_sql("select * from jinsi_lilam where jinsi_lilam_id=".$_GET['jinsi_lilam_id']);
}
if(isset($_POST['submit']))
{
    for($i=0;$i<count($_POST['stock_id']);$i++)
    {
        $data=new Jinsililamapprove();
        $data->stock_id=$_POST['stock_id'][$i];
         $data->item_id   = $_POST['item_id'][$i];
        $data->category  = $_POST['category'][$i];
        $data->jinsi_lilam_id=$_POST['jinsi_lilam_id'];
        $data->prev_stock=$_POST['prev_stock'][$i];
        $data->rate= $_POST['rate'][$i];
        $data->reduce_stock=$_POST['reduce_stock'][$i];
        $data->stock_entry_date=$_POST['stock_entry_date'][$i];
        $data->current_analysed_rate=$_POST['current_analysed_rate'][$i];
        $data->reason=$_POST['reason'][$i];
        $data->created_date=  $_POST['created_date'];
        $data->created_date_english = DateNepToEng($_POST['created_date']);
        $data->save();
    }
    echo alertBox("थप सफल ", "jinsililam_search.php");
}
$item_type = Itemtype::find_all();
$datas= Enlist::find_all();
$jinsi_lilam_id= Jinsililam::get_max_jinsi_lilam_id() +1;
$jinsi_lilam_result = Jinsililam::find_by_sql("select distinct jinsi_lilam_id from jinsi_lilam");
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>जिन्सी लिलाम फाराम भर्नुहोस</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
            <h2 class="headinguserprofile">जिन्सी लिलाम फाराम भर्नुहोस	| <a href="jinsi_lilam_dashboard.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>जिन्सी लिलाम फाराम भर्नुहोस</h2>
                        <div class="userprofiletable">
                          <div class="myspacer"></div>
                          <?php if(!isset($_GET['submit']) && !isset($_GET['jinsi_lilam_id'])):?>
                            <table class="table table-responsive bordereless search_table">
                                <tr>
                                    <th>जिन्सी लिलाम फाराम नं</th>
                                    <th>लिलाम मिती </th>
                                </tr>
                                <?php foreach($jinsi_lilam_result as $data):
                                    $result=  Jinsililam::find_by_id($data->jinsi_lilam_id);?>
                                <tr>
                                    <td><?=convertedcit($data->jinsi_lilam_id);?></td>
                                    <td><?=convertedcit($result->created_date);?></td>
                                    <td><a href="jinsi_lilam_approve.php?jinsi_lilam_id=<?=$data->jinsi_lilam_id?>" class="btn">खोज्नुहोस</a></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                          <?php if(isset($_GET['submit']) || isset($_GET['jinsi_lilam_id'])):?>
                          <form method="post">
                          <table class="table table-bordered table-responsive myWidth100">
                              <tr>
                                    <td colspan="3">जिन्सी  लिलाम फाराम नं :</td>
                                    <td colspan="5"><input type="text" readonly="true" name="jinsi_lilam_id" value="<?=$_GET['jinsi_lilam_id'];?>"></td>
                                     <td colspan="2">मिती :</td>
                                     <td colspan="5"><input required type="text" readonly="true" name="created_date" id="nepaliDate3"></td>
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
                                 <th class="myCenter">लिलाम गर्ने परिणाम</th>
                                <th class="myCenter">हालको अनुमानित मूल्य</th>
                                <th class="myCenter">जिन्सी लिलामको कारण</th>                                
                            </tr>
                              <?php $i=1;foreach($lilam_result as $data):
                                $stock_result= ItemStock::find_by_sql("select * from item_stock where item_id = $data->item_id and category = $data->category and rate = $data->rate limit 1");
                              $final_stock_result = array_shift($stock_result);
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
                                
                                if($data->category==1)
                                 {
                                     $category= "खर्च हुने";
                                 }
                                 else
                                 {
                                     $category="खर्च नहुने";
                                 } 
                                    $item_stock_data= ItemStock::find_by_item_id_and_category($data->item_id,$data->category);
                                    ?>
                            <tr>
                                <td><?php echo convertedcit($i)?></td>
                                <td><input type="text" readonly="true" name="khata_id[]" value="<?php echo $item_stock_data->khata_id;?>"></td>
                                <td><?php echo $category;?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['specification'];?></td>
                                <td><input type="text" name="stock_entry_date[]" value="<?= $dakhila_date?>"</td>
                                <td><?php echo $total_year;?></td>
                               <td><input type="text" name="prev_stock[]" value="<?=$data->prev_stock?>" readonly="true" id="prev_stock_<?=$i?>"></td>
                                <td><input type="text" name="rate[]"  readonly="true" value="<?=$data->rate?>"></td>
                                <td><?php echo convertedcit($amount);?></td>
                                <td><input type="text" id="reduce_stock_<?=$i?>" name="reduce_stock[]" id="reduce_lilam_stock_<?=$i?>"></td>
                                <td><input type="text" name="current_analysed_rate[]"></td>
                                <td><textarea name="reason[]"></textarea></td>
                                <input type="hidden" name="stock_id[]" id="stock_id_<?=$i?>" value="<?php echo $final_stock_result->id;?>"/>
                                <input type="hidden" name="category[]" value="<?php echo $data->category;?>"/>
                                <input type="hidden" name="item_id[]" value="<?=$data->item_id?>"/>
                            </tr>     
                            <?php $i++;endforeach;?>
                          </table>
                          <table class="table table-bordered">
                          	<tr>
                                    <td  class="myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></a></td>
                                    <!--<td class="myCenter"><a href="" class="btn">प्रिन्ट गर्नुहोस</a></td>-->
                               </tr>
                          </table>
                                   </form>
                          <?php endif;?>
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

