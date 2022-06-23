<?php
require_once 'includes/initialize.php';
$res=array();
$counter = $_POST['counter']+1;
$html="";
$html .=' <tr class="remove_log_detail">
        <td><input type="text" name="log_miti[]" id="nepaliDate'.$counter.'" required>
        <button type="button" class="ndp-click-trigger btn btn-primary btn-sm" onclick="showNdpCalendarBox(&quot;nepaliDate'.$counter.'&quot;)">मिति</button>  
        </td>
          <td><input type="text" name="place_to[]"/></td>
          <td><input type="text" name="place_from[]" /></td>
          <td><input type="text" name="km_to[]" id="km_to_'.$counter.'"/></td>
         <td><input type="text" name="km_from[]" id="km_from_'.$counter.'"/></td>
         <td><input type="text" name="total[]" id="total_km_'.$counter.'"/></td>
          <td><input type="text" name="petrol[]" /></td>
          <td><input type="text" name="mobil[]" /></td>
          <td><input type="text" name="grease[]" /></td>
          <td><input type="text" name="oil[]" /></td>
    </tr>';
$res['html'] = $html;
echo json_encode($res);exit;