<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>रशिद नियन्त्रण खाता</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">रशिद नियन्त्रण खाता| <a href="index.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="dashboardcontent">
                    	<a href="bill_amdani.php"><div class="userprofile">
                                                    <h3>आम्दानी रशिद भर्नुहोस् </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="bill_dispatch.php"><div class="userprofile">
                                                    <h3>निकासा भएको रसिद </h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="bill_dispatch_view.php"><div class="userprofile">
                                                    <h3>सहायक आम्दानी खाता</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                         <a href="bill_control_view_type.php"><div class="userprofile">
                                                    <h3>रशिद नियत्रण खाता</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                    </div>
                </div><!-- main menu ends -->
              
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>