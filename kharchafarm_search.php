<?php require_once("includes/initialize.php"); 
    $maag_id = '';
    $print_url = '#';
    if(isset($_GET['maag_id']))
    {

                    $maag_id = (int) $_GET['maag_id'];
                    $data_1 = Kharcha_mag_faram1::find_by_id($maag_id);
                    if(!empty($data_1)): 
                    $print_url = generatePrintUrl();
                    $dep_selected = Department::find_by_id($data_1->department_id);
                    $fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
                    $data_2 = Kharcha_mag_faram2::find_by_maag_id($maag_id);
                    endif;

    }
     else
    {
         $sql_one ="select * from kharcha_mag_faram_1 order by id desc";
        $data_1=Kharcha_mag_faram1::find_by_sql($sql_one);
    }
      $item_type = Itemtype::find_all();
      $deps = Department::find_all();
    ?>   <?php include("menuincludes/header.php"); ?>

<title>खर्च माग फारम खोज्नुहोस:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च माग फाराम खोज्नुहोस <a href="dashboard_kharcha.php" class="btn">पछी जानुहोस</a></h2>
                    
                    <div class="OurContentFull">
                    	<!--<h2>खर्च माग फारम खोज्नुहोस	 </h2>-->
                        <div class="userprofiletable">
                            <form method="get" >
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                              <td>एकीकृत खर्च माग फारम खोज्नुहोस: <input class="fill_height" type="text" name="maag_id" value="<?=$maag_id?>" /> <input type="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(isset($_GET['maag_id'])){// show if maag_id is selected ?>
                                <?php if(!empty($data_1)){ ?>
                                
                            <div class="myPrint"><a href="<?=$print_url?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
                                   
									<div class="printlogo"><img src="images/janani.png" alt="Logo"></div>
                                    <div class="mydate">म.ले.प. फाराम नं: ५१</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">माग फाराम</div>
									<div class="printContent">
										<div class="chalanino">श्री प्रमुख : </div>
										<div class="patrano">भण्डार शाखा :</div>
										<div class="chalanino">निकासी नं : <?= convertedcit($_GET['maag_id']) ?></div>
										
                                                                                    <div class="mydate in_block">आर्थिक वर्ष :<?php echo convertedcit($fiscal_selected->year); ?></div><br>
                                                                                    <div class="mydate in_block"> मिति : <?= convertedcit($data_1->maag_date) ?> </div>
                                                                                    
                                                                                
										<div class="banktextdetails">
										     <table class="table table-bordered">
	                                                                                 <tr>
    	                                                                                     <th>क्र.स.</th>
                                                                                             <th>सामानको नाम</th>
                                                                                             <th>स्पेशिफिकेशन</th>
                                                                                             <th>सामानको परिमाण</th>
                                                                                             <th>इकाई</th>
                                                                                             <th>निकासी सामानको परिमाण</th>
                                                                                             <th>जिन्सी खाता पाना नं</th>
                                                                                             <th>कैफियत</th>
                                                                                          </tr>
                                                                                          <tr>
                                                                                            <th>१</th>
                                                                                            <th>२</th>
                                                                                            <th>३</th>
                                                                                            <th>४</th>
                                                                                            <th>५</th>
                                                                                            <th>६</th>
                                                                                            <th>७</th>
                                                                                            <th>८</th>
                                                                                        </tr>
                                                                                        <?php $sn=1; foreach ($data_2 as $list): 
                                                                                        
                                                                                        ?>
                                                                                        
                                                                                            <?php 
                                                                                                $iteminst = getItemInstance($list->category);
                                                                                               $item_selected = $iteminst->find_by_id($list->item_id);
                                                                                               $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                                                                               $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                                                                                 $stock = ItemStock::find_by_item_id_and_category($item_selected->id,1);
                                                                                            ?>
                                                                                        <tr>
                                                                                            <td><?=convertedcit($sn)?></td>
                                                                                            <td><?=$item_selected->name?></td>
                                                                                            <td><?=$item_selected->specification?></td>
                                                                                            <td><?=convertedcit($list->qty)?></td>
                                                                                            <td><?=$unit_selected->name?></td>
                                                                                            <td><?=convertedcit($list->qty)?></td>
                                                                                            <td><?=convertedcit($stock->khata_id)?></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <?php $sn++; endforeach;?>
                                                                                      </table>
										</div>
<div class="banktextdetails">
   <table class="table table-borderless">
	<tr>
    	<td>माग गर्नेको दस्तखत : </td>
        <td>&nbsp;</td>
        <td>क. बजारबाट खरिद गरिदिनु ।	</td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>नाम</td>
	  <td></td>
	  <td> <span>&#10003;</span> ख. मौज्दातबाट दिनु ।</td>
	  <td></td>
  </tr>
	<tr>
	  <td>मिति</td>
	  <td><?php // echo convertedcit(generateCurrDate());?></td>
	  <td>आदेश दिनेको दस्तखत</td>
	  <td></td>
  </tr>
	<tr>
	  <td>प्रयोजन- <?= $dep_selected->name ?>को लागी </td>
	  <td></td>
	  <td>मिति</td>
	  <td><?php //echo convertedcit(generateCurrDate());?></td>
  </tr>
	<tr>
	  <td>जिन्सी खातामा चढाउनेको दस्तखत</td>
	  <td></td>
	  
  <td >मालसामान बुझिलिनेको दस्तखत</td>
      
	  <td></td>
  </tr>
	<tr>
	  <td>मिति</td>
	  <td><?php //echo convertedcit(generateCurrDate());?></td>
	  <td>मिति</td>
	  <td><?php //echo convertedcit(generateCurrDate());?></td>
  </tr>
</table>
</div> 
                        <?php }else
                                {?>
                                       <h3>maag not found</h3>
                                <?php }
                                ?>
       <?php }else{// show if maag_id is selected ?>
                                                                                    
                                                                                    <table class="table table-bordered td1">
                                                                                             <tr>
                                                                                                  <th>सि. नं .</th>
                                                                                                 <th>खर्च माग फारम नं </th>
                                                                                                 <th>शाखा </th>
                                                                                                 <th>खर्च माग गरेको मिति</th>
                                                                                                 <th>पुरा विवरण </th>
                                                                                            </tr>
                                                                                            <?php $i=1; foreach($data_1 as $data):
                                                                                              $dep_res = Department::find_by_id($data->department_id);
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?= convertedcit($i) ?></td>
                                                                                                <td><?=convertedcit($data->id)?></td>
                                                                                                <td><?= $dep_res->name ?></td>
                                                                                                <td><?=convertedcit($data->maag_date)?></td>
                                                                                                <td><a href="kharchafarm_search.php?maag_id=<?=$data->id?>" class="btn">पुरा विवरण हेर्नुहोस </a> &nbsp;&nbsp;<a href="kharchafarm_edit.php?maag_id=<?=$data->id?>" class="btn">सच्याउनुहोस</a></td>
                                                                                            </tr>
                                                                                            <?php $i++; endforeach;?>
                                                                                    </table>  
        <?php } ?>
										
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

