<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
    if(!empty($_POST['update_id']))
    {
        $data=  Workers::find_by_id($_POST['update_id']);
    }
    else
    {
        $data = new Workers();
	
    }
	$data->name= $_POST['name'];
        $data->shreni_id    = $_POST['shreni_id'];
        $data->taha_id      = $_POST['taha_id'];
        $data->type         = $_POST['type'];
        $data->post         = $_POST['post'];
        $data->is_jinsi         = $_POST['is_jinsi'];
	if($data->save()){
            echo alertBox("कर्मचारी थप सफल", "settings_worker.php");
        }
	
	
        
        
}
if(isset($_GET['id']))
{
    $result=Workers::find_by_id($_GET['id']);
}
else
{
    $result=Workers::setEmptyObjects();
}
$office_result=  Workers::find_all();
$shreni_result = Shreni::find_all();
$taha_result = Taha::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>कर्मचारी विवरण थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">कर्मचारी विवरण  हेर्नुहोस | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	<h2>कर्मचारी थप्नुहोस </h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                            	<div class="inputWrap">
                                    <div class="titleInput">श्रेणी छान्नुहोस् :</div>
                                    <div class="newInput">
                                        <select name="shreni_id">
                                            <option value="">--------</option>
                                            <?php foreach($shreni_result as $data):?>
                                                <option value="<?=$data->id?>" <?php if($result->shreni_id==$data->id){ echo 'selected="selected"';}?>><?=$data->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                  <div class="titleInput">तह  छान्नुहोस् :</div>
                                    <div class="newInput">
                                        <select name="taha_id">
                                            <option value="">--------</option>
                                            <?php foreach($taha_result as $data):?>
                                                <option value="<?=$data->id?>" <?php if($result->taha_id==$data->id){ echo 'selected="selected"';}?>><?=$data->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                  <div class="titleInput">प्राबिधिक / अप्राबिधिक :</div>
                                  <div class="newInput"><input type="radio"  name="type" required value="1"  <?php if($result->type==1){ echo 'checked="checked"';}?>>&nbsp;&nbsp;प्राबिधिक &nbsp;&nbsp;
                                  <input type="radio"  name="type" required value="2" <?php if($result->type==2){ echo 'checked="checked"';}?>>&nbsp;&nbsp;अप्राबिधिक</div>
                                  <div class="titleInput">कर्मचारीको नाम:</div>
                                        
									<div class="newInput"><input type="text"  name="name" required value="<?php echo $result->name;?>"></div>
                                    <div class="titleInput">कर्मचारीको पद: </div>
									<div class="newInput"><input type="text"  name="post" required value="<?php echo $result->post;?>"></div>
                                   <div class="newInput"><input type="checkbox"  name="is_jinsi"  value="1" <?php if($result->is_jinsi==1){?> checked="checked" <?php } ?> /> जिन्सी शाखाको भएमा टिक लगाउनुहोस</div>
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn">
                                    <input type="hidden" name="update_id" value="<?php echo $result->id;?>"/></div>
                                </div>
                            </form>
                            <?php if(!empty($office_result)):?>
                            <h2 class="headinguserprofile">कर्मचारी विवरण</h2>
                                    <table class="table table-bordered table-striped table-hover">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">कर्मचारीको श्रेणी  </th>
                                            <th class="myCenter">कर्मचारीको तह </th>
                                            <th class="myCenter">प्राबिधिक / अप्राबिधिक</th>
                                            <th class="myCenter">कर्मचारीको नाम </th>
                                            <th class="myCenter">कर्मचारीको पद </th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($office_result as $data):
                                              if($data->type == 1)
                                              {
                                                  $name = "प्राबिधिक";
                                              }
                                              if($data->type==2)
                                              {
                                                  $name = "अप्राबिधिक";
                                              }
                                             
                                              ?>
                                          	<tr>
                                                       
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo Shreni::getName($data->shreni_id);?></td>
                                                        <td class="myCenter"><?php echo Taha::getName($data->taha_id);?></td>
                                                        <td class="myCenter"><?php echo $name;?></td>
                                                        <td class="myCenter"><?php echo $data->name;?></td>
                                                        <td class="myCenter"><?php echo $data->post;?></td>
                                                        <td class="myCenter"><a href="settings_worker.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php endif;?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

