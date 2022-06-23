<?php require_once("includes/initialize.php");
        // echo DB_NAME;exit;
       $sql="select * from enlist ";
        if(isset($_POST['submit']))
        {
            $sql.=" where name like '%".$_POST['enlist_name']."%'";
        }
        $sql.="  order by id desc";
        if(isset($_GET['id']))
        {
            $result = Enlist::find_by_id($_GET['id']);
            if($result->delete())
            {
                $reset = Enlist::resetAutoIncrement();
                if($reset)
                {
                    $session->message("सुची दर्ता हटाउन सफल");    
                    redirect_to("settings_enlist_view.php");
                }
            }
        }
       $datas= Enlist::find_by_sql($sql);
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->


                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                            <form method="post">
                                <table class="table table-hover"
                                       <tr>
                                        </table>
                                    </form>
                        		<span class="myMessage"><?php echo $message;?></span>
                                    	<table class="table table-bordered table-hover table-striped">
                                            <tr>&nbsp;</tr>
                                            <tr>
                                    
                                            <th class="myCenter">सि. नं .</th>
                                            <th class="myCenter">दर्ता. नं .</th>
                                            <th class="myCenter">फर्म /कम्पनीको नाम</th>
                                            <th class="myCenter">ठेगाना</th>
                                            <th class="myCenter">सम्पर्क नं.</th>
                                            <th class="myCenter">करदाता नं</th>
                                            <th class="myCenter">कारोवारको किसिम</th>
                                            <th class="myCenter">दर्ता मिती</th>

                                </tr>
                                          <?php $i=1;foreach($datas as $data): ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->id); ?></td>
                                                        <td class="myCenter"><?php echo $data->name; ?></td>
                                                        <td class="myCenter"><?php echo $data->address; ?></td>
                                                        <td class="myCenter"><?php echo $data->number; ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->taxpayer_number); ?></td>
                                                        <td class="myCenter"><?php echo $data->business_type; ?></td>
                                                        <td class="myCenter"><?php echo convertedcit(DateEngToNep($data->date)); ?></td>
                                                        
                                                            
                                                        </td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>