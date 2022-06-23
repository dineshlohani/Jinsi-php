<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
    if(!empty($_POST['update_id']))
    {
        $data=Shreni::find_by_id($_POST['update_id']);
    }
    else
    {
        $data = new Shreni();
	
    }
	$data->name= $_POST['name'];
        if($data->save()){
        echo alertBox("श्रेणी  थप सफल", "setting_shreni.php");
        }
	
	
        
        
}
if(isset($_GET['id']))
{
    $result=Shreni::find_by_id($_GET['id']);
}
else
{
    $result=Shreni::setEmptyObjects();
}
$office_result=  Shreni::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>श्रेणी थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">श्रेणी हेर्नुहोस | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                 <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                            	<div class="inputWrap">
                                	<h1>श्रेणी थप्नुहोस </h1>
                                    <div class="titleInput">श्रेणीको  नाम:</div>
									<div class="newInput"><input type="text"  name="name" required value="<?php echo $result->name;?>"></div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn">
                                     <input type="hidden" name="update_id" value="<?php echo $result->id;?>"/></div>
                                </div>

                                    </form>
                            
                            <?php if(!empty($office_result)):?>
                            <h2 class="headinguserprofile">श्रेणी हेर्नुहोस </h2>
                                    <table class="table table-bordered table-hover table-striped">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">श्रेणीको नाम </th>
                                           <th  class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($office_result as $data): ?>
                                          	<tr>
                                                       
                                                        <td  class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td  class="myCenter"><?php echo $data->name;?></td>
                                                        <td class="myCenter"><a href="setting_shreni.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php endif;?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

