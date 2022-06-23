<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}

$profile = PrastabProfile::find_by_id((int) $_GET['id']);
$profile_details = PrastabDetails::find_by_profile_id($profile->id);
$member_details  = MemberInvited::find_by_profile_id_type_id($profile->id,1); 
$kharid_ikai_profile = KharidIkaiProfile::find_current();
$kharid_ikai_details = KharidIkaiDetails::find_by_profile_id($kharid_ikai_profile->id);

$sanyojak = getSanojakKhardIkai($kharid_ikai_profile->id,1);
//echo $sanyojak; exit;
//$evaluation_samiti_profile = EvaluationSamitiProfile::find_current();
//$evaluation_samiti_details = EvaluationSamitiDetails::find_by_profile_id($kharid_ikai_profile->id);
$fiscal_id = Fiscalyear::find_current_id();
$fiscal_selected = Fiscalyear::find_by_id($fiscal_id);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title> <?php echo SITE_SUBHEADING;?></title>



<body>
    <div class="myPrintFinals" > 
    	<div class="userprofiletable">
               <div class="printPage">

                                                                            <div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                            <div style="display:none" class="mydate">म.ले.प. फाराम नं: ५१</div>
                                                                            <h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                                                             <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
                                                                            <h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
                                                                            <div class="myspacer"></div>
                                                                            <div class="subjectBold letter_subject">खरिद इकाई बैठक खाता</div>
                                                                            <div class="printContent">
                                                                                    <div class="chalanino"></div>
                                                                                        <div class="patrano"></div>
                                                                                        <div class="mydate"><b>आर्थिक वर्ष :-<?php echo convertedcit($fiscal_selected->year); ?> </b></div><br>
                                                                                    <div class="mydate"><b>बैठक संख्या :</b><b><?=convertedcit($profile->id)?></b></div>
                                                                                    <div class="chalanino"></div>
                                                                                    <div class="myspacer"></div>
                                                                                    <div class="myspacer"></div>
                                                                                    <div class="banktextdetailss">
                                                                                        <p>
                                                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  आज मिति <?=convertedcit($profile->date_nepali)?> गते यस <?=SITE_NAME?> खरिद इकाई संयोजक श्री <?=$sanyojak?> को अधक्ष्यतामा बसेको बैठक मा देहाय बमोजिमको उपस्थिथि रह्यो | 
                                                                                           <br/>तपसिल :
                                                                                        </p>
                                                                                        <div class="myspacer"></div>
                                                                                         <table class="table tableBorder">
                                                                                             <tr>
                                                                                                 <th class="myCenter">सि नं</th>
                                                                                                 <th class="myCenter">नाम</th>
                                                                                                 <th class="myCenter">पद</th>
                                                                                                 <th class="myCenter">दस्तखत</th>
                                                                                             </tr>
                                                                                             <?php $counter = 1; foreach($kharid_ikai_details as $detail): 
                                                                                                    $worker = Workers::find_by_id($detail->worker_id);
                                                                                                    $pad    = Pad::find_by_id($detail->pad_id);
                                                                                                 ?>
                                                                                                    <td><?=convertedcit($counter)?></td>
                                                                                                    <td><?=$worker->name?></td>
                                                                                                    <td><?=$pad->name?></td>
                                                                                                    <td></td>
                                                                                         </tr>
                                                                                             <?php endforeach; ?>
                                                                                           </table>
                                                                                        <div class="myspacer"></div>
                                                                                        <div class="myspacer"></div>
                                                                                        <table class="table tableBorder">
                                                                                            <tr>
                                                                                                <td  colspan="4" style="text-align: center"><b> आमन्त्रित सदस्यहरु </b></td>
                                                                                        </tr>
                                                                                            <tr>
                                                                                                <th class="myCenter">सि. नं .</th>
                                                                                                <th class="myCenter">नाम</th>
                                                                                                <th class="myCenter">पद</th>
                                                                                                <th class="myCenter">दस्तखत</th>
                                                                                            </tr>
                                                                                            <?php $counter=1; foreach($member_details as $member): ?>
                                                                                                <tr>
                                                                                                    <td><?=convertedcit($counter)?></td>
                                                                                                    <td><?=$member->member?></td>
                                                                                                    <td><?=$member->pad?></td>
                                                                                                    <td>&nbsp;</td>
                                                                                                </tr>
                                                                                            <?php $counter++; endforeach; ?>
                                                                                        </table>
                                                                                        <div class="myspacer"></div>
                                                                                        <div class="myspacer"></div>
                                                                                        <table class="table tableBorder">
                                                                                            <tr>
                                                                                                <td  colspan="3"style="text-align: center"><b> प्रस्ताब तथा निर्णयहरु </b></td>
                                                                                            </tr>
                                                                                            <?php foreach($profile_details as $detail): ?>
                                                                                            <tr>
                                                                                                <td>प्रस्ताब नं <?=convertedcit($detail->sno_taken)?> :</td>
                                                                                                <td><?=$detail->description?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>निर्णय : </td>
                                                                                                <td><?=$detail->decesion?></td>
                                                                                            </tr>
                                                                                            <?php endforeach; ?>
                                                                                        </table>
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                    <br>
    <div class="banktextdetails">
<!--       <table class="table borderless sign_table">
            <tr>
            <td>माग गर्नेको दस्तखत :- </td>
            <td>&nbsp;</td>
            <td>क. बजारबाट खरिद गरिदिनु ।	</td>
            <td>&nbsp;</td>
        </tr>
            <tr>
              <td>नाम :- </td>
              <td></td>
              <td>ख. मौज्दातबाट दिनु ।</td>
              <td></td>
      </tr>
            <tr>
              <td>मिति :- </td>
              <td></td>
              <td>आदेश दिनेको दस्तखत :- </td>
              <td></td>
      </tr>
            <tr>
                <td>प्रयोजन :-  <b><?= $dep_selected->name ?>  को लागि<b> </td>
              <td></td>
              <td>मिति :- </td>
              <td></td>
      </tr>
            <tr>
              <td>जिन्सी खातामा चढाउनेको दस्तखत :- </td>
              <td></td>

      <td >मालसामान बुझिलिनेको दस्तखत :- </td>

              <td></td>
      </tr>
            <tr>
              <td>मिति :- </td>
              <td></td>
              <td>मिति :-</td>
              <td></td>
      </tr>
    </table>-->
    </div> 
                             
                                                                                    <div class="myspacer"></div>
                                                                            </div>

                                </div><!-- print page ends -->	
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
