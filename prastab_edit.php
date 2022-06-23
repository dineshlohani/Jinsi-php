<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
    redirect_to("logout.php");
}
if(isset($_POST['submit']))
{
//    echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
    $profile = PrastabProfile::find_by_id($_POST['profile_id']);
    $profile->date_nepali = $_POST['date_nepali'];
    $profile->date_english = DateNepToEng($_POST['date_nepali']);
    $profile_id = $profile->save();
    $edit_details = PrastabDetails::find_by_profile_id($_POST['profile_id']);
    foreach($edit_details as $edit_detail)
    {
        $edit_detail->delete();
    }
    for($i=0; $i<count($_POST['description']);$i++)
    {
        $details = new PrastabDetails;
        $details->sno_taken = $i+1;
        $details->description = $_POST['description'][$i];
        $details->decesion = $_POST['decesion'][$i];
        $details->profile_id = $_POST['profile_id'];
        $details->save();
    }
    
    $edit_details = MemberInvited::find_by_profile_id_type_id($_POST['profile_id'],1);
    foreach($edit_details as $edit_detail)
    {
        $edit_detail->delete();
    }
    for($i=0; $i<count($_POST['member']);$i++)
    {
        $details = new MemberInvited;
//        $details->sno_taken = $i+1;
        $details->member = $_POST['member'][$i];
        $details->pad = $_POST['pad'][$i];
        $details->profile_id = $_POST['profile_id'];
        $details->type       = 1;
        $details->save();
    }
   echo alertBox("कार्य सफल", "prastab_view.php");
}
$profile_selected = PrastabProfile::find_by_id((int) $_GET['id']);
$details_selected = PrastabDetails::find_by_profile_id((int) $_GET['id']);
$members_selected = MemberInvited::find_by_profile_id_type_id($profile_selected->id,1);
?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title><?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">प्रस्ताव |  <a href="kharid_ikai.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<span class="myMessage"><?php echo $message;?></span>
                                        <form method="post" enctype="multipart/form-data" >
                                            <span>मिति : <input type="text" name="date_nepali" id="nepaliDate3" required value="<?=$profile_selected->date_nepali?>" /></span>
                                            <table class="table table-bordered table-hover table-striped">
                                            <tr  style="background-color: #9999ff">
                                                <td colspan="4" style="text-align: center"><h5>आमन्त्रित सदस्यहरु</h5></td>
                                            </tr>
                                            <?php $counter = 1; foreach($members_selected as $member ): ?>
                                            <tr class="remove_member_row">
                                                <td><?=convertedcit($counter)?></td>
                                                <td>
                                                    नाम: <input type="text" value="<?=$member->member?>" required name="member[]" />
                                                </td>
                                                <td>पद : <input type="text" value="<?=$member->pad?>" required name="pad[]" /></td>
                                                <td><?php if($counter==1): ?><span class="btn" id="btn_add_member">थप्नुहोस</span> | <span class="btn" id="btn_deduct_member">हटाउनुहोस</span><?php endif; ?> </td>   
                                           </tr>
                                           <?php $counter++; endforeach; ?>
                                            <tbody id="member-add">
                                                
                                            </tbody>
                                         </table>
                                            <div class="myspacer"></div>
                                            <div class="myspacer"></div>
                                            <table class="table table-bordered table-hover table-striped">
                                                <tr style="background-color: #9999ff">
                                                <td colspan="4" style="text-align: center"><h5>प्रस्ताब तथा निर्णयहरु</h5></td>
                                            </tr>
                                            <?php foreach($details_selected as $detail): ?>
                                            <tr class="remove_prastab_row">
                                                <td>प्रस्ताव नं <?=convertedcit($detail->sno_taken)?></td>
                                                <td>
                                                    <textarea required rows="5" cols="75" name="description[]"><?=$detail->description?></textarea>
                                                </td>
                                                <td>निर्णय नं <?=convertedcit(1)?></td>
                                                <td><textarea required rows="5" cols="75" name="decesion[]"><?=$detail->decesion?></textarea></td>   
                                           </tr>
                                           <?php endforeach; ?>
                                            <tbody id="prastab-add">
                                                
                                            </tbody>
                                         </table>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><span class="btn" id="btn_add_prastab">थप्नुहोस</span></td>
                                                <td><span class="btn" id="btn_deduct_prastab">हटाउनुहोस</span> </td>
                                                <td><input type="submit" class="btn" name="submit" value="सेभ गर्नुहोस्" /></td>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="profile_id" value="<?=(int) $_GET['id']?>" />
                                        </form>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>