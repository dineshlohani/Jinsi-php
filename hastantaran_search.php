<?php require_once("includes/initialize.php"); 
  
if(isset($_POST['submit']) || isset($_GET['hastantaran_id']))
{
	$result=  Hastantaransecond::find_by_hastantaran_id($_GET['hastantaran_id']);
        $data=  Hastantaranone::find_by_id($_GET['hastantaran_id']);
        $get_result=Hastantaranone::find_by_id($_GET['hastantaran_id']);
        $office_result = Office::find_by_id($data->office_id);
        $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
        // print_r($get_result);exit;
}
$data_1=Hastantaranone::find_all(); 
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>हस्तान्तरण फाराम खोज्नुहोस</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
                    <h2 class="headinguserprofile">हस्तान्तरण फाराम खोज्नुहोस | <a href="dashboard_hastantaran.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>हस्तान्तरण फाराम खोज्नुहोस	 </h2>
                        <div class="userprofiletable">
                            <form method="get">
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                              <td>हस्तान्तरण फाराम खोज्नुहोस: <input class="fill_height" type="text" name="hastantaran_id"/> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(!isset($_GET['submit']) && !isset($_GET['hastantaran_id'])):?>
                            <table class="table table-bordered td1">
                                                                                             <tr>
                                                                                                 <th>हस्तान्तरण फारम नं </th>
                                                                                                 <th>हस्तान्तरण  मिति</th>
                                                                                                 <th>सामान हस्तानतरण गरिएको कार्यालयको नाम</th>
                                                                                                 <th>ठेगाना</th>
                                                                                                 <th>&nbsp;</th>
                                                                                             
                                                                                            </tr>
                                                                                            <?php foreach($data_1 as $data):
                                                                                                $office_data= Office::find_by_id($data->office_id);
                                                                                                ?>
                                                                                            <tr>
                                                                                                <td><?=convertedcit($data->hastantaran_id)?></td>
                                                                                                <td><?=convertedcit($data->hastantaran_date)?></td>
                                                                                                <td><?=  Office::getName($data->office_id)?></td>
                                                                                                <td><?=$office_data->address?></td>
                                                                                                <td><a class="btn" href="hastantaran_search.php?hastantaran_id=<?=$data->hastantaran_id?>" class="btn">पुरा विवरण हेर्नुहोस </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php endforeach;?>
                                                                                    </table> 
                            <?php endif;?>
                            <?php if(isset($_GET['submit'])|| isset($_GET['hastantaran_id'])):?>
                            <div class="myPrint"><a href="hastantaran_search_print.php?hastantaran_id=<?=$_GET['hastantaran_id'];?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
