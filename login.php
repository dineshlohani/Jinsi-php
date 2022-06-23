<?php 
	require_once("includes/initialize.php");
    error_reporting(-1);
	if(isset($_POST['submit']))
	{
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$found_user = User::authenticate_for_user($username, $password);
               
                
               
		 if ($found_user)
		{
		$_SESSION['fiscal_year'] = $_POST['fiscal_id'];
           $session->login($found_user);	
			redirect_to('index.php');
		}
		else
		{
			$session->message = "Username or password did not match";	
			redirect_to("login.php");	
		}
	}

?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>Login Panel ::<?=SITE_SUBHEADING?> Jinsi Software</title>

</head>

<body>
    <div id="top_wrap">
        <div class="container">
            <div class="content row">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                	<h1><?=SITE_NAME?>- जिन्सी सफ्टवेयर <img src="images/flag.gif" alt="Nepal Flag Flapping" /></h1> 
                </div>
            </div>
        </div>	
    </div><!-- top wrap ends -->
    <div id="body_wrap">
        <div class="container">
            <div class="content row">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="loginwrap">
                		<h2>लगइन गर्नुहोस् </h2>
                        <div class="logo">
                        	<img src="images/logo_login.png" alt="Logo " />
                            
                            
                        </div>
                        <div id="inputplaceholder">
                        <?php echo $message; ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div id="myusername">
                                <input id="username" type="text" name="username" class="username" placeholder="insert username" required="required" />
                            </div>
                            <div id="mypassword">
                                <input type="password" class="password" name="password" placeholder="insert password"/>
                            </div>
                            <hr><hr>
                            <div>
                                
                                <div id="fiscalyear">
                                <span> आ.ब छान्नुहोस् :- </span>
                                <select  name="fiscal_id" required="required">
                                    <option>----------</option>
                                    <option value="1"><?=convertedcit(2077.2078)?></option>
                                    <option value="2"><?=convertedcit(2078.2079)?></option>
                                </select>
                             </div>
                             <hr><hr>
                            </div>
                            <div id="submit">
                                <input type="submit" name="submit" class="btn" value="लगइन"/>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>