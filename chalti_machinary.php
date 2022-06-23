<?php require_once("includes/initialize.php");
$date_sql="select distinct miti_english from machinary_profile where machine_id=".$_GET['machine_id']." order by miti_english DESC";
$date_result = MachinarydetailsProfile::find_by_sql($date_sql);
//print_r($date_result);exit;
if(isset($_GET['date']))
{
    $current_id = Fiscalyear::find_current_id();
    $fiscal = Fiscalyear::find_by_id($current_id);
    $profile = Machinary::find_by_id($_GET['machine_id']);
    $machine_profile = MachinarydetailsProfile::find_by_machinary_id_date($_GET['machine_id'],$_GET['date']);
    $sql = "select * from machinary_details as a left join machinary_profile as b on b.id=a.machinary_id where b.machine_id=".$_GET['machine_id']." and b.miti_english='".$_GET['date']."'" ;
    $result_set = $database->query($sql);
}
?>
    <?php include("menuincludes/header.php"); ?>
    <!-- js ends -->
<title>चल्ती मेशिन वा सबारीको किताब :: <?php echo SITE_SUBHEADING;?></title>

   

<body>
    <?php include("menuincludes/topwrap.php"); ?>
        <div id="body_wrap_inner"> 
            <div class="">
                <div class="">
                    <div class="maincontent">
                        <h2 class="headinguserprofile">चल्ती मेशिन वा सबारीको किताब | <a href="machinary_details_view.php" class="btn">पछि जानुहोस</a></h2>
                        
                        <div class="OurContentRight2">
                                <table class="table table-bordered myWidth100">
                                    <tr>
                                        <th>सि नं </th>
                                        <th>मिती </th>
                                        <th> चल्ती मेशिन वा सबारीको नाम</th>
                                        <th>सबारी दर्ता नं</th>
                                         <td>मोडल नं </td>
                                        <th>पुरा विवरण </th>
                                    </tr>
                                    <?php $i=1;foreach($date_result as $data):
                                         $pro = Machinary::find_by_id($_GET['machine_id']);?>
                                    <tr>
                                        <td><?=convertedcit($i)?></td>
                                        <td><?=convertedcit(DateEngToNep($data->miti_english))?></td>
                                        <td><?=$pro->name?></td>
                                        <td><?=$pro->darta_no?></td>
                                        <td><?=$pro->model?></td>
                                        <td><a href="chalti_machinary.php?machine_id=<?=$_GET['machine_id']?>& date=<?=$data->miti_english?>" class="btn">खोज्नुहोस </a></td>
                                    </tr>
                                    <?php $i++; endforeach;?>
                                </table>
                            
                            <?php if(isset($_GET['date'])):?>
                            <div class="userprofiletable mySearchBox">
                                <div class="myPrint"><a href="chalti_machinary_print.php?machine_id=<?=$_GET['machine_id']  ?>& date=<?=$_GET['date']?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                <div class="printPage">
                                    <div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate">मलेप फारम नं २ </div>
                                    <h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h1 class="margin1em letter_title_two"><?=SITE_LOCATION?></h1>
                                    <h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
                                    <div class="myspacer"></div>
                                    <div class="subjectBold letter_subject">चल्ती मेशिन वा सबारीको मर्मत किताब </div>
                                    <div class="printContent">
                                        <div class="mydate"><b>मिति. <?=convertedcit(DateEngToNep($_GET['date']))?> </b></div>
                                           <div class="chalanino"> <b> आर्थिक वर्ष : <?=  convertedcit($fiscal->year)?> </b></div>
                                            <div class="banktextdetails">
                                                <table class="table table-bordered myWidth100">
                                                    <tr>
                                                        <td class=""><b> चल्ती मेशिन वा सबारीको नाम </b> </td>
                                                        <td><?=$profile->name?></td>
                                                        <td> <b>सबारी दर्ता नं </b> </td>
                                                        <td><?=convertedcit($profile->darta_no)?></td>
                                                        <td><b>ईन्जिन नं </b> </td>
                                                        <td><?=$profile->engine_no?></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td><b> सवारीको बजन </b> </td>
                                                        <td><?=$profile->weight?></td>
                                                        <td> <b>किसम </b> </td>
                                                        <td><?=$profile->type?></td>
                                                        <td> <b>जिन्सी खाता पाना नं </b> </td>
                                                        <td><?=$profile->jinsi_id?></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td><b> उतपादन  गर्ने देश </b> </td>
                                                        <td><?=$profile->made_in?></td>                                  
                                                        <td><b> अन्य विवरण </b> </td>
                                                        <td><?=$profile->detail?></td>
                                                        <td><b> च्यासिस नं </b></td>
                                                        <td><?=$profile->chesis_no?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b> मोडल नं </b></td>
                                                        <td><?=$profile->model?></td>
                                                        <td> <b>खरिद मोल </b></td>
                                                        <td><?=convertedcit(placeholder($profile->price))?></td>
                                                        <td><b> सवारी खरिद मिति </b></td>
                                                        <td><?=convertedcit($profile->miti)?></td>
                                                    </tr>
                                                </table><br>
