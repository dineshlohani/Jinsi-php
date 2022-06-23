<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $data=  Bhadadiyekodetails::find_by_property_id($_GET['property_id']);
 $result=  Bhadadiyekobasicinfo::find_by_id($_GET['property_id']);
 $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_id($fiscal_id);
if(!empty($data->rent_unit_id))
 {
     $rent_unit =Rentunit::getName($data->rent_unit_id);
 }
 else
 {
     $rent_unit="";
 }
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>भाडामा दिएको सम्पतीको अभिलेख खाता खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
<div class="mydate">म.ले.प. फाराम नं ५५</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">भाडामा दिएको सम्पतीको अभिलेख खाता</div>
									<div class="printContent">
										<div class="chalanino">आर्थिक वर्ष :<?php echo convertedcit($fiscal->year);?> </div>
                                        <div class="chalanino">भाडामा दिएको सम्पतीको नाम :<?php echo $result->property_name;?></div>
                                        <div class="chalanino">मोडल नं: <?php echo convertedcit($result->property_model_no);?></div>
                                        <div class="chalanino">सम्पतीको वर्गिकरण संकेत नं :<?php echo convertedcit($result->property_category_id);?></div>
                                        <div class="chalanino">जिन्सी खाता पाना नं:<?php echo convertedcit($result->jinsi_id);?></div>
										
                                                                               
										<div class="bankdetails">
										     <table  class="table table-bordered myWidth100">
                                                  
                                                  <tr>
                                                  	<th rowspan="2" class="myCenter">क्र.स.</th>
                                                    <th rowspan="2" class="myCenter">मिति</th>
                                                    <th colspan="2" class="myCenter">भाडामा लिने व्यक्ति वा कार्यालयको</th>
                                                    <th rowspan="2" class="myCenter">संख्या</th>
                                                    <th rowspan="2" class="myCenter">भाडा दिने स्वीकृत आदेश मिति</th>
                                                    <th colspan="2" class="myCenter">भाडा अवधि</th>
                                                    <th colspan="2" class="myCenter">इकाई अवधि</th>
                                                    <th rowspan="2" class="myCenter">प्रति इकाई अवधि भाडा दर</th>
                                                    <th rowspan="2" class="myCenter">जम्मा भाडा रकम</th>
                                                    <th rowspan="2" class="myCenter">रसिद नं</th>
                                                    <th rowspan="2" class="myCenter">फिर्ता प्राप्त मिति</th>
                                                    <th rowspan="2" class="myCenter">दाखिला मिति</th>
                                                    <th rowspan="2" class="myCenter">कैफियत</th>
                                                  </tr>
                                                  <tr>
                                                  	<th class="myCenter">नाम</th>
                                                    <th class="myCenter">ठेगाना</th>
                                                    <th class="myCenter">देखि</th>
                                                    <th class="myCenter">सम्म</th>
                                                    <th class="myCenter">इकाई </th>
                                                    <th class="myCenter">अवधि</th>
                                                  </tr>
                                                  <tr>
                                                      <td><?php echo convertedcit(1);?></td>
                                                    <td><?php echo convertedcit($data->approved_date);?></td>
                                                    <td><?php echo $data->customer_name; ?></td>
                                                     <td><?php echo $data->customer_address; ?></td>
                                                    <td><?php echo convertedcit($data->count);?></td>
                                                    <td><?php echo convertedcit($data->approved_date);?></td>
                                                    <td><?php echo convertedcit($data->start_date);?></td>
                                                    <td><?php echo convertedcit($data->end_date);?></td>
                                                     <td><?=$rent_unit?></td>
                                                    <td><?php echo convertedcit($data->period);?></td>
                                                    <td><?php echo convertedcit(placeholder($data->period_per_unit_price));?></td>
                                                    <td><?php echo convertedcit(placeholder($data->total_rent_amount));?></td>
                                                    <td><?php echo convertedcit($data->rashid_no);?></td>
                                                    <td><?php echo convertedcit($data->return_date);?></td>
                                                    <td><?php echo convertedcit($data->dakhila_date);?></td>
                                                    <td></td>
                                                   
                                                  </tr>
                                                </table>

                                             

									  </div>
<div class="banktextdetails">
   <table class="table borderless myWidth">
	<tr>
    	<td><br>फाँटवालाको दस्तखत :<br><br></td>
        <td>&nbsp;</td>
        <td><br>शाखा प्रमुखको दस्तखत	:<br><br></td>
        <td>&nbsp;</td>
        <td><br>कार्यालय प्रमुखको दस्तखत : <br><br></td>
        <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>मिति :- </td>
	  <td></td>
	  <td>मिति :- </td>
	  <td></td>
      <td>मिति :- </td>
	  <td></td>
  </tr>
</table>
</div> 
										
										<div class="myspacer"></div>
									</div>
				</div>				
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
