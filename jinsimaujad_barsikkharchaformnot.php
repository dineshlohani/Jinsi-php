<?php require_once("includes/initialize.php"); 
  
if(isset($_GET['submit']) || isset($_GET['maujad_id']))
{

	
     if(empty($_GET['maujad_id']) && !is_numeric($_GET['maujad_id']))
    {
        echo alertBox("कृपया अंक हालेर खोज्नुहोला", "jinsimaujad_barsikkharchaformnot.php");
    }
    else
    {
    $maujad_id=$_GET['maujad_id'];
    $result= Notspentmaujadbarsikkharcha::find_by_maujad_id($_GET['maujad_id']);
    }
if(empty($result))
      {
          echo alertBox("निम्न जिन्सी मौज्जाद फाराम नं भेटिएन...","jinsimaujad_barsikkharchaformnot.php" );
      }
//      print_r($result);exit;
        
}
else
{
    $result= Notspentmaujadbarsikkharcha::find_by_sql("select distinct maujad_id from spent_maujad_barsik_kharcha");
}
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण फाराम भर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण फाराम भर्नुहोस / <a href="dashboard_jinsinmaujadbibarannot.php">पछाडी  जानुहोस </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण फाराम भर्नुहोस</h2>
                        <form method="get">
                             <table  class="table table-responsive bordereless left_margin search_table">
                                                   <tr>
                                                        <td >जिन्सी मौज्जाद फाराम नं : <input type="text"  name="maujad_id" > <input type="submit" value="खोज्नुहोस" name="submit" class="btn search_btn"/></td>
                                                        
                                                   </tr>
                            </table>
                        </form>
                         <?php if(!isset($_GET['submit']) && !isset($_GET['maujad_id'])):
                            ?>
                            <table class="table table-bordered">
                                                 <tr>
                                                     <th>जिन्सी मौज्जाद फाराम नं :</th>
                                                     <th>मौज्जाद मुल्यांकन मिति</th>
                                                     <th>पुरा विवरण </th>
                                                </tr>
                                                <?php foreach($result as $data):
                                                    $maujad_result = Notspentmaujadbarsikkharcha::find_by_maujad_ids($data->maujad_id);
//                                                                                                print_r($data);
                                                ?>
                                                <tr>
                                                    <td><?=convertedcit($data->maujad_id)?></td>
                                                    <td><?=convertedcit($maujad_result->created_date)?></td>
                                                    <td><a href="jinsimaujad_barsikkharchaformnot.php?maujad_id=<?=$data->maujad_id?>" class="btn">पुरा विवरण हेर्नुहोस </a></td>
                                                </tr>
                                                <?php endforeach;?>
                                        </table>  
                        <?php endif;?>
                        <?php if(isset($_GET['submit']) || isset($_GET['maujad_id'])):
                            $maujad_date_result = Notspentmaujadbarsikkharcha::find_by_maujad_ids($_GET['maujad_id']);?>
                        <div class="userprofiletable">
                        	
                            <div class="myPrint"><a href="jinsimaujad_barsikkharchaformnot_print.php?maujad_id=<?php echo $maujad_id;?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
<div class="mydate"><b> म.ले.प. फाराम नं :- </b> ५७</div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण फाराम भर्नुहोस</div>
									<div class="printContent">
										<div class="chalanino"><b> आर्थिक वर्ष :- </b> </div>
                                        <div class="chalanino"><b> मौज्जादमा रहेका खर्च भएर नजाने जिन्सी सामान :- </b> </div>
										
                                                                               
										<div class="bankdetails">
                                         <span> <b> जिन्सी मौज्जाद फाराम नं :-  <?php echo convertedcit($maujad_id);?> </b></span>
                                         <div class="chalanino"><b>जिन्सी मौज्जाद मुल्यांकन मिति :  <?=  convertedcit($maujad_date_result->created_date)?></b></div>
										
										     <table  class="table table-bordered table-responsive">
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
                                                  <?php $i=1; foreach($result as $data):
                                                      $item_result=  ItemStock::find_by_id($data->spent_item_id);
                                                      $spent_data=  Notspentitem::find_by_id($item_result->item_id); 
                                                    if(!empty($data))
                                                    {
                                                        $stock = $data->prev_stock;
                                                        $rate=$item_result->rate;
                                                        $amount=$stock * $rate;
                                                    }
                                                    else
                                                    {
                                                        $stock="";
                                                        $rate="";
                                                        $amount="";
                                                    } 
                                                    
                                                    
                                                      ?>
                                                  <tr>
                                                    <td><?php echo convertedcit($i);?></td>
                                                    <td><?php echo convertedcit($spent_data->id); ?></td>
                                                    <td><?php echo convertedcit($spent_data->budget_title_id); ?></td>
                                                    <td><?php echo $spent_data->name;?></td>
                                                     <td><?php echo convertedcit($data->prev_stock);?></td>
                                                    <td><?php echo Unit::getName($spent_data->unit_id);?></td>
                                                    <td><?php echo convertedcit($item_result->rate);?></td>
                                                   <td><?php echo convertedcit(placeholder($amount));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->in_use));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->not_in_use));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->to_repair));?></td>
                                                    <td><?php echo convertedcit($data->not_to_repair); ?></td>
                                                    <td><?php echo $data->remarks;?></td>
                                                  </tr>
                                                  <?php $i++; endforeach;?>
                                                </table>

                                             

										</div>
<div class="banktextdetails">
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :-</td>
	  <td></td>
	  <td>मिति :-</td>
	  <td></td>
      <td>मिति :- </td>
	  <td></td>
  </tr>
</table>
</div> 
										
										<div class="myspacer"></div><?php endif;?>
									</div>
                                
                            </div><!-- print page ends -->
                                        

                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

