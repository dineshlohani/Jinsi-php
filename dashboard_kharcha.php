<?php require_once("includes/initialize.php"); ?>
<?php if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>Dashboard Kharcha</title>
</head>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">खर्च माग फारम | <a href="dashboard_maag.php" class="btn">माग फारममा जानु होस् </a></h2>
                    <div class="dashboardcontent">
                    	<a href="kharchafarm_newAdd.php"><div class="userprofile">
                                                    <h3>नया खर्च माग फारम भर्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="kharchafarm_search.php"><div class="userprofile">
                                                    <h3>खर्च माग फारम खोज्नुहोस</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        
                    </div>
                </div><!-- main menu ends -->
               
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>