<!--                                                 <center> <b> पेट्रोल मोबिल ग्रिज आदीको मोल तथा परिमाण</b></center>
                                                 <table class="table table-bordered myWidth100">
                                                     <tr>
                                                         <td class="myCenter myBold">मिति </td>
                                                         <td class="myCenter myBold">चलेको माईल (कि.मि)</td>
                                                         <td class="myCenter myBold">ईन्धन खर्च परिमाण (लिटर)</td>
                                                         <td class="myCenter myBold">मोल (रकम रु )</td>
                                                         <td class="myCenter myBold"> कैफियत </td>
                                                     </tr>
                                                     <?php foreach($machine_profile as $data):?>
                                                     <tr>
                                                         <td><?=convertedcit($data->miti)?></td>
                                                         <td><?=convertedcit($data->total_distance+0)?></td>
                                                         <td><?=convertedcit($data->quantity)?></td>
                                                         <td><?= convertedcit(placeholder(floatval($data->total_amount)))?></td>
                                                         <td></td>
                                                         
                                                     </tr>
                                                     <?php endforeach;?>
                                                  </table>-->
                                                  <center> <b> फेरिएको सामान तथा मर्मतको विवरण र मोल </b></center>
                                                  <table class="table table-bordered myWidth100">
                                                       <tr>
                                                        <th>क्र.स.</th>
                                                        <th>सामानको  नाम </th>
                                                       <th>इकाइ</th>
                                                       <th>परिमाण</th>
                                                       <th>दर</th>
                                                       <th>जम्मा</th>
                                                       </tr>
                                                     <?php  $array = array();$i=1;while($data= mysqli_fetch_object($result_set)):
//    print_r($data);exit;
                                                             array_push($array, $data);
                                                         if($data->category==1)
                                                         {
                                                             $name_result = Spentitem::find_by_id($data->item_id);
                                                         }
                                                         else
                                                         {
                                                             $name_result = Notspentitem::find_by_id($data->item_id);
                                                         }
                                                         ?>
                                                     
                                                       <tr>
                                                          <td><?=convertedcit($i)?></td>
                                                          <td><?=$name_result->name?></td>
                                                          <td><?=  Unit::getName($name_result->unit_id)?></td>
                                                          <td><?=convertedcit($data->item_amount+0)?></td>
                                                          <td><?=convertedcit($data->item_rate+0)?></td>
                                                          <td><?=convertedcit($data->item_amount* $data->item_rate +0)?></td>
                                                          
                                                      </tr>
                                                     <?php $i++; 
                                                    
                                                     endwhile;?>
                                                    <tr>
                                                         <td colspan="5">जम्मा रु</td>
                                                         <td><?=convertedcit(placeholder($array[0]->grand_total+0))?></td>
                                                     </tr>
                                                    <tr>
                                                        <td colspan="5">भ्याट  रकम रु</td>
                                                        <td><?=convertedcit(placeholder($array[0]->vat_amount+0))?></td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="5">कुल जम्मा रु</td>
                                                        <td><?=convertedcit(placeholder($array[0]->sum_amount+0))?></td>
                                                    </tr>
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

