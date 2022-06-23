<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Unit();
	if($data->savePostData($_POST)){
        $session->message("इकाईको किसिम थप सफल");    
        redirect_to("settings_units_view.php");
        
        }       
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>इकाईको किसिम थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
                    <h2 class="headinguserprofile">इकाईको किसिम | <a href="settings_units_view.php" class="btn">इकाईको किसिम हेर्नुहोस</a> </h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>इकाईको किसिम थप्नुहोस </h1>
                                    		<div class="titleInput">इकाईको किसिमको नाम:</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                    		<div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                                    	</div>
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

