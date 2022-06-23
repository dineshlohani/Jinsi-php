<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Department();
	$_POST['name'] = $_POST['name'];
	if($data->savePostData($_POST)){
        $session->message("शाखा थप सफल");    
        redirect_to("settings_department_view.php");
        
        }
	
	
        
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>शाखा हेर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">शाखा थप्नुहोस | <a href="settings_department_view.php" class="btn"> शाखा हेर्नुहोस</a> | <a href="settings.php" class="btn">पछि जानुहोस </a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>शाखा थप्नुहोस </h1>
                                    		<div class="titleInput">शाखाको नाम :</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                    		<div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                                    	</div><!-- my new wrap  -->
                                    	
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

