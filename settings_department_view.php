<?php require_once("includes/initialize.php"); 
	$datas= Department::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>शाखा :: <?php echo SITE_SUBHEADING;?></title>
</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">शाखा | <a href="settings_department_add.php" class="btn">शाखा थप्नुहोस + </a> || <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        	<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th>सि. नं .</th>
                                            <th>शाखा</th>
                                            <th>सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          	<tr>
                                                        <td><?php echo convertedcit($i); ?></td>
                                                        <td><?php echo $data->name; ?></td>
                                                        <td><a href="settings_department_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
           
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>