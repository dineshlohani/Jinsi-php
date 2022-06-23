<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
$maag_id = '';
$print_url = '#';
//print_r($_GET);exit;
if(!empty($_GET['maag_worker_id']))
{
    $maag_worker_selected = Workers::find_by_id($_GET['maag_worker_id']);
}
else
{
    $maag_worker_selected = Workers::setEmptyObjects();
}
if(!empty($_GET['sifaris_worker_id']))
{
    $sifaris_worker_selected = Workers::find_by_id($_GET['sifaris_worker_id']);
}
else
{
    $sifaris_worker_selected = Workers::setEmptyObjects();
}
if(!empty($_GET['aadesh_worker_id']))
{
    $aadesh_worker_selected = Workers::find_by_id($_GET['aadesh_worker_id']);
}
else
{
    $aadesh_worker_selected = Workers::setEmptyObjects();
}
		$maag_id = (int) $_GET['maag_id'];
        $data_1 = Kharid_mag_faram1::find_by_id($maag_id);

        if(!empty($data_1)): 
            $print_url = generatePrintUrl();
            $dep_selected = Department::find_by_id($data_1->department_id);
    		$fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
    		 $date_selected= convertedcit(DateEngToNep($data_1->maag_date_english));
    		$data_2 = Kharid_mag_faram2::find_by_maag_id($maag_id);
        endif;
                 $item_type = Itemtype::find_all();
  $deps = Department::find_all();
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खरिद माग फारम खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>


<body>
    <div class="myPrintFinal">
        <div class="userprofiletable">
            <div class="printPage">

                <div class="printlogo">
                    <div class="letter_head">
                        <div class="row">
                            <div class="col-3">
                                <img src="images/janani.png" alt="Logo">
                            </div>
                            <div class="col-6 text-center">
                                <h1 class=""><?=SITE_NAME?></h1>
                                <h3 class=""><?=SITE_LOCATION?></h3>
                                <h4 class=" "><?=SITE_ADDRESS?></h4>
                                <h4 class=""> कार्यालय कोड नं: </h4>
                            </div>
                            <div class="col-3 text-right">
                                <div class="text-right mt-4"> म. ले. प. फारम नं : ४०१ </div>
                            </div>
                        </div>
                    </div>
                    <div class="myspacer"></div>
                    <div class="text-center mt-3"> <span class="letter_title"> माग फाराम </span></div>
                    <div class="printContent">
                        <div class="row">
                            <div class="col-9">

                            </div>
                            <div class="col-3">
                                <div class=" in_block">आर्थिक वर्ष :<?php echo convertedcit($fiscal_selected->year); ?></div><br>
                                <div class=" in_block">माग नं: <?=convertedcit($maag_id);?> </div><br>
                                <div class=" in_block"> मिति : <?= convertedcit($data_1->maag_date) ?> </div>
                            </div>
                        </div>

                        <div class="banktextdetailss">
                            <table class="table table-bordered">
                                            <tr>
                                                <th class="width3" rowspan="2" class="">क्र.स.</th>
                                                <th rowspan="2" class="">सामानको नाम</th>
                                                <th rowspan="2" class="">स्पेशिफिकेशन</th>
                                                <th colspan="2" class="text-center"> माग गरिएको </th>
                                                
<!--
                                                <th>सामानको परिमाण</th>
                                                <th>इकाई</th>
                                                <th>निकासी सामानको परिमाण</th>
                                                <th>जिन्सी खाता पाना नं</th>
-->
                                                <th rowspan="2" class="">कैफियत</th>
                                            </tr>
                                            <tr>
                                                <th class=""> एकाइ </th>
                                                <th class=""> परिमाण </th>
                                            </tr>
                                            
                                            <?php $sn=1; foreach ($data_2 as $list): 
                                                                                        
                                                                                        ?>

                                            <?php 
                                                    $iteminst = getItemInstance($list->category);
                                                   $item_selected = $iteminst->find_by_id($list->item_id);
                                                   $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                                                   $unit_selected = Unit::find_by_id($item_selected->unit_id);
                                                     $stock = ItemStock::find_by_item_id_and_category($item_selected->id,1);
                                             ?>
                                            <tr>
                                                <td><?=convertedcit($sn)?></td>
                                                <td><?=$item_selected->name?></td>
                                                <td><?=$item_selected->specification?></td>
                                                <td><?=$unit_selected->name?></td>
                                                <td> <?=convertedcit(intval($list->qty))?></td>
                                                <td> <?=$list->remarks?> </td>
<!--
                                                <td><?=convertedcit($stock->khata_id)?></td>
                                                <td></td>
-->
                                            </tr>
                                            <?php $sn++; endforeach;?>
                                        </table>
                        </div>
                        <div class="">
                            <div class="row mt-3">
                                <div class="col-4">
                                    <div class=" "> माग गर्नेको दस्तखत : </div>
                                    <div class=" "> नाम : <?=$maag_worker_selected->name?></div>
                                    <div class=" "> मिति </div>
<!--                                    <div class=" "> प्रयोजन </div>-->
                                    <div class=" "> प्रयोजन- <?= $dep_selected->name ?>को लागी </div>

                                    <div class="mt-5"> मालसामान बुझिलिनेको दस्तखत : </div>
                                    <div class=""> मिति : </div>
                                </div>
                                <div class="col-4">
                                    <div class=""> सिफारिस गर्नेको दस्तखत : </div>
                                    <div class=""> नाम : <?=$sifaris_worker_selected->name?></div>
                                    <div class=""> मिति : </div>
                                </div>
                                <div class="col-4">
                                    <div class=""> क. बजारबाट खरिद गरिदिनु । <input type="checkbox"  <?php if($data_1->kharid_maag_process==1 ){ ?> checked="checked" <?php } ?> disabled="true" > </div>
                                    <div class=""> ख. मौज्दातबाट दिनु । <input type="checkbox"  <?php if($data_1->kharid_maag_process==2 ){ ?> checked="checked" <?php } ?> disabled="true"  > </div>
                                    <div class="mt-5"> आदेश दिनेको दस्तखत </div>
                                    <div class=""> नाम : <?=$aadesh_worker_selected->name?></div>
                                     <div class=""> मिति : </div>
                                    <div class="mt-5"> जिन्सी खातामा चढाउनेको दस्तखत </div>
                                    <div class=""> मिति : </div>

                                </div>
                            </div>
                        </div>


                        <div class="myspacer"></div>
                    </div>

                </div><!-- print page ends -->



            </div><!-- print page ends -->
        </div><!-- userprofile table ends -->
    </div><!-- my print final ends -->
