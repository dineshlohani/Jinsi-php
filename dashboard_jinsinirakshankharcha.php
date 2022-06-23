<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम | <a href="dashboard_jinsinirakshan.php" class="btn">जिन्सी निरिक्षणमा जानु होस्  </a></h2>
                    <div class="dashboardcontent">
                    	<a href="jinsinirakshan_kharchaform.php"><div class="userprofile">
                                                    <h3>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="jinsinirakshan_kharchaformfill.php"><div class="userprofile">
                                                    <h3>खर्च भएर जाने जिन्सी मालसामानको निरिक्षण फाराम खोज्नुहोस </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        
                    </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>