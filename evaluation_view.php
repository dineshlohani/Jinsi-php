<?php require_once("includes/initialize.php");
if(!$session->is_logged_in())
{
    redirect_to("logout.php");
}
//if(isset($_GET['action']) && $_GET['action']=="set_current")
//{
//    KharidIkaiProfile::set_current( (int) $_GET['id']);
//}
//	$datas= Enlist::find_all();
        $profiles = EvaluationProfile::find_all();
?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">प्रस्ताब / निर्णय  | <a href="evaluation_form.php" class="btn"> थप्नुहोस + </a> | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<span class="myMessage"><?php echo $message;?></span>
                                        <?php foreach($profiles as $profile):
                                                $details = EvaluationDetails::find_by_profile_id($profile->id);
                                                $members = MemberInvited::find_by_profile_id_type_id($profile->id,2);
                                            ?>
                                        
                                    	<table class="table table-bordered table-hover table-striped">
                                            <tr style="background-color:#9999ff">
                                                <td><strong>बैठक संख्या: <?=convertedcit($profile->id)?></strong></td>
                                                <td><strong>मिति: <?=convertedcit($profile->date_nepali)?></strong></td>
                                                <td><a class="btn" href="evaluation_edit.php?id=<?=$profile->id?>">Edit<a> <span ><a class="myPrint" target="_blank" href="evaluation_print.php?id=<?=$profile->id?>">प्रिन्ट गर्नुहोस</a></span></td>
                                            </tr>
                                            <tr>
                                                <td  colspan="3"style="text-align: center"><b> आमन्त्रित सदस्यहरु </b></td>
                                            </tr>
                                            <tr>
                                                <th class="myCenter">सि. नं .</th>
                                                <th class="myCenter">नाम</th>
                                                <th class="myCenter">पद</th>
                                            </tr>
                                            <?php $counter=1; foreach($members as $member): ?>
                                                <tr>
                                                    <td><?=convertedcit($counter)?></td>
                                                    <td><?=$member->member?></td>
                                                    <td><?=$member->pad?></td>
                                                </tr>
                                            <?php $counter++; endforeach; ?>
                                            <tr>
                                                <td  colspan="3"style="text-align: center"><b> प्रस्ताब तथा निर्णयहरु </b></td>
                                            </tr>
                                            <tr>
                                                <th class="myCenter">सि. नं .</th>
                                                <th class="myCenter">प्रस्ताब</th>
                                                <th class="myCenter">निर्णय</th>
                                            </tr>
                                          <?php $counter= 1; 
                                                foreach($details as $detail):
                                                
                                              ?> 
                                                <tr>
                                                    <td><?=convertedcit($detail->sno_taken)?></td>
                                                    <td><?=$detail->description?></td>
                                                    <td><?=$detail->decesion?></td>
                                                </tr>
                                              
                                          <?php $counter++; endforeach; ?>
                                        </table>
                                        <div class="myspacer"></div>
                                        <div class="myspacer"></div>
                                        <?php endforeach; ?>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>