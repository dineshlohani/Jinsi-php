<?php require_once("includes/initialize.php");
if(isset($_POST['submit']))
//error_reporting(-1);  
{
    ini_set('max_input_vars', 3000);
	for($i=0;$i<count($_POST['spent_item_id']);$i++)
        {
            $j=$i+1;
            $data = new Spentmaujadbarsikkharcha();
            $data->prev_stock=$_POST['prev_stock'][$i];
            $data->maujad_id=$_POST['maujad_id'];
            $data->spent_item_id=$_POST['spent_item_id'][$i];
            $data->in_use=$_POST['in_use'][$i];
            $data->not_in_use=$_POST['not_in_use'][$i];
            $data->to_repair=$_POST['to_repair'][$i];
            $data->not_to_repair=$_POST['not_to_repair'][$i];
            $data->remarks=$_POST['remarks'][$i];
            $data->created_date_english=  DateNepToEng($_POST['created_date']);
            $data->created_date= $_POST['created_date'];
            $data->save();
            echo $data->save();
            
        }

    echo alertBox("थप सफल...!!","jinsimaujad_barsikkharcha.php"); 	
    //exit;
    
}
  $item_type = ItemStock::find_by_sql("select * from item_stock where category=1 order by item_id Asc");
  //echo $item_tye;
  $maujad_id=  Spentmaujadbarsikkharcha::get_max_maujad_id() +1;
    //echo $maujad_id;
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण :: <?php echo SITE_SUBHEADING;?></title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण भर्नुहोस / <a class="btn" href="dashboard_jinsinmaujadbibaran.php">पछाडी  जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2>खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण</h2>
                        <div class="userprofiletable">
                        	
                                         <div class="myPrint"><a href="#">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
<div class="mydate">म.ले.प. फाराम नं : ५७</div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर जाने जिन्सी मौज्जादको वार्षिक विवरण</div>
									<div class="printContent">
										<div class="chalanino">आर्थिक वर्ष : </div>
										
										<div class="bankdetails">
                                                                                    <form method="post">
										   <div class="chalanino inline_block">जिन्सी मौज्जाद फाराम नं : <input class="width10p" type="text" readonly="true" name="maujad_id" value="<?=$maujad_id?>"> </div>
                                                                                   <div class="mydate">जिन्सी मौज्जाद मुल्यांकन मिति : <input style="width:39% !important" class="right_side_date" type="text" readonly="true" name="created_date" id="nepaliDate3" required> </div>
										
                                                                               
                                                                                        <table  class="table table-bordered table-responsive td1 td2">
                                                   
                                                  <tr>
                                                    <th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी नं/खाता पाना नं</th>
                                                    <th rowspan="2" class="myCenter"> जिन्सी वर्गिकरण संकेत नं</th>
                                                    <th rowspan="2" class="myCenter">जिन्सी सामानको नाम</th>
                                                    <th colspan="4" class="myCenter">मौज्जाद बाँकी</th>
                                                    <th colspan="4" class="myCenter">जिन्सी सामानको भौतिक अवस्था</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                  </tr>
                                                  <tr>
                                                    <th class="myCenter">परिमाण</th>
                                                    <th class="myCenter">इकाई</th>
                                                    <th class="myCenter">दर</th>
                                                    <th class="myCenter">जम्मा मुल्य</th>
                                                    <th class="myCenter">प्रयोगमा रहेको</th>
                                                    <th class="myCenter">प्रयोगमा नरहेको</th>
                                                    <th class="myCenter">मर्मत गर्नुपर्ने</th>
                                                    <th class="myCenter">मर्मत हुन नसक्ने</th>
                                                  </tr>
                                                  <tr>
                                                   <th class="myCenter">१</th>
                                                    <th class="myCenter">२</th>
                                                    <th class="myCenter">३</th>
                                                    <th class="myCenter">४</th>
                                                    <th class="myCenter">५</th>
                                                    <th class="myCenter">६</th>
                                                    <th class="myCenter">७</th>
                                                    <th class="myCenter">८</th>
                                                    <th class="myCenter">९</th>
                                                    <th class="myCenter">१०</th>
                                                    <th class="myCenter">११</th>
                                                    <th class="myCenter">१२</th>
                                                    <th class="myCenter">१३</th>
                                                  </tr>
                                                  <?php $i=1;foreach ($item_type as $data):
                                                      if($data->stock==0)
                                                      {
                                                          continue;
                                                      }
                                                        $spent_data=  Spentitem::find_by_id($data->item_id); 
                                                        //print_r($spent_data);
                                                  $total_amount=$data->stock * $data->rate;
                                                  //echo $total_amount;
                                                  ?>
                                                  <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($data->item_id);?></td>
                                                    <td><?php echo convertedcit($spent_data->budget_title_id);?></td>
                                                    <td><?php echo $spent_data->name;?></td>
                                                    <td><input class="none_input myCenter" type="text" name="prev_stock[]" id="prevstock_<?= $data->id ?>"  readonly="true" value="<?php echo $data->stock+0;?>"</td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($data->rate+0);?></td>
                                                    <td><?php echo convertedcit($total_amount);?></td>
                                                    <td><input class="" type="text" id="inuse_<?=$data->id?>"  name="in_use[]"></td>
                                                    <td><input class="" readonly="true" type="text" id="notinuse_<?=$data->id?>" name="not_in_use[]"></td>
                                                    <td><input class="" type="text" id="torepair_<?=$data->id?>" name="to_repair[]"></td>
                                                    <td><input class="" readonly="true" type="text" id="nottorepair_<?=$data->id?>" name="not_to_repair[]"></td>
                                                    <td><input class="" type="text" name="remarks[]"></td>
                                                  </tr>
                                                     <input type="hidden" name="spent_item_id[]" value="<?php echo $data->id;?>"/>
                                                  <?php $i++;endforeach;?>
                                                  
                                                </table>
                                                <input type="submit" value="सेभ गर्नुहोस" name="submit" class="btn mydate search_btn"/>
                                        </form>
                                             

										</div>

										
										<div class="myspacer"></div>
									</div>
                                
                            </div><!-- print page ends -->
                              
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

