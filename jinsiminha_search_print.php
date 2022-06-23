<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
  $jinsi_minha_result= Jinsiminhafinal::find_by_jinsi_minha_id($_GET['jinsi_minha_id']);
        $jinsi_minha_id=$_GET['jinsi_minha_id'];
 $fiscal_id=  Fiscalyear::find_current_id();
 $fiscal=  Fiscalyear::find_by_is_current($fiscal_id);
  $jinsi_minha_date = Jinsiminhaapprove::find_by_jinsi_minha_ids($_GET['jinsi_minha_id']);
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>जिन्सी निर्सग / मिन्हा फाराम  खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal" > 
    	<div class="userprofiletable">
               <div class="printPage">
                                   
									<div class="printlogo"><img src="images/emblem_nepal.png" alt="Logo"></div>
<div class="mydate">म.ले.प. फाराम नं  ४८</div>
									<h1 class="margin1em letter_title_one"><?=SITE_NAME?></h1>
									<h5 class="margin1em letter_title_two"><?=SITE_LOCATION?></h5>
									<h5 class="margin1em letter_title_three"><?=SITE_ADDRESS?></h5>
									<div class="myspacer"></div>
									<div class="subjectBold letter_subject">जिन्सी निर्सग / मिन्हा फाराम</div>
									<div class="printContent">
                                    
										<!--<div class="chalanino">जिन्सी निर्सग / मिन्हा फाराम नं:</div>-->
										
                                        <div class="myspacer"></div>
									  <div class="bankdetails">
									 <div class="mydate"><b> जिन्सी मिन्हा मिति :- </b><?php echo convertedcit($jinsi_minha_date->created_date);?></div>
					  <span> <b>जिन्सी मिन्हा फाराम नं :-</b> <?php echo convertedcit($jinsi_minha_id);?> </span>
                          <table class="table table-bordered table-responsive myWidth100">
                          	<tr>
                            	<th class="myCenter">क्र.स.</th>
                                <th class="myCenter">जिन्सी खाता पाना नं</th>
                                <th class="myCenter">जिन्सी बर्गीकरण संकेत नं</th>
                                <th class="myCenter">सामानको नाम</th>
                                <th class="myCenter">स्पेशिफिकेशन</th>
                                <th class="myCenter">शुरु प्राप्त मिति</th>
                                <th class="myCenter">प्रयोग भएको वर्ष</th>
                                <th class="myCenter">परिमाण</th>
                                <th class="myCenter">परल मूल्य</th>
                                <th class="myCenter">मिन्हा भएको परिणाम</th>
                                <th class="myCenter">हालको अनुमानित मूल्य</th>
                                <th class="myCenter">जिन्सी  मिन्हाको कारण</th>                                
                            </tr>
                            <?php $i=1;foreach($jinsi_minha_result as $data):
                                $stock_result=  ItemStock::find_by_id($data->stock_id);
                                $result=get_item_stock_details($data->item_id,$data->category);
                                  $amount=$data->prev_stock * $data->rate; 
                                 $dakhila_id =  DakhilaItemDetails::find_by_item_id_rate_category_of_max_dakhila($stock_result->item_id,$stock_result->category,$data->rate);
                                    if(empty($dakhila_id))
                                    {
                                        $dakhila_result=  ItemStock::find_stock($stock_result->item_id,$stock_result->category,$data->rate);
                                        $dakhila_date = $dakhila_result->stock_date;
                                        $total_year=calculate_total_days_year($dakhila_date);
                                    }
                                    else
                                     {
                                        $dakhila_profile_result =  Dakhilaprofile::find_by_id($dakhila_id);
                                        $dakhila_date = $dakhila_profile_result->date_nepali;
                                        $total_year=calculate_total_days_year($dakhila_date);
//                                        echo $total_year;exit;
                                    }
                                    if($data->category==1)
                                    {
                                        $category = "५२ / खर्च हुने ";
                                    }
                                    else
                                    {
                                        $category = "४७ / खर्च नहुने ";
                                    }
                                    
                                 ?>
                            <tr>
                            	 <td><?php echo convertedcit($i)?></td>
                                <td><?php echo convertedcit($stock_result->item_id);?></td>
                                <td><?php echo $category;?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['specification'];?></td>
                                <td><?php echo convertedcit($data->stock_entry_date);?></td>
                                <td><?php echo $total_year;?></td>
                                 <td><?php echo convertedcit($data->prev_stock);?></td>
                                 <td><?php echo convertedcit($amount);?></td>
                                 <td><?php echo convertedcit($data->actual_reduced_stock);?></td>
                                <td><?php echo convertedcit($data->current_analysed_rate);?></td>
                                <td><?php echo convertedcit($data->reason);?></td>
                            </tr>   
                            <?php endforeach;?>
                          </table>

</div> 
										
<div class="myspacer"></div>

<div class="bankdetails">
   <table class="table borderless myWidth100">
		<tr>
        	<td><br>फाँटवालाको दस्तखत: <br><br></td>
            <td></td>
            <td><br>शाखा प्रमुखको दस्तखत: <br><br></td>
            <td></td>
            <td><br>आदेश दिनको दस्तखत: <br><br></td>
            <td></td>
        </tr>
        <tr>
        	<td>मिति:- </td>
            <td></td>
            <td>मिति:- </td>
            <td></td>
            <td>मिति:-  </td>
            <td></td>
        </tr>
        <tr>
          <td>पद: </td>
          <td></td>
          <td>पद: </td>
          <td></td>
          <td>पद: </td>
          <td></td>
        </tr>
        <tr>
          <td>मिति:-  </td>
          <td></td>
          <td>मिति:- </td>
          <td></td>
          <td>मिति:-  </td>
          <td></td>
        </tr>
   </table>
</div> 
                       								

</div>
				</div>				
										

									</div><!-- print page ends 
                            </div><!-- userprofile table ends -->
                        </div><!-- my print final ends -->
