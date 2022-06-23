<?php require_once("includes/initialize.php"); 

$fiscals = FiscalYear::find_all();
$current_fiscal = Fiscalyear::find_current_id();
$rent_units=  Rentunit::find_all();
$sql= "select * from bhada_taken group by khata_number asc";
$bhada = Bhadataken::find_by_sql($sql);

//$datas= Enlist::find_all();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>भाडामा लिएको  अभिलेख किताब भर्नुहोस	</title>


<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	
                <div class="maincontent">
                    <h2 class="headinguserprofile"> भाडामा लिएको अभिलेख किताब हेर्नुहोस	| <a href="dashboard_bhadaliyeko.php" class="btn">पछि जानुहोस </a> </h2>
                    <div class="OurContentFull">
                    	<h2> भाडामा लिएको  अभिलेख किताब भर्नुहोस	</h2>
                        <div class="userprofiletables">
                        
                          <table class="table table-bordered table-responsive myWidth80 box_center">
                              <tr>
                                  <th>अविलेख खाता नं  </th>
                                  <th>भाडामा दिनेको नाम</th>
                                  <th>ठेगाना</th>
                                  <th>सम्पर्क न</th>
                                  <th>विवरण</th>
                              </tr>
                      <?php foreach($bhada as $data): 
                          $enlist = Bhadaenlist::find_by_id($data->enlist_id);
                          ?>
                              <tr>
                                  <td><?= convertedcit($data->khata_number) ?></td>
                                  <td><?= $enlist->name ?></td>
                                  <td><?= $enlist->address ?></td>
                                  <td><?= convertedcit($enlist->number) ?></td>
                                  <td><a class="btn" href="bhadadiyeko_view_taken.php?enlist_id=<?= $data->enlist_id ?>&khata_number=<?= $data->khata_number ?>">विवरण हेर्नुहोस</a></td>
                              </tr>
                      <?php endforeach; ?>        
                          </table>
                  
                            
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
             
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

<?php

