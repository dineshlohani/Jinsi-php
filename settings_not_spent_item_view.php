<?php require_once("includes/initialize.php"); 
         $item_type= Itemtype::find_all();
	//$datas= Notspentitem::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च नहुने सामानको विवरण:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च नहुने सामानको विवरण | <a href="settings_not_spent_item_add.php" class="btn">खर्च नहुने सामानको विवरण थप्नुहोस + </a>||<a href="settings.php" class="btn">पछि जानुहोस  </a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	
							<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">जिन्सी खाता पाना. नं .</th>
                                            <th class="myCenter">सामानको किसिम</th>    
                                            <th class="myCenter">सामनको नाम</th>
                                            <th class="myCenter">सामनको ब्रान्ड</th>
                                            <th class="myCenter">स्पेशिफिकेशन</th>
                                            <th class="myCenter">उत्पादन गर्ने देश</th>
                                            <th class="myCenter">साइज</th>
                                            <th class="myCenter">अनुमानित आयु</th>
                                            <th class="myCenter">बजेट शिर्षकको नाम</th>
                                            <th class="myCenter">इकाईको किसिम</th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          
                                         <?php foreach($item_type as $type): 
                                            // echo $type->name;
                                        $datas= Notspentitem::find_by_item_type_id($type->id); 
                                       if(!empty($datas))
                                       {
                                          $i=1;foreach($datas as $data): 
                                              if(!empty($data->budget_title_id))
                                              {
                                                  $budget_title = Budgettitle::getName($data->budget_title_id);
                                              }
                                              else
                                              {
                                                  $budget_title = "";
                                              }
                                              !empty($data->unit_id)?$unit= Unit::getName($data->unit_id) : $unit="";
                                              
                                              ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->id); ?></td>
                                                        <td class="myCenter"><?php echo Itemtype::getName($data->item_type_id);?></td>
                                                        <td class="myCenter"><?php echo $data->name; ?></td>
                                                        <td class="myCenter"><?php echo $data->brand; ?></td>
                                                        <td class="myCenter"><?php echo $data->specification; ?></td>
                                                        <td class="myCenter"><?php echo $data->made_in; ?></td>
                                                        <td class="myCenter"><?php echo $data->size; ?></td>
                                                        <td class="myCenter"><?php echo $data->time_period; ?></td>
                                                        <td class="myCenter"><?php echo $budget_title; ?></td>
                                                        <td class="myCenter"><?php echo $unit; ?></td>
                                                        <td class="myCenter"><a href="settings_not_spent_item_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                                 
                                                    <tr style="border:5px solid rgb(105,105,105); border-right: 5px solid transparent; border-left:5px solid transparent;">
                                                        <td colspan="12">
                                                           
                                                        </td>
                                                    </tr>
                                                    
                                  <?php } endforeach; ?>           
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>