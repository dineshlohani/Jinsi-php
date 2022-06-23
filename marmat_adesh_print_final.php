<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
$adesh_id=$_GET['adesh_no'];
$profile = Marmatadeshprofile::find_by_id($adesh_id);
$details= Marmatadesh:: find_by_adesh_id($adesh_id);
$fiscal_id= Fiscalyear::find_current_id();
 $fiscal_year = Fiscalyear::find_by_id($fiscal_id);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>मर्मत आदेश :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
                 <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
                                    <div class="mydate">म.ले.प. फाराम नं: ४५</div>  <br>
                                    <div class="mydate">मर्मत आदेश नं:  <?=convertedcit($_GET['adesh_no'])?></div>
				    <h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
                                    <h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">मर्मत आदेश</div>
									<div class="printContent">
                                        <div class="chalanino">श्रीमान् प्रमुख प्रशासकिय आधिकृत ज्यू <br>कालिका नगरपालिका , <br> चितवन </div><br>
                                        <div class="">देहयका समानहरु मर्मत गर्न आवश्यक देखिएकाले सो को अनुमानित लागत समेत पेश गरेको छु । सो समानहरु मर्मतको आदेश पाँउ । </div>
                                        <br>
                                        <center> <b> तपशिल </b> </center>
									    <table class="table table-responsive table-bordered">
									        <tr>
									            <th>सि.नं.</th>
									            <th>सामानको किसिम </th>
									            <th>सामानको नाम</th>
									             <th>परिमाण</th>
									             <th>ईकाई </th>
									            <th> मर्मत विवरण </th>
									            <th> अनुमानित लागत रु </th>
									           <th> कैफियत   </th>
									        </tr>
                                                                                <?php $i=1;foreach($details as $data):if($data->category==1)
                                                                                    {
                                                                                        $name="खर्च हुने ";
                                                                                        $item_name =  Spentitem::getName($data->item_id);
                                                                                        $spent_result = Spentitem::find_by_id($data->item_id);
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $name ="खर्च नहुने ";
                                                                                        $item_name =Notspentitem::getName($data->item_id);
                                                                                        $spent_result = Notspentitem::find_by_id($data->item_id);
                                                                                    }
?>
									        <tr>
									            <td><?=$i?></td>
                                                                                    <td><?=$name?></td>
									            <td><?=$item_name?></td>
                                                                                    <td><?=convertedcit($data->quantity)?></td>
									            <td><?=Unit::getName($spent_result->unit_id)?></td>
									            <td><?=$data->marmat_details?></td>
									            <td><?=convertedcit(placeholder($data->amount+0))?></td>
									           <td><?=$data->remarks?></td>
									        </tr>
                                                                                <?php $i++; endforeach;?>
									    </table>
                                        <br>
                                        <div class="banktextdetails">
                                            <div class="mydate" style="margin-right: 300px;">
                                                <table class="table borderless sign_table">
                                                    <tr>
                                                    <td>मर्मत आदेश माग गर्नेको नाम :  </td>
                                                   <td>&nbsp;&nbsp;<?= get_name_by_type_and_enlist_id($profile->type, $profile->enlist_id)?></td>


                                                </tr>
                                                <tr>
                                                      <td>दस्तखत </td>
                                                      <td></td>

                                                </tr>
                                                <tr>
                                                    <td> मिति	 </td>
                                                    <td></td>

                                                </tr>

                                            </table>
                                            </div> 
                                            <div class="myspacer"> </div>
   
                                            <div >
                                                <b> जिन्सी शाखाले भर्ने :</b>
                                                <p> माथि उल्लेखित समानहरु मर्मत गर्न आबश्यक भएकाले मर्मत आदेशका लागि सिफारिस गर्दछु ।	</p>
                                                <div class="mydate" style="margin-right: 300px;">
                                                    <table class="table borderless sign_table">
                                                        <tr>
                                                            <td> जिन्सी शाखा प्रमुखको दस्तखत:</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td> मिति </td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="myspacer"> </div>
                                            </div>
                                            <br>
                                            <div>
                                                <b> आर्थिक प्रशासन शाखाले भर्ने :	</b>
                                                <p> उल्लेखित सामानहरु  मर्मतका लागि बजेट उपशिर्षक नं....................................को खर्च शिर्षक नं ........................... बाट भूक्तानी दिन बजेट बाँकी देखिन्छ/देखिदैन |</p>
                                            </div>
                                            <br><br>
                                            <div style="margin-left: 30px;">
                                                <table class="table borderless myWidth100 sign_table">
                                                    <tr>
                                                        <td> आर्थिक शाखा प्रमुखको दस्तखत: </td>
                                                        <td> </td>
                                                        <td class="myRight" style="margin-right: 280px;">कार्यालय प्रमुखको दस्तखत : </td>
                                                        <td> &nbsp;&nbsp; &nbsp;  </td>
                                                    </tr>
                                                    <tr>
                                                        <td> मिती : </td>
                                                        <td> </td>
                                                        <td class="myRight" style="margin-right: 380px;"> मिती : </td>
                                                        <td> &nbsp;&nbsp; &nbsp; </td>
                                                    </tr>
                                                </table>
                                            </div>
</div> 
                                        <br><br>
                                        
                                    </div>


				                    </div>
                                         		
										

									</div><!-- print page ends -->
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
