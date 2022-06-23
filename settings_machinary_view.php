<?php require_once("includes/initialize.php"); 
         $item_type= Machinary::find_all();
	//$datas= Notspentitem::find_all();
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>चल्ती मेशिन वा सवारीको किताब:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">चल्ती मेशिन वा सवारीको किताब| <a href="settings_machinary.php" class="btn">चल्ती मेशिन वा सवारीको किताब थप्नुहोस + </a>||<a href="settings.php" class="btn">पछि जानुहोस  </a></h2>
                    
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                        		<table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">सवारी दर्ता नं</th>
                                            <th class="myCenter">चल्ती मेशिन वा सबारीको नाम</th>
                                            <th class="myCenter">किसिम</th>    
                                            <th class="myCenter">मोडल नं</th>
                                            <th class="myCenter">ईन्जिन नं</th>
                                            <th class="myCenter">उत्पादन गर्ने देश</th>
                                            <th class="myCenter">च्यासिस नं</th>
                                            <th class="myCenter">सबारीको बजन</th>
                                            <th class="myCenter">जिन्सी खाता पाना नं</th>
                                            <th class="myCenter">अन्य विवरण</th>
                                            <th class="myCenter">खरिद मोल</th>
                                            <th class="myCenter">सबारी खरिद मिति</th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          
                                         <?php $i=1; foreach($item_type as $data): 
                                            // echo $type->name;
//                                        $datas= Notspentitem::find_by_item_type_id($type->id); 
                                     
                                              ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?=$data->darta_no?></td>
                                                        <td class="myCenter"><?=$data->name?></td>
                                                        <td class="myCenter"><?=$data->type?></td>
                                                        <td class="myCenter"><?=$data->model?></td>
                                                        <td class="myCenter"><?=$data->engine_no?></td>
                                                        <td class="myCenter"><?=$data->made_in?></td>
                                                        <td class="myCenter"><?=$data->chesis_no?></td>
                                                        <td class="myCenter"><?=$data->weight?></td>
                                                        <td class="myCenter"><?=$data->jinsi_id?></td>
                                                        <td class="myCenter"><?=$data->detail?></td>
                                                        <td class="myCenter"><?=$data->price?></td>
                                                        <td class="myCenter"><?=$data->miti?></td>
                                                        <td class="myCenter"><a href="settings_machinary_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>