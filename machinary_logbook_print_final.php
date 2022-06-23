<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $current_id = Fiscalyear::find_current_id();
    $fiscal = Fiscalyear::find_by_id($current_id);
    $enlist_result= Machinarylogprofile::find_by_enlist_id($_GET['enlist_id']);
     $sql = "select * from machinary_log_details as a left join machinary_log_profile as b on b.id=a.log_id where b.enlist_id=".$_GET['enlist_id']." and b.miti_english='".$_GET['date']."'" ;
    $result_set = $database->query($sql);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>सवारीको लगबुक :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
              <div class="printPage">
                                    <div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate">मलेप फारम नं २ </div>
                                    <h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
                                    <h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
                                    <div class="myspacer"></div>
                                    <div class="subjectBold letter_subject">सवारीको लगबुक</div>
                                    <div class="printContent">
                                        <div class="mydate"><b>मिति. <?=convertedcit(DateEngToNep($_GET['date']))?> </b></div>
                                           <div class="chalanino"> <b> आर्थिक वर्ष : <?=  convertedcit($fiscal->year)?> </b></div>
                                            <div class="banktextdetails">
                                                <table class="table table-bordered myWidth100">
                                                    <tr>
                                                        <td class=""><b> ड्राइभरको नाम : </b> </td>
                                                        <td><?=get_name_by_type_and_enlist_id($enlist_result->type,$enlist_result->enlist_id)?></td>
                                                        <td> <b>सवारी नं:</b> </td>
                                                        <td><?=$enlist_result->machine_no?></td>
                                                        <td><b>सवारीको किसिम</b> </td>
                                                        <td><?=$enlist_result->machine_type?></td>
                                                    </tr>
                                                </table><br>
                                                   <table class="table table-bordered myWidth100">
                                                       <tr>
                                                            <th class="myCenter" rowspan="2">क्र.स.</th> 
                                                            <th class="myWidth5 myCenter" rowspan="2">मिती </th>
                                                            <th class="myCenter" colspan="2">ठाउँ</th>
                                                            <th class="myCenter" colspan="2" >किलो मिटर</th>
                                                            <th class="myCenter" rowspan="2">जम्मा </th>
                                                            <th class="myCenter" rowspan="2">पेट्रोल/डिजल (लिटर)</th>
                                                            <th class="myCenter" rowspan="2">मोबिल (लिटर)</th>
                                                            <th class="myCenter" rowspan="2">ग्रीज </th>
                                                            <th class="myCenter" rowspan="2">गेयर आयल</th>
                                                        </tr>
                                                        <tr>
                                                            <td>बाट </td>
                                                            <td>सम्म</td>
                                                             <td>देखि</td>
                                                            <td>सम्म</td>
                                                        </tr>    
                                                     <?php  $i = 1;while($data= mysqli_fetch_object($result_set)):?> 
                                                     
                                                      <tr>
                                                          <td><?=convertedcit($i)?></td>
                                                          <td><?=convertedcit($data->log_miti)?></td>
                                                          <td><?=$data->place_from?></td>
                                                          <td><?=$data->place_to?></td>
                                                          <td><?=convertedcit(placeholder($data->km_to))?></td>
                                                          <td><?=convertedcit(placeholder($data->km_from))?></td>
                                                          <td><?=convertedcit(placeholder($data->total))?></td>
                                                          <td><?=convertedcit($data->petrol)?></td>
                                                          <td><?=convertedcit($data->mobil)?></td>
                                                          <td><?=convertedcit($data->grease)?></td>
                                                          <td><?=convertedcit($data->oil)?></td>
                                                      </tr>
                                                     <?php $i++; 
                                                     endwhile;?>
                                                  </table>
                                                  <div class="banktextdetails">
   <table class="table borderless table-responsive">
	<tr>
    	<td>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td>शाखा प्रमुखको दस्तखत	:</td>
        <td>&nbsp;</td>
        <td>कार्यालय प्रमुखको दस्तखत:</td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति</td>
	  <td></td>
	  <td>मिति</td>
	  <td></td>
      <td>मिति</td>
	  <td></td>
  </tr>
</table>
</div> 
                                            </div>
                                </div><!-- print page ends -->
                            </div>
                                          <?php // }?>			
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
