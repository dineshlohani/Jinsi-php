<?php require_once("includes/initialize.php"); 
	?>
  <?php
    
if(isset($_POST['submit']))
{
	$data = new Itemcondition();
	if($data->savePostData($_POST)){
        $session->message("सामनको भौतिक अवस्था थप सफल");    
        redirect_to("settings_item_physical_condition_view.php");
        
        }        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सामानको भौतिक अवस्था  थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">सामानको भौतिक अवस्था हेर्नुहोस | <a href="settings_item_physical_condition_view.php" class="btn">सामानको भौतिक अवस्था हेर्नुहोस</a> | <a href="settings.php" class="btn">पछि जानुहोस </a></h2>
                    <div class="OurContentFull">
                    	<h2>सामानको भौतिक अवस्था थप्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<table class="table table-bordered">
                                        	<div class="inputWrap">
                                            	<h1>सामानको भौतिक अवस्था थप्नुहोस </h1>
                                                <div class="titleInput">सामानको भौतिकको  किसिम:</div>
												<div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                                <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                                            </div>

                                    </form>
                        </div>
                  </div>
                </div><!-- main menu ends -->
         
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

