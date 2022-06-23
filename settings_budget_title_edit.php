<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= Budgettitle::find_by_id($_POST['update_id']);
   $data->name=$_POST['name'];
   if($data->save())
    {
        $session->message(" बजेट शिर्षक सच्याउन सफल");
        redirect_to("settings_budget_title_view.php");
    }
}
$data= Budgettitle::find_by_id($_GET['id']);

?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>बजेट शिर्षक सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">बजेट शिर्षक सच्याउनुहोस्  | <a href="settings_budget_title_view.php" class="btn">बजेट शिर्षक थप्नुहोस</a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>बजेट शिर्षक सच्याउनुहोस् </h1>
                                    		<div class="titleInput">शिर्षकको नं:</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="sn" value="<?php echo $data->name;?>" required></div>
                                    		<div class="titleInput">बजेट शिर्षकको नाम :</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="name" value="<?php echo $data->name;?>" required></div>
                                    		<div class="saveBtn myCenter"><input type="submit" name="submit" value="सच्याउनु होस्" class="btn"></div>
                                    	</div>
                                    	
                                        <input type="hidden" name="update_id" value="<?php echo $data->id?>"/>
                                        </form>
                                    
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>