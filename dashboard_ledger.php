<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

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
                    <h2 class="dashboard">जिन्सी सहायक लेजर खाता रिर्पोट | <a href="index.php" class="btn">ड्यासबोर्डमा जानु होस्  </a></h2>
                    <div class="dashboardcontent">
                        <a href="ledger_add.php"><div class="userprofile">
                                                    <h3>सामान वितरण</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="ledger_return.php"><div class="userprofile">
                                                    <h3>सामान फिर्ता</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="ledger_view_dashboard.php"><div class="userprofile">
                                                    <h3>खाता हेर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                    </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>