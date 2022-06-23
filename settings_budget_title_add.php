<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Budgettitle();
	if($data->savePostData($_POST)){
        $session->message("बजेट शिर्षक थप सफल");    
        redirect_to("settings_budget_title_view.php");
        
        }        
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>बजेट शिर्षक थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">बजेट शिर्षक हेर्नुहोस | <a href="settings_budget_title_view.php" class="btn">बजेट शिर्षक हेर्नुहोस</a> </h2>
                   
                    <div class="OurContentFull">
                    	<h2>बजेट शिर्षक थप्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>बजेट शिर्षक थप्नुहोस </h1>
                                    		<div class="titleInput">शिर्षक नं:</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="sn" required></div>
                                    		<div class="titleInput">बजेट शिर्षकको नाम:</div>
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

