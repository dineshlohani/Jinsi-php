<?php require_once("includes/initialize.php"); 
if(isset($_POST['submit']))
{
	$data = new Machinary();
        $_POST['miti_english'] = DateNepToEng($_POST['miti']);
	if($data->savePostData($_POST))
            {
            echo alertBox("थप सफल","settings_machinary_view.php");
            }
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>चल्ती मेशिन वा सवारीको किताब :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">चल्ती मेशिन वा सवारीको किताब | <a href="settings_machinary_view.php" class="btn">चल्ती मेशिन वा सवारीको किताब हेर्नुहोस</a>  | <a href="settings.php" class="btn">पछि जानुहोस </a></h2>
                  
                    <div class="OurContentFull">
                    	
                    	
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                        		<div class="inputWrap1">
                    				<h1>चल्ती मेशिन वा सवारीको किताब थप्नुहोस </h1>
                    				<div class="inputWrap50 inputWrapLeft">
                    				    <div class="titleInput">चल्ती मेशिन वा सबारीको नाम:</div>
					                    <div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                        <div class="titleInput">किसम:</div>
					    <div class="newInput"><input type="text" id="topictype_name" name="type" required></div>
                                                            <div class="titleInput">मोडल नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="model" required></div>
                                        <div class="titleInput">ईन्जिन नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="engine_no" ></div>
                                        <div class="titleInput">उत्पादन गर्ने देश:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="made_in" ></div>
                    		       <div class="titleInput">च्यासिस नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="chesis_no" ></div>
                                       
                                                </div>
                    		        <div class="inputWrap50 inputWrapRight">
                                    	 <div class="titleInput">सवारी दर्ता नं:</div>
                                         <div class="newInput"><input type="text" id="topictype_name" name="darta_no" ></div>
                                        <div class="titleInput">सबारीको बजन:</div>
                                                            <div class="newInput"><input type="text" id="topictype_name" name="weight" ></div>
                                        <div class="titleInput">जिन्सी खाता पाना नं:</div>
                                                        <div class="newInput"><input type="text" id="topictype_name" name="jinsi_id" ></div>
                                         <div class="titleInput">अन्य विवरण:</div>
                                        <div class="newInput"><input type="text" id="topictype_name" name="detail" ></div>
                                         <div class="titleInput">खरिद मोल:</div>
                                        <div class="newInput"><input type="text" id="topictype_name" name="price" ></div>
                                         <div class="titleInput">सबारी खरिद मिति:</div>
                                        <div class="newInput"><input type="text"  name="miti" id="nepaliDate3" ></div>
                                    </div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                    	        </div>
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

