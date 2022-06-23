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
                    <h2 class="dashboard"> स्टोक हल्नुहोस | <a href="index.php" class="btn">पछि जानुहोस्  </a></h2>
                    <div class="dashboardcontent">
                        <a href="insert_stock.php"><div class="userprofile">
                        	<h3>मौज्जाद स्टोक हाल्नुहोस्</h3>
                            <div class="dashimg">
                            	<img src="images/new_plan_icon.png" alt="New Plan  Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                        <a href="insert_stock_department.php"><div class="userprofile">
                        	<h3>हस्तान्तरण मार्फत स्टोक हाल्नुहोस्</h3>
                            <div class="dashimg">
                            	<img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
			 <a href="insert_stock_department_search.php"><div class="userprofile">
                        	<h3>हस्तान्तरण मार्फत स्टोक खोज्नुहोस </h3>
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