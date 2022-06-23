<?php 
    require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['update_id']))
        {
            $description = Description::find_by_id($_POST['update_id']);
        }
        else
        {
            $description = new Description;
        }
        $description->name = $_POST['name'];
        if($description->save())
        {
            echo alertBox("हाल्न सफल", "settings_description_view.php");
        }
    }
    if(isset($_GET['update_id']))
    {
        $result = Description::find_by_id($_GET['update_id']);
    }
    else
    {
        $result = Description::setEmptyobjects();
    }
    
    if(isset($_GET['del_id']))
    {
       $description_data = Description::find_by_id($_GET['del_id']);
       if($description_data->delete())
       {
           echo alertBox("हटाउन सफल", "settings_description_view.php");
       }
    }
        
    $description_details = Description::find_all();    
    
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>विवरण हेर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">विवरण थप्नुहोस | <a href="settings.php" class="btn">पछि जानुहोस </a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                                    	<div class="inputWrap">
                                    		<h1>विवरण थप्नुहोस </h1>
                                    		<div class="titleInput">विवरणको नाम :</div>
                                    		<div class="newInput"><input type="text" id="topictype_name" name="name" value='<?=$result->name?>' required></div>
                                                <div class="newInput"><input type="hidden" id="topictype_name" name="update_id" value='<?=$result->id?>'></div>
                                    		<div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn"></div>
                                    	</div><!-- my new wrap  -->
                                    	
                                    	

                                </form>
                                <br/>
                                <br/>
                                <?php 
                                    if(!empty($description_details))
                                    {
                                ?>
                                 <table class="table table-bordered table-responsive ">
                                            <tr>
                                                <th>क्र.सं.</th>
                                                <th>विवरण</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                         <?php 
                                            $i=1;
                                            foreach($description_details as $data):


                                             ?>
                                            <tr> 
                                                <td><?php echo convertedcit($i);?></td>
                                                <td><?= $data->name ?></td>
                                                <td><a href="settings_description_view.php?update_id=<?= $data->id ?>" class="btn-link btn">सच्याउनु होस्</a>    <a href="settings_description_view.php?del_id=<?= $data->id ?>" class="btn-link btn ">हटाउनु होस्</a></td>
                                            </tr>
                                         <?php
                                            $i++;
                                            endforeach;
                                         ?>
                                        </table>
                                <?php 
                                    }
                                ?>    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>



