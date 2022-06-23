<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडामा दिएको सम्पतीको अभिलेख खाता</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">भाडामा दिएको सम्पतीको अभिलेख खाता| <a href="index.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="dashboardcontent">
                    	<a href="bhadadiyeko_newAdd.php"><div class="userprofile">
                                                    <h3>भाडामा दिएको सम्पतीको अभिलेख खाता भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="bhadadiyeko_view_dashboard.php"><div class="userprofile">
                                                    <h3>भाडामा दिएको सम्पतीको अभिलेख खाता खोज्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="bhadadiyeko_return.php"><div class="userprofile">
                                                    <h3>भाडामा दिएको सम्पतीको अभिलेख खाता फिर्ता गर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                    </div>
                </div><!-- main menu ends -->
              
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>