<?php require_once("includes/initialize.php"); 
	?>
  <?php
  
  
if(isset($_POST['submit']))
{
    if(!empty($_POST['update_id']))
    {
        $data= Bhadaenlist::find_by_id($_POST['update_id']);
    }
    else
    {
        $data = new Bhadaenlist();
	
    }
	$data->name= $_POST['name'];
        $data->address=$_POST['address'];
        $data->number=$_POST['number'];
	if($data->save()){
        echo alertBox(" थप सफल", "bhada_enlist_add.php");
        }
	
	
        
        
}
if(isset($_GET['id']))
{
    $result= Bhadaenlist::find_by_id($_GET['id']);
}
else
{
    $result= Bhadaenlist::setEmptyObjects();
}
$office_result= Bhadaenlist::find_all();

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>कर्मचारी विवरण थप्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">भाडामा दिने/लिने व्यक्ति / संसंस्थाको विवरण  हेर्नुहोस | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	<h2>भाडामा दिने/लिने व्यक्ति / संसंस्थाको विवरण</h2>
                        <div class="userprofiletable">
                        	<form method="POST" enctype="multipart/form-data">
                            	<div class="inputWrap">
                                   <div class="titleInput">  नाम:</div>
                                        
									<div class="newInput"><input type="text"  name="name" required value="<?php echo $result->name;?>"></div>
                                    <div class="titleInput"> ठेगाना: </div>
									<div class="newInput"><input type="text"  name="address" required value="<?php echo $result->address;?>"></div>
                                    
                                      <div class="titleInput"> सम्पर्क नम्बर: </div>
									<div class="newInput"><input type="text"  name="number" required value="<?php echo $result->number;?>"></div>                                  
                                    <div class="saveBtn myCenter"><input type="submit" name="submit" value="सेभ गर्नुहोस" class="btn">
                                    <input type="hidden" name="update_id" value="<?php echo $result->id;?>"/></div>
                                </div>
                            </form>
                                            <?php if(!empty($office_result)):?>
                            <!--<a href="print_karmachari_biwaran.php" class='btn' style="float:right;" target="_blank">प्रिन्ट गर्नुहोस् ।</a>-->
            
                            <h2 class="headinguserprofile">भाडामा दिने/लिने व्यक्ति / संसंस्थाको विवरण</h2>
                                    <table class="table table-bordered table-striped table-hover">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                                <th class="myCenter">सि नं </th>
                                          <th class="myCenter"> नाम </th>
                                            <th class="myCenter"> ठेगाना </th>
                                            <th class="myCenter"> सम्पर्क न </th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($office_result as $data):
                                            
                                              ?>
                                          	<tr>
                                                       
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo $data->name;?></td>
                                                        <td class="myCenter"><?php echo $data->address;?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->number);?></td>
                                                        <td class="myCenter"><a href="bhada_enlist_add.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php endif;?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

