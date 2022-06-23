<?php require_once("includes/initialize.php"); 
	$datas= Spentitem::find_all();
        
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खर्च हुने सामनको विवरण:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खर्च हुने सामनको विवरण </h2>
                    <div class="OurContentLeft">
                   	  <?php include("menuincludes/settingsmenu.php"); ?>
                    </div>
                    <div class="OurContentRight">
                    	<h2>खर्च हुने सामनको विवरण : </h2>
                        <div class="userprofiletable">
                        	<div class="settingsMenuWrap1">
                                    <div class="settingsMenu2"><a href="settings_spent_item_add.php">खर्च हुने सामनको विवरण थप्नुहोस + </a></div>
                                <!--<div class="settingsMenu1"><a href="settings_topic_add_sub.php">सह शिर्षक थप्नुहोस +</a></div>-->
                            </div>
                            <div class="myspacer"></div>
							<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th>सि. नं .</th>
                                            <th>जिन्सी खाता पाना नं</th>
                                            <th>सामनको किसिम</th>
                                            <th>सामनको नाम</th>
                                            <th>स्पेशिफिकेशन</th>
                                            <th>बजेट शिर्षकको नाम</th>
                                            <th>इकाईको किसिम</th>
                                            <th>सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          	<tr>
                                                       
                                                        <td><?php echo convertedcit($i); ?></td>
                                                        <td><?php echo convertedcit($data->id); ?></td>
                                                         <td><?php echo Itemtype::getName($data->item_type_id);?></td>
                                                        <td><?php echo $data->name; ?></td>
                                                        <td><?php echo $data->specification; ?></td>
                                                        <td><?php echo Budgettitle::getName($data->budget_title_id); ?></td>
                                                        <td><?php echo Unit::getName($data->unit_id); ?></td>
                                                        <td><a href="settings_spent_item_edit.php?id=<?php echo $data->id; ?>">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>