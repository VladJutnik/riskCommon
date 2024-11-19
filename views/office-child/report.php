



<div class="table-responsive">
    <table id="tableId2" class="table table-bordered table-sm table2excel_with_colors">
        <tr class="row0">
            <th class="text-center column0 style2 s style2" rowspan="2">№</th>
            <th class="text-center column1 style2 s style2" rowspan="2">Федеральный округ</th>
            <th class="text-center column2 style2 s style2" rowspan="2">Регион</th>
            <th class="text-center column3 style2 s style2" rowspan="2">Муниципальное образование</th>
            <th class="text-center column4 style2 s style2" rowspan="2">Год</th>
            <th class="text-center column4 style2 s style2" rowspan="2">Контингент</th>
            <th class="text-center column5 style2 s style2" rowspan="2">Класс</th>
            <th class="text-center column6 style2 s style2" rowspan="2">Буква класса</th>
            <th class="text-center column7 style2 s style2" rowspan="2">Дата тестирования</th>
            <th class="text-center column8 style2 s style2" rowspan="2">Идентификатор ученика</th>
            <th class="text-center column9 style2 s style2" colspan="2">Работа по психологической поддержке ребенка в плане профилактики повышенной<br />
                тревожности</th>
            <th class="text-center column10 style2 s style2" colspan="5">Уровень тревожности по Ч.Д. Спилбергеру, ЮЛ. Ханину</th>
            <th class="text-center column13 style2 s style2" colspan="4">оценка симптомов беспокойства и нервозности</th>
            <th class="text-center column17 style2 s style2" colspan="4">оценка индикации возможных причин тревожности</th>
            <th class="text-center column21 style2 s style2" colspan="4">оценка профилактики, реализуемых в отношении ребенка со стороны учителей (классного руководителя)</th>
            <th class="text-center column25 style2 s style2" colspan="4">оценка профилактики, реализуемых в отношении ребенка со стороны<br />
                родителей</th>
            <th class="text-center column29 style2 s style2" colspan="4">оценка индикации форм проявления агрессии у ребенка</th>
            <th class="text-center column33 style2 s style2" colspan="4">оценка индикации возможных причин агрессивности ребенка</th>
            <th class="text-center column37 style2 s style2" colspan="2">оценка агрессивности и враждебности по опроснику Басса-Дарки</th>
        </tr>
        <tr class="row1">
            <th class="text-center column10 style1 s">ОТРИЦАТЕЛЬНО</th>
            <th class="text-center column10 style1 s">ПОЛОЖИТЕЛЬНО</th>

            <th class="text-center column10 style1 s">низкая тревожность</th>
            <th class="text-center column10 style1 s">умеренная тревожность</th>
            <th class="text-center column10 style1 s">высокая тревожность</th>
            <th class="text-center column11 style1 s">РТ</th>
            <th class="text-center column12 style1 s">ЛТ</th>
            <th class="text-center column13 style1 s">оценка</th>
            <th class="text-center column14 style1 s">0 - 28,55</th>
            <th class="text-center column15 style1 s">28,56 - 71,44</th>
            <th class="text-center column16 style1 s">71,45 - 100</th>
            <th class="text-center column17 style1 s">оценка</th>
            <th class="text-center column18 style1 s">0 - 28,55</th>
            <th class="text-center column19 style1 s">28,56 - 71,44</th>
            <th class="text-center column20 style1 s">71,45 - 100</th>
            <th class="text-center column21 style1 s">оценка</th>
            <th class="text-center column22 style1 s">0 - 14.275</th>
            <th class="text-center column23 style1 s">14.276 - 35.72</th>
            <th class="text-center column24 style1 s">35.73 - 50</th>
            <th class="text-center column25 style1 s">оценка</th>
            <th class="text-center column26 style1 s">0 - 14.275</th>
            <th class="text-center column27 style1 s">14.276 - 35.72</th>
            <th class="text-center column28 style1 s">35.73 - 50</th>
            <th class="text-center column29 style1 s">оценка</th>
            <th class="text-center column30 style1 s">0 - 28,55</th>
            <th class="text-center column31 style1 s">28,56 - 71,44</th>
            <th class="text-center column32 style1 s">71,45 - 100</th>
            <th class="text-center column33 style1 s">оценка</th>
            <th class="text-center column34 style1 s">0 - 28,55</th>
            <th class="text-center column35 style1 s">28,56 - 71,44</th>
            <th class="text-center column36 style1 s">71,45 - 100</th>
            <th class="text-center column37 style3 s">индекс агрессивности</th>
            <th class="text-center column38 style3 s">индекс враждебности</th>
        </tr>
        <?
        $i = 1;
        foreach ($result as $one){?>
            <tr>
                <td class="text-center"><?=$i++?></td>
                <td class="text-center"><?=$one['federal_district_id']?></td>
                <td class="text-center"><?=$one['region_id']?></td>
                <td class="text-center"><?=$one['municipality_id']?></td>
                <td class="text-center"><?=$one['year']?></td>
                <td class="text-center"><?=$one['class_individual']?></td>
                <td class="text-center"><?=$one['class']?></td>
                <td class="text-center"><?=$one['classA']?></td>
                <td class="text-center"><?=$one['testing_date']?></td>
                <td class="text-center"><?=$one['name_responsible_person_individual']?></td>

                <td class="text-center"><?=$one['estimation_11111']?></td>
                <td class="text-center"><?=$one['estimation_22222']?></td>
                <td class="text-center"><?=$one['anxiety_1']?></td>
                <td class="text-center"><?=$one['anxiety_2']?></td>
                <td class="text-center"><?=$one['anxiety_3']?></td>
                <td class="text-center"><?=$one['rt']?></td>
                <td class="text-center"><?=$one['lt']?></td>

                <td class="text-center"><?=$one['estimation_1']?></td>
                <td class="text-center"><?=$one['estimation_1_1_0_28']?></td>
                <td class="text-center"><?=$one['estimation_1_2_28_71']?></td>
                <td class="text-center"><?=$one['estimation_1_3_71_100']?></td>
                <td class="text-center"><?=$one['estimation_2']?></td>
                <td class="text-center"><?=$one['estimation_2_1_0_28']?></td>
                <td class="text-center"><?=$one['estimation_2_2_28_71']?></td>
                <td class="text-center"><?=$one['estimation_2_3_71_100']?></td>
                <td class="text-center"><?=$one['estimation_3']?></td>
                <td class="text-center"><?=$one['estimation_3_1_0_14']?></td>
                <td class="text-center"><?=$one['estimation_3_2_14_35']?></td>
                <td class="text-center"><?=$one['estimation_3_3_71_50']?></td>
                <td class="text-center"><?=$one['estimation_4']?></td>
                <td class="text-center"><?=$one['estimation_4_1_0_14']?></td>
                <td class="text-center"><?=$one['estimation_4_2_14_35']?></td>
                <td class="text-center"><?=$one['estimation_4_3_71_50']?></td>
                <td class="text-center"><?=$one['estimation_5']?></td>
                <td class="text-center"><?=$one['estimation_5_1_0_28']?></td>
                <td class="text-center"><?=$one['estimation_5_2_28_71']?></td>
                <td class="text-center"><?=$one['estimation_5_3_71_100']?></td>
                <td class="text-center"><?=$one['estimation_6']?></td>
                <td class="text-center"><?=$one['estimation_6_1_0_28']?></td>
                <td class="text-center"><?=$one['estimation_6_2_28_71']?></td>
                <td class="text-center"><?=$one['estimation_6_3_71_100']?></td>
                <td class="text-center"><?=$one['aggressiveness_index']?></td>
                <td class="text-center"><?=$one['includes_index']?></td>
            </tr>
        <?}?>
    </table>
    <br>
    <br>
    <br>
</div>

