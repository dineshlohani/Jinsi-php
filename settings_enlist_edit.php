<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= Enlist::find_by_id($_POST['update_id']);
   $_POST['date']= DateNepToEng($_POST['nep_date']);
   if($data->savePostData($_POST))
    {
        $session->message("सुची दर्ता सच्याउन सफल");
        redirect_to("settings_enlist_view.php");
    }
}
$data= Enlist::find_by_id($_GET['id']);

?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>सुची दर्ता  सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">सुची दर्ता सच्याउनुहोस् | <a href="settings_enlist_add.php" class="btn">सुची दर्ता थप्नुहोस</a> | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>                  <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                              	   <div class="inputWrap">
                                   	     <h1>सुची दर्ता सच्याउनुहोस् </h1>
                                         <div class="titleInput">फर्म /कम्पनीको नाम:</div>
										 <div class="newInput"><input type="text" id="topictype_name" name="name" value="<?php echo $data->name;?>" required></div>
                                         <div class="titleInput">ठेगाना :</div>
										 <div class="newInput"><input type="text" id="topictype_name" name="address" value="<?php echo $data->address;?>" required></div>
										 <div class="titleInput">सम्पर्क नं:</div>
									     <div class="newInput"><input type="text" id="topictype_name" name="number" value="<?php echo $data->number?>"></div>
                                         <div class="titleInput">करदाता नं:</div>
										 <div class="newInput"><input type="text" id="topictype_name" name="taxpayer_number" value="<?php echo $data->taxpayer_number;?>" required></div>
                                         <div class="titleInput">कारोवारको किसिम :</div>
										 <div class="newInput"><input type="text" id="topictype_name" name="business_type" value="<?php echo $data->business_type;?>" required></div>		
					                     <div class="titleInput">मिती:</div>
                                          <div class="newInput"><input type="text"  name="nep_date" value="<?= DateEngToNep($data->date) ?>" id="nepaliDate10" required></div>					
                                                                                 <div class="saveBtn myCenter"><input type="submit" name="submit" value="सच्याउनुहोस्" class="btn">
                                         	<input type="hidden" name="update_id" value="<?php echo $data->id?>"/>
                                         </div>
                                   </div>              
                              </form>
                                    
                      </div>
                </div>
          </div><!-- main menu ends -->
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>