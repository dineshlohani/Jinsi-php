<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= Itemtype::find_by_id($_POST['update_id']);
   $data->name=$_POST['name'];
   if($data->save())
    {
        $session->message(" सामनको किसिम सच्याउन सफल");
        redirect_to("settings_department_view.php");
    }
}
$data= Itemtype::find_by_id($_GET['id']);

?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>सामानको किसिम  सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">सामानको किसिम सच्याउनुहोस् | <a href="settings_item_type_add.php" class="btn">सामानको किसिम थप्नुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>सामानको किसिम सच्याउनुहोस् </h1>
                                    		<div class="titleInput">सामानको किसिमको नाम :</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="name" value="<?php echo $data->name;?>" required></div>
                                    		<div class="saveBtn myCenter"><input type="submit" name="submit" value="सच्याउनु होस्" class="btn"></div>
                                    		<input type="hidden" name="update_id" value="<?php echo $data->id?>"/>
                                    	</div>
                                    	
                                        
                                        </form>
                                    
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>