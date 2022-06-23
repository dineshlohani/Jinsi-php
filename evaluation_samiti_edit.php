<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
    redirect_to("logout.php");
}
if(isset($_POST['submit']))
{
//    echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
    $profile = EvaluationSamitiProfile::find_by_id($_POST['profile_id']);
    $profile->date_nepali = $_POST['date_nepali'];
    $profile->date_english = DateNepToEng($_POST['date_nepali']);
    $profile_id = $profile->save();
    $edit_details = EvaluationSamitiDetails::find_by_profile_id($_POST['profile_id']);
    foreach ($edit_details as $edit_detail)
    {
        $edit_detail->delete();
    }
    for($i=0; $i<count($_POST['pad_id']);$i++)
    {
        $details = new EvaluationSamitiDetails;
        $details->worker_id = $_POST['worker_id'][$i];
        $details->pad_id = $_POST['pad_id'][$i];
        $details->profile_id = $_POST['profile_id'];
        $details->save();
    }
    echo alertBox("कार्य सफल", "evaluation_samiti.php");
}

$profile = EvaluationSamitiProfile::find_by_id( (int) $_GET['id']);
$details = EvaluationSamitiDetails::find_by_profile_id($profile->id);
$workers =  Workers::find_all();
$pads = Pad::find_all();
//        echo "<pre>"; print_r($workers); exit;
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title><?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">खरिद इकाई |  <a href="kharid_ikai.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<span class="myMessage"><?php echo $message;?></span>
                                        <form method="post" enctype="multipart/form-data" >
                                            <span>गठन मिति : <input type="text" name="date_nepali" id="nepaliDate3" required value="<?=$profile->date_nepali?>" /></span>
                                        <table class="table table-bordered table-hover table-striped">
                                         <?php $counter = 1; foreach($details as $detail): ?>
                                            <tr class="remove_ikai_row">
                                                <td><?=convertedcit($counter)?></td>
                                                <td>कर्मचारीको नाम</td>
                                                <td>
                                                    <select required name="worker_id[]">
                                                        <option value="">----</option>
                                                        <?php foreach($workers as $worker): ?>
                                                        <option <?php if($worker->id==$detail->worker_id){?> selected="selected" <?php } ?> value="<?=$worker->id?>"><?=$worker->name?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>पद</td>
                                                <td>
                                                    <select name="pad_id[]" required>
                                                        <option value="">----</option>
                                                        <?php foreach($pads as $pad): ?>
                                                        <option <?php if($pad->id==$detail->pad_id){?> selected="selected" <?php } ?> value="<?=$pad->id?>"><?=$pad->name?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php endforeach; ?>
                                            <tbody id="ikai-add">
                                                
                                            </tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><span class="btn" id="btn_add_ikai">थप्नुहोस</span></td>
                                                <td><span class="btn" id="btn_deduct_ikai">हटाउनुहोस</span> </td>
                                                <td><input type="submit" class="btn" name="submit" value="सेभ गर्नुहोस्" /></td>
                                            </tr>
                                        </table>
                                            <input type="hidden" name="profile_id" value="<?=(int)$_GET['id']?>" />
                                        </form>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>