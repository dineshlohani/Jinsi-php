<?php require_once("includes/initialize.php");
if(!$session->is_logged_in()){ redirect_to("logout.php");} ?>
<?php $fiscal = FiscalYear::find_by_is_current(1); 
        $enlist = Enlist::find_by_id($_GET['enlist_id']);
        //print_r($enlist);
?>  
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title></title>

</head>

<body>
   
                       
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
             <div class="printPage">
             	<div class="printlogo"><img src="images/janani.png" alt="Logo"></div>
                <h6 class="marginright1 letter_title_four">अनुसूची - २ ख</h6>
                <h6 class="marginright1 letter_title_five">नियम १८ को उपनियम (२) संग सम्बन्धित</h6>
                                    	<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									
                                                <div class="myspacer"></div>
									<div class="printContent">
                                        <div class="mydate">मिति :<?php echo convertedcit(DateEngToNep($enlist->date)); ?> </div>
										<div class="patrano">आ.ब : <?php echo convertedcit($fiscal->year); ?></div>
										
										
                                                                                <div class="chalanino">सुची दर्ता नं : <?=convertedcit($enlist->id)?></div>
										<div class="myspacer20"></div>
                                                                                <div class="subject">विषय:- मौजुदा सुचीमा दर्ता भएको प्रमाण।</div>
										<div class="myspacer20"></div>
                                                                                <div class="bankname">श्री <?=$enlist->name?></div>
										<div class="bankaddress"><?php echo $enlist->address;?></div>
										<div>प्यान / भ्याट नं:- <?= convertedcit($enlist->taxpayer_number) ?></div>
										<div class="banktextdetails">
										    श्री <?=$enlist->name?> बाट यस <?php echo SITE_NAME.'मा';?> आर्थिक वर्ष <?php echo convertedcit($fiscal->year)?>
										    का लागि <?=$enlist->business_type?> निर्माण कार्य/सेवा/मालसामान उपलब्ध गराउने प्रयोजनार्थ मौजुदा सूचीमा सूचीकृत हुन पाउँ भनी मिति
										    <?=convertedcit($enlist->date)?> मा यस कार्यालयमा निवेदन प्राप्त हुन आएकोले मौजुदा सूचीमा दर्ता गरी यो निस्सा/प्रमाण उपलब्ध गराईएको छ । 
											</div>
										<div class="myspacer30"></div>
										<div class="oursignature">प्रमुख प्रशासकीय अधिकृत</div>
										<div class="myspacer"></div>
									</div>
                                
                            </div>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->