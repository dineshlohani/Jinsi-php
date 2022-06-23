<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>प्रस्ताब फाराम पेश गर्ने बारे</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">प्रस्ताब फाराम पेश गर्ने बारे| <a href="index.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="dashboardcontent">
                        <a href="prastabana.php"><div class="userprofile">
                                                    <h3>प्रस्ताब फाराम भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/icon11.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="prastabana_search.php"><div class="userprofile">
                                                    <h3>प्रस्ताब फाराम खोज्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/icon11.png" alt="Billing Icons" class="dashimg" />
                            </div>
                            </div></a><!-- user profile ends -->
                            <a href="darrate_search.php"><div class="userprofile">
                                                    <h3>दर रेट पेश सम्बन्धमा </h3>
                            <div class="dashimg">
                                <img src="images/icon11.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        
                    </div>
                </div><!-- main menu ends -->
              
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>