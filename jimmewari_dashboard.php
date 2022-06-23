<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता | <a href="index.php" class="btn">ड्यासबोर्डमा जानु होस्  </a></h2>
                    <div class="dashboardcontent">
                        <a href="jimmewari_khata.php"><div class="userprofile">
                                                    <h3>खप्नेमाल सामानको मौज्जाद तथा जिम्मेबारी विवरण खाता</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="jimmewari_khata_detail_report.php"><div class="userprofile">
                                                    <h3>बिस्तृत बिवरण हेर्नुहोस </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        
                    </div>
                </div><!-- main menu ends -->
              
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>