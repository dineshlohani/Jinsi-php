 <?php require_once("menuincludes/header.php"); ?>
<div id="top_wrap1">  
    	   
                <div class="col col-lg-8 col-md-6 col-sm-12 col-xs-12 title">
                    <a href="index.php" title="ड्यासबोर्डमा जानुहोस्"><h1><?php echo SITE_NAME; ?><span class="myRight myFlag"> <img src="images/flag.gif" alt="Nepal Flag Flapping" height="35em" /></span></h1></a>
                    
                </div>
                
                
                <div class="col col-lg-4 col-md-6 col-sm-12 col-xs-12 toplink">
                    <ul>
                        
                        <li><a href="logout.php">लग आउट गर्नुहोस् </a></li>
                        
                        <?php if($_SESSION['669d55221cf323ee455e8e94b4840d1ckalika_mode'] == 'administrator')
                        { ?>

                          <!--<li><a href="create_user.php">प्रयोगकर्ता थप्नुहोस</a></li>-->
                       <?php }
                        
                        ?>
                    </ul>
                </div>
                   	
    </div><!-- top wrap ends -->
    <?php include("menuincludes/mainmenusuperadmin.php"); ?>