<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= Itemcondition::find_by_id($_POST['update_id']);
   $data->name=$_POST['name'];
   if($data->save())
    {
        $session->message("सामनको भौतिक अवस्था सच्याउन सफल");
        redirect_to("settings_item_physical_condition_view.php");
    }
}
$data= Itemcondition::find_by_id($_GET['id']);

?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>सामानको भौतिक अवस्था सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">सामानको भौतिक अवस्था सच्याउनुहोस् | <a href="settings_item_physical_condition_add.php" class="btn">सामानको किसिम थप्नुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                        	<h1>सामानको भौतिक अवस्था सच्याउनुहोस् </h1>
                                            <div class="titleInput">सामानको भौतिकको  किसिम :</div>
											<div class="newInput"><input type="text" id="topictype_name" name="name" value="<?php echo $data->name;?>" required></div>
                                            <div class="saveBtn myCenter"><input type="submit" name="submit" value="सच्याउनु होस्" class="btn">
                                            <input type="hidden" name="update_id" value="<?php echo $data->id?>"/></div>
                                        </div>
                                        </form>
                                    
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>