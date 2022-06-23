<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
 $adesh_id = '';
$print_url = '#';
$adesh_id = (int) $_GET['adesh_id'];
$data_1 = KharidAdeshProfile::find_by_id($adesh_id);
 $maag= Kharid_mag_faram1::find_by_id($data_1->maag_id); 
 $fiscal_year= Fiscalyear::find_by_id($maag->fiscal_id);
if(!empty($data_1)): 
    $print_url = generatePrintUrl();
    $firm_selected = Enlist::find_by_id($data_1->enlist_id);
    if(empty($firm_selected)){
                         $firm_selected = Enlist::setEmptyObjects();
                        $firm_selected->name = $data_1->non_enlist_name;
                        $firm_selected->address = $data_1->non_enlist_address;
                    }
    //$fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
    $data_2 = KharidAdeshItemDetails::find_by_adesh_id($adesh_id);
endif;
$net_total=0;
$item_type = Itemtype::find_all();
?>
<?php include("menuincludes/header1.php"); ?>
<!-- js ends -->
<title>खरिद आदेश खोज्नुहोस :: <?php echo SITE_SUBHEADING;?></title>

</head>

<body>
    <div class="myPrintFinal">
        <div class="userprofiletable">
            <div class="printPage">

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
                            <div class="text-right mt-4"> म. ले. प. फारम नं : ४०२ </div>
                        </div>
                    </div>
                </div>
                <div class="myspacer"></div>
                <div class="text-center mt-3"> <span class="letter_title"> खरिद आदेश </span></div>


                <div class="printContent mt-3">
                    <div class="print-font">
                        <div class="row">
                            <div class="col-8">
<!--                                <div class="">श्री, ....................... </div>-->
                               <br>
                                <div class="">   श्री <?=$firm_selected->name?> </div>
                            </div>
                            <div class="col-4">
                                <div class=""> खरिद आदेश नं. :- <?=convertedcit($adesh_id)?> </div>
                                <div class=" "> खरिद आदेश मिति :- <?=convertedcit($data_1->date_nepali)?> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="">ठेगाना :- <?=$firm_selected->address?></div>
                                <div class="">संस्था दर्ता नं :- <?= convertedcit($firm_selected->darta_number) ?> </div>
                            </div>
                            <div class="col-4">
                                <div class="">फोन नं:- <?= convertedcit($firm_selected->phone_number)?> </div>
                                <div class=""> पान नं :- <?= convertedcit($firm_selected->taxpayer_number)?></div>
                            </div>
                            <div class="col-4">
                                <div class=" "> खरिद सम्वन्धि निर्णय नं : <?=convertedcit($data_1->nirnaya_no)?></div>
                                                <div class=" "> निर्णय मिति : <?=convertedcit($data_1->nirnaya_nepali_date)?> </div>
                            </div>
                        </div>


                        <!--
                        <div class="row">
                            <div class="col-8">
                                
                                <div class="">TPN/PAN :- </div>
                                <div class="">करदाता नं :- <?=$firm_selected->taxpayer_number?> </div>
                                <div class="">संस्था दर्ता नं :- <?= $firm_selected->darta_number ?> </div>
                                <div class="">सम्पर्क नं:- <?= $firm_selected->phone_number?> </div>
                            </div>
                            <div class="col-4">
                               <div class=" ">आर्थिक वर्ष :- <?=convertedcit($fiscal_year->year)?> </div>
                                
                                
                                <div class=" "> खरिद सम्वन्धि निर्णय नं :- 500</div>
                                <div class=" "> निर्णय मिति :- </div>
                            </div>
                        </div>
