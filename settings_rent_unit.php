<?php require_once("includes/initialize.php"); 
	?>
  <?php
if(isset($_POST['submit']))
{
    if(!empty($_POST['update_id']))
    {
        $data= Rentunit::find_by_id($_POST['update_id']);
    }
    else
    {
        $data = new Rentunit();
	
    }
	$data->name= $_POST['name'];
       if($data->save()){
        echo alertBox("इकाई थप सफल", "settings_rent_unit.php");
        }
	    
}
if(isset($_GET['id']))
{
    $result=Rentunit::find_by_id($_GET['id']);
}
else
{
    $result=Rentunit::setEmptyObjects();
}
$office_result=  Rentunit::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडाको इकाई थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
                    <h2 class="headinguserprofile">भाडाको इकाई विवरण  हेर्नुहोस | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                    
                    <div class="OurContentFull">
                    	<h2>भाडाको इकाई थप्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                            	<div class="inputWrap">
                                	<h1>भाडाको इकाई थप्नुहोस </h1>
                                    <div class="titleInput">भाडाको इकाई</div>
									<div class="newInput"><input type="text"  name="name" required value="<?php echo $result->name;?>"></div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn">
                                    <input type="hidden" name="update_id" value="<?php echo $result->id;?>"/>
                                    </div>
                                </div>
                            </form>
                            <?php if(!empty($office_result)):?>
                            <h2 class="headinguserprofile">भाडाको इकाई विवरण </h2>
                                    <table class="table table-bordered table-striped table-hover">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">भाडाको इकाई </th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($office_result as $data): ?>
                                          	<tr>
                                                       
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo $data->name;?></td>
                                                        <td class="myCenter"><a href="settings_rent_unit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php endif;?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

