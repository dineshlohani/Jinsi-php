<?php require_once("includes/initialize.php");
        

       $sql="select * from enlist ";
        if(isset($_POST['submit']))
        {
            $sql.=" where name like '%".$_POST['enlist_name']."%'";
        }
        $sql.="  order by id desc";
        //$data->date 		=  DateNepToEng($_POST['date']);
       $datas= Enlist::find_by_sql($sql);
	?>
  
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>सुची दर्ता :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="maincontent">
             <h2 class="headinguserprofile">सुची दर्ता | <a href="settings_enlist_add.php" class="btn">सुची दर्ता  थप्नुहोस + </a> | <a href="settings.php" class="btn">पछि जानुहोस</a></h2>
                   
                    <div class="OurContentFull">
                    	
                        <div class="userprofiletable">
                            <form method="post">
                                <table class="table table-hover"
                                       <tr>
                                        <th>
                                           नाम 
                                        </th>
                                        <td>
                                             <input class="form-control" type="text" name="enlist_name">
                                        </td>  
                                        <td>
                                            <input class="btn" type="submit" value="खोज्नुहोस" name="submit">
                                        </td>
                                        <td>
                                            <a href="suchidarta_print.php" class="btn">प्रिन्ट गर्नुहोस</a>
                                        </td>
                                    </tr>
                               
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
                                            <th class="myCenter">करदाता पान नं</th>
                                            <th class="myCenter">सम्पर्क व्यक्ति </th>
                                            <th class="myCenter">फोन नं </th>
                                            <th class="myCenter">कारोवारको किसिम</th>
                                            <th class="myCenter">दर्ता मिती</th>
                                            <th class="myCenter">सच्याउनुहोस् </th>
                                          </tr>
                                          <?php $i=1;foreach($datas as $data): 
                                        //   echo "<pre>";
                                        //   print_r($data);
                                          ?>
                                          	<tr>
                                                        <td class="myCenter"><?php echo convertedcit($i); ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->id); ?></td>
                                                        <td class="myCenter"><?php echo $data->name; ?></td>
                                                        <td class="myCenter"><?php echo $data->address; ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->taxpayer_number); ?></td>
                                                        <td class="myCenter"><?php echo $data->contact_person; ?></td>
                                                        <td class="myCenter"><?php echo convertedcit($data->phone_number); ?></td>
                                                        <td class="myCenter"><?php echo $data->business_type; ?></td>
                                                        
                                                        <td class="myCenter"><?php echo convertedcit(DateEngToNep($data->date)); ?></td>
                                                        <td class="myCenter"><a href="suchidarta_patra_print.php?enlist_id=<?=$data->id?>" class=btn>सुची दर्ता पत्र </a> | <a href="settings_enlist_edit.php?id=<?php echo $data->id; ?>" class="btn">सच्याउनुहोस्</a></td>
                                                    </tr>
                                        
                                          <?php $i++; endforeach; ?>
                                        </table>

                        </div>
                  </div>
                </div><!-- main menu ends -->
            >   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>