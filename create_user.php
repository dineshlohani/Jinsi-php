<?php
require_once("includes/initialize.php"); 
 error_reporting(1);
 include("menuincludes/header.php");
?>
 <?php $datas= User::find_all();
 // echo "<pre>";
 // print_r($datas);
 $data= Department::find_all();
//  $depart = "SELECT t1.*,t2.name as department FROM user t1
// LEFT JOIN settings_department t2 ON t2.id = t1.department";
// echo $depart;
// exit;
// print_r(mysqli_fetch_array($depart));
// exit;
//  echo "<pre>";
//  print_r($result);
?>
<?php include("menuincludes/topwrap.php"); ?>
	<ol class="breadcrumb" style="text-align: center;">
	<li class="breadcrumb-item" ><a href="user_add.php">प्रयोगकर्ता थप्नुहोस</a></li></ol>
				<table class="table table-bordered table-responsive">
					<thead>
						<th>क्र.सं</th>
						<th>प्रयोगकर्ताको नाम</th>
						<th>वार्ड नं</th>
						<th>फोन नं</th>
						<th>ई-मेल</th>
						<th>युजरनेम</th>
						<th>मोड</th>
						<th>शाखा</th>
						<th>सच्याउनुहोस्</th>
					</thead>
					<tbody>
						<?php $i=1;foreach($datas as $data): ?>
						<?php 
						if($data->mode==0)
						{
							$mode="सुपर एडमिन";
						}
						elseif ($data->mode==1) 
						{
							$mode="एडमिन";
						}
						elseif ($data->mode==2)
						{
							$mode="प्रयोगकर्ता";
						}
						?>
						
						<?php 
						$i = 1;
						?>
						<td><?php echo convertedcit($i++) ?></td>
						<td><?php echo convertedcit($data->name)?></td>
						<td><?php echo convertedcit($data->ward)?></td>
						<td><?php echo convertedcit($data->phone)?></td>
						<td><?php echo $data->email?></td>
						<td><?php echo $data->username?></td>
						<td><?php echo $mode?></td>
						
					    <td><?php
					    	if (!empty($data->department)) {
					    		$sakha =Department::find_by_id($data->department);
					    		$saakha = $sakha->name;
					    	}
					    	else{
					    		$saakha = '--';
					    	}
					    
					    echo $saakha;?> </td>
						<td><a href="user_edit.php">सच्याउनुहोस्</a></td>
					</tbody>
				<?php endforeach;?>
				</table>
<?php include("menuincludes/footer.php"); ?>