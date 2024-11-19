<table style="border: 1px solid #000000;" class=" table table-bordered">
    <tr>
        <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Показатели</th>
        <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Всего детей</th>
        <th align="center" colspan="3" style="padding: 0rem;" class="text-center" >Из них, с нарушениями</th>
    </tr>
    <tr>
        <th class="text-center" style="padding: 0rem;" >осанки и зрения</th>
        <th class="text-center" align="center" style="padding: 0rem;" >осанки</th>
        <th class="text-center" align="center" style="padding: 0rem;" >зрения</th>
    </tr>
    <? if($modelF->class == '342'){?>
        <?=
        $this->render(
            'table-create/_1_4.php',
            [
                'model' => $model,
                'form' => $form,
            ]
        ); ?>
    <? }
    else if($modelF->class == '486'){?>
        <?=$this->render(
            'table-create/_5_9.php',
            [
                'model' => $model,
                'form' => $form,
            ]
        );?>
    <?}
    else {?>
        <?=$this->render(
            'table-create/_10_11.php',
            [
                'model' => $model,
                'form' => $form,
            ]
        );?>
    <?}?>

</table>