<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च भएर नजाने जिन्सी मौज्जाद</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">खर्च भएर नजाने जिन्सी मौज्जादको  विवरण	 | <a href="dashboard_jinsinmaujad.php" class="btn">जिन्सी मौज्जादमा जानु होस् </a></h2>
                    <div class="dashboardcontent">
                    	<a href="jinsimaujad_barsikkharchanot.php"><div class="userprofile">
                                                    <h3>खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण फाराम भर्नुहोस् </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="jinsimaujad_barsikkharchaformnot.php"><div class="userprofile">
                                                    <h3>खर्च भएर नजाने जिन्सी मौज्जादको वार्षिक विवरण खोज्नुहोस </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        
                    </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>