<?php require_once("includes/initialize.php"); 
  
if(isset($_GET['submit']) || isset($_GET['property_id']))
{
    $data= Bhadaliyekodetails::find_by_property_id($_GET['property_id']);
     $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
    if(empty($data))
{
    echo alertBox("निम्न खाता नं भेटिएन...कृपया पुनः प्रयास गर्नुहोला...","bhadaliyeko_search.php"); 
}

}
  $bhada_result=  Bhadaliyekodetails::find_all();
?>
<?php 
if(!empty($data->rent_unit_id))
{
    $rent = Rentunit::getName($data->rent_unit_id);

}
else
{
    $rent = "";
}
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडामा लिएको मेसिन औजारको अभिलेख किताब खोज्नुहोस</title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">भाडामा लिएको मेसिन औजारको अभिलेख किताब खोज्नुहोस | <a href="dashboard_bhadaliyeko.php" class="btn">पछाडी  जानुहोस </a> </h2>
                    
                    <div class="OurContentFull">
                    	<h2>भाडामा लिएको मेसिन औजारको अभिलेख किताब खोज्नुहोस</h2>
                        <div class="userprofiletable">
                            <form method="post">
                        	<table class="table table-responsive bordereless search_table">
                                          <tr>
                                          	<td>भाडामा लिएको मेसिन औजारको अभिलेख किताब खोज्नुहोस : <input class="fill_height" type="text" name="property_id" /> <input type="submit" name="submit" value="खोज्नुहोस" class="btn search_btn"/></td>
                                          </tr>
                                </table>
                            </form>
                            <?php if(!isset($_GET['submit']) && !isset($_GET['property_id'])):?>
                            <table class="table table-responsive bordereless search_table">
                                <tr>
                                    <th>सम्पतीको अभिलेख खाता नं</th>
                                    <th>मिती </th>
                                </tr>
                                <?php foreach($bhada_result as $data):?>
                                <tr>
                                    <td><?=convertedcit($data->id)?></td>
                                    <td><?=convertedcit($data->miti)?></td>
                                    <td><a href="bhadaliyeko_search.php?property_id=<?=$data->id?>" class="btn">खोज्नुहोस</a></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <?php endif;?>
                                <?php if(isset($_GET['submit']) || isset($_GET['property_id'])):?>
                            <div class="myPrint"><a href="bhadaliyeko_search_print.php?property_id=<?php echo $_GET['property_id'];?>" target="_blank">प्रिन्ट गर्नुहोस</a></div><div class="myspacer"></div>
                                          <div class="printPage">
<div class="mydate">म.ले.प. फाराम नं ५६	</div>
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                                                        

									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">भाडामा लिएको मेसिन औजारको अभिलेख किताब</div>
									<div class="printContent">
										<div class="chalanino">आर्थिक वर्ष :<?php echo convertedcit($fiscal->year);?> </div>
                                        <div class="chalanino">भाडामा लिएको मेसिन औजारको नाम	:<?php echo $data->rent_item_name;?></div>
                                       
                                                                               
										<div class="bankdetails">
										     <table  class="table table-bordered table-responsive">
                                                  <tr>
                                                  	<th rowspan="2">क्र.स.</th>
                                                    <th rowspan="2">मिति</th>
                                                    <th colspan="2">भाडामा दिने व्यक्त्ती वा कार्यालयको</th>
                                                    <th colspan="2">भाडामा लिएको</th>
                                                    <th colspan="2">भाडा अवधि</th>
                                                    <th colspan="2">इकाई अवधि</th>
                                                    <th rowspan="2">प्रति इकाई  भाडा दर</th>
                                                    <th rowspan="2">जम्मा भाडा रकम</th>
                                                    <th colspan="2">फिर्ता गरेको</th>
                                                    <th rowspan="2">कैफियत</th>
                                                  </tr>
                                                  <tr>
                                                  	<th>नाम</th>
                                                    <th>ठेगाना</th>
                                                    <th>संख्या</th>
                                                    <th> स्वीकृत आदेश मिति</th>
                                                    <th>देखि</th>
                                                    <th>सम्म</th>
                                                    <th>इकाई </th>
                                                    <th>अवधि</th>
                                                    <th>मिति</th>
                                                    <th>फिर्ता गर्ने आदेश मिति</th>
                                                  </tr>
                                                  <tr>
                                                   <td><?php echo convertedcit(1);?></td>
                                                    <td><?php echo convertedcit($data->miti);?></td>
                                                    <td><?php echo $data->org_name; ?></td>
                                                     <td><?php echo $data->org_address; ?></td>
                                                    <td><?php echo convertedcit($data->item_count);?></td>
                                                    <td><?php echo convertedcit($data->approved_date);?></td>
                                                    <td><?php echo convertedcit($data->start_date);?></td>
                                                    <td><?php echo convertedcit($data->end_date);?></td>
                                                    <td><?=$rent?></td>
                                                    <td><?php echo convertedcit($data->rent_period);?></td>
                                                    <td><?php echo convertedcit(placeholder($data->per_unit_rent));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->total_rent_amount));?></td>
                                                    <td><?php echo convertedcit($data->return_date);?></td>
                                                    <td><?php echo convertedcit($data->item_return_order_date);?></td>
                                                    <td></td>
                                                  </tr>
                                                </table>

                                             

									  </div>
<div class="banktextdetails">
   <table class="table borderless table-responsive">
	<tr>
    	<td><br>फाँटवालाको दस्तखत :</td>
        <td>&nbsp;</td>
        <td><br>शाखा प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
        <td><br>कार्यालय प्रमुखको दस्तखत : </td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :-</td>
	  <td> &nbsp; </td>
	  <td>मिति :-</td>
	  <td> &nbsp; </td>
      <td>मिति :-</td>
	  <td> &nbsp;</td>
  </tr>
</table>
</div> 
										
										<div class="myspacer"></div><?php endif;?>
									</div>
                                
                            </div><!-- print page ends -->
                                        

                                        
                                         
                                        
                                              
                                
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

