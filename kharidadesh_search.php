<?php require_once("includes/initialize.php"); 
    $adesh_id = '';
    $print_url = '#';
    $net_total=0;
    if(isset($_GET['adesh_id']))
    {

                    $adesh_id = (int) $_GET['adesh_id'];
                    $data_1 = KharidAdeshProfile::find_by_id($adesh_id);
                    //print_r($data_1);
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
                    //print_r($data_2);
                    endif;
    }
    else
    {
        $sql_one="select * from kharid_adesh_profile order by id desc";
        $data_1=  KharidAdeshProfile::find_by_sql($sql_one);
        //print_r($data_1);
    }
      $item_type = Itemtype::find_all();
      //$deps = Department::find_all();
    ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>खरिद आदेश खोज्नुहोस:: <?php echo SITE_SUBHEADING;?></title
</head>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner">
        <div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">खरिद आदेश खोज्नुहोस / <a href="dashboard_kharid.php" class="btn">खरिद आदेशमा जानुहोस </a></h2>
                    <div class="OurContentFull">
                        <h2>खरिद आदेश खोज्नुहोस </h2>
                        <div class="userprofiletable">
                            <form method="get">
                                <table class="table table-responsive search_table">
                                    <tr>
                                        <td><b> खरिद आदेश खोज्नुहोस: </b><input class="fill_height" type="text" name="adesh_id" value="<?=$adesh_id?>" /> <input type="submit" value="खोज्नुहोस" class="btn search_btn" /></td>
                                    </tr>
                                </table>
                            </form>
                            <?php if(isset($_GET['adesh_id'])){// show if maag_id is selected ?>
                            <?php if(!empty($data_1)){
                                    $maag= Kharid_mag_faram1::find_by_id($data_1->maag_id); 
                                   $fiscal_year= Fiscalyear::find_by_id($maag->fiscal_id);
                                    ?>
                            <div class="myPrint"><a href="<?=$print_url?>" target="_blank">प्रिन्ट गर्नुहोस</a></div>
                            <div class="myspacer"></div>
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
                                <div class="printContent">
                                    <div class="print-font">
                                        <div class="row">
                                            <div class="col-9">
                                               <br>
                                                <div class="">  श्री <?=$firm_selected->name?> </div>
                                            </div>
                                            <div class="col-3">
                                                <div class=""> खरिद आदेश नं. :- <?=convertedcit($adesh_id)?> </div>
                                                <div class=" "> खरिद आदेश मिति :- <?=convertedcit($data_1->date_nepali)?> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="">ठेगाना :- <?=$firm_selected->address?></div>
                                                <div class="">संस्था दर्ता नं :- <?= convertedcit($firm_selected->darta_number) ?> </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="">फोन नं:- <?= convertedcit($firm_selected->phone_number)?> </div>
                                                <div class=""> पान नं :- <?= convertedcit($firm_selected->taxpayer_number)?> </div>
                                            </div>
                                            <div class="col-3">
                                                <div class=" "> खरिद सम्वन्धि निर्णय नं : <?=convertedcit($data_1->nirnaya_no)?></div>
                                                <div class=" "> निर्णय मिति : <?=convertedcit($data_1->nirnaya_nepali_date)?> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <table class="table table-responsive table-bordered">
                                            <tr>
                                                <th class="" rowspan="3"  style="width:3%;">क्र.स.</th>
                                                <th colspan="5" class="text-center"> सामानको </th>
                                                <th colspan="2" class="text-center"> मूल्य </th>
                                                <th class="" rowspan="3">कैफियत</th>
                                            </tr>
                                            <tr>
                                                <th class="" rowspan="2" style="width:8%;">जिन्सी बर्गिकरण संकेत नं</th>
                                                <th class="" rowspan="2">विवरण</th>
                                                <th class="" rowspan="2">स्पेशिफिकेशन</th>
                                                <th rowspan="2" style="width:5%;">सामानको परिमाण</th>
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
                                                <th> <?= convertedcit(placeholder($data_1->total_vat_amount)) ?></th>
                                                <th> </th>
                                            </tr>
                                            <tr>
                                                <th> </th>
                                                <th colspan="6" style="text-align: right;">कुल जम्मा </th>
                                                <th> <?= convertedcit(placeholder($data_1->total_with_vat)) ?> </th>
                                                <th> </th>
                                            </tr>
                                        </table>
                                        <div class="marginmtop10 print-font">
                                            माथि उल्लिखित सामान मिति <?=convertedcit($data_1->entry_date_nepali)?> भित्र <?=SITE_NAME?> कार्यालयमा दाखिला गरी बिल/इन्भाइस प्रस्तुत गर्नुहोला ।
                                        </div>
                                    </div>
                                    <div class="banktextdetails1 print-font">
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
                                    <div class="myspacer"></div>

                                    <div class="banktextdetails1 print-font">
                                        <p class="marginmtop5">माथि उल्लेखित सामानहरु मिति <?= convertedcit($data_1->entry_date_nepali) ?> भित्र <?=SITE_NAME?>मा बुझाउने छु भनी सहिछाप गर्ने । </p>


                                        <div class="margintop35 px-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    फर्मको नाम : <?=$firm_selected->name?>
                                                </div>
                                                <div class="col-md-4">
                                                    दस्तखत र छाप :
                                                </div>
                                                <div class="col-md-4">
                                                    मिति :-
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <?php }else
                                {?>
                                    <h3>maag not found</h3>
                                    <?php }
                                ?>
                                    <?php }else{// show if maag_id is selected ?>

                                    <table class="table table-bordered td1">
                                        <tr>
                                            <th>सि.नं</th>
                                            <th>खरिद आदेश नं </th>
                                            <th>खरिद आदेश दिएको मिति</th>
                                            <th>फर्म / कम्पनिको नाम</th>
                                            <th>पुरा विवरण </th>
                                        </tr>
                                        <?php $i=1; foreach($data_1 as $data):
                                                 $check_adesh= Dakhilaprofile::check_adesh($data->id);
                                                   $check_mag_form= Prastabanaadd::check_mag_form_id($data->maag_id);

                                                      $firm_selected = Enlist::find_by_id($data->enlist_id);
                                                        if(empty($firm_selected)){
                                                            $firm_selected = Enlist::setEmptyObjects();
                                                            $firm_selected->name = $data->non_enlist_name;
                                                            $firm_selected->address = $data->non_enlist_address;
                                                        }                                             
                                                    ?>
                                        <tr>
                                            <td><?= convertedcit($i) ?></td>
                                            <td><?=convertedcit($data->id)?></td>
                                            <td><?=convertedcit($data->date_nepali)?></td>
                                            <td><?= $firm_selected->name ?></td>
                                            <td><a class="btn" href="kharidadesh_search.php?adesh_id=<?=$data->id?>">पुरा विवरण हेर्नुहोस </a>
                                                <?php if($check_adesh==FALSE): ?>
                                                <a class="btn" href="kharidadesh_edit.php?id=<?=$data->id?>&maag_id=<?= $data->maag_id ?>">सच्याउनुहोस</a>
                                                <a class="btn" onclick="return confirm('के तपाई निश्चित हुनुन्छ?');" href="kharidadesh_delete.php?id=<?=$data->id?>">हटाउनु होस्</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach;?>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div><!-- print page ends -->
                        </div>
                    </div>
                </div><!-- main menu ends -->
            </div>
        </div>
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>
