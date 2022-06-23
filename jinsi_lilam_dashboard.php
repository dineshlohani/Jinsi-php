<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>जिन्सी लिलाम</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">जिन्सी लिलाम | <a href="index.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="dashboardcontent">
                    	<a href="jinsililam_newAdd.php"><div class="userprofile">
                                                    <h3>जिन्सी लिलाम फाराम भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="jinsi_lilam_approve.php"><div class="userprofile">
                                                    <h3>लिलाम स्वीकृत गर्नुहोस </h3>
                            <div class="dashimg">
                              <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                        </div>
                        </div></a><!-- user profile ends -->
                        <a href="jinsi_lilam_tippani.php"><div class="userprofile">
                                                    <h3>लिलाम टिप्पणी </h3>
                            <div class="dashimg">
                          <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                         </div>
                        </div></a><!-- user profile ends -->
                         <a href="jinsi_lilam_final.php"><div class="userprofile">
                                                    <h3>लिलाम मार्फत स्टैक घटाउनुहोस् </h3>
                            <div class="dashimg">
                             <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                        </div>
                        </div></a><!-- user profile ends -->
                    </div>
                </div><!-- main menu ends -->
              
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>