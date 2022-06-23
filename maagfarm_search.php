<?php require_once("includes/initialize.php"); 
    $maag_id = '';
    $print_url = '#';
    if(isset($_GET['maag_id']))
    {

                    $maag_id = (int) $_GET['maag_id'];
                    $data_1 = Kharid_mag_faram1::find_by_id($maag_id);
                    if(!empty($data_1)): 
                    $print_url = generatePrintUrl();
                    $dep_selected = Department::find_by_id($data_1->department_id);
                    $fiscal_selected = Fiscalyear::find_by_id($data_1->fiscal_id);
                    $date_selected= convertedcit(DateEngToNep($data_1->maag_date_english));
                    $data_2 = Kharid_mag_faram2::find_by_maag_id($maag_id);
                    endif;

    }
    else
    {
        $sql_one = "select * from kharid_mag_faram_1 order by id desc";
        $data_1=Kharid_mag_faram1::find_by_sql($sql_one);
    }
    $item_type = Itemtype::find_all();
    $deps = Department::find_all();
    $jinsi_workers = Workers::getJinsiWorkers(); 
    ?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title> माग फारम खोज्नुहोस:: <?php echo SITE_SUBHEADING;?></title>



<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner">
        <div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile"> माग फाराम खोज्नुहोस |<a href="dashboard_maag1.php" class="btn">पछी जानुहोस</a></h2>

                    <div class="OurContentRight2">

                        <div class="userprofiletable mySearchBox">
                            <form method="get">
                                <table class="table table-responsive search_table">
                                    <tr>
                                        <td><b> माग फारम खोज्नुहोस: </b> <input class="fill_height" type="text" name="maag_id" value="<?=$maag_id?>" /> <input type="submit" value="खोज्नुहोस" class="btn search_btn" /></td>
                                    </tr>
                                </table>
                            </form>
                            <?php if(isset($_GET['maag_id'])){// show if maag_id is selected ?>
                            <?php if(!empty($data_1)){ ?>
                            <div class="myPrint"><form method="get" target="_blank" action="<?=$print_url?>" ><input type="submit" value="प्रिन्ट गर्नुहोस" /><input type="hidden" name="maag_id" value="<?=$_GET['maag_id']?>" /></div>
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
                                            <div class="text-right mt-4"> म. ले. प. फारम नं : ४०१ </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="myspacer"></div>

                                    <div class="text-center mt-3"> <span class="letter_title"> माग फाराम </span></div>
                                    <div class="printContent">
                                        <div class="row">
                                            <div class="col-10">

                                            </div>
                                            <div class="col-2">
                                                <div class=" in_block">आर्थिक वर्ष :<?php echo convertedcit($fiscal_selected->year); ?></div><br>
                                                <div class=" in_block">माग नं: <?=convertedcit($maag_id)?> </div><br>
                                                <div class=" in_block"> मिति : <?= convertedcit($data_1->maag_date) ?> </div>
                                            </div>
                                        </div>

                                        <div class="">
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
                                                    <td> <?=$list->remarks?></td>
                                                    <!--
                                                <td><?=convertedcit($stock->khata_id)?></td>
                                                <td></td>
-->
                                                </tr>
                                                <?php $sn++; endforeach;?>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="myfont">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="b"> माग गर्नेको दस्तखत : </div>
                                                    <div class=" "> नाम <select name="maag_worker_id">
                                                                             <option value="">--छान्नुहोस--</option>
                                                                            <?php 
                                                                                  foreach($jinsi_workers as $jinsi_worker):    
                                                                                ?>
                                                                            <option value="<?=$jinsi_worker->id?>"><?=$jinsi_worker->name?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        </div>
                                                    <div class=" "> मिति </div>
                                                    <!--                                               <div class=" "> प्रयोजन  </div>-->
                                                    <div class=" "> प्रयोजन- <?= $dep_selected->name ?>को लागी </div>

                                                    <div class="mt-5"> मालसामान बुझिलिनेको दस्तखत : </div>
                                                    <div class=""> मिति : </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="b"> सिफारिस गर्नेको दस्तखत : </div>
                                                    <div class=""> नाम : <select name="sifaris_worker_id">
                                                                             <option value="">--छान्नुहोस--</option>
                                                                            <?php  
                                                                                  foreach($jinsi_workers as $jinsi_worker):    
                                                                                ?>
                                                                            <option value="<?=$jinsi_worker->id?>"><?=$jinsi_worker->name?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        
                                                    </div>
                                                    <div class=""> मिति : </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class=""> क. बजारबाट खरिद गरिदिनु । <input type="checkbox" <?php if($data_1->kharid_maag_process==1 ){ ?> checked="checked" <?php } ?> disabled="true" > </div>
                                                    <div class=""> ख. मौज्दातबाट दिनु । <input type="checkbox" <?php if($data_1->kharid_maag_process==2 ){ ?> checked="checked" <?php } ?> disabled="true"  > </div>
                                                    <div class="mt-5"> आदेश दिनेको दस्तखत <select name="aadesh_worker_id">
                                                                            <option value="">--छान्नुहोस--</option>
                                                                            <?php 
                                                                                  foreach($jinsi_workers as $jinsi_worker):    
                                                                                ?>
                                                                            <option value="<?=$jinsi_worker->id?>"><?=$jinsi_worker->name?></option>
                                                                            <?php endforeach; ?>
                                                                        </select></form></div>
                                                    <div class=""> मिति : </div>
                                                    <div class="mt-5"> जिन्सी खातामा चढाउनेको दस्तखत </div>
                                                    <div class=""> मिति : </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php }else
                                {?>
                                        <h3>maag not found</h3>
                                        <?php }
                                ?>
                                        <?php }else{// show if maag_id is selected ?>
                                        <div class="our_contents">
                                            <table class="table table-bordered td1">
                                                <tr>
                                                    <th>सि. नं .</th>
                                                    <th>माग फारम नं </th>
                                                    <th>माग गरेको मिति</th>
                                                    <th>माग फारमको प्रकार</th>
                                                    <th>फर्म / कम्पनिको नाम</th>
                                                    <th>&nbsp;</th>

                                                </tr>
                                                <?php $i=1; 
                                                    foreach($data_1 as $data):
                                                    $type = ($data->kharid_maag_process==1)? 'बजारबाट खरिद' : 'मौज्दातबाट वितरण';
                                                    $check_id = KharidAdeshProfile::check_maag_id($data->id);
                                                     $enlist_id = KharidAdeshProfile::get_enlist_from_maag($data->id);
                                                     if(!$enlist_id)
                                                     {
                                                         $enlist_name = "";
                                                     }
                                                     else
                                                     {
                                                        $firm_selected = Enlist::find_by_id($enlist_id);
                                                        $enlist_name = $firm_selected->name;
                                                     }
                                                     
                                                    ?>
                                                <tr>
                                                    <td><?= convertedcit($i) ?></td>
                                                    <td><?=convertedcit($data->id)?></td>
                                                    <td><?=convertedcit($data->maag_date)?></td>
                                                    <td><?=$type?></td>
                                                    <td><?= $enlist_name  ?></td>
                                                    <td><a class="btn" href="maagfarm_search.php?maag_id=<?=$data->id?>">पुरा विवरण हेर्नुहोस </a>
                                                        <?php if($check_id==FALSE): ?>
                                                        <a class="btn" href="maagfarm_edit.php?id=<?=$data->id?>">सच्याउनु होस् </a> <a onclick="return confirm('के तपाई निश्चित हुनुन्छ?');" class="btn" href="maagfarm_delete.php?id=<?= $data->id ?>">हटाउनु होस्</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; endforeach;?>
                                            </table>
                                        </div>
                                        <?php } ?>
                                        <div class="myspacer"></div>
                                    </div>

                                </div><!-- print page ends -->






                            </div>
                        </div>
                    </div><!-- main menu ends -->
                </div>
            </div>
        </div><!-- top wrap ends -->
        <?php include("menuincludes/footer.php"); ?>
