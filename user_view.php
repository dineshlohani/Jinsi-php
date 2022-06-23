<?php require_once("includes/initialize.php"); 
	$datas= User::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>प्रयोगकर्ता हेर्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">प्रयोगकर्ता हेर्नुहोस/ <a href="settings.php">Go Back</a></h2>
                   
                    <div class="OurContentFull">
                    	<h2>पद : </h2>
                        <div class="userprofiletable">
                        	<div class="settingsMenuWrap1">
                                    <div class="settingsMenu2"><a href="user_add.php">प्रयोगकर्ता हेर्नुहोस थप्नुहोस + </a></div>
                                <!--<div class="settingsMenu1"><a href="settings_topic_add_sub.php">सह शिर्षक थप्नुहोस +</a></div>-->
                            </div>
                            <div class="myspacer"></div>
							<div class="myMessage"><?php echo $message;?></div>
                                    	<table class="table table-bordered">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th>सि. नं .</th>
                                            <th>प्रयोगकर्ताको नाम</th>
                                            <th>सम्पर्क न.</th>
                                            <th>वार्ड न.</th>
                                            <th>इमेल ठेगाना</th>
                                            <th>कार्यरत अवस्था</th>
                                            <th>मोड </th>
                                            <th>जारी मिती </th>
                                            <th>युजरनेम</th>
                                            <th>सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          <?php 
                                          if($data->mode==0)
                                          {
                                              $mode="सुपर एडमिन";
                                          }
                                          elseif ($data->mode==1) 
                                          {
                                              $mode="एडमिन";
                                          }
                                          elseif ($data->mode==2)
                                          {
                                              $mode="प्रयोगकर्ता";
                                          }
                                          ?>
                                          	<tr>
                                                        <td><?php echo convertedcit($i); ?></td>
                                                        <td><?php echo $data->name; ?></td>
                                                        <td><?php echo $data->phone; ?></td>
                                                        <td><?php echo $data->ward; ?></td>
                                                        <td><?php echo $data->email; ?></td>
                                                        <td><?php echo $data->status; ?></td>
                                                        <td><?php echo $mode; ?></td>
                                                        <td><?php echo $data->appointed_date; ?></td>
                                                         <td><?php echo $data->username; ?></td>
                                                        <td><a href="user_edit.php?id=<?php echo $data->id; ?>">सच्याउनुहोस्</a></td>
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