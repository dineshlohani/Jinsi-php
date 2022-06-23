<?php require_once("includes/initialize.php"); 
        if(isset($_POST['submit']))
        {
            $item_type=  Machinarylogprofile::find_by_id($_POST['machine_id']); 
        }
        else
        {
         $item_type= Machinarylogprofile::find_by_sql("select distinct enlist_id from machinary_log_profile");
        
        }
        //$datas= Notspentitem::find_all();
	$machinary_result = Machinarylogprofile::find_all();
         ?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सवारीको लगबुक:: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile">सवारीको लगबुक| <a href="machinary_logbook.php" class="btn">थप्नुहोस[+]</a> |<a href="index.php" class="btn">पछि जानुहोस  </a></h2>
                    
                    <div class="OurContentFull">
                        <form method="post">
                            <div class="inputWrap50 inputWrap50">
                    				    <div class="titleInput">ड्राइभरको नाम :</div>
                                                    <div class="newInput">
                                                        <select name="machine_id" id="machine_id" required>
                                                            <option value="">-----</option>
                                                            <?php foreach($machinary_result as $data):
                                                                $name = get_name_by_type_and_enlist_id($data->type,$data->enlist_id);
                                                                ?>
                                                            <option value="<?=$data->id?>"><?=$name?></option>
                                                                <?php endforeach;?>
                                                        </select>
                                                    </div>
                                          <div class="saveBtn myCenter"><input type="submit" name="submit" value="खोज्नुहोस" class="btn"></div>
                                          <br> <div class="saveBtn myCenter"><a href="machinary_logbook_details.php" class="btn">रद्ध गर्नुहोस</a></div>
                                           </div>
                        </form>
                        <div class="userprofiletable">
                            <?php if(!isset($_POST['submit'])){?>
                        		<table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                        <tr>
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter"> ड्राइभरको नाम   :</th>
                                            <th class="myCenter">सवारी नं:</th>
                                            <th class="myCenter">सवारीको किसिम</th>    
                                             <th class="myCenter">खाता हेर्नुहोस</th>
                                          </tr>
                                          
                                         <?php $i=1; foreach($item_type as $result_log): 
                                              $data= Machinarylogprofile::find_by_enlist_id($result_log->enlist_id);
                                              $driver_name = get_name_by_type_and_enlist_id($data->type,$data->enlist_id);
                                         
                                         ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?=$driver_name?></td>
                                                        <td class="myCenter"><?=  $data->machine_no?></td>
                                                        <td class="myCenter"><?= $data->machine_type?></td>
                                                        <td class="myCenter"><a href="machinary_logbook_print.php?enlist_id=<?php echo $data->enlist_id; ?>" class="btn">खाता हेर्नुहोस</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>
                            <?php } else {?>
                            <table class="table table-bordered myWidth100 table-responsive">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                                <th class="myCenter">सि. नं .</th>
                                                <th class="myCenter"> ड्राइभरको नाम   :</th>
                                                <th class="myCenter">सवारी नं:</th>
                                                <th class="myCenter">सवारीको किसिम</th>    
                                                 <th class="myCenter">खाता हेर्नुहोस</th>
                                            </tr>
                                          
                                         <?php // $item_type;
                                          $data = $item_type;
                                           $driver_name = get_name_by_type_and_enlist_id($data->type,$data->enlist_id);
                                           ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit(1); ?></td>
                                                        <td class="myCenter"><?=$driver_name?></td>
                                                        <td class="myCenter"><?=  $data->machine_no?></td>
                                                        <td class="myCenter"><?= $data->machine_type?></td>
                                                        <td class="myCenter"><a href="machinary_logbook_print.php?enlist_id=<?php echo $data->enlist_id; ?>" class="btn">खाता हेर्नुहोस</a></td>
                                                    </tr>
                                        
                                         
                                        </table>
                            <?php } ?>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>