<?php
$mode = $_SESSION['669d55221cf323ee455e8e94b4840d1ckalika_mode'];
//print_r($mode);
?>

<div class="mainmenu">
    	<nav>
            <ul>
            	<?php if($mode == 'administrator'){?>
                <li><a href="index.php">गृहपृष्ठ</a></li>
                <li><a href="settings.php">सेटिंग</a>
                	<ul>
                		<li><a href="settings_department_add.php">शाखाको नाम थप्नुहोस</a></li>
                		<li><a href="settings_item_type_add.php">सामानको किसिम थप्नुहोस</a></li>
                		<li><a href="settings_budget_title_add.php">बजेट शिर्षक थप्नुहोस</a></li>
                		<li><a href="settings_units_add.php">इकाईको किसिम थप्नुहोस</a></li>
                		<li><a href="settings_spent_item_add.php">खर्च हुने सामानको विवरण थप्नुहोस</a></li>
                		<li><a href="settings_not_spent_item_add.php">खर्च नहुने सामानको विवरण थप्नुहोस</a></li>
                		<li><a href="settings_item_physical_condition_add.php">सामानको भौतिक अवस्था थप्नुहोस </a></li>
                		<li><a href="setting_office.php">कार्यालय थप्नुहोस</a></li>
                		<li><a href="settings_worker.php">कर्मचारी  थप्नुहोस</a></li>
                		<li><a href="settings_land_unit.php">जग्गाको इकाई थप्नुहोस</a></li>
                		<li><a href="settings_land_type.php">जग्गाको किसिम थप्नुहोस</a></li>
                		<li><a href="settings_current_land_type.php">जग्गा प्राप्त हुँदाको बखतको किसिम</a></li>
                		<li><a href="settings_rent_unit.php">भाडाको इकाई थप्नुहोस</a></li>
                		<li><a href="settings_prakar_type_add.php">प्रस्ताबको प्रकार थप्नुहोस</a></li>
                		<li><a href="settings_enlist_view.php">सुची दर्ता</a></li>
                	</ul>
                </li>
                <!--<li><a href="#">रिपोर्ट हेर्नुहोस </a></li>-->
                <li><a href="dashboard_maag.php">माग फारम</a></li>
                <li><a href="dashboard_kharid.php">खरिद आदेश</a></li>
                <li><a href="dashboard_dakhila.php">दाखिला रिर्पोट</a>
                <li><a href="dashboard_jinsikhata.php">जिन्सी खाता</a></li>
                <li><a href="dashboard_jinsinirakshan.php">जिन्सी निरिक्षण</a></li>
                <li><a href="dashboard_jinsinmaujad.php">जिन्सी मौज्जाद</a></li>
                <li><a href="dashboard_hastantaran.php">हस्तान्तरण</a></li>
                <li><a href="dashboard_jinsiminha.php">जिन्सी मिन्हा</a></li>
                <li><a href="dashboard_jinsililam.php">जिन्सी लिलाम</a></li>
                <li><a href="dashboard_prastabana.php">प्रस्तावना </a></li>
                <li><a href="dashboard_jinsitippani.php">जिन्सी टिप्पणी</a>
                    <ul>
                        <li><a href="jinsitippani.php">जिन्सी टिप्पणी भर्नुहोस् </a></li>
                        <li><a href="jinsi_tippani_search.php">जिन्सी टिप्पणी खोज्नुहोस </a></li>
                    </ul>
                </li>
                <li><a href="#">सम्पतीको अभिलेख खाता</a>
                    <ul>
                        <li><a href="dashboard_gharjagga.php">घर जग्गा अभिलेख खाता</a></li>
                        <li><a href="dashboard_bhadadiyeko.php">भाडामा दिएको सम्पतीको अभिलेख खाता</a></li>
                        <li><a href="dashboard_bhadaliyeko.php">भाडामा लिएको मेशिन औजारको अभिलेख खाता</a></li>
                    </ul>
                </li>        
                
                   <li>
                    <a href="prastab_view.php">खरिद इकाई प्रस्ताब निर्णय</a>
                </li>
                <li>
                    <a href="evaluation_view.php">मुल्यांकन समिति</a>
                </li>
            
        <?php } 
        else {?>
        
        <li><a href="index.php">गृहपृष्ठ</a></li>
        
        
        <?php }?>
        
        </ul>
        </nav>		
        
    </div><!-- main menu ends -->