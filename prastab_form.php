<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in())
{
    redirect_to("logout.php");
}
if(isset($_POST['submit']))
{
//    echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
    $profile = new PrastabProfile;
    $profile->date_nepali = $_POST['date_nepali'];
    $profile->date_english = DateNepToEng($_POST['date_nepali']);
    $profile_id = $profile->save();
    for($i=0; $i<count($_POST['description']);$i++)
    {
        $details = new PrastabDetails;
        $details->sno_taken = $i+1;
        $details->description = $_POST['description'][$i];
        $details->decesion = $_POST['decesion'][$i];
        $details->profile_id = $profile_id;
        $details->save();
    }
    for($i=0; $i<count($_POST['member']);$i++)
    {
        $details = new MemberInvited;
//        $details->sno_taken = $i+1;
        $details->member = $_POST['member'][$i];
        $details->pad = $_POST['pad'][$i];
        $details->profile_id = $profile_id;
        $details->type       = 1;
        $details->save();
    }
   echo alertBox("कार्य सफल", "prastab_view.php");
}
?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title><?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">प्रस्ताव / निर्णय |  <a href="prastab_view.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<span class="myMessage"><?php echo $message;?></span>
                                        <form method="post" enctype="multipart/form-data" >
                                        <span>मिति : <input type="text" name="date_nepali" id="nepaliDate3" /></span>
                                        <table class="table table-bordered table-hover table-striped">
                                            <tr  style="background-color: #9999ff">
                                                <td colspan="4" style="text-align: center"><h5>आमन्त्रित सदस्यहरु</h5></td>
                                            </tr>
                                            <tr class="remove_member_row">
                                                <td><?=convertedcit(1)?></td>
                                                <td>
                                                    नाम: <input type="text" required name="member[]" />
                                                </td>
                                                <td>पद : <input type="text" required name="pad[]" /></td>
                                                <td><span class="btn" id="btn_add_member">थप्नुहोस</span> | <span class="btn" id="btn_deduct_member">हटाउनुहोस</span> </td>   
                                           </tr>
                                            <tbody id="member-add">
                                                
                                            </tbody>
                                         </table>
                                        <div class="myspacer"></div>
                                        <div class="myspacer"></div>
                                        
                                        </table>
                                        <table class="table table-bordered table-hover table-striped">
                                            <tr style="background-color: #9999ff">
                                                <td colspan="4" style="text-align: center"><h5>प्रस्ताब तथा निर्णयहरु</h5></td>
                                            </tr>
                                            <tr class="remove_prastab_row">
                                                <td>प्रस्ताव नं <?=convertedcit(1)?></td>
                                                <td>
                                                    <textarea required rows="5" cols="75" name="description[]"></textarea>
                                                </td>
                                                <td>निर्णय नं <?=convertedcit(1)?></td>
                                                <td><textarea required rows="5" cols="75" name="decesion[]"></textarea></td>   
                                           </tr>
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
                                        </form>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>