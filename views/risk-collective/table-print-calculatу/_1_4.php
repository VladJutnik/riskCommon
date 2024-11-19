<table style="border: 1px solid #000000;" class=" table table-sm table-bordered">
    <tr>
        <th align="center" style="padding: 0rem;" class="text-center"></th>
        <th align="center" style="padding: 0rem;" class="text-center">N</th>
        <th align="center" style="padding: 0rem;" class="text-center">G1</th>
        <th align="center" style="padding: 0rem;" class="text-center">коэффициент</th>
        <th align="center" style="padding: 0rem;" class="text-center">G2</th>
        <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
        <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> k</span></th>
        <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">P</span><span style="font-size: 8px"> i</span></th>
    </tr>
    <tr>
        <td align="center" style="padding: 0rem;" class="text-center">1-4 классы</td>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_21?></td>
        <?$g1 = $model->field_22 + $model->field_23 + $model->field_24 ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$g1?></td>
        <?$koef = 1.469 ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$koef?></td>
        <?$g2 = $model->field_21 - $g1 ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$g2?></td>
        <?$risk = round($modelR['risk_assessment'], 3) ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$risk?></td>
        <?$riskKol = ($model->field_21 == '0') ? 0 : round(( ($g1*$koef) + ($g2*$risk) )/$model->field_21, 3) ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$riskKol?></td>
        <?$ver = round(( $riskKol*$riskKol*100), 3) ?>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$ver?></td>
    </tr>
    <tr>
        <td align="center" style="padding: 0rem;" class="text-center">в т.ч. 1 классы</td>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_1?></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
    </tr>
    <tr>
        <td align="center" style="padding: 0rem;" class="text-center">2 классы</td>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_5?></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
    </tr>
    <tr>
        <td align="center" style="padding: 0rem;" class="text-center">3 классы</td>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_9?></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
    </tr>
    <tr>
        <td align="center" style="padding: 0rem;" class="text-center">4 классы</td>
        <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_13?></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
        <td align="center" style="padding: 0rem;" class="text-center"></td>
    </tr>
</table>