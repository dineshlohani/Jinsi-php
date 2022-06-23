<?php require_once("includes/initialize.php"); 
$dakhila_items =  DakhilaItemDetails::find_by_sql("select * from dakhila_item_details where dakhila_id = 0");
$html  = '';
$html .='<table>
            <tr>
                <td>Item Name</td>
                <td>Item id</td>
                <td>Category</td>
                <td>rate</td>
                <td>qty</td>
            </tr>
';
foreach($dakhila_items as $item_sel)
{
   $iteminst         = getItemInstance($item_sel->category);
    $item_selected    = $iteminst->find_by_id($item_sel->item_id);
   
    $html .= '<tr>';
    $html .= '<td>'.$item_selected->name.'</td>';
    $html .= '<td>'.$item_sel->item_id.'</td>';
    $html .= '<td>'.$item_sel->category.'</td>';
    $html .= '<td>'.$item_sel->rate_vat.'</td>';
    $html .= '<td>'.$item_sel->qty.'</td>';
    $html .= '</tr>';
}
echo $html;
    