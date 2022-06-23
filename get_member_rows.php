<?php
require_once("includes/initialize.php");
$res = array();
$counter = $_POST['counter']+1;

 $html = '';
 $html .= '<tr class="remove_member_row">
            <td>'.convertedcit($counter).'</td>
            <td>
                नाम: <input type="text" required name="member[]" />
            </td>
            <td>पद : <input type="text" required name="pad[]" /></td>
            <td>&nbsp;</td>   
       </tr>';
$res['html'] = $html;
echo json_encode($res); exit;