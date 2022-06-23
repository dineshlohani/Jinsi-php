<?php require_once("includes/initialize.php"); ?>
<?php	if(!$session->is_logged_in()){ redirect_to("logout.php");}?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>Main::<?php echo SITE_SUBHEADING;?></title>
<?php
$id= $_GET['id'];
$return_id = $_GET['id_return'];

?>
</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
                    <h2 class="dashboard">भाडाका सामन हटाउनुहोस्  | <a href="index.php" class="btn">ड्यासबोर्डमा जानु होस्  </a></h2>
                    <div class="dashboardcontent">
                        <a href="bhada_add_edit.php?id=<?= $id ?>"><div class="userprofile">
                                                    <h3>भाडा दिईएको फारम</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                     <?php if($return_id==2):?>
                        <a href="bhada_return_edit.php?id=<?= $id ?>"><div class="userprofile">
                                                    <h3>भाडाको सामान फिर्ता फारम</h3>
                            <div class="dashimg">
                                <img src="images/billing-icon.png" alt="Billing Icons" class="dashimg" />
                            </div>
                        </div></a><!-- user profile ends -->
                    <?php endif; ?>
                    </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

