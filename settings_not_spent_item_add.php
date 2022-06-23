<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  $budget_title= Budgettitle::find_all();
  $units= Unit::find_all();
  $item_types= Itemtype::find_all();
if(isset($_POST['submit']))
{
	$data = new Notspentitem();
	if($data->savePostData($_POST)){
        $session->message("खर्च नहुने सामनको विवरण थप सफल");    
        redirect_to("settings_not_spent_item_view.php");
        
        }
	
	
        
        
}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च नहुने सामानको विवरण  थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च नहुने सामानको विवरण थप्नुहोस | <a href="settings_not_spent_item_view.php" class="btn">खर्च नहुने सामानको विवरण हेर्नुहोस</a>  | <a href="settings.php" class="btn">पछि जानुहोस </a></h2>
                  
                    <div class="OurContentFull">
                    	
                    	
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                        		<div class="inputWrap1">
                    				<h1>खर्च नहुने सामानको विवरण थप्नुहोस </h1>
                    				<div class="inputWrap50 inputWrapLeft">
                    				    <div class="titleInput">खर्च नहुने सामानको नाम:</div>
					                    <div class="newInput"><input type="text" id="topictype_name" name="name" required></div>
                                        <div class="titleInput">सामानको ब्रान्ड:</div>
					    <div class="newInput"><input type="text" id="topictype_name" name="brand" required></div>
                                                            <div class="titleInput">सामानको किसिम:</div>
										<div class="newInput"><select name="item_type_id" required>
                                            		<option value="">छान्नुहोस्</option>
                                            		<?php foreach($item_types as $item_type): ?>
                                            			<option value="<?=$item_type->id?>"><?=$item_type->name?></option>
                                            		<?php endforeach; ?>
                                            	</select></div>
                                        <div class="titleInput">स्पेशिफिकेशन:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="specification" ></div>
                                        <div class="titleInput">उत्पादन गर्ने देश:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="made_in" ></div>
                    		        </div>
                    		        <div class="inputWrap50 inputWrapRight">
                                    	<div class="titleInput">साइज:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="size" ></div>
                                        <div class="titleInput">अनुमानित आयु:</div>
										<div class="newInput"><input type="text" id="topictype_name" name="time_period" ></div>
                                        <div class="titleInput">बजेट शिर्षकको नाम:</div>
										<div class="newInput"><select name="budget_title_id">
                                                    <option value="">--छान्नुहोस् --</option> 
                                                    <?php foreach ($budget_title as $title): ?>
                                                    <option value="<?=$title->id?>"><?=$title->name?></option>
                                                    <?php endforeach;?>
                                                </select></div>
                                        <div class="titleInput">इकाईको किसिम:</div>
										<div class="newInput"><select name="unit_id">
                                                    <option value="">--छान्नुहोस् --</option> 
                                                    <?php foreach ($units as $data): ?>
                                                    <option value="<?=$data->id?>"><?=$data->name?></option>
                                                    <?php endforeach;?>
                                                </select></div>
                                    </div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                    	        </div>
                                    	

                                    </form>
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

