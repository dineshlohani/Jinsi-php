<?php require_once("includes/initialize.php");
if(!$session->is_logged_in())
{
    redirect_to("logout.php");
}
if(isset($_GET['action']) && $_GET['action']=="set_current")
{
    KharidIkaiProfile::set_current( (int) $_GET['id']);
}
	$datas= Enlist::find_all();
        $profiles = KharidIkaiProfile::find_all();
?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सुची दर्ता :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">खरिद इकाई | <a href="kharid_ikai_add.php" class="btn">खरिद इकाई थप्नुहोस + </a> | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<span class="myMessage"><?php echo $message;?></span>
                                        <?php foreach($profiles as $profile):
                                                $current_link = '<a class="btn"  href="kharid_ikai.php?id='.$profile->id.'&action=set_current">Set Current</a>';
                                               
                                               if($profile->is_current==1)
                                               {
                                                   $current_link = '<img src="images/right.png" width="30" height="30" />';
                                               }
                                               
                                                $details = KharidIkaiDetails::find_by_profile_id($profile->id);
                                            ?>
                                        
                                    	<table class="table table-bordered table-hover table-striped">
                                            <tr style="background-color:#9999ff">
                                                <td><strong>खरिद इकाई: <?=convertedcit($profile->id)?></strong></td>
                                                <td><strong>गठन मिति: <?=convertedcit($profile->date_nepali)?></strong></td>
                                                <td><a class="btn" href="kharid_ikai_edit.php?id=<?=$profile->id?>">Edit<a> | <?=$current_link?></td>
                                            </tr>
                                            <tr>
                                                <th class="myCenter">सि. नं .</th>
                                                <th class="myCenter">नाम</th>
                                                <th class="myCenter">पद</th>
                                            </tr>
                                          <?php $counter= 1; 
                                                foreach($details as $detail):
                                                $worker = Workers::find_by_id($detail->worker_id);
                                                $pad    = Pad::find_by_id($detail->pad_id);
                                              ?> 
                                                <tr>
                                                    <td><?=convertedcit($counter)?></td>
                                                    <td><?=$worker->name?></td>
                                                    <td><?=$pad->name?></td>
                                                </tr>
                                              
                                          <?php $counter++; endforeach; ?>
                                        </table>
                                        <?php endforeach; ?>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>