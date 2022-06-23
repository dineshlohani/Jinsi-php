<?php 
    require_once("includes/initialize.php"); 
  error_reporting(1);
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['update_id']))
        {
            $data=BillAmdani::find_by_id($_POST['update_id']);
        }
        else
        {
            $data= new BillAmdani();
        }
        $data->nepali_date= $_POST['nepali_date'];
        $data->english_date = DateNepToEng($_POST['nepali_date']);
        $data->quantity = $_POST['quantity'];
        $data->description_id = $_POST['description_id'];
        $data->pressed_from = $_POST['pressed_from'];
        $data->pressed_to = $_POST['pressed_to'];
        $data->pressed_total = $_POST['pressed_total'];
        $data->save();
        echo alertBox("थप सफल ","bill_amdani.php");
    }
    $description_data = Rashidtype::find_all();
    if(isset($_GET['id']))
    {
        $result = BillAmdani::find_by_id($_GET['id']);
        $value="अपडेट गर्नुहोस ";
    }
    else
    {
        $result = BillAmdani::setEmptyObjects();
        $value = "सेब गर्नुहोस ";
    }
    
    $final_result = BillAmdani::find_all();
  //$final_date = get_last_date_rashid($description_id);
    
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> रसिद नियन्त्रण खाता</title>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontents">
                    <!--<h2 class="headinguserprofile">अन्य प्रस्ताब माग फाराम भर्नुहोस | </h2>-->
                    <div class="OurContentFull">
                        <h2>आम्दानी रसिद ||  <a href="bill_control_dashboard.php" class="btn">पछि जानुहोस </a></h2>
                        <div class="userprofiletables">
                           
                            <div class="subjectBold letter_subject">आम्दानी रसिद</div>
                        <form method="POST" id="rashid_form">
                            <table class="table table-bordered table-responsive td1 td2">
                                <tr>
                                    <th rowspan="2" style="width: 150px !important;"> मिति </th>
                                    <th rowspan="2"> किसिम  </th>
                                    <th rowspan="2"> ठेलि संख्या </th>
                                    <th colspan="4" style="text-align: center;"> छापिएर आएको रसिद  </th>
                                </tr>
                                <tr>
                                    <th> प्रति ठेली </th>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                  
                                   
                                </tr>
                                <tr>
                                    
                                    <td><input style="width: 150px;" type='text' class="bill_date" name='nepali_date' id='nepaliDate9' required value="<?=$result->nepali_date?>"></td>
                                    <td>
                                            <select required id="selected_description_id" class="form-control fill_height" name='description_id'>
                                                <option value=''>छान्नुहोस</option>
                                                <?php foreach($description_data as $data){?>
                                                <option value='<?=$data->id?>' <?php if($data->id== $result->description_id){ echo 'selected="selected"';}?>><?=$data->name?></option>
                                                <?php } ?>
                                            </select>
                                    </td>
                                    <td><input class="form-control fill_height" type='text' id="quantity_theli" name='quantity'  required value="<?=$result->quantity?>"></td>
                                     <td><input class="form-control fill_height" type='text' name=''  id="each" required value="<?php if(!empty($result->quantity)){echo ($result->pressed_total / $result->quantity ); } ?>"></td>
                                    <td><input class="form-control fill_height" readonly="true" type='text' name='pressed_from' id="dispatch_from" required value="<?=$result->pressed_from?>"></td>
                                    <td><input class="form-control fill_height" type='text' readonly="true" name='pressed_to' id="dispatch_to" required value="<?=$result->pressed_to?>"></td>
                                    <td><input class="form-control fill_height" type='text' name='pressed_total' readonly="true" id="dispatch_total" required value="<?=$result->pressed_total?>"></td>
                                   
                                <input type="hidden" name="update_id" value="<?=$result->id?>"/>
                                </tr>
                                <tr>
                                    <td colspan="13">  <button class="btn"  id="submitbillamdani" name="submit" ><?=$value?></button> </td>
                                </tr>
                            </table>
                        
                        </form>
                            <?php if(!empty($final_result)){?>
                            <table class="table table-bordered table-responsive td1 td2">
                                <tr>
                                    
                                    <th rowspan="2" style="width: 150px !important;"> मिति </th>
                                    <th rowspan="2"> किसिम  </th>
                                    <th rowspan="2"> ठेलि संख्या </th>
                                    <th colspan="3" style="text-align: center;"> छापिएर आएको रसिद  </th>
                                       <th rowspan="2"> प्रति ठेली </th>
                                    <th rowspan="2">सच्याउनुहोस</th>
                                 
                                     
                                </tr>
                                <tr>
                                    <th> र.नं. देखि </th>
                                    <th> र.नं. सम्म </th>
                                    <th> जम्मा रसिद </th>
                                    
                                   
                                </tr>
                                <?php foreach($description_data as $des):
                                    $result_all = BillAmdani::find_by_des_id($des->id);
                                ?>
                                <tr>
                                    <th colspan="8">  <h2><?= $des->name ?></h2></th>
                                </tr>
                               
                                <?php
                                  foreach($result_all as $final):  
                                    ?>
                                
                                <tr>
                                    
                                    <td><?=convertedcit($final->nepali_date)?></td>
                                    <td><?= Rashidtype::getName($final->description_id)?></td>
                                    <td><?=convertedcit($final->quantity)?></td>
                                    <td><?=convertedcit($final->pressed_from)?></td>
                                    <td><?=convertedcit($final->pressed_to)?></td>
                                    <td><?=convertedcit($final->pressed_total)?></td>
                                    
                                    <td><?= convertedcit($final->pressed_total/$final->quantity) ?></td>
                                    <td><a href="bill_amdani.php?id=<?=$final->id?>" class="btn">सच्याउनुहोस</a></td>
                                </tr>
                                <?php
                                endforeach;
                                endforeach;?>
                            </table>
                            <?php }?>
                            <br/>
                            <br/>
                            <br/>
                            <div>
                              
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

