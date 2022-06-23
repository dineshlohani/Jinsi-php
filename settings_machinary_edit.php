<?php require_once("includes/initialize.php"); 
if(isset($_POST['submit']))
{
	$data = Machinary::find_by_id($_POST['update_id']);
        $_POST['miti_english'] = DateNepToEng($_POST['miti']);
	if($data->savePostData($_POST))
            {
            echo alertBox("सच्याउन सफल","settings_machinary_view.php");
            }
}
$id = $_GET['id'];
$result = Machinary::find_by_id($id);
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
                    				<h1>चल्ती मेशिन वा सवारीको किताब सच्याउनुहोस  </h1>
                    				<div class="inputWrap50 inputWrapLeft">
                    				    <div class="titleInput">चल्ती मेशिन वा सबारीको नाम:</div>
                                                    <div class="newInput"><input type="text" id="topictype_name" name="name" required value="<?=$result->name?>"></div>
                                        <div class="titleInput">किसम:</div>
					    <div class="newInput"><input type="text" id="topictype_name" name="type" required value="<?=$result->type?>"></div>
                                                            <div class="titleInput">मोडल नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="model" required value="<?=$result->model?>"></div>
                                        <div class="titleInput">ईन्जिन नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="engine_no" value="<?=$result->engine_no?>"></div>
                                        <div class="titleInput">उत्पादन गर्ने देश:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="made_in" value="<?=$result->made_in?>"></div>
                    		       <div class="titleInput">च्यासिस नं:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="chesis_no" value="<?=$result->chesis_no?>"></div>
                                       
                                                </div>
                    		        <div class="inputWrap50 inputWrapRight">
                                    	 <div class="titleInput">सवारी दर्ता नं:</div>
                                         <div class="newInput"><input type="text" id="topictype_name" name="darta_no" value="<?=$result->darta_no?>" ></div>
                                        <div class="titleInput">सबारीको बजन:</div>
                                                            <div class="newInput"><input type="text" id="topictype_name" name="weight" value="<?=$result->weight?>"></div>
                                        <div class="titleInput">जिन्सी खाता पाना नं:</div>
                                                        <div class="newInput"><input type="text" id="topictype_name" name="jinsi_id" value="<?=$result->jinsi_id?>"></div>
                                         <div class="titleInput">अन्य विवरण:</div>
                                        <div class="newInput"><input type="text" id="topictype_name" name="detail" value="<?=$result->detail?>"></div>
                                         <div class="titleInput">खरिद मोल:</div>
                                        <div class="newInput"><input type="text" id="topictype_name" name="price" value="<?=$result->price?>"></div>
                                         <div class="titleInput">सबारी खरिद मिति:</div>
                                        <div class="newInput"><input type="text"  name="miti" id="nepaliDate3" value="<?=$result->miti?>"></div>
                                    </div>
                                                <input type="hidden" name="update_id" value="<?=$_GET['id']?>"
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                    	        </div>
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

