<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>
<?php $mode = $_SESSION['669d55221cf323ee455e8e94b4840d1ckalika_mode'];
//print_r($mode);
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>Main::<?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner">
    
    	<div class="">
            <div class="">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                <?php if ($mode == 'administrator') {?> 
                    <h2 class="dashboard">दाखिला रिर्पोट | <a href="index.php" class="btn">ड्यासबोर्डमा जानु होस्  </a></h2>
                    <div class="dashboardcontent">
                    	<a href="dakhila_newAdd.php"><div class="userprofile">
                                                    <h3>नया दाखिला रिर्पोट भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="dakhila_search.php"><div class="userprofile">
                                                    <h3>दाखिला रिर्पोट खोज्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        	 	
                        <?php }
                        else{ ?>
                        <a href="dakhila_search.php"><div class="userprofile">
                                <h3>दाखिला रिर्पोट खोज्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        	 
                        
                    </div>
                    <?php }?>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>