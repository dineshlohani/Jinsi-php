<?php require_once("includes/initialize.php"); ?>
<?php
	
	if(!$session->is_logged_in()){ redirect_to("logout.php");}
?>
<?php
$name = $address = $number = $email =  '';

if (isset($_POST['submit'])) {
    $password1=$_POST['password'];
    $password2=$_POST['password1'];
    if($password1!=$password2)
    {
       $session->message("the two passwords didn't matched");
       redirect_to("user.php");
    }
    else
    {
    $user = new User();
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    $user->password = md5($_POST['password']);
    $user->status = 1;
    $user->ward = $_POST['ward'];
    $user->email =$_POST['email'];
    $user->phone = $_POST['phone'];
    $user->status = $_POST['status'];
    $user->appointed_date = $_POST['appointed_date'];
    $user->appointed_date_english=DateNepToEng($_POST['appointed_date']);                
    $user->mode= $_POST['mode'];
    
    if ($user->save()) {
        //$session->message("Staff created successfully");
        $session->message("User added successfully", 1);
        redirect_to("user_view.php");
        
    } else {
        $session->message("User added failed", 0);
        
    }

    }
}
?>
<?php include("menuincludes/header.php"); 
include 'menu/header_script.php';?>
<!-- js ends -->
<title>User Profile :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">प्रयोगकर्ताको  प्रोफाइल</h2>
                    <div class="OurContentLeft">
                    	
                    </div>
                    <div class="OurContentFull">
                    	<h2>प्रयोगकर्ता थप्नुहोस </h2>
                        <div class="userprofiletable">
                            <?php echo $message;?>
                            <form method="post">
                            <table class="table table-bordered table-responsive">
                                            <tr>
                                              <td>प्रयोगकर्ताको नाम :</td>
                                              <td><input type="text" name="name" required></td>
                                            </tr>
                                            <tr>
                                             <td>सम्पर्क न.:</td>
                                              <td><input type="text" name="phone" required>	</td>
                                            </tr>
                                            <tr>
                                              <td>वार्ड न.  :</td>
                                                      <td>
                                                          <select name="ward" >
                                                                  <option value="">छान्नुहोस् </option>
                                                                  <option value="1">१  </option>
                                                                  <option value="2">२  </option>
                                                                  <option value="3">३  </option>
                                                                  <option value="4">४   </option>
                                                                  <option value="5">५  </option>
                                                                  <option value="6">६  </option>
                                                                  <option value="7">७  </option>
                                                                  <option value="8">८   </option>
                                                                  <option value="9">९  </option>
                                                                  <option value="10">१०  </option>
                                                                  <option value="11">११  </option>

                                                           </select>
                                                      </td>
                                            </tr>

                                              <td>इमेल ठेगाना:</td>
                                              <td><input type="email" name="email" required></td>
                                            </tr>
                                            <tr>
                                                <td> कार्यरत अवस्था :</td>
                                                  <td><input type="radio" name="status" value="1"/>Active|
                                                  <input type="radio" name="status" value="0"/>Inactive
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> मोड  :</td>
                                                  <td>
                                                      <select name="mode">
                                                          <option value="">छान्नुहोस्</option>
                                                          <option value="0">सुपर एडमिन</option>
                                                              <option value="1">एडमिन</option>
                                                          <option value="2">प्रयोगकर्ता </option>
                                                      </select>
                                                  </td>
                                            </tr>
                                             <tr>
                                                <td>जारी मिती :</td>
                                                <td><input type="text" name="appointed_date" id="nepaliDate5" />
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                              <td>युजरनेम:</td>
                                              <td><input type="text" name="username" required></td>
                                            </tr>
                                            <tr>
                                              <td>पास्स्वोर्ड :</td>
                                              <td><input type="password" name="password" required id="new_password"></td>
                                            </tr>
                                            <tr>
                                              <td>पास्स्वोर्ड पुनः हाल्नुहोस :</td>
                                              <td><input type="password" name="password1" required id="confirm_password" oninput="myFunction()"   ><span id="demo"></span></td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td><input type="submit" name="submit" value="इन्ट्री गर्नुहोस" class="submithere"></td>
                                            </tr>
                              
                            </table>
                            </form>
                        </div>

                        
                    </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>