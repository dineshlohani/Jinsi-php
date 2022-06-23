<?php require_once("includes/initialize.php");
$date_sql="select distinct miti_english from machinary_log_profile where enlist_id=".$_GET['enlist_id']." order by miti_english DESC";
$date_result = Machinarylogprofile::find_by_sql($date_sql);
//print_r($date_result);exit;
if(isset($_GET['date']))
{
    $current_id = Fiscalyear::find_current_id();
    $fiscal = Fiscalyear::find_by_id($current_id);
    $enlist_result= Machinarylogprofile::find_by_enlist_id($_GET['enlist_id']);
     $sql = "select * from machinary_log_details as a left join machinary_log_profile as b on b.id=a.log_id where b.enlist_id=".$_GET['enlist_id']." and b.miti_english='".$_GET['date']."'" ;
    $result_set = $database->query($sql);
}
?>
    <?php include("menuincludes/header.php"); ?>
    <!-- js ends -->
<title>सवारीको लगबुक :: <?php echo SITE_SUBHEADING;?></title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
        <div id="body_wrap_inner"> 
            <div class="">
                <div class="">
                    <div class="maincontent">
                        <h2 class="headinguserprofile">सवारीको लगबुक  | <a href="machinary_logbook_details.php" class="btn">पछि जानुहोस</a></h2>
                        
                        <div class="OurContentRight2">
                                <table class="table table-bordered myWidth100">
                                    <tr>
                                        <th>सि नं </th>
                                        <th>मिती </th>
                                        <th class="myCenter"> ड्राइभरको नाम   :</th>
                                        <th class="myCenter">सवारी नं:</th>
                                        <th class="myCenter">सवारीको किसिम</th>    
                                        <th>पुरा विवरण </th>
                                    </tr>
                                    <?php $i=1;foreach($date_result as $data):
                                         $pro = Machinarylogprofile::find_by_enlist_id($_GET['enlist_id']);
                                    $driver_name = get_name_by_type_and_enlist_id($pro->type,$pro->enlist_id);
                                    ?>
                                    <tr>
                                        <td><?=convertedcit($i)?></td>
                                        <td><?=convertedcit(DateEngToNep($data->miti_english))?></td>
                                        <td><?=$driver_name?></td>
                                        <td><?=$pro->machine_no?></td>
                                        <td><?=$pro->machine_type?></td>
                                        <td><a href="machinary_logbook_print.php?enlist_id=<?=$_GET['enlist_id']?>& date=<?=$data->miti_english?>" class="btn">खोज्नुहोस </a></td>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                </table>
                            
                            <?php if(isset($_GET['date'])):?>
                            <div class="userprofiletable mySearchBox">
                                <div class="myPrint"><a href="machinary_logbook_print_final.php?enlist_id=<?=$_GET['enlist_id']?>& date=<?=$data->miti_english?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
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
                      </div>
                            <?php endif;?>
                    </div><!-- main menu ends -->
                </div>
             </div>   
        </div><!-- top wrap ends -->
<?php include("menuincludes/footer.php"); ?>

