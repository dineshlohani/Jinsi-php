<?php require_once("includes/initialize.php");	?>
  <?php
if(isset($_POST['submit']))
{       
   $data= User::find_by_id($_POST['update_id']);
   $_POST['appointed_date_english']= DateNepToEng($_POST['appointed_date']);
   
   if($data->savePostData($_POST))
    {
        $session->message("प्रयोगकर्ता शिर्षक सच्याउन सफल");
        redirect_to("user_view.php");
    }
}
$data= User::find_by_id($_GET['id']);

?>
<?php include("menuincludes/header.php");

?>
<!-- js ends -->
<title>प्रयोगकर्ता सच्याउनुहोस् :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">प्रयोगकर्ता सच्याउनुहोस् / <a href="user_add.php">प्रयोगकर्ता थप्नुहोस</a></h2>
                  
                    <div class="OurContentFull">
                    	<h2>प्रयोगकर्ता सच्याउनुहोस् </h2>
                        <div class="userprofiletable">
                        	  <form method="post" enctype="multipart/form-data">
                                    	<table class="table table-bordered">
                                          <tr>
                                              <td>प्रयोगकर्ताको नाम :</td>
                                              <td><input type="text" name="name" value="<?=$data->name?>" required></td>
                                            </tr>
                                            <tr>
                                             <td>सम्पर्क न.:</td>
                                              <td><input type="text" name="phone" value="<?=$data->phone?>" required>	</td>
                                            </tr>
                                            <tr>
                                              <td>वार्ड न.  :</td>
                                                      <td>
                                                          <select name="ward"  >
                                                                  <option value="" >छान्नुहोस् </option>
                                                                  <option value="1"  <?php if($data->ward==1){echo 'selected="selected"';} ?>>१  </option>
                                                                  <option value="2"  <?php if($data->ward==2){echo 'selected="selected"';} ?>>२  </option>
                                                                  <option value="3"  <?php if($data->ward==3){echo 'selected="selected"';} ?>>३  </option>
                                                                  <option value="4"  <?php if($data->ward==4){echo 'selected="selected"';} ?>>४   </option>
                                                                  <option value="5"  <?php if($data->ward==5){echo 'selected="selected"';} ?>>५  </option>
                                                                  <option value="6"  <?php if($data->ward==6){echo 'selected="selected"';} ?>>६  </option>
                                                                  <option value="7"  <?php if($data->ward==7){echo 'selected="selected"';} ?>>७  </option>
                                                                  <option value="8"  <?php if($data->ward==8){echo 'selected="selected"';} ?>>८   </option>
                                                                  <option value="9"  <?php if($data->ward==9){echo 'selected="selected"';} ?>>९  </option>
                                                                  <option value="10"  <?php if($data->ward==10){echo 'selected="selected"';} ?>>१०  </option>
                                                                  <option value="11"  <?php if($data->ward==11){echo 'selected="selected"';} ?>>११  </option>

                                                           </select>
                                                      </td>
                                            </tr>

                                              <td>इमेल ठेगाना:</td>
                                              <td><input type="email" name="email"  value="<?=$data->email?>" required></td>
                                            </tr>
                                            <tr>
                                                <td> कार्यरत अवस्था :</td>
                                                  <td><input type="radio" name="status" value="1" <?php if($data->status==1){echo 'checked="checked"';}?> />Active|
                                                  <input type="radio" name="status" value="0" <?php if($data->status==0){echo 'checked="checked"';}?>/>Inactive
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> मोड  :</td>
                                                  <td>
                                                      <select name="mode">
                                                          <option value="">छान्नुहोस्</option>
                                                          <option value="0"  <?php if($data->mode==0){echo 'selected="selected"';} ?> >सुपर एडमिन</option>
                                                              <option value="1"  <?php if($data->ward==1){echo 'selected="selected"';} ?>>एडमिन</option>
                                                          <option value="2"  <?php if($data->ward==2){echo 'selected="selected"';} ?>>प्रयोगकर्ता </option>
                                                      </select>
                                                  </td>
                                            </tr>
                                             <tr>
                                                <td>जारी मिती :</td>
                                                <td><input type="text" name="appointed_date" value="<?=$data->appointed_date?>" id="nepaliDate5" />
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                              <td>युजरनेम:</td>
                                              <td><input type="text" name="username" value="<?=$data->username?>" required></td>
                                            </tr>
                                            <tr>
                                              <td>पास्स्वोर्ड :</td>
                                              <td><input type="password" name="password"  required id="new_password"></td>
                                            </tr>
                                            <tr>
                                              <td>पास्स्वोर्ड पुनः हाल्नुहोस :</td>
                                              <td><input type="password" name="password1"  required id="confirm_password" oninput="myFunction()"   ><span id="demo"></span></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td><input type="submit" name="submit" value="इन्ट्री गर्नुहोस" class="submithere"></td>
                                            </tr>
                              
                                        <input type="hidden" name="update_id" value="<?php echo $data->id?>"/>
                                        </table
                                       

                                    ></form>
                                    
                                    

                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>