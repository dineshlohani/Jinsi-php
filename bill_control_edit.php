<?php 
    require_once("includes/initialize.php"); 
  
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['update_id']))
        {
            $bill_control = BillControl::find_by_id($_POST['update_id']);
        }
        else
        {
            $bill_control = new BillControl;
        }
        $date = DateNepToEng($_POST['nepali_date']);
        $_POST['english_date'] = $date;
        unset($_POST['update_id']);
        if($bill_control->savePostData($_POST))
        {
            echo alertBox("हाल्न सफल", "bill_control_view.php");
        }
        
    }
    if(isset($_GET['update_id']))
    {
        $result = BillControl::find_by_id($_GET['update_id']);
    }
    else
    {
        $result = BillControl::setEmptyobjects();
    }
    
    if(isset($_GET['del_id']))
    {
       $description_data = BillControl::find_by_id($_GET['del_id']);
       if($description_data->delete())
       {
           echo alertBox("हटाउन सफल", "bill_control_view.php");
       }
    }
   $description_data = Description::find_all();    
$bill_control_data = BillControl::find_all(); 
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> अन्य प्रस्ताब माग फाराम भर्नुहोस</title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontents">
                    <!--<h2 class="headinguserprofile">अन्य प्रस्ताब माग फाराम भर्नुहोस | <a href="aanya_prastabana_dashboard.php" class="btn">पछि जानुहोस </a> </h2>-->
                    <div class="OurContentFull">
                        <h2>रसिद नियन्त्रण खाता || <a href="bill_control_view.php" class="btn">पछि जानुहोस </a></h2>
                        <div class="userprofiletables">
                           
                            <div class="subjectBold letter_subject">रसिद नियन्त्रण खाता</div>
                        <form method="post">
                            <table class="table table-bordered table-responsive td1 td2">
                                <tr>
                                    
                                    <th rowspan="2"> मिति </th>
                                    <th rowspan="2"> ठेलि संख्या </th>
                                    <th rowspan="2"> विवरण </th>
                                    <th colspan="3"> छापिएर आएको रसिद  </th>
                                    <th colspan="3"> निकासा भएको रसिद </th>
                                    <th colspan="3"> मौज्दात रहेको रसिद </th>
                                    <th rowspan="2"> प्रपाणित गर्ने </th>
                                </tr>
                                <tr>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    <th>&nbsp;</th>
                                </tr>
                                <tr>
                                    
                                    <td><input type='text' name='nepali_date' id='nepaliDate9' value="<?=$result->nepali_date?>" required></td>
                                    <td><input type='text' name='quantity' value="<?=$result->quantity?>" required></td>
                                    <td>
                                        <select name='description_id'>
                                            <option value=''>छान्नुहोस</option>
                                            <?php foreach($description_data as $data){?>
                                            <option value='<?=$data->id?>'<?php if($data->id==$result->description_id){echo 'selected="selected"';}?>><?=$data->name?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input class="myWidth5" type='text' name='pressed_from' value="<?=$result->pressed_from?>" required></td>
                                    <td><input type='text' name='pressed_to' value="<?=$result->pressed_to?>" required></td>
                                    <td><input type='text' name='pressed_total' value="<?=$result->pressed_total?>" required></td>
                                    <td><input type='text' name='passed_from' value="<?=$result->passed_from?>" required></td>
                                    <td><input type='text' name='passed_to' value="<?=$result->passed_to?>" required></td>
                                    <td><input type='text' name='passed_total' value="<?=$result->passed_total?>" required></td>
                                    <td><input type='text' name='maujdata_from' value="<?=$result->maujdata_from?>" required></td>
                                    <td><input type='text' name='maujdata_to' value="<?=$result->maujdata_to?>" required></td>
                                    <td><input type='text' name='maujdata_total' value="<?=$result->maujdata_total?>" required></td>
                                    <td><input type='text' name='verified_by' value="<?= $result->verified_by?>" required></td>
                                    <td><input type='hidden' name='update_id' value='<?=$result->id?>'></td>
                                    <td><input type="submit" name="submit" value="शेभ गर्नुहोस"></td>
                                </tr>
                            </table>
                        </form>
                                        
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

