<?php require_once("includes/initialize.php"); ?>
<?php	if(!($session->is_logged_in())){ redirect_to("logout.php");}
$mode = $_SESSION['669d55221cf323ee455e8e94b4840d1ckalika_mode'];
//print_r($mode);
?>

<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>Jinsi Software</title>

</head>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    
    <div id="body_wrap_inner"> 
    	
        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 maincontent">
            <h2 class="dashboard">जिन्सी सफ्टवेयरको ड्यासबोर्डमा यहाँहरुलाई स्वागत छ |</h2>
            <div class="dashboardcontent">
                 <?php
                        if ($mode == 'administrator') {?>
                <a href="dashboard_maag.php">
                    <div class="userprofile1">
                        <h3>माग फारम</h3>
                        <div class="dashimg">
                           <img src="images/icon06.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_kharid.php">	
                    <div class="userprofile1">
                       <h3>खरिद आदेश</h3>
                       <div class="dashimg">
                           <img src="images/icon01.png" alt="New Plan  Icons" class="dashimg" />
                       </div>

                   </div></a><!-- user profile ends -->

                   <a href="dashboard_dakhila.php">
                       <div class="userprofile1">
                        <h3>दाखिला रिर्पोट</h3>
                        <div class="dashimg">
                           <img src="images/icon05.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsikhata.php">
                       <div class="userprofile1">
                        <h3>जिन्सी खाता</h3>
                        <div class="dashimg">
                           <img src="images/icon02.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->

                   <a href="dashboard_prastabana.php">
                     <div class="userprofile1">
                       <h3>प्रस्तावना </h3>
                       <div class="dashimg">
                           <img src="images/icon11.png" alt="Billing Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsitippani.php">
                     <div class="userprofile1">
                       <h3>टिप्पणी</h3>
                       <div class="dashimg">
                           <img src="images/icon11.png" alt="Billing Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsinirakshan.php"><div class="userprofile1">
                       <h3>जिन्सी निरिक्षण</h3>
                       <div class="dashimg">
                           <img src="images/icon03.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsinmaujad.php"><div class="userprofile1">
                    <h3>जिन्सी मौज्जाद</h3>
                    <div class="dashimg">
                       <img src="images/icon04.png" alt="New Plan  Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_hastantaran.php">
                 <div class="userprofile1">
                   <h3>हस्तान्तरण</h3>
                   <div class="dashimg">
                       <img src="images/icon07.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_gharjagga.php">
                 <div class="userprofile1">
                   <h3>घर जग्गा अभिलेख खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon08.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_jinsiminha.php">
                 <div class="userprofile1">
                   <h3>जिन्सी मिन्हा</h3>
                   <div class="dashimg">
                       <img src="images/icon09.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_jinsililam.php">
                 <div class="userprofile1">
                   <h3>जिन्सी लिलाम</h3>
                   <div class="dashimg">
                       <img src="images/icon10.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->

               <a href="dashboard_bhadadiyeko.php">
                 <div class="userprofile1">
                   <h3>भाडामा दिएको सम्पतीको अभिलेख खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon12.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_bhadaliyeko.php">
                 <div class="userprofile1">
                   <h3>भाडामा लिएको मेशिन औजारको अभिलेख खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon13.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->

               <a href="dashboard_stock_check.php">
                 <div class="userprofile1">
                   <h3>स्टक </h3>
                   <div class="dashimg">
                       <img src="images/icon13.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->			
               <a href="settings.php"><div class="userprofile1">
                   <h3>सेटिंग</h3>
                   <div class="dashimg">
                       <img src="images/icon14.png" alt="Settings Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="aanya_prastabana_dashboard.php"><div class="userprofile1">
                   <h3>अन्य प्रस्तावना</h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_marmat_adesh.php"><div class="userprofile1">
                   <h3>मर्मत आदेश </h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a> 
               <a href="hastantaran_dashboard.php"><div class="userprofile1">
                   <h3>स्टक हाल्नुहोस </h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a> 
               <a href="bill_control_dashboard.php"><div class="userprofile1">
                   <h3>रसिद नियन्त्रण खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a> 
               <a href="dashboard_ledger.php"><div class="userprofile1">
                   <h3>सहायक जिन्सी खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a>
               <a href="machinary_dashboard.php"><div class="userprofile1">
                   <h3>चल्ती मेशिन वा सवारीको मर्मत किताब भर्नुहोस</h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a>
               <a href="jimmewari_dashboard.php"><div class="userprofile1">
                   <h3>मौज्जाद तथा जिम्मेबारी विवरण खाता</h3>
                   <div class="dashimg">
                       <img src="images/icon15.png" alt="Report Icons" class="dashimg" />
                   </div>
               </div></a>
           <?php } 
           else{ ?>
                 <a href="dashboard_dakhila.php">
                       <div class="userprofile1">
                        <h3>दाखिला रिर्पोट</h3>
                        <div class="dashimg">
                           <img src="images/icon05.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsikhata.php">
                       <div class="userprofile1">
                        <h3>जिन्सी खाता</h3>
                        <div class="dashimg">
                           <img src="images/icon02.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsinirakshan.php"><div class="userprofile1">
                       <h3>जिन्सी निरिक्षण</h3>
                       <div class="dashimg">
                           <img src="images/icon03.png" alt="New Plan  Icons" class="dashimg" />
                       </div>
                   </div></a><!-- user profile ends -->
                   <a href="dashboard_jinsinmaujad.php"><div class="userprofile1">
                    <h3>जिन्सी मौज्जाद</h3>
                    <div class="dashimg">
                       <img src="images/icon04.png" alt="New Plan  Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
               <a href="dashboard_stock_check.php">
                 <div class="userprofile1">
                   <h3>स्टक </h3>
                   <div class="dashimg">
                       <img src="images/icon13.png" alt="Billing Icons" class="dashimg" />
                   </div>
               </div></a><!-- user profile ends -->
          <?php  }
           ?>
           </div>
       </div><!-- main menu ends -->

   </div><!-- top wrap ends -->
   <?php include("menuincludes/footer.php"); ?>