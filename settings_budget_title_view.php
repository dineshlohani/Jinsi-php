<?php require_once("includes/initialize.php"); 
	$datas= Budgettitle::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>बजेट शिर्षक :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">बजेट शिर्षक | <a href="settings_budget_title_add.php" class="btn">बजेट शिर्षक थप्नुहोस + </a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered  table-hover table-striped tablesorter">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">शिर्षक नं.</th>
                                            <th class="myCenter">बजेट शिर्षक</th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo $data->sn; ?></td>
                                                        <td class="myCenter"><?php echo $data->name; ?></td>
                                                        <td class="myCenter"><a href="settings_budget_title_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>