<div class="mydate"> <b> म.ले.प. फाराम नं :- </b>४८</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5><br>
									<span class=""> हस्तान्तरण फारम नं : <b> <?php echo convertedcit($data->hastantaran_id);?></b></span><br>
									<span class="mydate">आ. ब.  : <?=convertedcit($fiscal->year)?></span><br>
									<span class="mydate"> मिति :<?= convertedcit($data->hastantaran_date)?></span>
									
									<div class="subjectBold letter_subject">हस्तान्तरण फाराम</div>
									<div class="printContent">
                                            <div class="chalanino"><b> श्री, </b> <?php echo Office::getName($data->office_id);?>  </div>
                                            <div style="margin-left:20px;" class="chalanino"><?=$office_result->address?></div>
										        <div class="bankdetails">
                                                    तपशिल बमेजिमका सामानहरु मिति <?php echo convertedcit($data->hastantaran_date);?> को निर्णय अनुसार <?=SITE_NAME?>को  <?php echo Workers::getpost($data->worker_id);?>  पदका श्री  <?php echo Workers::getName($data->worker_id);?>  को हस्ते पठाएको छु ।  सो सामान भण्डार दाखिला गरी बाट ७ दिन भित्र दाखिला प्रतिवेदन पठाईदिनुहुन अनुरोध छ ।									
						

                                                                                </div><div class="myspacer"></div>
										<div class="bankdetails">
										     <table class="table table-bordered myWidth100">
                                                                                    
                                                                                         <tr>
                                                                                              <th class="myCenter">क्र.स.</th>
                                                                                              <th class="myCenter">जिन्सी खाता पाना नं</th>
                                                                                              <th class="myCenter">जिन्सी संकेत नं</th>
                                                                                              <th class="myCenter">सामानको नाम</th>
                                                                                              <th class="myCen">स्पेशिफिकेशन</th>
                                                                                              <th class="myCenter">इकाई</th>
                                                                                              <th class="myCenter">परिमाण</th>
                                                                                              <th class="myCenter">परल मुल्य</th>
                                                                                              <th class="myCenter">प्राप्त मिति</th>
                                                                                              <th class="myCenter">मालसामनको भौतिक अबस्था</th>
                                                                                            </tr>
                                                                                            
                                                                                            <?php $i=1;foreach($result as $data):
                                                                                                $item_result=get_item_stock_details($data->item_id,$data->category);
                                                                                            $stock_data=  ItemStock::find_stock($data->item_id,$data->category,$data->rate);
                                                                                            if($data->category==1)
                                                                                            {
                                                                                                $html="खर्च हुने ";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $html= "खर्च नहुने";
                                                                                            }
                                                                                            ?>
                                                                                            <?php if(!empty($data->current_status))
                                                                                                    {
                                                                                                        $name=  Itemcondition::getName($data->current_status);
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        $name="";
                                                                                                    }
                                                                                              ?>
                                                                                            <tr>
                                                                                                <td><?php echo convertedcit($i++);?></td>
                                                                                              <td><?php echo convertedcit($stock_data->khata_id);?></td>
                                                                                              <td><?php echo $html;?></td>
                                                                                              <td><?php echo convertedcit($item_result['name']);?></td>
                                                                                              <td><?php echo convertedcit($item_result['specification']);?></td>
                                                                                              <td><?php echo convertedcit($item_result['unit']);?></td>
                                                                                              <td><?php echo convertedcit($data->quantity);?></td>
                                                                                              <td><?php echo convertedcit(placeholder(round($data->total_amount,2,PHP_ROUND_HALF_UP)));?></td>
                                                                                              <td><?php echo convertedcit($data->created_date);?></td>
                                                                                              <td><?=$name?></td>
                                                                                            </tr>
                                                                                            <?php endforeach; ?>
                                                                                          </table>

                                                                                        </div>
                                                                                        <div class="bankdetails">
                                                                                            <table class="table table-borderless myWidth100">
                                                                                                <tr>
                                                                                                    <th> फाँटवालाको दस्तखत :	</th>
                                                                                                    <th style="text-align:center"> प्रमाणित गर्ने शाखा प्रमुखको दस्तखत :  </th>
                                                                                                    <th style="text-align:right"> कार्यालय प्रमुखको दस्तखत : </th>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <br>
                                                                                            <br>
                                                                                            <br>
                                                                                        </div>                                                                                  
                                                                                          <div class="bankdetails">								
                                                                                          </div>
                                                                                          <div class="bankdetails">
                                                                                              <center> माथी लेखिए बमोजिमका सामानहरु  <?= Office::getName($get_result->office_id)?>मा दाखिला गर्ने गरी २ प्रति हस्तान्तरण फाराम समेत बुझिलिएँ ।	</center>
                                                                                              <center> <b> सामान बुझिलिनेको : </b></center>
                                                                                             <table class="table table-bordered myWidth100 t_height">
                                                                                                  
                                                                                                  <tr>
                                                                                                    <td>नाम : <?=Workers::getName($get_result->worker_id)?></td>
                                                                                                    <td>दस्तखत :</td>
                                                                                                    </tr>
                                                                                                  <tr>
                                                                                                    <td>पद	: <?=Workers::getpost($get_result->worker_id)?></td>
                                                                                                    <td>मिति: <?= convertedcit($get_result->hastantaran_date)?></td>
                                                                                                    </tr>
                                                                                                  
                                                                                          </table>
                                                                                          </div> 

                                                                                          
                                                                                          <div class="bankdetails myCenter">
                                                                                          <center> <b>सामान बुझिलिने कार्यालयले भर्ने:</b> </center>
                                                                                          <p class="myCenter">माथी लेखिए बमोजिमका सामानहरु <?=SITE_NAME?> मार्फत प्राप्त भएको व्यहोरा  प्रमाणित गर्दछु । </p>
                                                                                          <center> <b> प्रमाणित गर्नेको </b></center>
                                                                                          </div>
                                                                                          <div class="bankdetails">
                                                                                              <!--<center> <b> प्रमाणित गर्नेको : </b></center>-->
                                                                                             <table class="table table-bordered myWidth100 t_height">
                                                                                                 
                                                                                                  <tr>
                                                                                                    <td>नाम :</td>
                                                                                                    <td>दस्तखत :</td>
                                                                                                    </tr>
                                                                                                  <tr>
                                                                                                    <td>पद	:</td>
                                                                                                    <td>मिति:</td>
                                                                                                    </tr>
                                                                                                  
</table>
    <?php endif;?>
</div> 
                       								

</div>
				</div>
                                
                            </div><!-- print page ends -->
                                        
                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>


