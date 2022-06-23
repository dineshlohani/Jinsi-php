<?php require_once("includes/initialize.php"); 
	$datas= Itemcondition::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सामानको भौतिक अवस्था :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">सामानको भौतिक अवस्था | <a href="settings_item_physical_condition_add.php" class="btn">सामानको भौतिक अवस्था थप्नुहोस + </a></h2>
                  
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	
							<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered table-striped table-hover">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">सामानको भौतिकको किसिम</th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo $data->name; ?></td>
                                                        <td class="myCenter"><a href="settings_item_physical_condition_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>