-->
                    </div>

                </div>
                <div class="">
                    <table class="table myWidth100 table-bordered">
                        <tr>
                            <th class="" rowspan="3"  style="width:3%;">क्र.स.</th>
                            <th colspan="5" class="text-center"> सामानको </th>
                            <th colspan="2" class="text-center"> मूल्य </th>
                            <th class="" rowspan="3">कैफियत</th>

                        </tr>
                        <tr>

                            <th class="" rowspan="2"  style="width:10%;">जिन्सी बर्गिकरण संकेत नं</th>
                            <th class="" rowspan="2">विवरण</th>
                            <th class="" rowspan="2"   style="width:8%;">स्पेशिफिकेशन</th>
                            <th rowspan="2"  style="width:5%;">सामानको परिमाण</th>
                            <th class="" rowspan="2">इकाई</th>


                        </tr>
                        <tr>
                            <th class="myCenter">दर</th>
                            <th class="myCenter">जम्मा</th>
                        </tr>
                        
                        <?php $sn=1; foreach ($data_2 as $list): ?>
                        <?php 
                            $iteminst = getItemInstance($list->category);
                            $item_selected = $iteminst->find_by_id($list->item_id);
                            $budget_selected = Budgettitle::find_by_id($item_selected->budget_title_id);
                            $unit_selected = Unit::find_by_id($item_selected->unit_id);
                            ?>
                        <tr>
                            <td><?=convertedcit($sn)?></td>
                            <td><?=convertedcit($budget_selected->sn)?></td>
                            <td><?= $item_selected->name ?></td>
                            <td><?=$item_selected->specification?></td>
                            <td><?=convertedcit($list->qty)?></td>
                            <td><?=$unit_selected->name?></td>
                            <td><?=convertedcit($list->rate)?></td>
                            <td><?=convertedcit($list->total)?></td>
                            <td><?=$list->remarks?></td>
                            
                        </tr>
                        <?php 
  $net_total+=$list->total;
  $sn++; endforeach;?>

                       <tr>
                                                <th> </th>
                                                <th colspan="6" style="text-align: right;"> जम्मा </th>
                                                <th> <?= convertedcit(placeholder($data_1->total_amount)) ?></th>
                                                <th> </th>
                                            </tr>
                                            <tr>
                                                <th> </th>
                                                <th colspan="6" style="text-align: right;"> मु.अ.कर ( १३% ) </th>
                                                <th> <?php echo convertedcit($data_1->total_vat_amount);?></th>
                                                <th> </th>

                                            </tr>
                                            <tr>
                                                <th> </th>
                                                <th colspan="6" style="text-align: right;">कुल जम्मा </th>
                                                <th> <?= convertedcit(placeholder($data_1->total_with_vat)) ?> </th>
                                                <th> </th>

                                            </tr>
                    </table>
                    <div class="marginmtop10">
                        माथि उल्लिखित सामान मिति <?=convertedcit($data_1->entry_date_nepali)?> भित्र <?=SITE_NAME?> कार्यालयमा दाखिला गरी बिल/इन्भाइस प्रस्तुत गर्नुहोला ।
                    </div>

                </div>
                <div class="banktextdetails1">
                    <div class="border-box margintop10 margintop35">
                        <div class="margin-bottom35"> उपर्युक्तअनुसार खरिद आदेश तयार गर्ने, सिफारिस गर्ने र स्वीकृत गर्नेः </div>
                        <div class="midd-sign-box">
                            <div class="b"> फाँटवालाको दस्तखत : </div>
                            <div> नाम : <span> </span> </div>
                            <div> मिति: </div>
                        </div>
                        <div class="marginleft3p midd-sign-box">
                            <div class="b"> शाखा प्रमुखको दस्तखत : </div>
                            <div> नाम : <span> </span></div>
                            <div> मिति: </div>
                        </div>
                        <div class="marginleft3p midd-sign-box">
                            <div class="b"> कार्यालय प्रमुखको दस्तखत : </div>
                            <div> नाम : <span> </span> </div>
                            <div> मिति: </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>

            <div class="myspacer"></div>

            <div class="banktextdetails1">
                <p class="marginmtop5">माथि उल्लेखित सामानहरु मिति <?= convertedcit($data_1->entry_date_nepali) ?> भित्र <?=SITE_NAME?>मा बुझाउने छु भनी सहिछाप गर्ने । </p>


                <div class="margintop35">
                    <div class="row">
                        <div class="col">
                            फर्मको नाम : <?=$firm_selected->name?>
                        </div>
                        <div class="col">
                            दस्तखत र छाप :
                        </div>
                        <div class="col">
                            मिति :-
                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div><!-- print page ends -->



    </div><!-- print page ends -->
    </div><!-- userprofile table ends -->
    </div><!-- my print final ends -->
