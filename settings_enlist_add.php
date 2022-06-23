<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
	$data = new Enlist();
        $_POST['date']= DateNepToEng($_POST['nep_date']);
	if($data->savePostData($_POST)){
        $session->message("सुची दर्ता थप सफल");    
        redirect_to("settings_enlist_view.php");
        
        }        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सुची दर्ता थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>
</head>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
            <h2 class="headinguserprofile">सुची दर्ता थप्नुहोस | <a href="settings_enlist_view.php" class="btn">सुची दर्ता हेर्नुहोस </a>  | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                 <div class="OurContentFull">
                    	<h2>सुची दर्ता थप्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                            	<div class="inputWrap">
                                	<h1>सुची दर्ता थप्नुहोस </h1>
                                    <div class="titleInput">फर्म /कम्पनीको नाम:</div>
									<div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                    <div class="titleInput">ठेगाना:</div>
									<div class="newInput"><input type="text" id="topictype_name" name="address" required></div>
                                    <div class="titleInput">करदाता पान नं:</div>
									<div class="newInput"><input type="text" id="topictype_name" name="taxpayer_number" required></div>
									 <div class="titleInput">संस्था दर्ता नम्बर :</div>
									<div class="newInput"><input type="text" id="topictype_name" name="darta_number" required></div>
									<div class="titleInput">सम्पर्क व्यक्तिको नाम:</div>
									<div class="newInput"><input type="text" id="contact_person" name="contact_person" required></div>
									 <div class="titleInput">फोन नं:</div>
									<div class="newInput"><input type="text" id="topictype_name" name="phone_number" required></div>
                                    <div class="titleInput">कारोवारको किसिम:</div>
									<div class="newInput"><input type="text" id="topictype_name" name="business_type" required></div>
                                      <div class="titleInput">मिती:</div>
                                      <div class="newInput"><input type="text"  name="nep_date" id="nepaliDate10" required></div>                                   
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                                </div>
                                

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

