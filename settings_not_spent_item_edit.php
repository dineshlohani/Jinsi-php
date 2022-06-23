<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= Notspentitem::find_by_id($_POST['update_id']);
  
   if($data->savePostData($_POST))
    {
        $session->message("खर्च नहुने सामनको विवरण सच्याउन सफल");
        redirect_to("settings_not_spent_item_view.php");
    }
}
$data= Notspentitem::find_by_id($_GET['id']);
$budget_title= Budgettitle::find_all();
$units= Unit::find_all();
 $item_types= Itemtype::find_all();
?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>खर्च नहुने सामनको विवरण सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
            <h2 class="headinguserprofile">खर्च नहुने सामनको विवरण सच्याउनुहोस् | <a href="settings_not_spent_item_add.php" class="btn">शाखा थप्नुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                              	<div class="inputWrap1">
                                	<h1>खर्च नहुने सामनको विवरण सच्याउनुहोस् </h1>
                                    <div class="inputWrap50 inputWrapLeft">
                                    	<div class="titleInput">सामानको नाम :</div>
										<div class="newInput"><input type="text" id="topictype_name" name="name" value="<?php echo $data->name;?>" required></div>
                                        <div class="titleInput">सामानको ब्रान्ड:</div>
                                        <div class="newInput"><input type="text" id="topictype_name" value="<?= $data->brand ?>" name="brand" required></div>
                                                                                <div class="titleInput">सामनको किसिम:</div>
										<div class="newInput"><select name="item_type_id" required>
                                            		<option value="">छान्नुहोस्</option>
                                            		<?php foreach($item_types as $item_type): ?>
                                            			<option value="<?=$item_type->id?>" <?php if($data->item_type_id==$item_type->id){?> selected="selected" <?php }?>><?=$item_type->name?></option>
                                            		<?php endforeach; ?>
                                            	</select></div>
                                        <div class="titleInput">स्पेशिफिकेशन :</div>
										<div class="newInput"><input type="text" id="topictype_name" name="specification" value="<?php echo $data->specification;?>" ></div>
                                        <div class="titleInput">उत्पादन गर्ने देश :</div>
										<div class="newInput"><input type="text" id="topictype_name" name="made_in" value="<?php echo $data->made_in;?>" ></div>
                                    </div>
                                    <div class="inputWrap50 inputWrapRight">
                                    	<div class="titleInput">साइज :</div>
										<div class="newInput"><input type="text" id="topictype_name" name="size" value="<?php echo $data->size;?>" ></div>
                                        <div class="titleInput">अनुमानित आयु :</div>
										<div class="newInput"><input type="text" id="topictype_name" name="time_period" value="<?php echo $data->time_period;?>" ></div>
                                        <div class="titleInput">बजेट शिर्षकको नाम :</div>
										<div class="newInput"><select name="budget_title_id">
                                                    <option value="">--छान्नुहोस् --</option> 
                                                    <?php foreach ($budget_title as $title): ?>
                                                    <option <?php if($title->id==$data->budget_title_id){echo 'selected="selected"';} ?> value="<?=$title->id?>"><?=$title->name?></option>
                                                    <?php endforeach;?>
                                                </select></div>
                                        <div class="titleInput">इकाईको किसिम:</div>
                                       
			              <div class="newInput"><select name="unit_id">
                                                    <option value="">--छान्नुहोस् --</option> 
                                                    <?php foreach ($units as $unit): ?>
                                                    <option <?php if($unit->id==$data->unit_id){echo 'selected="selected"';} ?> value="<?=$unit->id?>"><?=$unit->name?></option>
                                                    <?php endforeach;?>
                                                </select> </div>
                                    </div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सच्याउनु होस्" class="btn">
                                    	<input type="hidden" name="update_id" value="<?php echo $data->id?>"/>
                                    </div>
                                </div>
                                    	</form>
                                    
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>