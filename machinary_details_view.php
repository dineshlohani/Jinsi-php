<?php require_once("includes/initialize.php"); 
        if(isset($_POST['submit']))
        {
            $item_type=  MachinarydetailsProfile::find_by_machine_id($_POST['machine_id']); 
        }
        else
        {
         $item_type= MachinarydetailsProfile::find_by_sql("select distinct machine_id from machinary_profile");
        
        }
        //$datas= Notspentitem::find_all();
	$machinary_result = Machinary::find_all();
         ?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>चल्ती मेशिन वा सवारीको किताब:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">चल्ती मेशिन वा सवारीको किताब| <a href="index.php" class="btn">पछि जानुहोस  </a></h2>
                    
                    <div class="OurContentFull">
                        <form method="post">
                            <div class="inputWrap50 inputWrap50">
                    				    <div class="titleInput">चल्ती मेशिन वा सबारीको नाम:</div>
                                                    <div class="newInput">
                                                        <select name="machine_id" id="machine_id" required>
                                                            <option value="">-----</option>
                                                            <?php foreach($machinary_result as $data):?>
                                                            <option value="<?=$data->id?>"><?=$data->name?></option>
                                                                <?php endforeach;?>
                                                        </select>
                                                    </div>
                                          <div class="saveBtn myCenter"><input type="submit" name="submit" value="खोज्नुहोस" class="btn"></div>
                                          <br> <div class="saveBtn myCenter"><a href="machinary_details_view.php" class="btn">रद्ध गर्नुहोस</a></div>
                                           </div>
                        </form>
                        <div class="userprofiletable">
                            <?php if(!isset($_POST['submit'])){?>
                        		<table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">सवारी दर्ता नं</th>
                                            <th class="myCenter">चल्ती मेशिन वा सबारीको नाम</th>
                                            <th class="myCenter">किसिम</th>    
                                            <th class="myCenter">मोडल नं</th>
                                            <th class="myCenter">खाता हेर्नुहोस</th>
                                          </tr>
                                          
                                         <?php $i=1; foreach($item_type as $data): 
                                          $result = MachinarydetailsProfile::find_by_machine_id($data->machine_id);
                                             ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?=$result->darta_no?></td>
                                                        <td class="myCenter"><?=  Machinary::getName($data->machine_id)?></td>
                                                        <td class="myCenter"><?=$result->type?></td>
                                                        <td class="myCenter"><?=$result->model?></td>
                                                        <td class="myCenter"><a href="chalti_machinary.php?machine_id=<?php echo $data->machine_id; ?>" class="btn">खाता हेर्नुहोस</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php } else {?>
                            <table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">सवारी दर्ता नं</th>
                                            <th class="myCenter">चल्ती मेशिन वा सबारीको नाम</th>
                                            <th class="myCenter">किसिम</th>    
                                            <th class="myCenter">मोडल नं</th>
                                            <th class="myCenter">खाता हेर्नुहोस</th>
                                          </tr>
                                          
                                         <?php // $item_type;
                                          $result = MachinarydetailsProfile::find_by_machine_id($item_type->machine_id);
                                             ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit(1); ?></td>
                                                        <td class="myCenter"><?=$result->darta_no?></td>
                                                        <td class="myCenter"><?=  Machinary::getName($item_type->machine_id)?></td>
                                                        <td class="myCenter"><?=$result->type?></td>
                                                        <td class="myCenter"><?=$result->model?></td>
                                                        <td class="myCenter"><a href="chalti_machinary.php?machine_id=<?php echo $item_type->machine_id; ?>" class="btn">खाता हेर्नुहोस</a></td>
                                                    </tr>
                                        
                                         
                                        </table>
                            <?php } ?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>