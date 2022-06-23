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
        if($bill_control->savePostData($_POST))
        {
            echo alertBox("हाल्न सफल", "bill_control_view.php");
        }
        
    }
    if(isset($_POST['search']))
    {
        $start_date = DateNepToEng($_POST['start_date']);
        $end_date = DateNepToEng($_POST['end_date']);
        $search_data = BillControl::find_by_dates($start_date, $end_date);
       
    }
    
    $description_data = Description::find_all();    
    
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> अन्य प्रस्ताब माग फाराम भर्नुहोस</title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontents">
                    <!--<h2 class="headinguserprofile">अन्य प्रस्ताब माग फाराम भर्नुहोस | </h2>-->
                    <div class="OurContentFull">
                        <h2>रसिद नियन्त्रण खाता ||  <a href="bill_control_view.php" class="btn">पछि जानुहोस </a></h2>
                        <div class="userprofiletables">
                           
                            <div class="subjectBold letter_subject">रसिद नियन्त्रण</div>
                        <form method="post">
                            <table class="table table-bordered table-responsive td1 td2">
                                <tr>
                                    
                                    <th rowspan="2" style="width: 150px !important;"> मिति </th>
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
                   
                                </tr>
                                <tr>
                                    
                                    <td><input style="width: 150px;" type='text' name='nepali_date' id='nepaliDate9' required></td>
                                    <td><input class="form-control fill_height" type='text' name='quantity'  required></td>
                                    <td>
                                        <select class="form-control fill_height" name='description_id'>
                                            <option value=''>छान्नुहोस</option>
                                            <?php foreach($description_data as $data){?>
                                            <option value='<?=$data->id?>'><?=$data->name?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control fill_height" type='text' name='pressed_from' required></td>
                                    <td><input class="form-control fill_height" type='text' name='pressed_to'  required></td>
                                    <td><input class="form-control fill_height" type='text' name='pressed_total' required></td>
                                    <td><input class="form-control fill_height" type='text' name='passed_from' required></td>
                                    <td><input class="form-control fill_height" type='text' name='passed_to' required></td>
                                    <td><input class="form-control fill_height" type='text' name='passed_total' required></td>
                                    <td><input class="form-control fill_height" type='text' name='maujdata_from' required></td>
                                    <td><input class="form-control fill_height" type='text' name='maujdata_to' required></td>
                                    <td><input class="form-control fill_height" type='text' name='maujdata_total' required></td>
                                    <td><input class="form-control fill_height" type='text' name='verified_by' required></td>
                                   
                                
                                </tr>
                                <tr>
                                    <td colspan="13">  <input class="btn" type="submit" name="submit" value="शेभ गर्नुहोस"> </td>
                                </tr>
                            </table>
                        </form>
                            <br/>
                            <br/>
                            <br/>
                            <div>
                              
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

