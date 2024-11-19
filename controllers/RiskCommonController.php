<?php

namespace backend\modules\riskCommon\controllers;

use backend\modules\riskCommon\models\PrintCollectiveRisk;
use backend\modules\riskCommon\models\RiskChildrenList;
use backend\modules\riskCommon\models\RiskEstimation;
use backend\modules\riskCommon\models\RiskAssessmentCollective;
use backend\modules\riskCommon\models\RiskAssessmentIndividualCommon;
use backend\modules\riskCommon\models\RiskAssessmentKey;
use backend\modules\riskCommon\models\RiskAssessmentOrganizationCommon;
use backend\modules\riskCommon\models\RiskQuestionnaireBassDarck;
use backend\modules\riskCommon\models\RiskQuestionnaireFive;
use backend\modules\riskCommon\models\RiskQuestionnaireFour;
use backend\modules\riskCommon\models\RiskQuestionnaireOne;
use backend\modules\riskCommon\models\RiskQuestionnaireSix;
use backend\modules\riskCommon\models\RiskQuestionnaireSpielberger;
use backend\modules\riskCommon\models\RiskQuestionnaireThree;
use backend\modules\riskCommon\models\RiskQuestionnaireTwo;
use backend\modules\riskCommon\riskCommonInterface\RiskCommonInt;
use common\models\FederalDistrict;
use common\models\Municipality;
use common\models\Region;
use Exception;
use Mpdf\Mpdf;
use Yii;
use yii\db\ActiveQuery;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `risk-common` module
 */
class RiskCommonController extends Controller implements RiskCommonInt
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'captcha',
                            'index',
                            'content-questionnaire',
                            'view-common-risk',
                            //прописать URL ???
                            'create-common-risk',
                            'update-common-risk',
                            'print-common-risk',
                            'create-collective-risk',
                            'update-collective-risk',
                            'print-collective-risk-common',
                            'view-individual-risk',
                            'print-individual-risk',
                            'create-individual-common-risk',
                            'update-individual-common-risk',
                            'download-document',
                            'print-content-questionnaire',
                            'print-children-list',
                            'print-content-questionnaire-pattern',
                            'update-content-questionnaire',
                            'print-collective-risk',
                            'report-aggression-risk2',
                        ],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => [

                            'captcha',
                            'index',
                            'content-questionnaire',
                            'view-common-risk',
                            //прописать URL ???
                            'create-common-risk',
                            'update-common-risk',
                            'print-common-risk',
                            'create-collective-risk',
                            'update-collective-risk',
                            'print-collective-risk-common',
                            'view-individual-risk',
                            'print-individual-risk',
                            'create-individual-common-risk',
                            'update-individual-common-risk',
                            'download-document',
                            'index-admin',
                            'report-common-risk',
                            'report-individual-risk',
                            'report-collective-risk',
                            'print-content-questionnaire',
                            'print-children-list',
                            'print-content-questionnaire-pattern',
                            'update-content-questionnaire',
                            'print-collective-risk',
                            'report-aggression-risk',
                        ],
                        'allow' => true,
                        'roles' => [
                            'admin',
                            'admin_rick',
                        ],
                    ],
                ],
            ],

        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new RiskAssessmentOrganizationCommon();

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];

            if (($model = $this->findModelKey(trim($post['key']))) !== null) {
                Yii::$app->session->setFlash('success', 'Данные успешно загруженны, пожалуйста запомние Ваш ключ! ');
                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не найдены!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('/risk-common/index', [
            'model' => $model
        ]);
    }


    public function actionIndexAdmin()
    {
        $model = new RiskAssessmentOrganizationCommon();

        $riskCommon = (new \yii\db\Query())
            ->select([
                'federal_district.`name` as federal_districtName',
                'region.`name` as regionName',
                'municipality.`name` as municipalityName',
                'risk_assessment_organization_common.name_responsible_person as riskPerson',
                'risk_assessment_organization_common.create_at as riskCreate_at',
                'risk_assessment_organization_common.class as riskClass',
            ])
            ->from('risk_assessment_organization_common')
            ->join('inner JOIN', 'federal_district', 'risk_assessment_organization_common.federal_district_id = federal_district.id')
            ->join('inner JOIN', 'region', 'risk_assessment_organization_common.region_id = region.id')
            ->join('inner JOIN', 'municipality', 'risk_assessment_organization_common.municipality_id = municipality.id')
            ->where(['in', 'risk_assessment_organization_common.key',
                ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2',]
            ])
            ->orderBy([
                'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                'risk_assessment_organization_common.region_id' => SORT_ASC,
                'risk_assessment_organization_common.municipality_id' => SORT_ASC,
            ])
            ->all();


        $riskCommonArr = [];
        if ($riskCommon) {
            foreach ($riskCommon as $keyRiskCommon => $oneStrRisk) {

                $riskCommonArr['ocrug'][$oneStrRisk['federal_districtName']] += 1;
                $riskCommonArr['reg'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']] += 1;
                $riskCommonArr['reg2'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']][$oneStrRisk['riskClass']] += 1;
            }
        }
        //print_r('<pre>');
        //print_r($riskCommonArr['reg2']);
        //exit();
        $riskCollective = (new \yii\db\Query())
            ->select([
                'federal_district.`name` as federal_districtName',
                'region.`name` as regionName',
                'municipality.`name` as municipalityName',
                'risk_assessment_collective.name_responsible_person_individual as riskPerson',
                'risk_assessment_organization_common.create_at as riskCreate_at',
                'risk_assessment_organization_common.class as riskClass',
            ])
            ->from('risk_assessment_collective')
            ->join('inner JOIN', 'risk_assessment_organization_common', 'risk_assessment_organization_common.key = risk_assessment_collective.key')
            ->join('inner JOIN', 'federal_district', 'risk_assessment_organization_common.federal_district_id = federal_district.id')
            ->join('inner JOIN', 'region', 'risk_assessment_organization_common.region_id = region.id')
            ->join('inner JOIN', 'municipality', 'risk_assessment_organization_common.municipality_id = municipality.id')
            ->where(['in', 'risk_assessment_collective.key',
                ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2',]
            ])
            ->orderBy([
                'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                'risk_assessment_organization_common.region_id' => SORT_ASC,
                'risk_assessment_organization_common.municipality_id' => SORT_ASC,
            ])
            ->all();
        $riskCollectiveArr = [];
        if ($riskCollective) {
            foreach ($riskCollective as $keyRiskCollective => $oneStrRisk) {
                $riskCollectiveArr['ocrug'][$oneStrRisk['federal_districtName']] += 1;
                $riskCollectiveArr['reg'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']] += 1;
                $riskCollectiveArr['reg2'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']][$oneStrRisk['riskClass']] += 1;
            }
        }
        $riskIndividual = (new \yii\db\Query())
            ->select([
                'federal_district.`name` as federal_districtName',
                'region.`name` as regionName',
                'municipality.`name` as municipalityName',
                'risk_assessment_individual_common.name_responsible_person_individual as riskPerson',
                'risk_assessment_individual_common.class_individual as riskClassIndividual',
                'risk_assessment_organization_common.create_at as riskCreate_at',
            ])
            ->from('risk_assessment_individual_common')
            ->join('inner JOIN', 'risk_assessment_organization_common', 'risk_assessment_organization_common.key = risk_assessment_individual_common.key')
            ->join('inner JOIN', 'federal_district', 'risk_assessment_organization_common.federal_district_id = federal_district.id')
            ->join('inner JOIN', 'region', 'risk_assessment_organization_common.region_id = region.id')
            ->join('inner JOIN', 'municipality', 'risk_assessment_organization_common.municipality_id = municipality.id')
            ->where(['in', 'risk_assessment_individual_common.key',
                ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2',]
            ])
            ->orderBy([
                'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                'risk_assessment_organization_common.region_id' => SORT_ASC,
                'risk_assessment_organization_common.municipality_id' => SORT_ASC,
            ])
            ->all();

        //print_r('<pre>');
        //print_r($riskIndividual);
        //exit();

        $riskIndividualArr = [];
        if ($riskIndividual) {
            foreach ($riskIndividual as $keyRiskCollective => $oneStrRisk) {
                //print_r('<pre>');
                //print_r($riskCommonArr['reg2']);
                //exit();
                $riskIndividualArr['ocrug'][$oneStrRisk['federal_districtName']] += 1;
                $riskIndividualArr['reg'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']] += 1;
                $riskIndividualArr['reg2'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']][$oneStrRisk['riskClassIndividual']] += 1;
            }
        }


        $modelRiskChildrenList = (new \yii\db\Query())
            ->select([
                'risk_children_list.id_children_list as id',
                'risk_children_list.name_responsible_person_individual as name_responsible_person_individual',
                'risk_children_list.class as class',
                'risk_children_list.class_individual as class_individual',
                /*    'risk_questionnaire_one.estimation as estimation_one',
                'risk_questionnaire_two.estimation as estimation_two',
                'risk_questionnaire_three.estimation as estimation_three',
                'risk_questionnaire_four.estimation as estimation_four',
                'risk_questionnaire_five.estimation as estimation_five',
                'risk_questionnaire_six.estimation as estimation_six',
                'risk_questionnaire_spielberger.rt as rt',
                'risk_questionnaire_spielberger.lt as lt',
                'risk_questionnaire_bass_darck.aggressiveness_index as aggressiveness_index',
                'risk_questionnaire_bass_darck.includes_index as includes_index',*/
                'federal_district.`name` as federal_districtName',
                'region.`name` as regionName',
                'municipality.`name` as municipalityName',
            ])
            ->from('risk_children_list')
            /*->join('inner JOIN', 'risk_questionnaire_one', 'risk_questionnaire_one.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_two', 'risk_questionnaire_two.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_three', 'risk_questionnaire_three.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_four', 'risk_questionnaire_four.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_five', 'risk_questionnaire_five.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_six', 'risk_questionnaire_six.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_spielberger', 'risk_questionnaire_spielberger.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_bass_darck', 'risk_questionnaire_bass_darck.id_children_list = risk_children_list.id_children_list')*/
            ->join('inner JOIN', 'risk_assessment_organization_common', 'risk_assessment_organization_common.key = risk_children_list.key')
            ->join('inner JOIN', 'federal_district', 'risk_assessment_organization_common.federal_district_id = federal_district.id')
            ->join('inner JOIN', 'region', 'risk_assessment_organization_common.region_id = region.id')
            ->join('inner JOIN', 'municipality', 'risk_assessment_organization_common.municipality_id = municipality.id')
            ->where(['in', 'risk_children_list.key',
                ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2',]
            ])
            ->all();
        //print_r('<pre>');
        //print_r($modelRiskChildrenList);
        //exit();
        $riskChildrenListArr = [];
        if ($modelRiskChildrenList) {
            foreach ($modelRiskChildrenList as $keyRiskChildrenList => $oneStrRisk) {
                //print_r('<pre>');
                //print_r($riskCommonArr['reg2']);
                //exit();
                $riskChildrenListArr['ocrug'][$oneStrRisk['federal_districtName']] += 1;
                $riskChildrenListArr['reg'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']] += 1;
                $riskChildrenListArr['reg2'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']][$oneStrRisk['class_individual']] += 1;
                $riskChildrenListArr['reg3'][$oneStrRisk['federal_districtName']][$oneStrRisk['regionName']][$oneStrRisk['class_individual']][$oneStrRisk['class']] += 1;
            }
        }
        //print_r('<pre>');
        //print_r($riskChildrenListArr);
        //exit();

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];

            if (($model = $this->findModelKey(trim($post['key']))) !== null) {
                Yii::$app->session->setFlash('success', 'Данные успешно загруженны, пожалуйста запомние Ваш ключ! ');
                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не найдены!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('/risk-common/index-admin', [
            'model' => $model,
            'riskCommonArr' => $riskCommonArr,
            'riskCollectiveArr' => $riskCollectiveArr,
            'riskIndividualArr' => $riskIndividualArr,
            'riskChildrenListArr' => $riskChildrenListArr,
        ]);
    }

    public function actionCreateCommonRisk()
    {
        $model = new RiskAssessmentOrganizationCommon();
        $district_items = ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name');
        $region_items = ArrayHelper::map(Region::find()->where(['district_id' => 5])->all(), 'id', 'name');
        $municipality_items = ArrayHelper::map(Municipality::find()->where(['region_id' => 48])->all(), 'id',
            'name');
        //$model->captcha = rand(11111,99999);
        $model->user_id = 2;
        $model->organization_id = 2;
        //$model->federal_district_id = 5;
        //$model->region_id = 48;
        //$model->municipality_id = 253;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            $model->load(Yii::$app->request->post());
            $model->key = $model->generateKey();
            $decodingOverallRiskArray = $model->decodingOverallRisk($model);

            $model->risk_assessment_1 = $model->generalCalculateRisk1($decodingOverallRiskArray);
            $model->risk_assessment_2 = $model->generalCalculateRisk2($decodingOverallRiskArray);
            $model->risk_assessment_3 = $model->generalCalculateRisk3($decodingOverallRiskArray);
            $model->risk_assessment_4 = $model->generalCalculateRisk4($decodingOverallRiskArray);
            $model->risk_assessment_5 = $model->generalCalculateRisk5($decodingOverallRiskArray);
            $model->risk_assessment = round($model->generalCalculateRiskG($model->risk_assessment_1, $model->risk_assessment_2, $model->risk_assessment_3, $model->risk_assessment_4, $model->risk_assessment_5), 4);
            $model->risk_assessment_g = round($model->generalCalculateRisk($model->risk_assessment_1, $model->risk_assessment_2, $model->risk_assessment_3, $model->risk_assessment_4, $model->risk_assessment_5), 4);
            //print_r('<pre>');
            //print_r($decodingOverallRiskArray);
            //print_r('<br><br>');
            //print_r($model);
            //print_r('<br><br>');
            //print_r('</pre>');
            //exit();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно сохранены, пожалуйста запомние Ваш ключ! ');

                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не сохранены!');
            }
        }

        return $this->render('/risk-common/create-common-risk', [
            'model' => $model,
            'district_items' => $district_items,
            'region_items' => $region_items,
            'municipality_items' => $municipality_items,
        ]);
    }

    public function actionUpdateCommonRisk($id)
    {

        $model = $this->findModelKey($id);
        $district_items = ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name');
        $region_items = ArrayHelper::map(Region::find()->where(['district_id' => $model->federal_district_id])->all(),
            'id', 'name');
        $municipality_items = ArrayHelper::map(Municipality::find()->where(['region_id' => $model->region_id])->all(),
            'id', 'name');

        $model->user_id = 2;
        $model->organization_id = 2;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            $model->load(Yii::$app->request->post());
            $decodingOverallRiskArray = $model->decodingOverallRisk($model);
            $model->risk_assessment_1 = $model->generalCalculateRisk1($decodingOverallRiskArray);
            $model->risk_assessment_2 = $model->generalCalculateRisk2($decodingOverallRiskArray);
            $model->risk_assessment_3 = $model->generalCalculateRisk3($decodingOverallRiskArray);
            $model->risk_assessment_4 = $model->generalCalculateRisk4($decodingOverallRiskArray);
            $model->risk_assessment_5 = $model->generalCalculateRisk5($decodingOverallRiskArray);
            $model->risk_assessment = round($model->generalCalculateRiskG($model->risk_assessment_1, $model->risk_assessment_2, $model->risk_assessment_3, $model->risk_assessment_4, $model->risk_assessment_5), 4);
            $model->risk_assessment_g = round($model->generalCalculateRisk($model->risk_assessment_1, $model->risk_assessment_2, $model->risk_assessment_3, $model->risk_assessment_4, $model->risk_assessment_5), 4);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно обновлены, пожалуйста запомние Ваш ключ! ');
                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не сохранены!');
            }
        }

        return $this->render('/risk-common/update-common-risk', [
            'model' => $model,
            'district_items' => $district_items,
            'region_items' => $region_items,
            'municipality_items' => $municipality_items,
        ]);
    }

    public function actionPrintCommonRisk()
    {
        if (Yii::$app->request->post()['key']) {
            $model = $this->findModelKey(Yii::$app->request->post()['key']);
            $this->layout = false;
            $html = '
            <br>
            <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>';

            $html .= '<h5>Ваш Ключ - ' . $model->key . '<br>';
            $html .= 'Учебный год: ' . Yii::$app->riskComponent->academicYear($model->year) . '<br>';
            $html .= 'Класс: ' . Yii::$app->riskComponent->trainingClass($model->class) . '<br>';
            $html .= '<h3 align="center">Оценка ОБЩЕГО РИСКА:</b></h3>';
            $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                <tr>
                     <th class="text-center">Индекс</th>
                     <th class="text-center">Оцениваемые показатели</th>
                     <th class="text-center">Значение</th>
                </tr>';
            $html .= $this->render(
                '/risk-common/_result-tableX.php',
                [
                    'model' => $model,
                ]
            );
            $html .= '
                <tr>
                   <th class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
                   <th class="text-center">Общий риск</th>
                   <th class="text-center">' . round($model['risk_assessment'], 3) . '</th>
               </tr>
            </table>';

            $mpdf = new Mpdf([
                'margin_top' => 5,
                'margin_left' => 20,
                'margin_right' => 10,
                //'mirrorMargins' => true
                //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Расчет общего риска.pdf', 'I'); //D - скачает файл!
//            /print_r($model);
//            /exit();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionCreateIndividualCommonRisk($id)
    {
        $model = new RiskAssessmentIndividualCommon();
        $modelF = ($id) ? $this->findModelKey($id) : new RiskAssessmentOrganizationCommon();
        //$model->captcha = rand(11111,99999);

        $model->user_id = 2;
        $model->organization_id = 2;
        $model->key = ($id) ? $id : 0;
        //$model->key = ($id) ? $id : $modelF->generateKey();

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            $model->load(Yii::$app->request->post());

            $decodingOverallIndividualRiskArr = $modelF->decodingOverallIndividualRisk($model);
            $generalCalculateIndividualZRiskArr = $modelF->generalCalculateIndividualZRisk($decodingOverallIndividualRiskArr);

            $model->risk_assessment_individual_y_1 = $modelF->generalCalculateIndividualY1Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_2 = $modelF->generalCalculateIndividualY2Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_3 = $modelF->generalCalculateIndividualY3Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_4 = $modelF->generalCalculateIndividualY4Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_5 = $modelF->generalCalculateIndividualY5Risk($decodingOverallIndividualRiskArr);


            $model->risk_assessment_individual_y = $model->risk_assessment_individual_y_1 + $model->risk_assessment_individual_y_2 + $model->risk_assessment_individual_y_3 + $model->risk_assessment_individual_y_4 + $model->risk_assessment_individual_y_5;
            $model->risk_assessment_individual_z = $generalCalculateIndividualZRiskArr;
            $modelRiskAssessment = $this->findModelKey($id);
            if ($modelRiskAssessment) {
                $overallRisk = ($modelRiskAssessment->risk_assessment_g) ? $modelRiskAssessment->risk_assessment_g : 0;
            }
            $generalCalculateIndividualRisk = $modelF->generalCalculateIndividualRisk($overallRisk + $model->risk_assessment_individual_y + $model->risk_assessment_individual_z);

            $model->risk_assessment_individual_kv = $modelF->generalCalculateIndividualKvRisk($generalCalculateIndividualRisk, Yii::$app->riskComponent->trainingClassIndividualDecoding($model->class_individual));

            $model->risk_assessment_individual = $generalCalculateIndividualRisk;

            //print_r('<pre>');
            //print_r($model);
            //print_r('<br><br>');
            //print_r('</pre>');
            //exit();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно сохранены, пожалуйста запомние Ваш ключ! ');

                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не сохранены!');
            }


        }

        return $this->render('/risk-individual/create-individual-common-risk', [
            'model' => $model,
            'modelF' => $modelF,
        ]);
    }

    public function actionUpdateIndividualCommonRisk($id)
    {

        $model = $this->findModelIdIndividual($id);
        $modelF = ($model->key) ? $this->findModelKey($model->key) : new RiskAssessmentOrganizationCommon();

        $model->user_id = 2;
        $model->organization_id = 2;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            $model->load(Yii::$app->request->post());

            $decodingOverallIndividualRiskArr = $modelF->decodingOverallIndividualRisk($model);
            $generalCalculateIndividualZRiskArr = $modelF->generalCalculateIndividualZRisk($decodingOverallIndividualRiskArr);

            $model->risk_assessment_individual_y_1 = $modelF->generalCalculateIndividualY1Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_2 = $modelF->generalCalculateIndividualY2Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_3 = $modelF->generalCalculateIndividualY3Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_4 = $modelF->generalCalculateIndividualY4Risk($decodingOverallIndividualRiskArr);
            $model->risk_assessment_individual_y_5 = $modelF->generalCalculateIndividualY5Risk($decodingOverallIndividualRiskArr);


            $model->risk_assessment_individual_y = $model->risk_assessment_individual_y_1 + $model->risk_assessment_individual_y_2 + $model->risk_assessment_individual_y_3 + $model->risk_assessment_individual_y_4 + $model->risk_assessment_individual_y_5;
            $model->risk_assessment_individual_z = $generalCalculateIndividualZRiskArr;
            $modelRiskAssessment = $this->findModelKey($model->key);
            if ($modelRiskAssessment) {
                $overallRisk = ($modelRiskAssessment->risk_assessment_g) ? $modelRiskAssessment->risk_assessment_g : 0;
            }
            //print_r($overallRisk);
            //exit();
            $generalCalculateIndividualRisk = $modelF->generalCalculateIndividualRisk($overallRisk + $model->risk_assessment_individual_y + $model->risk_assessment_individual_z);

            $model->risk_assessment_individual_kv = $modelF->generalCalculateIndividualKvRisk($generalCalculateIndividualRisk, Yii::$app->riskComponent->trainingClassIndividualDecoding($model->class_individual));

            $model->risk_assessment_individual = $generalCalculateIndividualRisk;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно обновлены, пожалуйста запомние Ваш ключ! ');
                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не сохранены!');
            }


        }

        return $this->render('/risk-individual/update-individual-common-risk', [
            'model' => $model,
            'modelF' => $modelF,
        ]);
    }

    public function actionPrintIndividualRisk()
    {
        if (Yii::$app->request->post()['id']) {
            $modelOrganizationCommon = new RiskAssessmentOrganizationCommon();
            $modelIndividualCommon = new RiskAssessmentIndividualCommon();
            $rows = (new \yii\db\Query())
                ->from('risk_assessment_organization_common')
                ->join('inner JOIN', 'risk_assessment_individual_common', 'risk_assessment_individual_common.key = risk_assessment_organization_common.key')
                ->where(['risk_assessment_individual_common.id_individual' => Yii::$app->request->post()['id']])
                ->all();

            $this->layout = false;

            $html = '
            <br>
            <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>';

            $html .= '
            <div align="center" ><b>Заключение по индивидуальному риску нарушения осанки и зрения</b></div>';
            $html .= '<br>Ваш Ключ - ' . $rows[0]['key'] . '<br>';
            $html .= 'Учебный год: ' . Yii::$app->riskComponent->academicYear($rows[0]['year']) . '<br>';
            $html .= 'Класс: ' . Yii::$app->riskComponent->trainingClass($rows[0]['class']) . '<br>';
            $html .= '<h3 align="center">Оценка ОБЩЕГО РИСКА:</h3>';
            $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                <tr>
                     <th class="text-center">Индекс</th>
                     <th class="text-center">Оцениваемые показатели</th>
                     <th class="text-center">Значение</th>
                </tr>';
            $html .= $this->render(
                '/risk-common/_result-tableX.php',
                [
                    'model' => $rows[0],
                ]
            );
            $html .= $this->render(
                '/risk-individual/_result-tableY.php',
                [
                    'model' => $rows[0],
                    'modelOrganizationCommon' => $modelOrganizationCommon,
                    'modelIndividualCommon' => $modelIndividualCommon,
                ]
            );
            $html .= '</table>';
            $html .= '<div>
                </b>
                </b>
                </b>
                <h3>Заключение:</h3>
                <div style="text-indent: 25px;">
                    Индивидуальный риск – <span
                            style="color: blue;">' . $modelOrganizationCommon->decodingTextRisk($rows[0]['risk_assessment_individual']) . '
                </span> (R=<span style="color: blue;">' . $rows[0]['risk_assessment_individual'] . '</span>),
                    в т.ч. вклад управляемых факторов составляет <span
                            style="color: blue;">' . $modelOrganizationCommon->contributionControlledFactors($rows[0]) . '%</span>,
                    из них на управляемые общеобразовательной организацией
                    факторы приходится <span
                            style="color: blue;">' . $modelOrganizationCommon->contributionControlledFactors2($rows[0]) . '%</span>
                    ;
                    на факторы, управляемые семьей – <span
                            style="color: blue;">' . $modelOrganizationCommon->contributionControlledFactors3($rows[0]) . '%</span>
                    .
                </div>
                <div style="text-indent: 25px;">
                    Вероятность наступления события (формирование нарушений осанки и (или) зрения) в текущем учебном году, в
                    случае если факторы
                    риска не будут скорректированы составит <span
                            style="color: blue;">' . $modelOrganizationCommon->contributionControlledFactors4($rows[0]['risk_assessment_individual']) . '%</span>
                    ;
                    к моменту окончания школы, при неизменных факторах риска, вероятность составит <span
                            style="color: blue;">' . $modelOrganizationCommon->contributionControlledFactors4($rows[0]['risk_assessment_individual_kv']) . '%</span>
                    .
                </div>
            </div>';


            $mpdf = new Mpdf([
                'margin_top' => 5,
                'margin_left' => 10,
                'margin_right' => 10,
                //'mirrorMargins' => true
                //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Заключение по индивидуальному риску нарушения осанки и зрения.pdf', 'I'); //D - скачает файл!
//            /print_r($model);
//            /exit();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionCreateCollectiveRisk($id = false)
    {
        $model = new RiskAssessmentCollective();
        $modelF = ($id) ? $this->findModelKey($id) : new RiskAssessmentOrganizationCommon();
        //$model->captcha = rand(11111,99999);
        //print_r('<pre>');
        //print_r($id);
        //print_r('<br>');
        //print_r($modelF);
        //print_r('</pre>');
        $model->user_id = 2;
        $model->organization_id = 2;
        $model->key = ($id) ? $id : 0;
        $model->class_collective = ($modelF->class) ? $modelF->class : 0;
        $model->field_1 = 0;
        $model->field_2 = 0;
        $model->field_3 = 0;
        $model->field_4 = 0;
        $model->field_5 = 0;
        $model->field_6 = 0;
        $model->field_7 = 0;
        $model->field_8 = 0;
        $model->field_9 = 0;
        $model->field_10 = 0;
        $model->field_11 = 0;
        $model->field_12 = 0;
        $model->field_13 = 0;
        $model->field_14 = 0;
        $model->field_15 = 0;
        $model->field_16 = 0;
        $model->field_17 = 0;
        $model->field_18 = 0;
        $model->field_19 = 0;
        $model->field_20 = 0;
        $model->field_21 = 0;
        $model->field_22 = 0;
        $model->field_23 = 0;
        $model->field_24 = 0;
        //$model->key = ($id) ? $id : $modelF->generateKey();

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentCollective'];
            $model->load(Yii::$app->request->post());

            $model->field_21 = $model->field_1 + $model->field_5 + $model->field_9 + $model->field_13 + $model->field_17;
            $model->field_22 = $model->field_2 + $model->field_6 + $model->field_10 + $model->field_14 + $model->field_18;
            $model->field_23 = $model->field_3 + $model->field_7 + $model->field_11 + $model->field_15 + $model->field_19;
            $model->field_24 = $model->field_4 + $model->field_8 + $model->field_12 + $model->field_16 + $model->field_20;
            //print_r('<pre>');
            //print_r($model);
            //print_r('<br>');
            //print_r($post);
            //print_r('</pre>');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно сохранены, пожалуйста запомние Ваш ключ! ');

                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Данных не сохранены!');
            }


        }

        return $this->render('/risk-collective/create-collective-risk', [
            'model' => $model,
            'modelF' => $modelF,
        ]);
    }

    public function actionUpdateCollectiveRisk($id = false)
    {
        if ($id) {
            $modelF = $this->findModelKey($id);
            $model = RiskAssessmentCollective::find()->where(['key' => $modelF->key])->one();

            //$model->captcha = rand(11111,99999);
            //print_r('<pre>');
            //print_r($id);
            //print_r('<br>');
            //print_r($modelF);
            //print_r('</pre>');
            $model->user_id = 2;
            $model->organization_id = 2;
            $model->key = ($id) ? $id : 0;
            $model->class_collective = ($modelF->class) ? $modelF->class : 0;

            if (Yii::$app->request->post()) {
                $post = Yii::$app->request->post()['RiskAssessmentCollective'];
                $model->load(Yii::$app->request->post());

                $model->field_21 = $model->field_1 + $model->field_5 + $model->field_9 + $model->field_13 + $model->field_17;
                $model->field_22 = $model->field_2 + $model->field_6 + $model->field_10 + $model->field_14 + $model->field_18;
                $model->field_23 = $model->field_3 + $model->field_7 + $model->field_11 + $model->field_15 + $model->field_19;
                $model->field_24 = $model->field_4 + $model->field_8 + $model->field_12 + $model->field_16 + $model->field_20;
                //print_r('<pre>');
                //print_r($model);
                //print_r('<br>');
                //print_r($post);
                //print_r('</pre>');
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены, пожалуйста запомние Ваш ключ! ');

                    return $this->redirect(['view-common-risk', 'key' => $model->key]);
                } else {
                    Yii::$app->session->setFlash('error', 'Данных не сохранены!');
                }
            }

            return $this->render('/risk-collective/update-collective-risk', [
                'model' => $model,
                'modelF' => $modelF,
            ]);
        } else {
            return $this->redirect(['index']);
        }

    }

    public function actionPrintCollectiveRisk()
    {

        if (Yii::$app->request->post()['key']) {
            $modelR = new RiskAssessmentCollective();
            $model = $this->findModelKey(Yii::$app->request->post()['key']);
            $RiskAssessmentCollective = RiskAssessmentCollective::find()->where(['key' => Yii::$app->request->post()['key']])->one();
            $this->layout = false;

            $html = '
                <br>
                <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>
            ';
            $html .= '
                <div align="center" ><b>Заключение по коллективному риску нарушения осанки и зрения</b></div>
            ';

            $html .= '<br>';
            $html .= 'Ваш Ключ - ' . $model['key'] . '<br>';
            $html .= 'Учебный год: ' . Yii::$app->riskComponent->academicYear($model['year']) . '<br>';
            $html .= 'Класс: ' . Yii::$app->riskComponent->trainingClass($model['class']) . '<br>';
            $html .= '<h3 align="center">Оценка ОБЩЕГО РИСКА:</h3>';
            $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                <tr>
                     <th class="text-center">Индекс</th>
                     <th class="text-center">Оцениваемые показатели</th>
                     <th class="text-center">Значение</th>
                </tr>';
            $html .= $this->render(
                '/risk-common/_result-tableX.php',
                [
                    'model' => $model,
                ]
            );

            $html .= '</table>';
            $html .= '<h3 align="center">Оценка КОЛЛЕКТИВНОГО РИСКА:</h3>';
            $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                <tr>
                    <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Показатели</th>
                    <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Всего детей</th>
                    <th align="center" colspan="3" style="padding: 0rem;" class="text-center" >Из них, с нарушениями</th>
                </tr>
                <tr>
                    <th class="text-center" align="center" style="padding: 0rem;" >осанки и зрения</th>
                    <th class="text-center" align="center" style="padding: 0rem;" >осанки</th>
                    <th class="text-center" align="center" style="padding: 0rem;" >зрения</th>

                </tr>
                <tr>
                    <th width="200px" class="text-center" align="center" style="padding: 0rem;" >' . Yii::$app->riskComponent->trainingClass($model->class) . '</th>
                    <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $RiskAssessmentCollective->field_21 . '</th>
                    <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $RiskAssessmentCollective->field_22 . '</th>
                    <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $RiskAssessmentCollective->field_23 . '</th>
                    <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $RiskAssessmentCollective->field_24 . '</th>

                </tr>
            ';
            if ($model->class == '342') {
                $html .= $this->render(
                    '/risk-collective/table-print/_1_4.php',
                    [
                        'model' => $RiskAssessmentCollective,
                    ]
                );
            } else if ($model->class == '486') {
                $html .= $this->render(
                    '/risk-collective/table-print/_5_9.php',
                    [
                        'model' => $RiskAssessmentCollective,
                    ]
                );
            } else {
                $html .= $this->render(
                    '/risk-collective/table-print/_10_11.php',
                    [
                        'model' => $RiskAssessmentCollective,
                    ]
                );
            }
            $html .= '</table> ';
            $html .= '<h3 align="center">Расчёт коллективного риска :</h3>';
            $arraClas = [
                '1_4' => [
                    'vse' => '1-4 классы',
                    '1' => 'в т.ч. 1 классы',
                    '2' => '2 классы',
                    '3' => '3 классы',
                    '4' => '4 классы',
                ],
                '5_9' => [
                    'vse' => '5-9 классы',
                    '5' => 'в т.ч.  5 классы',
                    '6' => '6 классы',
                    '7' => '7 классы',
                    '8' => '8 классы',
                    '9' => '9 классы',
                ],
                '10_11' => [
                    'vse' => '10-11 классы',
                    '10' => 'в т.ч.  10 классы',
                    '11' => '11 классы',
                ],
            ];
            $riskCalculationByClassArray = $modelR->riskCalculationByClass($RiskAssessmentCollective, $model);
            $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                <tr>
                    <th width="150px" align="center" style="padding: 0rem;" class="text-center"></th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center">N</th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center">G1</th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center">коэффициент</th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center">G2</th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> k</span></th>
                    <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">P</span><span style="font-size: 8px"> i</span></th>
                </tr>
            ';
            foreach ($riskCalculationByClassArray as $key => $arrayClass) {
                foreach ($arrayClass as $keyTwo => $arrOne) {
                    if ($keyTwo == 'vse') {
                        $risk = $arrOne['R_k'];
                        $ver = round($arrOne['P_i'], 1);
                    }

                    $html .= '<tr>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arraClas[$key][$keyTwo] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['N'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G1'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['koef'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G2'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R_k'] . '</td>
                        <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['P_i'] . '</td>
                    </tr>';
                }
            }
            $html .= '</table></div>';
            $html .= '<div> <br></b></b>
                        <b>Заключение:</b> коллективный риск для <span
                            style="color: blue;">' . Yii::$app->riskComponent->trainingClass($model['class']) . '</span> составляет <span
                            style="color: blue;">' . $risk . ' - ' . $model->decodingTextRisk($risk) . '</span>, вероятность формирования нарушений осанки и зрения у обучающихся (при условии неизменности действующих общих факторов риска) составляет <span
                            style="color: blue;">' . $ver . '</span>%.
                        <br>При разработке программы профилактических мероприятий по организации необходимо обратить внимание на следующие управляемые общеобразовательной организацией группы факторов для обучающихся:
                        <br><span
                            style="color: blue;">' . Yii::$app->riskComponent->trainingClass($model->class) . ' – ' . $model->decodingOverallRisk2($model) . '</span>

                    </div>';

            /*$html .= '<div>
                </b>
                </b>
                </b>
                <h3>Заключение:</h3>
                <div style="text-indent: 25px;">
                    Индивидуальный риск – <span
                            style="color: blue;">'. $modelOrganizationCommon->decodingTextRisk($rows[0]['risk_assessment_individual']).'
                </span> (R=<span style="color: blue;">'. $rows[0]['risk_assessment_individual'] .'</span>),
                    в т.ч. вклад управляемых факторов составляет <span
                            style="color: blue;">'. $modelOrganizationCommon->contributionControlledFactors($rows[0]) .'%</span>,
                    из них на управляемые общеобразовательной организацией
                    факторы приходится <span
                            style="color: blue;">'. $modelOrganizationCommon->contributionControlledFactors2($rows[0]) .'%</span>
                    ;
                    на факторы, управляемые семьей – <span
                            style="color: blue;">'. $modelOrganizationCommon->contributionControlledFactors3($rows[0]).'%</span>
                    .
                </div>
                <div style="text-indent: 25px;">
                    Вероятность наступления события (формирование нарушений осанки и (или) зрения) в текущем учебном году, в
                    случае если факторы
                    риска не будут скорректированы составит <span
                            style="color: blue;">'. $modelOrganizationCommon->contributionControlledFactors4($rows[0]['risk_assessment_individual']) .'%</span>
                    ;
                    к моменту окончания школы, при неизменных факторах риска, вероятность составит <span
                            style="color: blue;">'. $modelOrganizationCommon->contributionControlledFactors4($rows[0]['risk_assessment_individual_kv']) .'%</span>
                    .
                </div>
            </div>';*/
            $mpdf = new Mpdf([
                'margin_top' => 5,
                'margin_left' => 20,
                'margin_right' => 10,
                //'mirrorMargins' => true
                //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Расчет коллективного риска.pdf', 'I'); //D - скачает файл!
//            /print_r($model);
//            /exit();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    public function actionPrintCollectiveRiskCommon($key = false)
    {
        $model = new PrintCollectiveRisk();
        if ($key) {
            $model1 = $this->findModelKey($key);
            if ($model1) {
                if ($model1->class == '342') {
                    $model->field1_4 = $model1->key;
                } else if ($model1->class == '486') {
                    $model->field5_9 = $model1->key;
                } else {
                    $model->field10_11 = $model1->key;
                }
            }
        }
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['PrintCollectiveRisk'];
            //print_r($post);
            //exit();
            $model1 = $this->findModelKey($post['field1_4']);
            $model2 = $this->findModelKey($post['field5_9']);
            $model3 = $this->findModelKey($post['field10_11']);

            if (
                $model1 &&
                $model2 &&
                $model3 &&
                ($model1->class == '342') &&
                ($model2->class == '486') &&
                ($model3->class == '2819')
            ) {
                $modelRis1 = RiskAssessmentCollective::find()->where(['key' => $model1->key])->one();
                $modelRis2 = RiskAssessmentCollective::find()->where(['key' => $model2->key])->one();
                $modelRis3 = RiskAssessmentCollective::find()->where(['key' => $model3->key])->one();
                if (
                    $modelRis1 &&
                    $modelRis2 &&
                    $modelRis3
                ) {

                    $modelSave = new RiskAssessmentKey();
                    $modelSave->key_1_4 = $model1->key;
                    $modelSave->key_5_9 = $model2->key;
                    $modelSave->key_10_11 = $model3->key;
                    $modelSave->user_id = 0;
                    $modelSave->federal_district_id = $model1->federal_district_id;
                    $modelSave->region_id = $model1->region_id;
                    $modelSave->municipality_id = $model1->municipality_id;
                    $modelSave->year = $model1->year;
                    $modelSave->organization_id = 0;
                    $modelSave->save(false);

                    $modelR = new RiskAssessmentCollective();

                    $this->layout = false;

                    $html = '
                    <br>
                    <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>
                ';
                    $html .= '
                    <div align="center" ><b>Заключение по коллективному риску нарушения осанки и зрения</b></div>
                ';
                    $html .= '<h3 align="center">Оценка КОЛЛЕКТИВНОГО РИСКА:</h3>';
                    $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                    <tr>
                        <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Показатели</th>
                        <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Всего детей</th>
                        <th align="center" colspan="3" style="padding: 0rem;" class="text-center" >Из них, с нарушениями</th>
                    </tr>
                    <tr>
                        <th class="text-center" align="center" style="padding: 0rem;" >осанки и зрения</th>
                        <th class="text-center" align="center" style="padding: 0rem;" >осанки</th>
                        <th class="text-center" align="center" style="padding: 0rem;" >зрения</th>
    
                    </tr>
                    <tr>
                        <th width="200px" class="text-center" align="center" style="padding: 0rem;" >' . Yii::$app->riskComponent->trainingClass($model1->class) . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis1->field_21 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis1->field_22 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis1->field_23 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis1->field_24 . '</th>
    
                    </tr>
                ';
                    $html .= $this->render(
                        '/risk-collective/table-print/_1_4.php',
                        [
                            'model' => $modelRis1,
                        ]
                    );
                    $html .= '
                    <tr>
                        <th width="200px" class="text-center" align="center" style="padding: 0rem;" >' . Yii::$app->riskComponent->trainingClass($model2->class) . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis2->field_21 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis2->field_22 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis2->field_23 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis2->field_24 . '</th>
    
                    </tr>
                ';
                    $html .= $this->render(
                        '/risk-collective/table-print/_5_9.php',
                        [
                            'model' => $modelRis2,
                        ]
                    );
                    $html .= '
                    <tr>
                        <th width="200px" class="text-center" align="center" style="padding: 0rem;" >' . Yii::$app->riskComponent->trainingClass($model3->class) . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis3->field_21 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis3->field_22 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis3->field_23 . '</th>
                        <th width="120px" class="text-center" align="center" style="padding: 0rem;" >' . $modelRis3->field_24 . '</th>
    
                    </tr>
                ';
                    $html .= $this->render(
                        '/risk-collective/table-print/_10_11.php',
                        [
                            'model' => $modelRis3,
                        ]
                    );

                    $html .= '</table> ';
                    $html .= '<h3 align="center">Оценка ОБЩЕГО РИСКА:</h3>';
                    $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                    <tr>
                         <th class="text-center">Индекс</th>
                         <th class="text-center">Оцениваемые показатели</th>
                         <th class="text-center">1-4 классы</th>
                         <th class="text-center">5-9 классы</th>
                         <th class="text-center">10-11 классы</th>
                    </tr>';
                    $html .= '
                        <tr><td class="text-center" align="center">х1.1.</td> <td>не промаркированная мебель</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model1['fieldTheme1_1']) . '</td><td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model2['fieldTheme1_1']) . '</td><td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model3['fieldTheme1_1']) . '</td></tr>
                        <tr><td class="text-center" align="center">х1.2.</td> <td>не стандартная мебель</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model1['fieldTheme1_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model2['fieldTheme1_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model3['fieldTheme1_2']) . '</td></tr>
                        <tr><td class="text-center" align="center">х1.3.</td> <td>не комплектная мебель</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model1['fieldTheme1_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model2['fieldTheme1_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model3['fieldTheme1_3']) . '</td></tr>
                        <tr><td class="text-center" align="center">х1.4.</td> <td>не ведется листок здоровья либо ведется не в полном объёме</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model1['fieldTheme1_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model2['fieldTheme1_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model3['fieldTheme1_4']) . '</td></tr>
                        <tr><td class="text-center" align="center">х1.5.</td> <td>дети не рассаживаются с учетом роста</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model1['fieldTheme1_5']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model2['fieldTheme1_5']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme1Decoding($model3['fieldTheme1_5']) . '</td></tr>
                        <tr class="font-weight-bold"><th class="text-center" align="center">х1</th>    <th>Итого по фактору ученическая мебель</th> <th class="text-center" align="center">' . $model1['risk_assessment_1'] . '</th> <th class="text-center" align="center">' . $model2['risk_assessment_1'] . '</th> <th class="text-center" align="center">' . $model3['risk_assessment_1'] . '</th></tr>

                    ';
                    $html .= '
                        <tr><td class="text-center" align="center">х2.1.</td> <td>отсутствие производственного контроля за уровнем освещенности в учебных классах и кабинетах</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model1['fieldTheme2_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model2['fieldTheme2_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model3['fieldTheme2_1']) . '</td></tr>
                        <tr><td class="text-center" align="center">х2.2.</td> <td>нарушения санитарного законодательства, выявленные в ходе контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого учебного года</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model1['fieldTheme2_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model2['fieldTheme2_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model3['fieldTheme2_2']) . '</td></tr>
                        <tr><td class="text-center" align="center">х2.3.</td> <td>наличие в отдельных учебных классах и кабинетах перегоревших ламп</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model1['fieldTheme2_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model2['fieldTheme2_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model3['fieldTheme2_3']) . '</td></tr>
                        <tr><td class="text-center" align="center">х2.4.</td> <td>наличие учебных классов и кабинетов, в которых не установлены светорассеивающие светильники</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model1['fieldTheme2_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model2['fieldTheme2_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme2Decoding($model3['fieldTheme2_4']) . '</td></tr>
                        <tr class="font-weight-bold"><th class="text-center" align="center">х2</th> <th>Итого по фактору искусственная освещенность</th> <th class="text-center" align="center">' . $model1['risk_assessment_2'] . '</th> <th class="text-center" align="center">' . $model2['risk_assessment_2'] . '</th> <th class="text-center" align="center">' . $model3['risk_assessment_2'] . '</th></tr>
                    ';
                    $html .= '
                        <tr><td class="text-center" align="center">х3.1.</td> <td>отсутствие проведения гимнастики для глаз вовремя перемен</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model1['fieldTheme3_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model2['fieldTheme3_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model3['fieldTheme3_1']) . '</td></tr>
                        <tr><td class="text-center" align="center">х3.2.</td> <td>отсутствие проведения гимнастики для глаз во время уроков с использованием электронных средств обучения</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model1['fieldTheme3_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model2['fieldTheme3_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme3Decoding($model3['fieldTheme3_2']) . '</td></tr>
                    
                    <tr class="font-weight-bold"><th class="text-center" align="center">х3</th> <th>Итого по фактору гимнастика для глаз</th> <th class="text-center" align="center">' . $model1['risk_assessment_3'] . '</th> <th class="text-center" align="center">' . $model2['risk_assessment_3'] . '</th> <th class="text-center" align="center">' . $model3['risk_assessment_3'] . '</th></tr>

                    ';
                    $html .= '
                        <tr><td class="text-center" align="center">х4.1.</td> <td>отсутствие проведения гимнастики для мышц спины и шеи вовремя перемен</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme4Decoding($model1['fieldTheme4_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme4Decoding($model2['fieldTheme4_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme4Decoding($model3['fieldTheme4_1']) . '</td></tr>
                        <tr class="font-weight-bold"><th class="text-center" align="center">х4</th> <th>Итого по фактору гимнастика для глаз</th> <th class="text-center" align="center">' . $model1['risk_assessment_4'] . '</th> <th class="text-center" align="center">' . $model2['risk_assessment_4'] . '</th> <th class="text-center" align="center">' . $model3['risk_assessment_4'] . '</th></tr>
                    ';
                    $html .= '
                        <tr><td class="text-center" align="center">х5.1.</td> <td>превышение регламентированного СанПиН значения продолжительности использования ЭСО во время уроков</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model1['fieldTheme5_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model2['fieldTheme5_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model3['fieldTheme5_1']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.2.</td> <td>превышение регламентированного СанПиН значения продолжительности использования ЭСО в общеобразовательной организации за учебный день</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model1['fieldTheme5_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model2['fieldTheme5_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model3['fieldTheme5_2']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.3.</td> <td>отсутствие локального акта о запрете использования обучающимися во время перемен устройств мобильной связи (сотовых телефонов)</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model1['fieldTheme5_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model2['fieldTheme5_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme5Decoding($model3['fieldTheme5_3']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.4.</td> <td colspan="2">конструктивные особенности используемых ЭСО на уроках, в том числе недостаточный размер диагонали (1-4):</td> </tr>
                        <tr><td class="text-center" align="center">х5.4.1.</td> <td>интерактивной доски</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model1['fieldTheme5_4_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model2['fieldTheme5_4_1']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model3['fieldTheme5_4_1']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.4.2.</td> <td>монитора компьютера</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model1['fieldTheme5_4_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model2['fieldTheme5_4_2']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model3['fieldTheme5_4_2']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.4.3.</td> <td>планшета</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model1['fieldTheme5_4_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model2['fieldTheme5_4_3']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model3['fieldTheme5_4_3']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.4.4.</td> <td>ноутбука</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model1['fieldTheme5_4_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model2['fieldTheme5_4_4']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model3['fieldTheme5_4_4']) . '</td></tr>
                        <tr><td class="text-center" align="center">х5.4.5.</td> <td>отсутствие второй клавиатуры у ноутбука</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model1['fieldTheme5_4_5']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model2['fieldTheme5_4_5']) . '</td> <td class="text-center" align="center">' . Yii::$app->riskComponent->fieldTheme6Decoding($model3['fieldTheme5_4_5']) . '</td></tr>
                        <tr class="font-weight-bold"><th class="text-center" align="center">х5</th> <th>Итого по фактору не рациональное использование электронных средств обучения и средств мобильной связи</th> <th class="text-center" align="center">' . $model1['risk_assessment_5'] . '</th> <th class="text-center" align="center">' . $model2['risk_assessment_5'] . '</th> <th class="text-center" align="center">' . $model3['risk_assessment_5'] . '</th></tr>

                    ';

                    $html .= '</table>';
                    $arraClas = [
                        '1_4' => [
                            'vse' => '1-4 классы',
                            '1' => 'в т.ч. 1 классы',
                            '2' => '2 классы',
                            '3' => '3 классы',
                            '4' => '4 классы',
                        ],
                        '5_9' => [
                            'vse' => '5-9 классы',
                            '5' => 'в т.ч.  5 классы',
                            '6' => '6 классы',
                            '7' => '7 классы',
                            '8' => '8 классы',
                            '9' => '9 классы',
                        ],
                        '10_11' => [
                            'vse' => '10-11 классы',
                            '10' => 'в т.ч.  10 классы',
                            '11' => '11 классы',
                        ],
                    ];
                    $riskCalculationByClassArray1 = $modelR->riskCalculationByClass($modelRis1, $model1);
                    $riskCalculationByClassArray2 = $modelR->riskCalculationByClass($modelRis2, $model2);
                    $riskCalculationByClassArray3 = $modelR->riskCalculationByClass($modelRis3, $model3);
                    $html .= '<h3 align="center">Расчёт коллективного риска:</h3>';
                    $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
                        <tr>
                            <th width="150px" align="center" style="padding: 0rem;" class="text-center"></th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center">N</th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center">G1</th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center">коэффициент</th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center">G2</th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> k</span></th>
                            <th width="70px" align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">P</span><span style="font-size: 8px"> i</span></th>
                        </tr>
                    ';
                    foreach ($riskCalculationByClassArray1 as $key => $arrayClass) {
                        foreach ($arrayClass as $keyTwo => $arrOne) {
                            if ($keyTwo == 'vse') {
                                $n1 = $arrOne['N'];
                                $risk1 = $arrOne['R_k'];
                                $ver1 = round($arrOne['P_i'], 1);
                            }

                            $html .= '<tr>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arraClas[$key][$keyTwo] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['N'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G1'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['koef'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G2'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R_k'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['P_i'] . '</td>
                        </tr>';
                        }
                    }
                    foreach ($riskCalculationByClassArray2 as $key => $arrayClass) {
                        foreach ($arrayClass as $keyTwo => $arrOne) {
                            if ($keyTwo == 'vse') {
                                $n2 = $arrOne['N'];
                                $risk2 = $arrOne['R_k'];
                                $ver2 = round($arrOne['P_i'], 1);
                            }

                            $html .= '<tr>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arraClas[$key][$keyTwo] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['N'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G1'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['koef'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G2'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R_k'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['P_i'] . '</td>
                        </tr>';
                        }
                    }
                    foreach ($riskCalculationByClassArray3 as $key => $arrayClass) {
                        foreach ($arrayClass as $keyTwo => $arrOne) {
                            if ($keyTwo == 'vse') {
                                $n3 = $arrOne['N'];
                                $risk3 = $arrOne['R_k'];
                                $ver3 = round($arrOne['P_i'], 1);
                            }

                            $html .= '<tr>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arraClas[$key][$keyTwo] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['N'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G1'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['koef'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['G2'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['R_k'] . '</td>
                            <td align="center" style="padding: 0rem;" class="text-center">' . $arrOne['P_i'] . '</td>
                        </tr>';
                        }
                    }
                    $html .= '</table>';
                    $riskVse = (($n1 * $risk1) + ($n2 * $risk2) + ($n3 * $risk3)) / ($n1 + $n2 + $n3);
                    $verVse = ($riskVse * $riskVse) * 100;
                    $html .= '<div> <br>
                            <b>Заключение:</b> коллективный риск для составляет <span style="color: blue;">' . round($riskVse, 3) . ' - ' . $model1->decodingTextRisk($riskVse) . '</span>, вероятность формирования нарушений осанки и зрения у обучающихся 
                            (при условии неизменности действующих общих факторов риска) составляет <span style="color: blue;">' . round($verVse, 2) . '</span>%, 
                            в том числе для обучающихся 
                            1-4 классов - <span style="color: blue;">' . round($ver1, 3) . '% (' . $model1->decodingTextRisk($risk1) . ' - ' . $risk1 . '</span>), 
                            5-9 классов – <span style="color: blue;">' . round($ver2, 3) . '% (' . $model1->decodingTextRisk($risk2) . ' - ' . $risk2 . '</span>), 
                            10-11 кл. – <span style="color: blue;">' . round($ver3, 3) . '% (' . $model1->decodingTextRisk($risk3) . ' - ' . $risk3 . '</span>).
                            <br>При разработке программы профилактических мероприятий по организации необходимо обратить внимание на следующие управляемые общеобразовательной организацией группы факторов для обучающихся:
                            <br><span style="color: blue;">' . Yii::$app->riskComponent->trainingClass($model1->class) . ' – ' . $model1->decodingOverallRisk2($model1) . '</span>
                            <br><span style="color: blue;">' . Yii::$app->riskComponent->trainingClass($model2->class) . ' – ' . $model1->decodingOverallRisk2($model2) . '</span>
                            <br><span style="color: blue;">' . Yii::$app->riskComponent->trainingClass($model3->class) . ' – ' . $model1->decodingOverallRisk2($model3) . '</span>
    
                        </div>';


                    $mpdf = new Mpdf([
                        'margin_top' => 5,
                        'margin_left' => 20,
                        'margin_right' => 10,
                        //'mirrorMargins' => true
                        //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
                    ]);
                    $mpdf->WriteHTML($html);
                    $mpdf->Output('Расчет коллективного риска.pdf', 'D'); //D - скачает файл!

                } else {
                    Yii::$app->session->setFlash('error', 'Данных не найдены!');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Данных не найдены!');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('/print-collective-risk/view', [
            'model' => $model,
        ]);
    }

    public function actionViewCommonRisk($key)
    {
        //ALTER TABLE `risk_questionnaire_one` ADD `estimation_teacher` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_teacher`;
        //ALTER TABLE `risk_questionnaire_two` ADD `estimation_teacher` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_teacher`, ADD `estimation_chile` VARCHAR(250) NOT NULL AFTER `estimation_parent`;
        //ALTER TABLE `risk_questionnaire_three` ADD `estimation_teacher` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_teacher`;
        //ALTER TABLE `risk_questionnaire_four` ADD `estimation_chile` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_chile`;
        //ALTER TABLE `risk_questionnaire_five` ADD `estimation_teacher` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_teacher`;
        //ALTER TABLE `risk_questionnaire_six` ADD `estimation_teacher` VARCHAR(250) NOT NULL AFTER `estimation`, ADD `estimation_parent` VARCHAR(250) NOT NULL AFTER `estimation_teacher`, ADD `estimation_chile` VARCHAR(250) NOT NULL AFTER `estimation_parent`;

        $modelR = new RiskAssessmentCollective();
        $model = $this->findModelKey($key);

        $modelRiskChildrenList = (new \yii\db\Query())
            ->select([
                'risk_children_list.id_children_list as id',
                'risk_children_list.name_responsible_person_individual as name_responsible_person_individual',
                'risk_children_list.class as class',
                'risk_questionnaire_one.estimation as estimation_one',
                'risk_questionnaire_two.estimation as estimation_two',
                'risk_questionnaire_three.estimation as estimation_three',
                'risk_questionnaire_four.estimation as estimation_four',
                'risk_questionnaire_five.estimation as estimation_five',
                'risk_questionnaire_six.estimation as estimation_six',
                'risk_questionnaire_spielberger.rt as rt',
                'risk_questionnaire_spielberger.lt as lt',
                'risk_questionnaire_bass_darck.aggressiveness_index as aggressiveness_index',
                'risk_questionnaire_bass_darck.includes_index as includes_index',
            ])
            ->from('risk_children_list')
            ->join('inner JOIN', 'risk_questionnaire_one', 'risk_questionnaire_one.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_two', 'risk_questionnaire_two.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_three', 'risk_questionnaire_three.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_four', 'risk_questionnaire_four.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_five', 'risk_questionnaire_five.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_six', 'risk_questionnaire_six.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_spielberger', 'risk_questionnaire_spielberger.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_bass_darck', 'risk_questionnaire_bass_darck.id_children_list = risk_children_list.id_children_list')
            ->where(['risk_children_list.key' => $key])
            ->all();

        $RiskAssessmentCollective = RiskAssessmentCollective::find()->where(['key' => $key])->one();
        $rows = (new \yii\db\Query())
            ->from('risk_assessment_organization_common')
            ->join('inner JOIN', 'risk_assessment_individual_common', 'risk_assessment_individual_common.key = risk_assessment_organization_common.key')
            ->where(['risk_assessment_organization_common.key' => $key])
            ->all();
        $result = [];
        $resultChild = [];
        $i = 0;
        foreach ($rows as $one) {
            $result['countChild'] += 1;
            $result['child'] += 1;
            $resultChild[$i]['id_individual'] = $one['id_individual'];
            $resultChild[$i]['class_individual'] = $one['class_individual'];
            $resultChild[$i]['violation_posture'] = $one['violation_posture'];
            $resultChild[$i]['visual_impairment'] = $one['visual_impairment'];
            $resultChild[$i]['risk_assessment_individual'] = $one['risk_assessment_individual'];
            $resultChild[$i]['risk_assessment_individual_kv'] = $one['risk_assessment_individual_kv'];
            $i++;
        }
        //print_r('<br><br>');
        //print_r('<pre>');
        //print_r($result);
        //print_r('<br><br>');
        //print_r($resultChild);
        //print_r('<br><br>');
        //print_r($rows);
        //print_r('</pre>');
        //exit();

        /*  //$model->captcha = rand(11111,99999);
          $model->captcha = 2;

          if(Yii::$app->request->post()){
              $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
              $model->load(Yii::$app->request->post());
              $model->key = $model->generateKey();
              $model->save();



              print_r('<br><br>');
              print_r($model->key);
              print_r('<br><br>');
              exit();
          }*/

        return $this->render('/risk-common/view-common-risk', [
            'model' => $model,
            'result' => $result,
            'resultChild' => $resultChild,
            'RiskAssessmentCollective' => $RiskAssessmentCollective,
            'modelR' => $modelR,
            'modelRiskChildrenList' => $modelRiskChildrenList,
        ]);
    }

    public function actionPrintChildrenList($key)
    {
        $modelСhild = new RiskChildrenList();
        $modelRiskChildrenList = (new \yii\db\Query())
            ->select([
                'risk_children_list.id_children_list as id',
                'risk_children_list.name_responsible_person_individual as name_responsible_person_individual',
                'risk_children_list.class as class',
                'risk_children_list.class_individual as class_individual',
                'risk_questionnaire_one.estimation as estimation_one',
                'risk_questionnaire_one.estimation_teacher as estimation_teacher_one',
                'risk_questionnaire_one.estimation_parent as estimation_parent_one',
                'risk_questionnaire_two.estimation as estimation_two',
                'risk_questionnaire_two.estimation_teacher as estimation_teacher_two',
                'risk_questionnaire_two.estimation_parent as estimation_parent_two',
                'risk_questionnaire_two.estimation_chile as estimation_chile_two',
                'risk_questionnaire_three.estimation as estimation_three',
                'risk_questionnaire_three.estimation_teacher as estimation_teacher_three',
                'risk_questionnaire_three.estimation_parent as estimation_parent_three',
                'risk_questionnaire_four.estimation as estimation_four',
                'risk_questionnaire_four.estimation_chile as estimation_chile_four',
                'risk_questionnaire_four.estimation_parent as estimation_parent_four',
                'risk_questionnaire_five.estimation as estimation_five',
                'risk_questionnaire_five.estimation_teacher as estimation_teacher_five',
                'risk_questionnaire_five.estimation_parent as estimation_parent_five',
                'risk_questionnaire_six.estimation as estimation_six',
                'risk_questionnaire_six.estimation_teacher as estimation_teacher_six',
                'risk_questionnaire_six.estimation_parent as estimation_parent_six',
                'risk_questionnaire_six.estimation_chile as estimation_chile_six',
                'risk_questionnaire_spielberger.rt as rt',
                'risk_questionnaire_spielberger.lt as lt',
                'risk_questionnaire_bass_darck.aggressiveness_index as aggressiveness_index',
                'risk_questionnaire_bass_darck.includes_index as includes_index',
                'risk_questionnaire_bass_darck.physical_aggression_1 as physical_aggression_1',
                'risk_questionnaire_bass_darck.indirect_aggression_2 as indirect_aggression_2',
                'risk_questionnaire_bass_darck.irritation_3 as irritation_3',
                'risk_questionnaire_bass_darck.negativism_4 as negativism_4',
                'risk_questionnaire_bass_darck.resentment_5 as resentment_5',
                'risk_questionnaire_bass_darck.suspicion_6 as suspicion_6',
                'risk_questionnaire_bass_darck.verbal_aggression_7 as verbal_aggression_7',
                'risk_questionnaire_bass_darck.feeling_guilty_8 as feeling_guilty_8',
            ])
            ->from('risk_children_list')
            ->join('inner JOIN', 'risk_questionnaire_one', 'risk_questionnaire_one.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_two', 'risk_questionnaire_two.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_three', 'risk_questionnaire_three.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_four', 'risk_questionnaire_four.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_five', 'risk_questionnaire_five.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_six', 'risk_questionnaire_six.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_spielberger', 'risk_questionnaire_spielberger.id_children_list =	risk_children_list.id_children_list')
            ->join('inner JOIN', 'risk_questionnaire_bass_darck', 'risk_questionnaire_bass_darck.id_children_list = risk_children_list.id_children_list')
            ->where(['risk_children_list.key' => $key])
            ->all();


        $resultChild = [];
        $resultClass = [];
        $resultClass2 = [];
        foreach ($modelRiskChildrenList as $one) {
            $class = Yii::$app->riskComponent->trainingClassIndividual($one['class']);
            $resultClass[$class] = $class;
            $resultChild[$class]['vse']['count'] += 1;
            $resultChild[$class]['vse']['one']['estimation_one'] += $one['estimation_one'];
            $resultChild[$class]['vse']['one']['estimation_teacher_one'] += $one['estimation_teacher_one'];
            $resultChild[$class]['vse']['one']['estimation_parent_one'] += $one['estimation_parent_one'];
            $resultChild[$class]['vse']['one']['vesi'] += 100;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_one']), 1);
            $resultChild[$class]['one'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['one'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['one'][$keyEstimationOne]['estimation'] += $one['estimation_one'];

            $resultChild[$class]['vse']['two']['estimation_two'] += $one['estimation_two'];
            $resultChild[$class]['vse']['two']['estimation_teacher_two'] += $one['estimation_teacher_two'];
            $resultChild[$class]['vse']['two']['estimation_parent_two'] += $one['estimation_parent_two'];
            $resultChild[$class]['vse']['two']['estimation_chile_two'] += $one['estimation_chile_two'];
            $resultChild[$class]['vse']['two']['vesi'] += 100;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_two']), 1);
            $resultChild[$class]['two'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['two'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['two'][$keyEstimationOne]['estimation'] += $one['estimation_two'];

            $resultChild[$class]['vse']['three']['estimation_three'] += $one['estimation_three'];
            $resultChild[$class]['vse']['three']['estimation_teacher_three'] += $one['estimation_teacher_three'];
            $resultChild[$class]['vse']['three']['estimation_parent_three'] += $one['estimation_parent_three'];
            $resultChild[$class]['vse']['three']['vesi'] += 50;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_three']), 1);
            $resultChild[$class]['three'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['three'][$keyEstimationOne]['vesi'] += 50;
            $resultChild[$class]['three'][$keyEstimationOne]['estimation'] += $one['estimation_three'];

            $resultChild[$class]['vse']['four']['estimation_four'] += $one['estimation_four'];
            $resultChild[$class]['vse']['four']['estimation_chile_four'] += $one['estimation_chile_four'];
            $resultChild[$class]['vse']['four']['estimation_parent_four'] += $one['estimation_parent_four'];
            $resultChild[$class]['vse']['four']['vesi'] += 50;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_four']), 1);
            $resultChild[$class]['four'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['four'][$keyEstimationOne]['vesi'] += 50;
            $resultChild[$class]['four'][$keyEstimationOne]['estimation'] += $one['estimation_four'];

            $resultChild[$class]['vse']['five']['estimation_five'] += $one['estimation_five'];
            $resultChild[$class]['vse']['five']['estimation_teacher_five'] += $one['estimation_teacher_five'];
            $resultChild[$class]['vse']['five']['estimation_parent_five'] += $one['estimation_parent_five'];
            $resultChild[$class]['vse']['five']['vesi'] += 100;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_five']), 1);
            $resultChild[$class]['five'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['five'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['five'][$keyEstimationOne]['estimation'] += $one['estimation_five'];

            $resultChild[$class]['vse']['six']['estimation_six'] += $one['estimation_six'];
            $resultChild[$class]['vse']['six']['estimation_teacher_six'] += $one['estimation_teacher_six'];
            $resultChild[$class]['vse']['six']['estimation_parent_six'] += $one['estimation_parent_six'];
            $resultChild[$class]['vse']['six']['estimation_chile_six'] += $one['estimation_chile_six'];
            $resultChild[$class]['vse']['six']['vesi'] += 100;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor($one['estimation_six']), 1);
            $resultChild[$class]['six'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['six'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['six'][$keyEstimationOne]['estimation'] += $one['estimation_six'];


            $resultChild[$class]['vse']['lt']['lt'] += $one['lt'];
            $resultChild[$class]['vse']['lt']['vesi'] += 100;

            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor2($one['lt']), 1);
            $resultChild[$class]['lt'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['lt'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['lt'][$keyEstimationOne]['estimation'] += $one['lt'];

            $resultChild[$class]['vse']['rt']['rt'] += $one['rt'];
            $resultChild[$class]['vse']['rt']['vesi'] += 100;
            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor2($one['rt']), 1);
            $resultChild[$class]['rt'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['rt'][$keyEstimationOne]['vesi'] += 100;
            $resultChild[$class]['rt'][$keyEstimationOne]['estimation'] += $one['rt'];

            $resultClass2[] = $one['aggressiveness_index'];

            $resultChild[$class]['vse']['aggressiveness_index']['aggressiveness_index'] += $one['aggressiveness_index'];
            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor22($one['aggressiveness_index']), 1);
            $resultChild[$class]['aggressiveness_index'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['aggressiveness_index'][$keyEstimationOne]['estimation'] += $one['aggressiveness_index'];
            $resultChild[$class]['aggressiveness_index'][$keyEstimationOne]['estimation1'][] = $one['aggressiveness_index'];


            $resultChild[$class]['vse']['includes_index']['includes_index'] += $one['includes_index'];
            $keyEstimationOne = substr($modelСhild->scoringDescriptionColor33($one['includes_index']), 1);
            $resultChild[$class]['includes_index'][$keyEstimationOne]['count'] += 1;
            $resultChild[$class]['includes_index'][$keyEstimationOne]['estimation'] += $one['includes_index'];
            $resultChild[$class]['includes_index'][$keyEstimationOne]['estimation1'][] = $one['includes_index'];


            $resultChild[$class]['vse']['physical_aggression_1'] += $one['physical_aggression_1'];
            $resultChild[$class]['vse']['indirect_aggression_2'] += $one['indirect_aggression_2'];
            $resultChild[$class]['vse']['irritation_3'] += $one['irritation_3'];
            $resultChild[$class]['vse']['negativism_4'] += $one['negativism_4'];
            $resultChild[$class]['vse']['resentment_5'] += $one['resentment_5'];
            $resultChild[$class]['vse']['suspicion_6'] += $one['suspicion_6'];
            $resultChild[$class]['vse']['verbal_aggression_7'] += $one['verbal_aggression_7'];
            $resultChild[$class]['vse']['feeling_guilty_8'] += $one['feeling_guilty_8'];
        }

     // print_r('<br><br>');
     // print_r('<pre>');
     // print_r($resultChild);
     // print_r('<br><br>');
     // print_r('</pre>');
     // exit();

        //adff2f
        //ffeb33
        //fa3737

      /*  $arr = [
            ['1. Спилбергер и Ханин', '', '',],
            ['1.1. реактичная тревожность', '', '',],
            ['Количество человек', 'низкая тревожность', 'до 30',],
            ['Количество человек', 'умеренная тревожность', '31 - 45',],
            ['Количество человек', 'высокая тревожность', '46 и более',],
            ['Коллективная оценка', 'РТ_общая оценка', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['1.2. личностная тревожность', '', '',],
            ['Количество человек', 'низкая тревожность', 'до 30',],
            ['Количество человек', 'умеренная тревожность', '31 - 45',],
            ['Количество человек', 'высокая тревожность', '46 и более',],
            ['Коллективная оценка', 'ЛТ_общая оценка', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['2. Симптомы беспокойства и нервозности', '', '',],
            ['Количество человек', 'зеленая зона', 'до 28,6',],
            ['Количество человек', 'желтая зона', '28,6 - 71,44',],
            ['Количество человек', 'красная зона', '71,45 - 100',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['3. Индикация причин тревожности', '', '',],
            ['Количество человек', 'зеленая зона', 'до 28,6',],
            ['Количество человек', 'желтая зона', '28,6 - 71,44',],
            ['Количество человек', 'красная зона', '71,45 - 100',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['4. Меры профилактики, реализуемые в отношении ребенка со стороны УЧИТЕЛЕЙ', '', '',],
            ['Количество человек', 'зеленая зона', 'до 14,28',],
            ['Количество человек', 'желтая зона', '14,29 - 35,72',],
            ['Количество человек', 'красная зона', '35,73 - 50',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['5. Меры профилактики, реализуемые в отношении ребенка со стороны РОДИТЕЛЕЙ', '', '',],
            ['Количество человек', 'зеленая зона', 'до 14,28',],
            ['Количество человек', 'желтая зона', '14,29 - 35,72',],
            ['Количество человек', 'красная зона', '35,73 - 50',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['6. Формы проявления агрессии у ребенка', '', '',],
            ['Количество человек', 'зеленая зона', 'до 14,28',],
            ['Количество человек', 'желтая зона', '14,29 - 35,72',],
            ['Количество человек', 'красная зона', '35,73 - 50',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['7. Индикация возможных причин агрессии', '', '',],
            ['Количество человек', 'зеленая зона', 'до 28,6',],
            ['Количество человек', 'желтая зона', '28,6 - 71,44',],
            ['Количество человек', 'красная зона', '71,45 - 100',],
            ['Коллективная оценка', 'оценка по ответам', '',],
            ['Коллективная оценка по', 'зеленая зона', '',],
            ['Коллективная оценка по', 'желтая зона', '',],
            ['Коллективная оценка по', 'красная зона', '',],
            ['8. Опросник агрессивности Басса-Дарки', '', '',],
            ['8.1. средний индекс враждебности класса', '', '',],
            ['Количество человек', 'низкий (хор)', '0 - 27',],
            ['Количество человек', 'средний', '28 - 49',],
            ['Количество человек', 'повышенный', '50 - 71',],
            ['Количество человек', 'высокий', '72 - 82',],
            ['Количество человек', 'очень высокий', 'более 82',],
            ['Коллективная оценка', 'РТ_общая оценка', '',],
            ['Коллективная оценка по', 'низкий (хор)', '',],
            ['Коллективная оценка по', 'средний', '',],
            ['Коллективная оценка по', 'повышенный', '',],
            ['Коллективная оценка по', 'высокий', '',],
            ['Коллективная оценка по', 'очень высокий', '',],
            ['8.2. средний индекс агрессивности класса', '', '',],
            ['Количество человек', 'низкий (хор)', '0 - 14',],
            ['Количество человек', 'средний', '15 - 36',],
            ['Количество человек', 'повышенный', '37 - 58',],
            ['Количество человек', 'высокий', '59 - 69',],
            ['Количество человек', 'очень высокий', '70 и более',],
            ['Коллект оценка', 'ЛТ_общая оценка', '',],
            ['Коллективная оценка по', 'низкий (хор)', '',],
            ['Коллективная оценка по', 'средний', '',],
            ['Коллективная оценка по', 'повышенный', '',],
            ['Коллективная оценка по', 'высокий', '',],
            ['Коллективная оценка по', 'очень высокий', '',],
        ];
        $resultTable = [];

        for($hhh = 0; $hhh <= 89; $hhh++){
            $resultTable[$hhh][] = $arr[$hhh][0];
            $resultTable[$hhh][] = $arr[$hhh][1];
            $resultTable[$hhh][] = $arr[$hhh][2];
            foreach ($resultClass as $class){

                $resultTable[$hhh][] = $resultChild[$class]['rt']['adff2f']['count'];
                $resultTable[$hhh][] = $resultChild[$class]['rt']['ffeb33']['count'];
                $resultTable[$hhh][] = $resultChild[$class]['rt']['fa3737']['count'];
            }
        }*/

        //print_r('<br><br>');
        //print_r('<pre>');
        //print_r($resultTable);
        //print_r('<br><br>');
        //print_r('</pre>');
        //exit();
        return $this->render('/risk-individual/view-collective-risk', [
            'key' => $key,
            'modelСhild' => $modelСhild,
            'resultChild' => $resultChild,
            'modelRiskChildrenList' => $modelRiskChildrenList,
        ]);
        /*$this->layout = false;
        $html = '
            <br>
            <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>
        ';
        $html .= '
            <div align="center" ><b><i>Коллективная оценка уровня тревожности и агрессии у обучающихся общеобразовательных организаций, профилактике нарушений психического здоровья</i></b></div>
        ';
        $html .= '<div>';


        $html2 = '<table style="border: 1px solid #000000;" class=" table table-sm table-bordered">';
        $html2 = '</table>';

        print_r($html2);
        exit();

        foreach ($resultChild as $keyClass => $oneClass) {
            $html .= '<b>Коллективная оценка за ' . $keyClass . ':</b><br>';
            $html .= '<div style="margin-left: 25px;"><i>1. Результаты «Оценка уровня реактивной и личностной тревожности (по Ч.Д. Спилбергеру, ЮЛ. Ханину)»:</i></div>';
            $html .= '<div style="margin-left: 45px;">Средний показатель РТ (реактивная тревожность): <b>' . round($oneClass['vse']['rt'] / $oneClass['vse']['count'], 3) . ' </b></div>';
            $html .= '<div style="margin-left: 45px;">Средний показатель ЛТ (личностная тревожность): <b>' . round($oneClass['vse']['lt'] / $oneClass['vse']['count'], 3) . ' </b></div>';

            $html .= '<div style="margin-left: 25px;"><i>2. Результаты «Опросник на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учителей, родителей (законных представителей), особенно при коротких сроках выполнения»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            $html .= '<div style="margin-left: 65px;"><i>- максимальное значение по ответам: </i>' . $oneClass['vse']['one']['vesi'] . ' </div>';
            $html .= '<div style="margin-left: 65px;"><i>- набранные значение по ответам: </i>' . $oneClass['vse']['one']['estimation_one'] . ' </div>';
            $html .= '<div style="margin-left: 45px;"><b>Средневзвешенная коллективная  оценка: ' . round($oneClass['vse']['one']['estimation_one'] / $oneClass['vse']['one']['vesi'], 3) . '</b></div>';
            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['one']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['one']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['one']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }


            $html .= '<div style="margin-left: 25px;"><i>3. Результаты «Опросник индикации возможных причин тревожности»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            if (($estimation1 = $oneClass['two']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «зеленой зоне» (норма): </i>' . $estimation1['count'] . ' </div>';
            }
            if (($estimation2 = $oneClass['two']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «желтой зоне» (незначительное отклонение от нормы): </i>' . $estimation2['count'] . ' </div>';
            }
            if (($estimation3 = $oneClass['two']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «красной зоне» (значительное отклонение от нормы): </i>' . $estimation3['count'] . ' </div>';
            }
            $html .= '<div style="margin-left: 45px;"> <b>Коллективная  оценка:</b> ' . round($oneClass['vse']['count'] * (($estimation2['count'] + $estimation3['count']) * 2), 3) . '</div>';

            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['two']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['two']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['two']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }


            $html .= '<div style="margin-left: 25px;"><i>4. Результаты «Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя)»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            if (($estimation1 = $oneClass['three']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «зеленой зоне» (норма): </i>' . $estimation1['count'] . ' </div>';
            }
            if (($estimation2 = $oneClass['three']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «желтой зоне» (незначительное отклонение от нормы): </i>' . $estimation2['count'] . ' </div>';
            }
            if (($estimation3 = $oneClass['three']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «красной зоне» (значительное отклонение от нормы): </i>' . $estimation3['count'] . ' </div>';
            }
            $html .= '<div style="margin-left: 45px;"> <b>Коллективная  оценка:</b> ' . round($oneClass['vse']['count'] * (($estimation2['count'] + $estimation3['count']) * 2), 3) . '</div>';

            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['three']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['three']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['three']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }


            $html .= '<div style="margin-left: 25px;"><i>5. Результаты «Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            if (($estimation1 = $oneClass['four']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «зеленой зоне» (норма): </i>' . $estimation1['count'] . ' </div>';
            }
            if (($estimation2 = $oneClass['four']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «желтой зоне» (незначительное отклонение от нормы): </i>' . $estimation2['count'] . ' </div>';
            }
            if (($estimation3 = $oneClass['four']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «красной зоне» (значительное отклонение от нормы): </i>' . $estimation3['count'] . ' </div>';
            }
            $html .= '<div style="margin-left: 45px;"> <b>Коллективная  оценка:</b> ' . round($oneClass['vse']['count'] * (($estimation2['count'] + $estimation3['count']) * 2), 3) . '</div>';

            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['four']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['four']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['four']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }


            $html .= '<div style="margin-left: 25px;"><i>6. Результаты «Опросник формы проявления агрессии у ребенка»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            if (($estimation1 = $oneClass['five']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «зеленой зоне» (норма): </i>' . $estimation1['count'] . ' </div>';
            }
            if (($estimation2 = $oneClass['five']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «желтой зоне» (незначительное отклонение от нормы): </i>' . $estimation2['count'] . ' </div>';
            }
            if (($estimation3 = $oneClass['five']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «красной зоне» (значительное отклонение от нормы): </i>' . $estimation3['count'] . ' </div>';
            }
            $html .= '<div style="margin-left: 45px;"> <b>Коллективная  оценка:</b> ' . round($oneClass['vse']['count'] * (($estimation2['count'] + $estimation3['count']) * 2), 3) . '</div>';

            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['five']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['five']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['five']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }


            $html .= '<div style="margin-left: 25px;"><i>7. Результаты «Опросник индикации возможных причин агрессивности ребенка»:</i></div>';
            $html .= '<div style="margin-left: 45px;"><b>Составляющие коллективной оценки: </b></div>';
            $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов: </i>' . $oneClass['vse']['count'] . ' </div>';
            if (($estimation1 = $oneClass['six']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «зеленой зоне» (норма): </i>' . $estimation1['count'] . ' </div>';
            }
            if (($estimation2 = $oneClass['six']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «желтой зоне» (незначительное отклонение от нормы): </i>' . $estimation2['count'] . ' </div>';
            }
            if (($estimation3 = $oneClass['six']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- общее количество респондентов оценка которых, находится в «красной зоне» (значительное отклонение от нормы): </i>' . $estimation3['count'] . ' </div>';
            }
            $html .= '<div style="margin-left: 45px;"> <b>Коллективная  оценка:</b> ' . round($oneClass['vse']['count'] * (($estimation2['count'] + $estimation3['count']) * 2), 3) . '</div>';

            $html .= '<div style="margin-left: 45px;"><b>Разбиение респондентов по индивидуальной оценки тревожности: </b></div>';
            if (($estimation = $oneClass['six']['adff2f']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «зеленой зоне» (норма): Данные отсутствуют </i> </div>';
            }
            if (($estimation = $oneClass['six']['ffeb33']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «желтой зоне» (незначительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в ««желтой зоне» (незначительное отклонение от нормы): Данные отсутствуют</i> </div>';
            }
            if (($estimation = $oneClass['six']['fa3737']) !== null) {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы): </i></div>';
                $html .= '<div style="margin-left: 85px;"><i>- общее количество респондентов: </i>' . $estimation['count'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- максимальное значение по ответам: </i>' . $estimation['vesi'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- набранные значение по ответам: </i>' . $estimation['estimation'] . ' </div>';
                $html .= '<div style="margin-left: 85px;"><i>- <b>Средневзвешенная коллективная  оценка:</b> </i>' . round($estimation['estimation'] / $estimation['vesi'], 3) . '</div>';
            } else {
                $html .= '<div style="margin-left: 65px;"><i>- Находящихся в «красной зоне» (значительное отклонение от нормы):  Данные отсутствуют</i></div>';
            }
            $html .= '<div style="margin-left: 25px;"><i>8. Результаты «Опросник агрессивности Басса – Дарки»:</i></div>';
            $html .= '<div style="margin-left: 45px;">Средний индекс агрессивности класса: <b>' . round($oneClass['vse']['aggressiveness_index'] / $oneClass['vse']['count'], 3) . ' </b></div>';
            $html .= '<div style="margin-left: 45px;">Средний индекс враждебности класса: <b>' . round($oneClass['vse']['includes_index'] / $oneClass['vse']['count'], 3) . ' </b></div>';
            $html .= '<div>';
            $html .= 'Работа по психологической поддержке в классе в плане профилактики повышенной тревожности (среди детей с повышенной тревожностью) расценивается - <b><span>' .
                $modelСhild->finalAssessmentText($oneClass['vse']['five']['estimation_five'], $oneClass['vse']['six']['estimation_six'], $oneClass['vse']['four']['estimation_four'])
                . '</span></b><br>';
            $html .= '<br>';
        }

        $html .= '</div>';
        $mpdf = new Mpdf([
            'margin_top' => 5,
            'margin_left' => 20,
            'margin_right' => 10,
            //'mirrorMargins' => true
            //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Коллективная оценка уровня агрессии.pdf', 'I'); //D - скачает файл!*/

    }

    public function actionViewIndividualRisk($id)
    {
        //$model = $this->findModelKey($key);

        $modelOrganizationCommon = new RiskAssessmentOrganizationCommon();
        $modelIndividualCommon = new RiskAssessmentIndividualCommon();

        $rows = (new \yii\db\Query())
            ->from('risk_assessment_organization_common')
            ->join('inner JOIN', 'risk_assessment_individual_common', 'risk_assessment_individual_common.key = risk_assessment_organization_common.key')
            ->where(['risk_assessment_individual_common.id_individual' => $id])
            ->one();
        //$result = [];
        //$resultChild = [];
        //$i = 0;
        //foreach ($rows as $one) {
        //    $result['countChild'] += 1;
        //    $result['child'] += 1;
        //    $resultChild[$i]['id_individual'] =$one['id_individual'];
        //    $resultChild[$i]['class_individual'] = $one['class_individual'];
        //    $resultChild[$i]['risk_assessment_individual'] = $one['risk_assessment_individual'];
        //    $resultChild[$i]['risk_assessment_individual_kv'] = $one['risk_assessment_individual_kv'];
        //    $i++;
        //}
        //print_r('<br><br>');
        //print_r('<pre>');
        //print_r($rows);
        //print_r('</pre>');
        //exit();

        /*  //$model->captcha = rand(11111,99999);
          $model->captcha = 2;

          if(Yii::$app->request->post()){
              $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
              $model->load(Yii::$app->request->post());
              $model->key = $model->generateKey();
              $model->save();



              print_r('<br><br>');
              print_r($model->key);
              print_r('<br><br>');
              exit();
          }*/

        return $this->render('/risk-individual/view-individual-risk', [
            'rows' => $rows,
            'modelOrganizationCommon' => $modelOrganizationCommon,
            'modelIndividualCommon' => $modelIndividualCommon,
            //'result' => $result,
            //'resultChild' => $resultChild,
        ]);
    }

    public function actionViewEstimation($key)
    {
        $model = RiskEstimation::find()->where(['key' => $key])->one();
        if (!$model) {
            $model = new RiskEstimation();
        }
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskEstimation'];
            $model->load(Yii::$app->request->post());
            $model->key = $key;
            $model->user_id = 2;
            $model->organization_id = 2;
            //print_r('<pre>');
            //print_r($model);
            //print_r('</pre>');
            //exit();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Ваша оценка принта!');

                return $this->redirect(['view-common-risk', 'key' => $model->key]);
            } else {
                Yii::$app->session->setFlash('error', 'Ваша оценка НЕ принта');
            }
        }

        return $this->render('/risk-common/view-estimation', [
            'model' => $model,
        ]);
    }

    public function actionContentQuestionnaire($key, $class)
    {
        $modelRiskQuestionnaireSpielberger = new RiskQuestionnaireSpielberger();
        $modelRiskQuestionnaireBassDarck = new RiskQuestionnaireBassDarck();
        $modelСhild = new RiskChildrenList();
        $modelСhild->key = $key;
        $modelСhild->class_individual = $class;
        $modelСhild->testing_date = date('Y-m-d');
        $modelRiskQuestionnaireOne = $this->findRiskQuestionnaireOne($key, $class);
        $modelRiskQuestionnaireOne->field_1_parent = '';
        $modelRiskQuestionnaireOne->field_2_parent = '';
        $modelRiskQuestionnaireOne->field_3_parent = '';
        $modelRiskQuestionnaireOne->field_4_parent = '';
        $modelRiskQuestionnaireOne->field_5_parent = '';
        $modelRiskQuestionnaireOne->field_6_parent = '';
        $modelRiskQuestionnaireOne->field_7_parent = '';
        $modelRiskQuestionnaireTwo = $this->findRiskQuestionnaireTwo($key, $class);
        $modelRiskQuestionnaireTwo->field_1_parent = '';
        $modelRiskQuestionnaireTwo->field_2_parent = '';
        $modelRiskQuestionnaireTwo->field_3_parent = '';
        $modelRiskQuestionnaireTwo->field_4_parent = '';
        $modelRiskQuestionnaireTwo->field_5_parent = '';
        $modelRiskQuestionnaireTwo->field_6_parent = '';
        $modelRiskQuestionnaireTwo->field_7_parent = '';
        $modelRiskQuestionnaireTwo->field_8_parent = '';
        $modelRiskQuestionnaireTwo->field_1_chile = '';
        $modelRiskQuestionnaireTwo->field_2_chile = '';
        $modelRiskQuestionnaireTwo->field_3_chile = '';
        $modelRiskQuestionnaireTwo->field_4_chile = '';
        $modelRiskQuestionnaireTwo->field_5_chile = '';
        $modelRiskQuestionnaireTwo->field_6_chile = '';
        $modelRiskQuestionnaireTwo->field_7_chile = '';
        $modelRiskQuestionnaireTwo->field_8_chile = '';
        $modelRiskQuestionnaireThree = $this->findRiskQuestionnaireThree($key, $class);
        $modelRiskQuestionnaireThree->field_1_parent = '';
        $modelRiskQuestionnaireThree->field_2_parent = '';
        $modelRiskQuestionnaireThree->field_3_parent = '';
        $modelRiskQuestionnaireThree->field_4_parent = '';
        $modelRiskQuestionnaireThree->field_5_parent = '';
        $modelRiskQuestionnaireThree->field_6_parent = '';
        $modelRiskQuestionnaireThree->field_7_parent = '';
        $modelRiskQuestionnaireFour = $this->findRiskQuestionnaireFour($key, $class);
        $modelRiskQuestionnaireFour->field_1_parent = '';
        $modelRiskQuestionnaireFour->field_2_parent = '';
        $modelRiskQuestionnaireFour->field_3_parent = '';
        $modelRiskQuestionnaireFour->field_4_parent = '';
        $modelRiskQuestionnaireFour->field_5_parent = '';
        $modelRiskQuestionnaireFour->field_6_parent = '';
        $modelRiskQuestionnaireFour->field_7_parent = '';
        $modelRiskQuestionnaireFour->field_8_parent = '';
        $modelRiskQuestionnaireFour->field_9_parent = '';
        $modelRiskQuestionnaireFour->field_10_parent = '';
        $modelRiskQuestionnaireFour->field_1_chile = '';
        $modelRiskQuestionnaireFour->field_2_chile = '';
        $modelRiskQuestionnaireFour->field_3_chile = '';
        $modelRiskQuestionnaireFour->field_4_chile = '';
        $modelRiskQuestionnaireFour->field_5_chile = '';
        $modelRiskQuestionnaireFour->field_6_chile = '';
        $modelRiskQuestionnaireFour->field_7_chile = '';
        $modelRiskQuestionnaireFour->field_8_chile = '';
        $modelRiskQuestionnaireFour->field_9_chile = '';
        $modelRiskQuestionnaireFour->field_10_chile = '';
        $modelRiskQuestionnaireFive = $this->findRiskQuestionnaireFive($key, $class);
        $modelRiskQuestionnaireFive->field_1_parent = '';
        $modelRiskQuestionnaireFive->field_2_parent = '';
        $modelRiskQuestionnaireFive->field_3_parent = '';
        $modelRiskQuestionnaireFive->field_4_parent = '';
        $modelRiskQuestionnaireFive->field_5_parent = '';
        $modelRiskQuestionnaireFive->field_6_parent = '';
        $modelRiskQuestionnaireFive->field_7_parent = '';
        $modelRiskQuestionnaireSix = $this->findRiskQuestionnaireSix($key, $class);
        $modelRiskQuestionnaireSix->field_1_parent = '';
        $modelRiskQuestionnaireSix->field_2_parent = '';
        $modelRiskQuestionnaireSix->field_3_parent = '';
        $modelRiskQuestionnaireSix->field_4_parent = '';
        $modelRiskQuestionnaireSix->field_5_parent = '';
        $modelRiskQuestionnaireSix->field_6_parent = '';
        $modelRiskQuestionnaireSix->field_1_chile = '';
        $modelRiskQuestionnaireSix->field_2_chile = '';
        $modelRiskQuestionnaireSix->field_3_chile = '';
        $modelRiskQuestionnaireSix->field_4_chile = '';
        $modelRiskQuestionnaireSix->field_5_chile = '';
        $modelRiskQuestionnaireSix->field_6_chile = '';
        if (Yii::$app->request->post()) {
            $postChildrenList = Yii::$app->request->post()['RiskChildrenList'];
            $postQuestionnaireOne = Yii::$app->request->post()['RiskQuestionnaireOne'];
            $postRiskQuestionnaireTwo = Yii::$app->request->post()['RiskQuestionnaireTwo'];
            $postRiskQuestionnaireThree = Yii::$app->request->post()['RiskQuestionnaireThree'];
            $postRiskQuestionnaireFour = Yii::$app->request->post()['RiskQuestionnaireFour'];
            $postRiskQuestionnaireFive = Yii::$app->request->post()['RiskQuestionnaireFive'];
            $postRiskQuestionnaireSix = Yii::$app->request->post()['RiskQuestionnaireSix'];

            $modelСhildNew = new RiskChildrenList();
            $modelRiskQuestionnaireOneNew = new RiskQuestionnaireOne();
            $modelRiskQuestionnaireTwoNew = new RiskQuestionnaireTwo();
            $modelRiskQuestionnaireThreeNew = new RiskQuestionnaireThree();
            $modelRiskQuestionnaireFourNew = new RiskQuestionnaireFour();
            $modelRiskQuestionnaireFiveNew = new RiskQuestionnaireFive();
            $modelRiskQuestionnaireSixNew = new RiskQuestionnaireSix();

            $modelСhildNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireOneNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireTwoNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireThreeNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireFourNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireFiveNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireSixNew->load(Yii::$app->request->post());
            $modelRiskQuestionnaireSpielberger->load(Yii::$app->request->post());
            $modelRiskQuestionnaireBassDarck->load(Yii::$app->request->post());


            $modelСhildNew->class_individual = $class;
            $modelСhildNew->testing_date = date("d.m.Y", strtotime($modelСhild->testing_date));
            if ($modelСhildNew->save()) {
                $modelRiskQuestionnaireOneNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireOneNew->key = $key;
                $modelRiskQuestionnaireOneNew->class = $class;
                $modelRiskQuestionnaireOneNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireOneNew->estimation = round($modelRiskQuestionnaireOne->scoringScores($modelRiskQuestionnaireOneNew), 2);
                $modelRiskQuestionnaireOneNew->estimation_teacher = round($modelRiskQuestionnaireOne->scoringScores_teacher($modelRiskQuestionnaireOneNew), 2);
                $modelRiskQuestionnaireOneNew->estimation_parent = round($modelRiskQuestionnaireOne->scoringScores_parent($modelRiskQuestionnaireOneNew), 2);

                $modelRiskQuestionnaireTwoNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireTwoNew->key = $key;
                $modelRiskQuestionnaireTwoNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireTwoNew->estimation = round($modelRiskQuestionnaireTwo->scoringScores($modelRiskQuestionnaireTwoNew), 2);
                $modelRiskQuestionnaireTwoNew->estimation_teacher = round($modelRiskQuestionnaireTwo->scoringScores_teacher($modelRiskQuestionnaireTwoNew), 2);
                $modelRiskQuestionnaireTwoNew->estimation_parent = round($modelRiskQuestionnaireTwo->scoringScores_parent($modelRiskQuestionnaireTwoNew), 2);
                $modelRiskQuestionnaireTwoNew->estimation_chile = round($modelRiskQuestionnaireTwo->scoringScores_chile($modelRiskQuestionnaireTwoNew), 2);

                $modelRiskQuestionnaireThreeNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireThreeNew->key = $key;
                $modelRiskQuestionnaireThreeNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireThreeNew->estimation = round($modelRiskQuestionnaireThree->scoringScores($modelRiskQuestionnaireThreeNew), 2);
                $modelRiskQuestionnaireThreeNew->estimation_teacher = round($modelRiskQuestionnaireThree->scoringScores_teacher($modelRiskQuestionnaireThreeNew), 2);
                $modelRiskQuestionnaireThreeNew->estimation_parent = round($modelRiskQuestionnaireThree->scoringScores_parent($modelRiskQuestionnaireThreeNew), 2);

                $modelRiskQuestionnaireFourNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireFourNew->key = $key;
                $modelRiskQuestionnaireFourNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireFourNew->estimation = round($modelRiskQuestionnaireFour->scoringScores($modelRiskQuestionnaireFourNew), 2);
                $modelRiskQuestionnaireFourNew->estimation_chile = round($modelRiskQuestionnaireFour->scoringScores_chile($modelRiskQuestionnaireFourNew), 2);
                $modelRiskQuestionnaireFourNew->estimation_parent = round($modelRiskQuestionnaireFour->scoringScores_parent($modelRiskQuestionnaireFourNew), 2);

                $modelRiskQuestionnaireFiveNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireFiveNew->key = $key;
                $modelRiskQuestionnaireFiveNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireFiveNew->estimation = round($modelRiskQuestionnaireFive->scoringScores($modelRiskQuestionnaireFiveNew), 2);
                $modelRiskQuestionnaireFiveNew->estimation_teacher = round($modelRiskQuestionnaireFive->scoringScores_teacher($modelRiskQuestionnaireFiveNew), 2);
                $modelRiskQuestionnaireFiveNew->estimation_parent = round($modelRiskQuestionnaireFive->scoringScores_parent($modelRiskQuestionnaireFiveNew), 2);

                $modelRiskQuestionnaireSixNew->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireSixNew->key = $key;
                $modelRiskQuestionnaireSixNew->class_individual = $modelСhildNew->class_individual;
                $modelRiskQuestionnaireSixNew->estimation = round($modelRiskQuestionnaireSix->scoringScores($modelRiskQuestionnaireSixNew), 2);
                $modelRiskQuestionnaireSixNew->estimation_teacher = round($modelRiskQuestionnaireSix->scoringScores_teacher($modelRiskQuestionnaireSixNew), 2);
                $modelRiskQuestionnaireSixNew->estimation_parent = round($modelRiskQuestionnaireSix->scoringScores_parent($modelRiskQuestionnaireSixNew), 2);
                $modelRiskQuestionnaireSixNew->estimation_chile = round($modelRiskQuestionnaireSix->scoringScores_chile($modelRiskQuestionnaireSixNew), 2);

                $modelRiskQuestionnaireSpielberger->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireSpielberger->key = $key;
                $modelRiskQuestionnaireSpielberger->class_individual = $modelСhildNew->class_individual;
                $arrValue = $modelRiskQuestionnaireSpielberger->scoringScores($modelRiskQuestionnaireSpielberger);
                $modelRiskQuestionnaireSpielberger->rt = $arrValue['RTvalue1'];
                $modelRiskQuestionnaireSpielberger->lt = $arrValue['LTvalue2'];

                $modelRiskQuestionnaireBassDarck->id_children_list = $modelСhildNew->id_children_list;
                $modelRiskQuestionnaireBassDarck->key = $key;
                $modelRiskQuestionnaireBassDarck->class_individual = $modelСhildNew->class_individual;
                $arrValueBassDarck = $modelRiskQuestionnaireBassDarck->scoringScores($modelRiskQuestionnaireBassDarck);

                $modelRiskQuestionnaireBassDarck['physical_aggression_1'] = $arrValueBassDarck['physical_aggression_1'];
                $modelRiskQuestionnaireBassDarck['indirect_aggression_2'] = $arrValueBassDarck['indirect_aggression_2'];
                $modelRiskQuestionnaireBassDarck['irritation_3'] = $arrValueBassDarck['irritation_3'];
                $modelRiskQuestionnaireBassDarck['negativism_4'] = $arrValueBassDarck['negativism_4'];
                $modelRiskQuestionnaireBassDarck['resentment_5'] = $arrValueBassDarck['resentment_5'];
                $modelRiskQuestionnaireBassDarck['suspicion_6'] = $arrValueBassDarck['suspicion_6'];
                $modelRiskQuestionnaireBassDarck['verbal_aggression_7'] = $arrValueBassDarck['verbal_aggression_7'];
                $modelRiskQuestionnaireBassDarck['feeling_guilty_8'] = $arrValueBassDarck['feeling_guilty_8'];
                $modelRiskQuestionnaireBassDarck['result_aggressiveness'] = $arrValueBassDarck['result_aggressiveness'];
                $modelRiskQuestionnaireBassDarck['result_hostility'] = $arrValueBassDarck['result_hostility'];
                $modelRiskQuestionnaireBassDarck->aggressiveness_index = $arrValueBassDarck['aggressiveness_index'];
                $modelRiskQuestionnaireBassDarck->includes_index = $arrValueBassDarck['includes_index'];

                if (
                    $modelRiskQuestionnaireOneNew->save() &&
                    $modelRiskQuestionnaireTwoNew->save() &&
                    $modelRiskQuestionnaireThreeNew->save() &&
                    $modelRiskQuestionnaireFourNew->save() &&
                    $modelRiskQuestionnaireFiveNew->save() &&
                    $modelRiskQuestionnaireSixNew->save() &&
                    $modelRiskQuestionnaireSpielberger->save() &&
                    $modelRiskQuestionnaireBassDarck->save()
                ) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['view-common-risk', 'key' => $key]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ваша оценка НЕ принта');

                //print_r($modelСhildNew->getErrors());
            }

            //print_r('<pre>');
            //print_r('<br><br>');
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireOneNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireTwoNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireThreeNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireFourNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireFiveNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireSixNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireOneNew['estimation']);
            ////print_r($modelСhild);
            ////print_r('<br><br>');
            //print_r($modelСhildNew);
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireOneNew->getErrors());
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireTwoNew->getErrors());
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireThreeNew->getErrors());
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireFourNew->getErrors());
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireFiveNew->getErrors());
            //print_r('<br><br>');
            //print_r($modelRiskQuestionnaireSixNew->getErrors());
            //print_r('<br><br>');
            //print_r('</pre>');
            //exit();
        }

        return $this->render('/office-child/adding-child', [
            'modelСhild' => $modelСhild,
            'modelRiskQuestionnaireOne' => $modelRiskQuestionnaireOne,
            'modelRiskQuestionnaireTwo' => $modelRiskQuestionnaireTwo,
            'modelRiskQuestionnaireThree' => $modelRiskQuestionnaireThree,
            'modelRiskQuestionnaireFour' => $modelRiskQuestionnaireFour,
            'modelRiskQuestionnaireFive' => $modelRiskQuestionnaireFive,
            'modelRiskQuestionnaireSix' => $modelRiskQuestionnaireSix,
            'modelRiskQuestionnaireSpielberger' => $modelRiskQuestionnaireSpielberger,
            'modelRiskQuestionnaireBassDarck' => $modelRiskQuestionnaireBassDarck,
        ]);
    }

    public function actionUpdateContentQuestionnaire($id)
    {
        $modelRiskQuestionnaireSpielberger = $this->findRiskQuestionnaireSpielbergerId($id);
        $modelRiskQuestionnaireBassDarck = $this->findRiskQuestionnaireBassDarckId($id);
        $modelСhild = $this->findRiskChildrenListId($id);

        $modelRiskQuestionnaireOne = $this->findRiskQuestionnaireOneId($id);
        $modelRiskQuestionnaireTwo = $this->findRiskQuestionnaireTwoId($id);
        $modelRiskQuestionnaireThree = $this->findRiskQuestionnaireThreeId($id);
        $modelRiskQuestionnaireFour = $this->findRiskQuestionnaireFourId($id);
        $modelRiskQuestionnaireFive = $this->findRiskQuestionnaireFiveId($id);
        $modelRiskQuestionnaireSix = $this->findRiskQuestionnaireSixId($id);

        if (Yii::$app->request->post()) {
            $postChildrenList = Yii::$app->request->post()['RiskChildrenList'];
            $postQuestionnaireOne = Yii::$app->request->post()['RiskQuestionnaireOne'];
            $postRiskQuestionnaireTwo = Yii::$app->request->post()['RiskQuestionnaireTwo'];
            $postRiskQuestionnaireThree = Yii::$app->request->post()['RiskQuestionnaireThree'];
            $postRiskQuestionnaireFour = Yii::$app->request->post()['RiskQuestionnaireFour'];
            $postRiskQuestionnaireFive = Yii::$app->request->post()['RiskQuestionnaireFive'];
            $postRiskQuestionnaireSix = Yii::$app->request->post()['RiskQuestionnaireSix'];

            //print_r(Yii::$app->request->post());

            $modelСhild->load(Yii::$app->request->post());
            $modelСhild->testing_date = date("d.m.Y", strtotime($modelСhild->testing_date));
            $modelRiskQuestionnaireOne->load(Yii::$app->request->post());
            $modelRiskQuestionnaireTwo->load(Yii::$app->request->post());
            $modelRiskQuestionnaireThree->load(Yii::$app->request->post());
            $modelRiskQuestionnaireFour->load(Yii::$app->request->post());
            $modelRiskQuestionnaireFive->load(Yii::$app->request->post());
            $modelRiskQuestionnaireSix->load(Yii::$app->request->post());
            $modelRiskQuestionnaireSpielberger->load(Yii::$app->request->post());


            if ($modelСhild->save()) {
                $modelRiskQuestionnaireOne->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireOne->estimation = round($modelRiskQuestionnaireOne->scoringScores($modelRiskQuestionnaireOne), 2);
                $modelRiskQuestionnaireOne->estimation_teacher = round($modelRiskQuestionnaireOne->scoringScores_teacher($modelRiskQuestionnaireOne), 2);
                $modelRiskQuestionnaireOne->estimation_parent = round($modelRiskQuestionnaireOne->scoringScores_parent($modelRiskQuestionnaireOne), 2);

                $modelRiskQuestionnaireTwo->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireTwo->estimation = round($modelRiskQuestionnaireTwo->scoringScores($modelRiskQuestionnaireTwo), 2);
                $modelRiskQuestionnaireTwo->estimation_teacher = round($modelRiskQuestionnaireTwo->scoringScores_teacher($modelRiskQuestionnaireTwo), 2);
                $modelRiskQuestionnaireTwo->estimation_parent = round($modelRiskQuestionnaireTwo->scoringScores_parent($modelRiskQuestionnaireTwo), 2);
                $modelRiskQuestionnaireTwo->estimation_chile = round($modelRiskQuestionnaireTwo->scoringScores_chile($modelRiskQuestionnaireTwo), 2);

                $modelRiskQuestionnaireThree->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireThree->estimation = round($modelRiskQuestionnaireThree->scoringScores($modelRiskQuestionnaireThree), 2);
                $modelRiskQuestionnaireThree->estimation_teacher = round($modelRiskQuestionnaireThree->scoringScores_teacher($modelRiskQuestionnaireThree), 2);
                $modelRiskQuestionnaireThree->estimation_parent = round($modelRiskQuestionnaireThree->scoringScores_parent($modelRiskQuestionnaireThree), 2);

                $modelRiskQuestionnaireFour->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireFour->estimation = round($modelRiskQuestionnaireFour->scoringScores($modelRiskQuestionnaireFour), 2);
                $modelRiskQuestionnaireFour->estimation_chile = round($modelRiskQuestionnaireFour->scoringScores_chile($modelRiskQuestionnaireFour), 2);
                $modelRiskQuestionnaireFour->estimation_parent = round($modelRiskQuestionnaireFour->scoringScores_parent($modelRiskQuestionnaireFour), 2);

                $modelRiskQuestionnaireFive->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireFive->estimation = round($modelRiskQuestionnaireFive->scoringScores($modelRiskQuestionnaireFive), 2);
                $modelRiskQuestionnaireFive->estimation_teacher = round($modelRiskQuestionnaireFive->scoringScores_teacher($modelRiskQuestionnaireFive), 2);
                $modelRiskQuestionnaireFive->estimation_parent = round($modelRiskQuestionnaireFive->scoringScores_parent($modelRiskQuestionnaireFive), 2);

                $modelRiskQuestionnaireSix->id_children_list = $modelСhild->id_children_list;
                $modelRiskQuestionnaireSix->estimation = round($modelRiskQuestionnaireSix->scoringScores($modelRiskQuestionnaireSix), 2);
                $modelRiskQuestionnaireSix->estimation_teacher = round($modelRiskQuestionnaireSix->scoringScores_teacher($modelRiskQuestionnaireSix), 2);
                $modelRiskQuestionnaireSix->estimation_parent = round($modelRiskQuestionnaireSix->scoringScores_parent($modelRiskQuestionnaireSix), 2);
                $modelRiskQuestionnaireSix->estimation_chile = round($modelRiskQuestionnaireSix->scoringScores_chile($modelRiskQuestionnaireSix), 2);

                $modelRiskQuestionnaireSpielberger->id_children_list = $modelСhild->id_children_list;
                $arrValue = $modelRiskQuestionnaireSpielberger->scoringScores($modelRiskQuestionnaireSpielberger);
                $modelRiskQuestionnaireSpielberger->rt = $arrValue['RTvalue1'];
                $modelRiskQuestionnaireSpielberger->lt = $arrValue['LTvalue2'];

                $modelRiskQuestionnaireBassDarck->id_children_list = $modelСhild->id_children_list;
                $arrValueBassDarck = $modelRiskQuestionnaireBassDarck->scoringScores($modelRiskQuestionnaireBassDarck);

                $modelRiskQuestionnaireBassDarck['physical_aggression_1'] = $arrValueBassDarck['physical_aggression_1'];
                $modelRiskQuestionnaireBassDarck['indirect_aggression_2'] = $arrValueBassDarck['indirect_aggression_2'];
                $modelRiskQuestionnaireBassDarck['irritation_3'] = $arrValueBassDarck['irritation_3'];
                $modelRiskQuestionnaireBassDarck['negativism_4'] = $arrValueBassDarck['negativism_4'];
                $modelRiskQuestionnaireBassDarck['resentment_5'] = $arrValueBassDarck['resentment_5'];
                $modelRiskQuestionnaireBassDarck['suspicion_6'] = $arrValueBassDarck['suspicion_6'];
                $modelRiskQuestionnaireBassDarck['verbal_aggression_7'] = $arrValueBassDarck['verbal_aggression_7'];
                $modelRiskQuestionnaireBassDarck['feeling_guilty_8'] = $arrValueBassDarck['feeling_guilty_8'];
                $modelRiskQuestionnaireBassDarck['result_aggressiveness'] = $arrValueBassDarck['result_aggressiveness'];
                $modelRiskQuestionnaireBassDarck['result_hostility'] = $arrValueBassDarck['result_hostility'];
                $modelRiskQuestionnaireBassDarck->aggressiveness_index = $arrValueBassDarck['aggressiveness_index'];
                $modelRiskQuestionnaireBassDarck->includes_index = $arrValueBassDarck['includes_index'];
                if (
                    $modelRiskQuestionnaireOne->save() &&
                    $modelRiskQuestionnaireTwo->save() &&
                    $modelRiskQuestionnaireThree->save() &&
                    $modelRiskQuestionnaireFour->save() &&
                    $modelRiskQuestionnaireFive->save() &&
                    $modelRiskQuestionnaireSix->save() &&
                    $modelRiskQuestionnaireBassDarck->save() &&
                    $modelRiskQuestionnaireSpielberger->save()
                ) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['view-common-risk', 'key' => $modelСhild->key]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ваша оценка НЕ принта');

                //print_r($modelСhildNew->getErrors());
            }

            //print_r('<pre>');
            //print_r('<br><br>');
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireOneNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireTwoNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireThreeNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireFourNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireFiveNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireSixNew);
            //print_r('<br><br>-----------<br><br>');
            //print_r($modelRiskQuestionnaireOneNew['estimation']);
            ////print_r($modelСhild);
            ////print_r('<br><br>');
            ////print_r($modelRiskQuestionnaireOne);
            ////print_r('<br><br>');
            //print_r('</pre>');
            //exit();
        }

        return $this->render('/office-child/adding-child', [
            'modelСhild' => $modelСhild,
            'modelRiskQuestionnaireOne' => $modelRiskQuestionnaireOne,
            'modelRiskQuestionnaireTwo' => $modelRiskQuestionnaireTwo,
            'modelRiskQuestionnaireThree' => $modelRiskQuestionnaireThree,
            'modelRiskQuestionnaireFour' => $modelRiskQuestionnaireFour,
            'modelRiskQuestionnaireFive' => $modelRiskQuestionnaireFive,
            'modelRiskQuestionnaireSix' => $modelRiskQuestionnaireSix,
            'modelRiskQuestionnaireSpielberger' => $modelRiskQuestionnaireSpielberger,
            'modelRiskQuestionnaireBassDarck' => $modelRiskQuestionnaireBassDarck,
        ]);
    }

    public function actionPrintContentQuestionnaire($id)
    {
        $modelСhild = $this->findRiskChildrenListId($id);

        $modelRiskQuestionnaireOne = $this->findRiskQuestionnaireOneId($id);
        $modelRiskQuestionnaireTwo = $this->findRiskQuestionnaireTwoId($id);
        $modelRiskQuestionnaireThree = $this->findRiskQuestionnaireThreeId($id);
        $modelRiskQuestionnaireFour = $this->findRiskQuestionnaireFourId($id);
        $modelRiskQuestionnaireFive = $this->findRiskQuestionnaireFiveId($id);
        $modelRiskQuestionnaireSix = $this->findRiskQuestionnaireSixId($id);
        $modelRiskQuestionnaireSpielberger = $this->findRiskQuestionnaireSpielbergerId($id);
        $modelRiskQuestionnaireBassDarck = $this->findRiskQuestionnaireBassDarckId($id);
        $this->layout = false;
        $html = '
            <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>
        ';
        $html .= '</b><h5>Ваш Ключ - ' . $modelСhild->key . '<br>';
        $html .= '<b>Контингент:</b> ' . Yii::$app->riskComponent->trainingClass($modelСhild->class_individual) . '<br>';
        $html .= '<b>Класс:</b> ' . Yii::$app->riskComponent->trainingClassIndividualName($modelСhild->class) . Yii::$app->riskComponent->trainingClassLetter($modelСhild->class_letter) . '<br>';
        $html .= '<b>Дата тестирования:</b> ' . $modelСhild->testing_date . '<br>';
        $html .= '<b>Идентификатор ученика:</b> ' . $modelСhild->name_responsible_person_individual . '</h5>';
        $html .= '<h5 align="center">Оценка уровня реактивной и личностной тревожности (по Ч.Д. Спилбергеру, ЮЛ. Ханину):</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -60px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы </th>
            </tr>
        ';
        $html .= '
            <tr><td>1. Я спокоен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_1) . '</td></tr> 
            <tr><td>2. Мне ничто не угрожает: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_2) . '</td></tr> 
            <tr><td>3. Я нахожусь в напряжении: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_3) . '</td></tr> 
            <tr><td>4. Я испытываю сожаление: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_4) . '</td></tr> 
            <tr><td>5. Я чувствую себя свободно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_5) . '</td></tr> 
            <tr><td>6. Я расстроен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_6) . '</td></tr> 
            <tr><td>7. Меня волнуют возможные неудачи: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_7) . '</td></tr> 
            <tr><td>8. Я чувствую себя отдохнувшим: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_8) . '</td></tr> 
            <tr><td>9. Я не доволен собой: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_9) . '</td></tr> 
            <tr><td>10. Я испытываю чувство внутреннего удовлетворения: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_10) . '</td></tr> 
            <tr><td>11. Я уверен в себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_11) . '</td></tr> 
            <tr><td>12. Я нервничаю: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_12) . '</td></tr> 
            <tr><td>13. Я не нахожу себе места: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_13) . '</td></tr> 
            <tr><td>14. Я взвинчен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_14) . '</td></tr> 
            <tr><td>15. Я не чувствую скованности, напряженности: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_15) . '</td></tr> 
            <tr><td>16. Я доволен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_16) . '</td></tr> 
            <tr><td>17. Я озабочен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_17) . '</td></tr> 
            <tr><td>18. Я слишком возбужден и мне не по себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_18) . '</td></tr> 
            <tr><td>19. Мне радостно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_19) . '</td></tr> 
            <tr><td>20. Мне приятно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_20) . '</td></tr> 
            <tr><td>21. Я испытываю удовольствие: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_21) . '</td></tr> 
            <tr><td>22. Я очень быстро устаю: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_22) . '</td></tr> 
            <tr><td>23. Я легко могу заплакать: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_23) . '</td></tr> 
            <tr><td>24. Я хотел бы быть таким же счастливым, как и другие: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_24) . '</td></tr> 
            <tr><td>25. Я проигрываю потому, что недостаточно быстро принимаю решения: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_25) . '</td></tr> 
            <tr><td>26. Обычно я чувствую себя бодрым: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_26) . '</td></tr> 
            <tr><td>27. Я спокоен, хладнокровен и собран: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_27) . '</td></tr> 
            <tr><td>28. Ожидаемые трудности обычно тревожат меня: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_28) . '</td></tr> 
            <tr><td>29. Я слишком переживаю из-за пустяков: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_29) . '</td></tr> 
            <tr><td>30. Я вполне счастлив: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_30) . '</td></tr> 
            <tr><td>31. Я принимаю все слишком близко к сердцу: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_31) . '</td></tr> 
            <tr><td>32. Мне не хватает уверенности в себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_32) . '</td></tr> 
            <tr><td>33. Обычно я чувствую себя в безопасности: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_33) . '</td></tr> 
            <tr><td>34. Я стараюсь избегать критических ситуаций: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_34) . '</td></tr> 
            <tr><td>35. У меня бывает хандра: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_35) . '</td></tr> 
            <tr><td>36. Я доволен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_36) . '</td></tr> 
            <tr><td>37. Всякие пустяки отвлекают и волнуют меня: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_37) . '</td></tr> 
            <tr><td>38. Я так сильно переживаю свои разочарования, что потом долго не могу о них забыть: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_38) . '</td></tr> 
            <tr><td>39. Я уравновешенный человек: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_39) . '</td></tr> 
            <tr><td>40. Меня охватывает сильное беспокойство, когда я думаю о своих делах и заботах:</td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_40) . '</td></tr>
        ';
        $html .= '
            <tr>
                <th colspan="2">Обработка и интерпретация результатов:</th>
            </tr> 
            <tr>
                <th>Показатель РТ (реактивная тревожность)</th>
                <th align="center">- ' . $modelRiskQuestionnaireSpielberger->rt . ' (' . Yii::$app->riskComponent->interpretation($modelRiskQuestionnaireSpielberger->rt) . ')</th>
            </tr> 
            <tr>
                <th>Показатель ЛТ (личностная тревожность)</th>
                <th align="center">- ' . $modelRiskQuestionnaireSpielberger->lt . ' (' . Yii::$app->riskComponent->interpretation($modelRiskQuestionnaireSpielberger->lt) . ')</th>
            </tr> 
        ';
        $html .= '</table>';
        $html .= '<h5 align="center">Опросник на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учителей, родителей (законных представителей), особенно при коротких сроках выполнения:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">ИТОГ</th>
            </tr>
        ';
        $arrName = [
            ['1. Учащение дыхания', 'field_1_teacher', 'field_1_parent',],
            ['2. Учащение пульса', 'field_2_teacher', 'field_2_parent',],
            ['3. Повышенная потливость', 'field_3_teacher', 'field_3_parent',],
            ['4. Покраснение отдельных участков кожных покровов', 'field_4_teacher', 'field_4_parent',],
            ['5. Нервные тики', 'field_5_teacher', 'field_5_parent',],
            ['6. Навязчивые не контролируемыми повторяющимися движениями (ребёнок постоянно крутит что-то в руках, теребит волосы, грызёт ручку, ногти и т.д.)', 'field_6_teacher', 'field_6_parent',],
            ['7. Иные проявления беспокойства и нервозности', 'field_7_teacher', 'field_7_parent',],
        ];
        $strItogTab1 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireOne[$arrName[$i][1]] === '2' || $modelRiskQuestionnaireOne[$arrName[$i][1]] === '3') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireOne[$arrName[$i][2]] === '2' || $modelRiskQuestionnaireOne[$arrName[$i][2]] === '3') ? 1 : 0;
            $strStroka = ($aa1 * 7.14) + ($aa2 * 7.14);
            $strItogTab1 = $strItogTab1 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    <th  align="center" >' . $modelRiskQuestionnaireOne['estimation_teacher'] . '' . $modelСhild->percentage_of_number($strItogTab1, $modelRiskQuestionnaireOne['estimation_teacher']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireOne['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab1, $modelRiskQuestionnaireOne['estimation_parent']) . '</th>
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor($strItogTab1) . ';">' . $strItogTab1 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor($modelRiskQuestionnaireOne->estimation) . ';">' . $modelRiskQuestionnaireOne->estimation . '</span>; ' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireOne->estimation) . ';</div>';
        $html .= '<h5 align="center">Опросник индикации возможных причин тревожности:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
                 <th class="text-center">ИТОГО</th>
            </tr>
        ';

        $arrName = [
            ['1. Завышенные требования учителей, не адекватные возможностям', 'field_1_teacher', 'field_1_parent', 'field_1_chile',],
            ['2. Завышенные требования родителей, не адекватные возможностям', 'field_2_teacher', 'field_2_parent', 'field_2_chile',],
            ['3. Грубость и приказной тон в общении со стороны учителей', 'field_3_teacher', 'field_3_parent', 'field_3_chile',],
            ['4. Грубость и приказной тон в общении со родителей (законных представителей)', 'field_4_teacher', 'field_4_parent', 'field_4_chile',],
            ['5. Грубость и приказной тон в общении со сверстниками', 'field_5_teacher', 'field_5_parent', 'field_5_chile',],
            ['6. Противоречивость предъявляемых к ребенку требований со стороны учителей', 'field_6_teacher', 'field_6_parent', 'field_6_chile',],
            ['7. Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей)', 'field_7_teacher', 'field_7_parent', 'field_7_chile',],
            ['8. Иные причины', 'field_8_teacher', 'field_8_parent', 'field_8_chile',],
        ];
        $strItogTab2 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireTwo[$arrName[$i][1]] !== '' && $modelRiskQuestionnaireTwo[$arrName[$i][1]] !== '0') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireTwo[$arrName[$i][2]] !== '' && $modelRiskQuestionnaireTwo[$arrName[$i][2]] !== '0') ? 1 : 0;
            $aa3 = ($modelRiskQuestionnaireTwo[$arrName[$i][3]] !== '' && $modelRiskQuestionnaireTwo[$arrName[$i][3]] !== '0') ? 1 : 0;
            $strStroka = ($aa1 * 4.16) + ($aa2 * 4.16) + ($aa3 * 4.16);
            $strItogTab2 = $strItogTab2 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo[$arrName[$i][3]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    
                    <th  align="center" >' . $modelRiskQuestionnaireTwo['estimation_teacher'] . '' . $modelСhild->percentage_of_number($strItogTab2, $modelRiskQuestionnaireTwo['estimation_teacher']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireTwo['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab2, $modelRiskQuestionnaireTwo['estimation_parent']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireTwo['estimation_chile'] . '' . $modelСhild->percentage_of_number($strItogTab2, $modelRiskQuestionnaireTwo['estimation_chile']) . '</th>
                    
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor($strItogTab2) . ';">' . $strItogTab2 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor($modelRiskQuestionnaireTwo->estimation) . ';">' . $modelRiskQuestionnaireTwo->estimation . '</span>; ' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireTwo->estimation) . ';</div>';


        $html .= '<h5 align="center">Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя):</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы респондента</th>
                 <th class="text-center">ИТОГ</th>
            </tr>
        ';

        $arrName = [
            ['1. Учителя преимущественно обращается к ребенку по имени ', 'field_1_teacher', 'field_1_parent',],
            ['2. Учителя объясняет новый материал на понятных примерах ', 'field_2_teacher', 'field_2_parent',],
            ['3. При объяснении нового материала ученик как правило испытывает интерес к процессу освоения новых знаний ', 'field_3_teacher', 'field_3_parent',],
            ['4. Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения ', 'field_4_teacher', 'field_4_parent',],
            ['5. При опросе ребенка учителя, как правило, не спрашивают его первым ', 'field_5_teacher', 'field_5_parent',],
            ['6. Учителя регулярно хвалят ребенка при всех, даже за небольшие успехи ', 'field_6_teacher', 'field_6_parent',],
            ['7. Учителя как правило, не акцентирует внимание коллектива на слабых сторонах ребенка ', 'field_7_teacher', 'field_7_parent',],
        ];
        $strItogTab3 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireThree[$arrName[$i][1]] !== '' && $modelRiskQuestionnaireThree[$arrName[$i][1]] !== '0') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireThree[$arrName[$i][2]] !== '' && $modelRiskQuestionnaireThree[$arrName[$i][2]] !== '0') ? 1 : 0;
            $strStroka = ($aa1 * 3.57) + ($aa2 * 3.57);
            $strItogTab3 = $strItogTab3 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    <th  align="center" >' . $modelRiskQuestionnaireThree['estimation_teacher'] . '' . $modelСhild->percentage_of_number($strItogTab3, $modelRiskQuestionnaireThree['estimation_teacher']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireThree['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab3, $modelRiskQuestionnaireThree['estimation_parent']) . '</th>
                  
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor50($strItogTab3) . ';">' . $strItogTab3 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor50($modelRiskQuestionnaireThree->estimation) . ';">' . $modelRiskQuestionnaireThree->estimation . '</span>; ' . $modelСhild->scoringDescriptionText50($modelRiskQuestionnaireThree->estimation) . ';</div>';


        $html .= '<br><h5 align="center">Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
                 <th class="text-center">ИТОГ</th>
            </tr>
        ';

        $arrName = [
            ['1. Родители как правило не повышают голос на ребенка при общении с ним ', 'field_1_parent', 'field_1_chile',],
            ['2. Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах ', 'field_2_parent', 'field_2_chile',],
            ['3. Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают ', 'field_3_parent', 'field_3_chile',],
            ['4. Родители всегда корректно отзываются об учителях, не давая им негативных оценок ', 'field_4_parent', 'field_4_chile',],
            ['5. Родители не запрещают без всяких причин делать то, что разрешалось делать раньше ', 'field_5_parent', 'field_5_chile',],
            ['6. Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации ', 'field_6_parent', 'field_6_chile',],
            ['7. У ребенка есть любимое занятие по душе ', 'field_7_parent', 'field_7_chile',],
            ['8. Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься ', 'field_8_parent', 'field_8_chile',],
            ['9. Родители владеют навыками игр и упражнений для снятия тревожности ', 'field_9_parent', 'field_9_chile',],
            ['10. Родители умеют спокойно справляться с повышенной тревожностью ребенка ', 'field_10_parent', 'field_10_chile',],

        ];
        $strItogTab4 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireFour[$arrName[$i][1]] !== '' && $modelRiskQuestionnaireFour[$arrName[$i][1]] !== '0') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireFour[$arrName[$i][2]] !== '' && $modelRiskQuestionnaireFour[$arrName[$i][2]] !== '0') ? 1 : 0;
            $strStroka = ($aa1 * 2.5) + ($aa2 * 2.5);
            $strItogTab4 = $strItogTab4 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    
                    <th  align="center" >' . $modelRiskQuestionnaireFour['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab4, $modelRiskQuestionnaireFour['estimation_parent']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireFour['estimation_chile'] . '' . $modelСhild->percentage_of_number($strItogTab4, $modelRiskQuestionnaireFour['estimation_chile']) . '</th>
                  
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor50($strItogTab4) . ';">' . $strItogTab4 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor50($modelRiskQuestionnaireFour->estimation) . ';">' . $modelRiskQuestionnaireFour->estimation . '</span>; ' . $modelСhild->scoringDescriptionText50($modelRiskQuestionnaireFour->estimation) . ';</div> ';


        $html .= '<br><h5 align="center">Опросник формы проявления агрессии у ребенка:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">ИТОГ</th>
            </tr>
        ';

        $arrName = [
            ['1. Физическая агрессия к сверстникам (стремление причинить вред с помощью силы)', 'field_1_teacher', 'field_1_parent',],
            ['2. Физическая агрессия к учителям', 'field_2_teacher', 'field_2_parent',],
            ['3. Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам', 'field_3_teacher', 'field_3_parent',],
            ['4. Вербальная агрессия к сверстникам (через угрозы и оскорбления)', 'field_4_teacher', 'field_4_parent',],
            ['5. Вербальная агрессия к учителям', 'field_5_teacher', 'field_5_parent',],
            ['6. Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам', 'field_6_teacher', 'field_6_parent',],
            ['7. Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей', 'field_7_teacher', 'field_7_parent',],
        ];
        $strItogTab5 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireFive[$arrName[$i][1]] === '1') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireFive[$arrName[$i][2]] === '1') ? 1 : 0;
            $aa12 = ($modelRiskQuestionnaireFive[$arrName[$i][1]] === '2') ? 1 : 0;
            $aa22 = ($modelRiskQuestionnaireFive[$arrName[$i][2]] === '2') ? 1 : 0;
            $strStroka = ($aa1 * 7.14) + ($aa2 * 7.14) + ($aa12 * 3.57) + ($aa22 * 3.57);
            $strItogTab5 = $strItogTab5 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    <th  align="center" >' . $modelRiskQuestionnaireFive['estimation_teacher'] . '' . $modelСhild->percentage_of_number($strItogTab5, $modelRiskQuestionnaireFive['estimation_teacher']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireFive['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab5, $modelRiskQuestionnaireFive['estimation_parent']) . '</th>
                  
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor($strItogTab5) . ';">' . $strItogTab5 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor($modelRiskQuestionnaireFive->estimation) . ';">' . $modelRiskQuestionnaireFive->estimation . '</span>; ' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireFive->estimation) . ';</div>';


        $html .= '<br><h5 align="center">Опросник индикации возможных причин агрессивности ребенка:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 14px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
                 <th class="text-center">ИТОГ</th>
            </tr>
        ';

        $arrName = [
            ['1. Агрессивное поведение родителей ', 'field_1_teacher', 'field_1_parent', 'field_1_chile',],
            ['2. Агрессивное поведение учителей', 'field_2_teacher', 'field_2_parent', 'field_2_chile',],
            ['3. Агрессивное поведение сверстников', 'field_3_teacher', 'field_3_parent', 'field_3_chile',],
            ['4. Использование агрессивной информационной среды', 'field_4_teacher', 'field_4_parent', 'field_4_chile',],
            ['5. Использование агрессивной игровой среды ', 'field_5_teacher', 'field_5_parent', 'field_5_chile',],
            ['6. Иные причины ', 'field_6_teacher', 'field_6_parent', 'field_6_chile',],
        ];
        $strItogTab6 = 0;
        for ($i = 0; $i < count($arrName); $i++) {
            $strStroka = 0;
            $aa1 = ($modelRiskQuestionnaireSix[$arrName[$i][1]] === '1') ? 1 : 0;
            $aa2 = ($modelRiskQuestionnaireSix[$arrName[$i][2]] === '1') ? 1 : 0;
            $aa3 = ($modelRiskQuestionnaireSix[$arrName[$i][3]] === '1') ? 1 : 0;
            $aa12 = ($modelRiskQuestionnaireSix[$arrName[$i][1]] === '2') ? 1 : 0;
            $aa22 = ($modelRiskQuestionnaireSix[$arrName[$i][2]] === '2') ? 1 : 0;
            $aa23 = ($modelRiskQuestionnaireSix[$arrName[$i][3]] === '2') ? 1 : 0;
            $strStroka = ($aa1 * 5.55) + ($aa2 * 5.55) + ($aa3 * 5.55) + ($aa12 * 2.77) + ($aa22 * 2.77) + ($aa23 * 2.77);
            $strItogTab6 = $strItogTab6 + $strStroka;

            $html .= '
                <tr>
                    <td>' . $arrName[$i][0] . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix[$arrName[$i][1]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix[$arrName[$i][2]]) . '</td>
                    <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix[$arrName[$i][3]]) . '</td>
                    <td  align="center">' . $strStroka . '</td>
                </tr> 
            ';
        }

        $html .= '
                <tr>
                    <th colspan="1">ИТОГ</th>
                    <th  align="center" >' . $modelRiskQuestionnaireSix['estimation_teacher'] . '' . $modelСhild->percentage_of_number($strItogTab6, $modelRiskQuestionnaireSix['estimation_teacher']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireSix['estimation_parent'] . '' . $modelСhild->percentage_of_number($strItogTab6, $modelRiskQuestionnaireSix['estimation_parent']) . '</th>
                    <th  align="center" >' . $modelRiskQuestionnaireSix['estimation_chile'] . '' . $modelСhild->percentage_of_number($strItogTab6, $modelRiskQuestionnaireSix['estimation_chile']) . '</th>
                  
                    <th  align="center"  style="background: ' . $modelСhild->scoringDescriptionColor($strItogTab6) . ';">' . $strItogTab6 . '</th>
                </tr> 
            ';
        $html .= '</table>';

        $html .= '<h5 align="center">Обработка и интерпретация результатов:</h5>';
        $html .= '<div><b>Оценка</b> - <span style="background: ' . $modelСhild->scoringDescriptionColor($modelRiskQuestionnaireSix->estimation) . ';">' . $modelRiskQuestionnaireSix->estimation . '</span>; ' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireSix->estimation) . ';</div>';

        $html .= '<br><h5 align="center">Опросник агрессивности Басса – Дарки:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; font-size: 13px; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы</th>
            </tr>
        ';

        $html .= '
            <tr><td>1. Временами я не могу справиться с желанием причинить вред другим</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_1) . '</td></tr> 
            <tr><td>2. Иногда сплетничаю о людях, которых не люблю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_2) . '</td></tr> 
            <tr><td>3. Я легко раздражаюсь, но быстро успокаиваюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_3) . '</td></tr> 
            <tr><td>4. Если меня не попросят по-хорошему, я не выполню</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_4) . '</td></tr> 
            <tr><td>5. Я не всегда получаю то, что мне положено</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_5) . '</td></tr> 
            <tr><td>6. Я не знаю, что люди говорят обо мне за моей спиной</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_6) . '</td></tr> 
            <tr><td>7. Если я не одобряю поведение друзей, я даю им это почувствовать</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_7) . '</td></tr> 
            <tr><td>8. Когда мне случалось обмануть кого-нибудь, я испытывал мучительные угрызения совести</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_8) . '</td></tr> 
            <tr><td>9. Мне кажется, что я не способен ударить человека</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_9) . '</td></tr> 
            <tr><td>10. Я никогда не раздражаюсь настолько, чтобы кидаться предметами</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_10) . '</td></tr> 
            <tr><td>11. Я всегда снисходителен к чужим недостаткам</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_11) . '</td></tr> 
            <tr><td>12. Если мне не нравится установленное правило, мне хочется нарушить его</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_12) . '</td></tr> 
            <tr><td>13. Другие умеют почти всегда пользоваться благоприятными обстоятельствами</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_13) . '</td></tr> 
            <tr><td>14. Я держусь настороженно с людьми, которые относятся ко мне несколько более дружественно, чем я ожидал</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_14) . '</td></tr> 
            <tr><td>15. Я часто бываю несогласен с людьми</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_15) . '</td></tr> 
            <tr><td>16. Иногда мне на ум приходят мысли, которых я стыжусь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_16) . '</td></tr> 
            <tr><td>17. Если кто-нибудь первым ударит меня, я не отвечу ему</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_17) . '</td></tr> 
            <tr><td>18. Когда я раздражаюсь, я хлопаю дверями</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_18) . '</td></tr> 
            <tr><td>19. Я гораздо более раздражителен, чем кажется</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_19) . '</td></tr> 
            <tr><td>20. Если кто-то воображает себя начальником, я всегда поступаю ему наперекор</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_20) . '</td></tr> 
            <tr><td>21. Меня немного огорчает моя судьба</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_21) . '</td></tr> 
            <tr><td>22. Я думаю, что многие люди не любят меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_22) . '</td></tr> 
            <tr><td>23. Я не могу удержаться от спора, если люди не согласны со мной</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_23) . '</td></tr> 
            <tr><td>24. Люди, увиливающие от работы, должны испытывать чувство вины</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_24) . '</td></tr> 
            <tr><td>25. Тот, кто оскорбляет меня и мою семью, напрашивается на драку</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_25) . '</td></tr> 
            <tr><td>26. Я не способен на грубые шутки</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_26) . '</td></tr> 
            <tr><td>27. Меня охватывает ярость, когда надо мной насмехаются</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_27) . '</td></tr> 
            <tr><td>28. Когда люди строят из себя начальников, я делаю все, чтобы они не зазнавались</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_28) . '</td></tr> 
            <tr><td>29. Почти каждую неделю я вижу кого-нибудь, кто мне не нравится</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_29) . '</td></tr> 
            <tr><td>30. Довольно многие люди завидуют мне</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_30) . '</td></tr> 
            <tr><td>31. Я требую, чтобы люди уважали меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_31) . '</td></tr> 
            <tr><td>32. Меня угнетает то, что я мало делаю для своих родителей</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_32) . '</td></tr> 
            <tr><td>33. Люди, которые постоянно изводят вас, стоят того, чтобы их "щелкнули по носу"</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_33) . '</td></tr> 
            <tr><td>34. Я никогда не бываю мрачен от злости</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_34) . '</td></tr> 
            <tr><td>35. Если ко мне относятся хуже, чем я того заслуживаю, я не расстраиваюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_35) . '</td></tr> 
            <tr><td>36. Если кто-то выводит меня из себя, я не обращаю внимания</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_36) . '</td></tr> 
            <tr><td>37. Хотя я и не показываю этого, меня иногда гложет зависть</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_37) . '</td></tr> 
            <tr><td>38. Иногда мне кажется, что надо мной смеются</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_38) . '</td></tr> 
            <tr><td>39. Даже если я злюсь, я не прибегаю к "сильным" выражениям</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_39) . '</td></tr> 
            <tr><td>40. Мне хочется, чтобы мои грехи были прощены</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_40) . '</td></tr> 
            <tr><td>41. Я редко даю сдачи, даже если кто-нибудь ударит меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_41) . '</td></tr> 
            <tr><td>42. Когда получается не, по-моему, я иногда обижаюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_42) . '</td></tr> 
            <tr><td>43. Иногда люди раздражают меня одним своим присутствием</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_43) . '</td></tr> 
            <tr><td>44. Нет людей, которых бы я по-настоящему ненавидел</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_44) . '</td></tr> 
            <tr><td>45. Мой принцип: "Никогда не доверять "чужакам"</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_45) . '</td></tr> 
            <tr><td>46. Если кто-нибудь раздражает меня, я готов сказать, что я о нем думаю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_46) . '</td></tr> 
            <tr><td>47. Я делаю много такого, о чем впоследствии жалею</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_47) . '</td></tr> 
            <tr><td>48. Если я разозлюсь, я могу ударить кого-нибудь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_48) . '</td></tr> 
            <tr><td>49. С детства я никогда не проявлял вспышек гнева</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_49) . '</td></tr> 
            <tr><td>50. Я часто чувствую себя как пороховая бочка, готовая взорваться</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_50) . '</td></tr> 
            <tr><td>51. Если бы все знали, что я чувствую, меня бы считали человеком, с которым нелегко работать</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_51) . '</td></tr> 
            <tr><td>52. Я всегда думаю о том, какие тайные причины заставляют людей делать что-нибудь приятное для меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_52) . '</td></tr> 
            <tr><td>53. Когда на меня кричат, я начинаю кричать в ответ</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_53) . '</td></tr> 
            <tr><td>54. Неудачи огорчают меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_54) . '</td></tr> 
            <tr><td>55. Я дерусь не реже и не чаще чем другие</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_55) . '</td></tr> 
            <tr><td>56. Я могу вспомнить случаи, когда я был настолько зол, что хватал попавшуюся мне под руку вещь и ломал ее</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_56) . '</td></tr> 
            <tr><td>57. Иногда я чувствую, что готов первым начать драку</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_57) . '</td></tr> 
            <tr><td>58. Иногда я чувствую, что жизнь поступает со мной несправедливо</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_58) . '</td></tr> 
            <tr><td>59. Раньше я думал, что большинство людей говорит правду, но теперь я в это не верю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_59) . '</td></tr> 
            <tr><td>60. Я ругаюсь только со злости</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_60) . '</td></tr> 
            <tr><td>61. Когда я поступаю неправильно, меня мучает совесть</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_61) . '</td></tr> 
            <tr><td>62. Если для защиты своих прав мне нужно применить физическую силу, я применяю ее</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_62) . '</td></tr> 
            <tr><td>63. Иногда я выражаю свой гнев тем, что стучу кулаком по столу</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_63) . '</td></tr> 
            <tr><td>64. Я бываю грубоват по отношению к людям, которые мне не нравятся</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_64) . '</td></tr> 
            <tr><td>65. У меня нет врагов, которые бы хотели мне навредить</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_65) . '</td></tr> 
            <tr><td>66. Я не умею поставить человека на место, даже если он того заслуживает</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_66) . '</td></tr> 
            <tr><td>67. Я часто думаю, что жил неправильно</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_67) . '</td></tr> 
            <tr><td>68. Я знаю людей, которые способны довести меня до драки</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_68) . '</td></tr> 
            <tr><td>69. Я не огорчаюсь из-за мелочей</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_69) . '</td></tr> 
            <tr><td>70. Мне редко приходит в голову, что люди пытаются разозлить или оскорбить меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_70) . '</td></tr> 
            <tr><td>71. Я часто только угрожаю людям, хотя и не собираюсь приводить угрозы в исполнение</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_71) . '</td></tr> 
            <tr><td>72. В последнее время я стал занудой</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_72) . '</td></tr> 
            <tr><td>73. В споре я часто повышаю голос</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_73) . '</td></tr> 
            <tr><td>74. Я стараюсь обычно скрывать свое плохое отношение к людям</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_74) . '</td></tr> 
            <tr><td>75. Я лучше соглашусь с чем-либо, чем стану спорить</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_75) . '</td></tr> 
       
            <tr>
                <th colspan="2">Оценка</th>
            </tr> 
            <tr><td>Физическая агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->physical_aggression_1 . '</th></tr>
            <tr><td>Косвенная агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->indirect_aggression_2 . '</th></tr>
            <tr><td>Раздражение:</td><th>' . $modelRiskQuestionnaireBassDarck->irritation_3 . '</th></tr>
            <tr><td>Негативизм:</td><th>' . $modelRiskQuestionnaireBassDarck->negativism_4 . '</th></tr>
            <tr><td>Обида:</td><th>' . $modelRiskQuestionnaireBassDarck->resentment_5 . '</th></tr>
            <tr><td>Подозрительность:</td><th>' . $modelRiskQuestionnaireBassDarck->suspicion_6 . '</th></tr>
            <tr><td>Вербальная агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->verbal_aggression_7 . '</th></tr>
            <tr><td>Чувство вины:</td><th>' . $modelRiskQuestionnaireBassDarck->feeling_guilty_8 . '</th></tr>
            <tr><td><b>Индекс агрессивности:</b></td><th>' . $modelRiskQuestionnaireBassDarck->aggressiveness_index . '</th></tr>
            <tr><td><b>Индекс враждебности:</b></td><th>' . $modelRiskQuestionnaireBassDarck->includes_index . '</th></tr>
        ';
        $html .= '</table>';

        $html2 = '<h3 align="center">Результаты оценки уровня тревожности и агрессии у респондента</h3>';

        $html2 .= '<b>Контингент:</b> ' . Yii::$app->riskComponent->trainingClass($modelСhild->class_individual) . '<br>';
        $html2 .= '<b>Класс:</b> ' . Yii::$app->riskComponent->trainingClassIndividualName($modelСhild->class) . Yii::$app->riskComponent->trainingClassLetter($modelСhild->class_letter) . '</h5>';
        $html2 .= '<b>Дата тестирования:</b> ' . $modelСhild->testing_date . '</h5>';
        $html2 .= '<b>Идентификатор ученика:</b> ' . $modelСhild->name_responsible_person_individual . '</h5>';


        $html2 .= '
            <div align="center"  style="margin-top: -5px;"><b>Заключение</b></div>
        ';
        $html2 .= '<div style="margin-top: 0px;">';
        $str = $modelСhild->finalAssessmentText($strItogTab5, $strItogTab6, $strItogTab4);
        $str2 = ($str === 'ОТРИЦАТЕЛЬНО') ? ', требуется корректировка реализуемых мер профилактики.' : '.';
        $html2 .= 'Организация работы по профилактики повышенной тревожности и агрессии, в отношении респондента, расценивается – <b><span style="color: #0b72b8; font-weight: bold">' . $str . '</span></b>' . $str2 . '<br>';
        //interpretationArr
        $html2 .= '<div style="text-align:justify; ">';
        $html2 .= 'Уровень тревожности по Ч.Д. Спилбергеру, ЮЛ. Ханину - 
         <span style="color: #0b72b8; font-weight: bold">' .
            Yii::$app->riskComponent->interpretationArr($modelRiskQuestionnaireSpielberger->rt, $modelRiskQuestionnaireSpielberger->lt) . '</span>
         (РТ - <span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireSpielberger->rt . ' </span>баллов
         ЛТ - <span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireSpielberger->lt . '</span> баллов);
         <b>оценка симптомов беспокойства и нервозности соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec($modelRiskQuestionnaireOne->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireOne->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireOne->estimation) . '</span>;
            
         <b>оценка индикации возможных причин тревожности соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec($modelRiskQuestionnaireTwo->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireTwo->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText($modelRiskQuestionnaireTwo->estimation) . '</span>;
                  
         <b>оценка профилактики, реализуемых в отношении ребенка со стороны учителей (классного руководителя) соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec50($modelRiskQuestionnaireThree->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireThree->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText50($modelRiskQuestionnaireThree->estimation) . '</span>;
                 
         <b>оценка профилактики, реализуемых в отношении ребенка со стороны родителей - законных представителей соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec50($modelRiskQuestionnaireFour->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireFour->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText50($modelRiskQuestionnaireFour->estimation) . '</span>;
                  
         <b>оценка индикации форм проявления агрессии у ребенка соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec($modelRiskQuestionnaireFive->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireFive->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText2($modelRiskQuestionnaireFive->estimation) . '</span>;
               
         <b>оценка индикации возможных причин агрессивности ребенка соответствует диапазону </b>
         <span> 
         ' . $modelСhild->scoringDescriptionTextDec($modelRiskQuestionnaireSix->estimation) . '</span> балла
         (<span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireSix->estimation . '</span> балла) - 
         <span style="color: #0b72b8; font-weight: bold">' . $modelСhild->scoringDescriptionText2($modelRiskQuestionnaireSix->estimation) . '</span>;
               
         <b>оценка агрессивности и враждебности по опроснику Басса-Дарки соответствует значениям,  </b>
         <span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireBassDarck->aggressiveness_index . '</span> (индекс агрессивности)
         <span style="color: #0b72b8; font-weight: bold">' . $modelRiskQuestionnaireBassDarck->includes_index . '</span> (индекс враждебности).
         
         ';
        $html2 .= '</div>';
        $html2 .= '<br><br><br><h5 align="center"><i>Данное заключение сформировано в ПС, в проекте «Сибирская школа территория здоровья»</i></h5>';

        /* $html2 .= '<br><b>Оценка включает в себя следующие сведения:</b><br>';

        $html2 .= '<div style="margin-left: 25px;"><i>1. Результаты «Оценка уровня реактивной и личностной тревожности (по Ч.Д. Спилбергеру, ЮЛ. Ханину)»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Показатель РТ (реактивная тревожность): <b>'.$modelRiskQuestionnaireSpielberger->rt.' ('.Yii::$app->riskComponent->interpretation($modelRiskQuestionnaireSpielberger->rt).')</b></div>';
        $html2 .= '<div style="margin-left: 45px;">Показатель ЛТ (личностная тревожность): <b>'.$modelRiskQuestionnaireSpielberger->lt.' ('.Yii::$app->riskComponent->interpretation($modelRiskQuestionnaireSpielberger->lt).')</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>2. Результаты «Опросник на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учителей, родителей (законных представителей), особенно при коротких сроках выполнения»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor($modelRiskQuestionnaireOne->estimation). ';">'.$modelRiskQuestionnaireOne->estimation.'</span>; ' .$modelСhild->scoringDescriptionText($modelRiskQuestionnaireOne->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>3. Результаты «Опросник индикации возможных причин тревожности»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor($modelRiskQuestionnaireTwo->estimation). ';">'.$modelRiskQuestionnaireTwo->estimation.'</span>; ' .$modelСhild->scoringDescriptionText($modelRiskQuestionnaireTwo->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>4. Результаты «Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя)»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor50($modelRiskQuestionnaireThree->estimation). ';">'.$modelRiskQuestionnaireThree->estimation.'</span>; ' .$modelСhild->scoringDescriptionText50($modelRiskQuestionnaireThree->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>5. Результаты «Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor50($modelRiskQuestionnaireFour->estimation). ';">'.$modelRiskQuestionnaireFour->estimation.'</span>; ' .$modelСhild->scoringDescriptionText50($modelRiskQuestionnaireFour->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>6. Результаты «Опросник формы проявления агрессии у ребенка»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor($modelRiskQuestionnaireFive->estimation). ';">'.$modelRiskQuestionnaireFive->estimation.'</span>; ' .$modelСhild->scoringDescriptionText($modelRiskQuestionnaireFive->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>7. Результаты «Опросник индикации возможных причин агрессивности ребенка»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Общая оценка по опроснику: <b><span style="color: ' .$modelСhild->scoringDescriptionColor($modelRiskQuestionnaireSix->estimation). ';">'.$modelRiskQuestionnaireSix->estimation.'</span>; ' .$modelСhild->scoringDescriptionText($modelRiskQuestionnaireSix->estimation). ';</b></div>';

        $html2 .= '<div style="margin-left: 25px;"><i>8. Результаты «Опросник агрессивности Басса – Дарки»:</i></div>';
        $html2 .= '<div style="margin-left: 45px;">Индекс агрессивности: <b>'.$modelRiskQuestionnaireBassDarck->aggressiveness_index.'</b></div>';
        $html2 .= '<div style="margin-left: 45px;">Индекс враждебности: <b>'.$modelRiskQuestionnaireBassDarck->includes_index.' </b></div>';*/


        $html2 .= '</div>';


        $mpdf = new Mpdf([
            'margin_top' => 5,
            'margin_left' => 20,
            'margin_right' => 10,
            //'mirrorMargins' => true
            //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html2);
        $mpdf->Output('Заключение по оценке уровня агрессии.pdf', 'I'); //D - скачает файл!

        //Yii::$app->session->setFlash('error', 'Данных не найдены!');
        //return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionReportCommonRisk($key = 1)
    {
        $model = new RiskAssessmentOrganizationCommon();
        $model->key = 'net';

        $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name'));
        //$region_items = ArrayHelper::merge(['' => 'Выберите регион ...','0'=>'Все'], ArrayHelper::map(Region::find()->where(['district_id' => 1])->all(), 'id', 'name'));
        $region_items = ['0' => 'Все'];

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            //federal_district_id
            //region_id
            $model->federal_district_id = $post['federal_district_id'];
            $model->region_id = $post['region_id'];
            $model->key = $post['key'];
            $where = [];
            $where += ($post['federal_district_id'] != '0') ? ['organization.federal_district_id' => $post['federal_district_id']] : [];
            $where += ($post['region_id'] != '0') ? ['organization.region_id' => $post['region_id']] : [];
            $where2 = [];
            $where2 += ($post['federal_district_id'] != '0') ? ['federal_district_id' => $post['federal_district_id']] : [];
            $where2 += ($post['region_id'] != '0') ? ['region_id' => $post['region_id']] : [];

            $wherefederal_district_id = ($post['federal_district_id'] != '0') ? ['id' => $post['federal_district_id']] : [];
            $whereregion_id = ($post['region_id'] != '0') ? ['id' => $post['region_id']] : [];
            $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->where($wherefederal_district_id)->all(), 'id', 'name'));
            $region_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(Region::find()->where($whereregion_id)->all(), 'id', 'name'));
            $where3 = [];
            if ($key == 2) {
                $where3 = ['in', 'key', ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2']];
            }
            if ($post['key'] == 'da') {
                $rows = (new \yii\db\Query())
                    ->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'risk_assessment_organization_common.federal_district_id AS federal_district_id',
                        'risk_assessment_organization_common.region_id AS region_id',
                        'risk_assessment_organization_common.municipality_id AS municipality_id',
                        'risk_assessment_organization_common.name_responsible_person AS title',
                        'risk_assessment_organization_common.name_responsible_person AS short_title',
                        'risk_assessment_organization_common.class AS class',
                    ])
                    ->from('risk_assessment_organization_common')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where2)
                    ->andWhere($where3)
                    ->orderBy([
                        'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                        'risk_assessment_organization_common.region_id' => SORT_ASC,
                        'risk_assessment_organization_common.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db)->queryAll();
            } else {
                $rows = (new \yii\db\Query())
                    ->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])
                    ->from('risk_assessment_organization_common')
                    ->join('inner JOIN', 'organization', 'organization.id = risk_assessment_organization_common.organization_id')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where)
                    ->orderBy([
                        'organization.federal_district_id' => SORT_ASC,
                        'organization.region_id' => SORT_ASC,
                        'organization.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db_anket)->queryAll();
            }

            //print_r('<pre>');
            //print_r($rows2);
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r($rows);
            //print_r('</pre>');
            //exit();
            //print_r('<pre>');
            //print_r($rows2);
            //print_r('<br><br><br>');
            //print_r('</pre>');
            //exit();
            //print_r('<pre>');
            //print_r($rows[0]['create_at']);
            //print_r('<br><br>');
            //print_r($rows);
            //print_r($post);
            //print_r('<br><br>');

            //print_r($result['result']);

            $arr = [
                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'fieldTheme5_4_5',
                'risk_assessment_1',
                'risk_assessment_2',
                'risk_assessment_3',
                'risk_assessment_4',
                'risk_assessment_5',
                'risk_assessment_g',
                'risk_assessment',
            ];
            $result = [];
            $i = 0;
            foreach ($rows as $row) {
                if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                    $result['result'][$i] = [
                        'federal_district_id' => $row['federal_district_id'],
                        'region_id' => $row['region_id'],
                        'municipality_id' => $row['municipality_id'],
                        'organization_id' => $row['organization_id'],
                        'title' => $row['title'],
                        'short_title' => $row['short_title'],
                        'user_id' => $row['user_id'],
                        'class' => Yii::$app->riskComponent->trainingClass($row['class']),
                        'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                        'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                        'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                        'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                        'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                        'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                        'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                        'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                        'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                        'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                        'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                        'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                        'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                        'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                        'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                        'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_1']),
                        'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_2']),
                        'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_3']),
                        'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_4']),
                        'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_5']),
                        'risk_assessment_1' => $row['risk_assessment_1'],
                        'risk_assessment_2' => $row['risk_assessment_2'],
                        'risk_assessment_3' => $row['risk_assessment_3'],
                        'risk_assessment_4' => $row['risk_assessment_4'],
                        'risk_assessment_5' => $row['risk_assessment_5'],
                        'risk_assessment_g' => $row['risk_assessment_g'],
                        'risk_assessment' => $row['risk_assessment'],
                        'create_at' => $row['create_at'],
                        'name_responsible_person' => $row['name_responsible_person'],
                    ];
                    $i++;
                }
            }
            /*if ($post['key'] == 'da'){
                $rows2 = (new \yii\db\Query())
                    ->from('risk_assessment_organization_common')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where2)
                    ->orderBy([
                        'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                        'risk_assessment_organization_common.region_id' => SORT_ASC,
                        'risk_assessment_organization_common.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db_anket)
                    ->queryAll();

                foreach ($rows2 as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                        $result['result'][$i] = [
                            'federal_district_id' => $row['federal_district_id'],
                            'region_id' => $row['region_id'],
                            'municipality_id' => $row['municipality_id'],
                            'organization_id' => $row['name_responsible_person'],
                            'title' => $row['name_responsible_person'],
                            'short_title' => $row['name_responsible_person'],
                            'user_id' => $row['user_id'],
                            'key' => $row['key'],
                            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_1']),
                            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_2']),
                            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_3']),
                            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_4']),
                            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_5']),
                            'risk_assessment_1' => $row['risk_assessment_1'],
                            'risk_assessment_2' => $row['risk_assessment_2'],
                            'risk_assessment_3' => $row['risk_assessment_3'],
                            'risk_assessment_4' => $row['risk_assessment_4'],
                            'risk_assessment_5' => $row['risk_assessment_5'],
                            'risk_assessment_g' => $row['risk_assessment_g'],
                            'risk_assessment' => $row['risk_assessment'],
                            'create_at' => $row['create_at'],
                            'name_responsible_person' => $row['name_responsible_person'],
                        ];
                        $i++;
                    }
                }
            }*/

            foreach ($result['result'] as $row) {
                $result['region'][$row['region_id']]['count'] += 1;
                $result['okrug'][$row['federal_district_id']]['count'] += 1;
                $result['itog']['count'] += 1;
                //$result['region'][$row['region_id']]['minRisk'] = ((double)$result['region'][$row['region_id']]['minRisk'] < (double)$row['risk_assessment']) ? $result['region'][$row['region_id']]['minRisk'] : $row['risk_assessment'];
                //$result['region'][$row['region_id']]['maxRisk'] = ((double)$result['region'][$row['region_id']]['maxRisk'] < (double)$row['risk_assessment']) ? $result['region'][$row['region_id']]['maxRisk'] : $row['risk_assessment'];
                //$result['region'][$row['region_id']]['minRisk'] = ((double)$result['region'][$row['region_id']]['minRisk'] < (double)$row['risk_assessment_g']) ? $result['region'][$row['region_id']]['minRisk'] : $row['risk_assessment_g'];
                //$result['region'][$row['region_id']]['maxRisk'] = ((double)$result['region'][$row['region_id']]['maxRisk'] < (double)$row['risk_assessment_g']) ? $result['region'][$row['region_id']]['maxRisk'] : $row['risk_assessment_g'];
                foreach ($arr as $key => $one) {
                    $result['region'][$row['region_id']][$one] += $row[$one];
                    $result['okrug'][$row['federal_district_id']][$one] += $row[$one];
                    $result['itog'][$one] += $row[$one];
                    //$result['okrug'][$row['federal_district_id']][$one] += $arr2[$one];
                    //$result['itog'][$one] += $arr2[$one];
                }
            }
            //print_r('<pre>');
            //print_r($result);
            //exit();
            //print_r($rows);
            //print_r('</pre>');
            //exit();
            //print_r('<pre>');
            //print_r($result);
            //print_r('<br><br><br>');
            //print_r('</pre>');

        }


        return $this->render('/risk-common/report-common-risk', [
            'model' => $model,
            'result' => $result,
            'district_items' => $district_items,
            'region_items' => $region_items,
        ]);

    }

    public function actionReportIndividualRisk($key = 1)
    {
        $model = new RiskAssessmentOrganizationCommon();
        $model->key = 'net';
        $modelIndividual = new RiskAssessmentIndividualCommon();

        $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name'));
        //$region_items = ArrayHelper::merge(['' => 'Выберите регион ...','0'=>'Все'], ArrayHelper::map(Region::find()->where(['district_id' => 1])->all(), 'id', 'name'));
        $region_items = ['0' => 'Все'];

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            //federal_district_id
            //region_id
            $model->federal_district_id = $post['federal_district_id'];
            $model->region_id = $post['region_id'];
            $model->key = $post['key'];
            $where = [];
            $where += ($post['federal_district_id'] != '0') ? ['organization.federal_district_id' => $post['federal_district_id']] : [];
            $where += ($post['region_id'] != '0') ? ['organization.region_id' => $post['region_id']] : [];
            $where2 = [];
            $where2 += ($post['federal_district_id'] != '0') ? ['federal_district_id' => $post['federal_district_id']] : [];
            $where2 += ($post['region_id'] != '0') ? ['region_id' => $post['region_id']] : [];
            $where3 = [];
            $where3 += ($post['federal_district_id'] != '0') ? ['risk_assessment_organization_common.federal_district_id' => $post['federal_district_id']] : [];
            $where3 += ($post['region_id'] != '0') ? ['risk_assessment_organization_common.region_id' => $post['region_id']] : [];

            $wherefederal_district_id = ($post['federal_district_id'] != '0') ? ['id' => $post['federal_district_id']] : [];
            $whereregion_id = ($post['region_id'] != '0') ? ['id' => $post['region_id']] : [];
            $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->where($wherefederal_district_id)->all(), 'id', 'name'));
            $region_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(Region::find()->where($whereregion_id)->all(), 'id', 'name'));
            $resultList22 = [];

            $where2223 = [];
            if ($key == 2) {
                $where2223 = ['in', 'risk_assessment_organization_common.key', ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2']];
            }
            if ($post['key'] == 'da') {
                $rows = (new \yii\db\Query())
                    /*->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.year AS year',
                        'risk_assessment_organization_common.class AS class',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])*/
                    ->from('risk_assessment_organization_common')
                    ->join('inner JOIN', 'risk_assessment_individual_common', 'risk_assessment_individual_common.key = risk_assessment_organization_common.key')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where3)
                    ->andWhere($where2223)
                    ->orderBy([
                        'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                        'risk_assessment_organization_common.region_id' => SORT_ASC,
                        'risk_assessment_organization_common.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db)->queryAll();
                foreach ($rows as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {

                        $row['class_individual'] = Yii::$app->riskComponent->trainingClassIndividualDecoding($rows['class_individual']);
                        $item = [
                            '1' => '342',
                            '2' => '342',
                            '3' => '342',
                            '4' => '342',
                            '5' => '486',
                            '6' => '486',
                            '7' => '486',
                            '8' => '486',
                            '9' => '486',
                            '10' => '2819',
                            '11' => '2819',
                        ];
                        $classIndikator = $item[$row['class_individual']];
                        $resultList22['organization'][] = [
                            'class_individual' => $classIndikator,
                            'violation_posture' => Yii::$app->riskComponent->fieldBBBB2($row['violation_posture']),
                            'visual_impairment' => Yii::$app->riskComponent->fieldBBBB2($row['visual_impairment']),
                            'fieldIndividualTheme1_1' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_1']),
                            'fieldIndividualTheme1_2' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_2']),
                            'fieldIndividualTheme1_3' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_3']),
                            'fieldIndividualTheme2_1' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_1']),
                            'fieldIndividualTheme2_2' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_2']),
                            'fieldIndividualTheme2_3' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_3']),
                            'fieldIndividualTheme3_1' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_1']),
                            'fieldIndividualTheme3_2' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_2']),
                            'fieldIndividualTheme4_1' => Yii::$app->riskComponent->fieldTheme41IndividualDecoding($row['fieldIndividualTheme4_1']),
                            'fieldIndividualTheme4_2' => Yii::$app->riskComponent->fieldTheme42IndividualDecoding($row['fieldIndividualTheme4_2']),
                            'fieldIndividualTheme5_1' => Yii::$app->riskComponent->fieldTheme51IndividualDecoding($row['fieldIndividualTheme5_1']),
                            'fieldIndividualTheme5_2' => Yii::$app->riskComponent->fieldTheme52IndividualDecoding($row['fieldIndividualTheme5_2']),
                            'fieldIndividualTheme6_1' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_1']),
                            'fieldIndividualTheme6_2' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_2']),
                            'risk_assessment_individual' => $row['risk_assessment_individual'],
                            'risk_assessment_individual_y' => $row['risk_assessment_individual_y'],
                            'risk_assessment_individual_y_1' => $row['risk_assessment_individual_y_1'],
                            'risk_assessment_individual_y_2' => $row['risk_assessment_individual_y_2'],
                            'risk_assessment_individual_y_3' => $row['risk_assessment_individual_y_3'],
                            'risk_assessment_individual_y_4' => $row['risk_assessment_individual_y_4'],
                            'risk_assessment_individual_y_5' => $row['risk_assessment_individual_y_5'],
                            'risk_assessment_individual_z' => $row['risk_assessment_individual_z'],
                            'risk_assessment_individual_kv' => $row['risk_assessment_individual_kv'],
                            'create_at' => $row['create_at'],
                            'federal_district_id' => $row['federal_district_id'],
                            'region_id' => $row['region_id'],
                            'name_responsible_person_individual' => $row['name_responsible_person_individual'],
                            'name_responsible_person' => $row['name_responsible_person'],
                            'municipality_id' => $row['municipality_id'],
                            'organization_id' => $row['organization_id'],
                            'title' => $row['title'],
                            'short_title' => $row['short_title'],
                            'user_id' => $row['user_id'],
                            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_1']),
                            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_2']),
                            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_3']),
                            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_4']),
                            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_5']),
                            'risk_assessment_1' => $row['risk_assessment_1'],
                            'risk_assessment_2' => $row['risk_assessment_2'],
                            'risk_assessment_3' => $row['risk_assessment_3'],
                            'risk_assessment_4' => $row['risk_assessment_4'],
                            'risk_assessment_5' => $row['risk_assessment_5'],
                            'risk_assessment_g' => $row['risk_assessment_g'],
                            'risk_assessment' => $row['risk_assessment'],
                            '1risk_assessment_individual' => $model->contributionControlledFactors4($row['risk_assessment_individual']),
                            '1risk_assessment_individual_kv' => $model->contributionControlledFactors4($row['risk_assessment_individual_kv']),
                        ];
                    }
                }
                //print_r('<pre>');
                //print_r('Общая база');
                //print_r('<br><br><br>');
                //print_r($resultList22);
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('</pre>');
                //exit();
            } else {

                $rows = (new \yii\db\Query())
                    ->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.year AS year',
                        'risk_assessment_organization_common.class AS class',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])
                    ->from('risk_assessment_organization_common')
                    ->join('inner JOIN', 'organization', 'organization.id = risk_assessment_organization_common.organization_id')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where)
                    ->orderBy([
                        'organization.federal_district_id' => SORT_ASC,
                        'organization.region_id' => SORT_ASC,
                        'organization.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db_anket)->queryAll();
                $resultList = [];
                foreach ($rows as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                        $resultList[$row['organization_id']][$row['class']] = [
                            'federal_district_id' => $row['federal_district_id'],
                            'region_id' => $row['region_id'],
                            'municipality_id' => $row['municipality_id'],
                            'organization_id' => $row['organization_id'],
                            'title' => $row['title'],
                            'short_title' => $row['short_title'],
                            'user_id' => $row['user_id'],
                            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_1']),
                            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_2']),
                            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_3']),
                            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_4']),
                            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_5']),
                            'risk_assessment_1' => $row['risk_assessment_1'],
                            'risk_assessment_2' => $row['risk_assessment_2'],
                            'risk_assessment_3' => $row['risk_assessment_3'],
                            'risk_assessment_4' => $row['risk_assessment_4'],
                            'risk_assessment_5' => $row['risk_assessment_5'],
                            'risk_assessment_g' => $row['risk_assessment_g'],
                            'risk_assessment' => $row['risk_assessment'],
                            'create_at' => $row['create_at'],
                            'name_responsible_person' => $row['name_responsible_person'],
                        ];
                        $resultList[$row['organization_id']]['title'] = $row['title'];
                    }
                }

                $rows2 = (new \yii\db\Query())
                    ->from('risk_assessment_individual_common')
                    ->join('inner JOIN', 'organization', 'organization.id = risk_assessment_individual_common.organization_id')
                    ->join('inner JOIN', 'students_class', 'students_class.id = risk_assessment_individual_common.	class_students_id')
                    ->join('inner JOIN', 'students', 'students.id = risk_assessment_individual_common.students_id')
                    ->where(['risk_assessment_individual_common.year' => '2023/2024',])
                    ->andWhere($where)
                    ->orderBy([
                        'organization.federal_district_id' => SORT_ASC,
                        'organization.region_id' => SORT_ASC,
                        'organization.municipality_id' => SORT_ASC,
                    ])
                    ->all();

                $arrCr = [
                    'class_individual',
                    'violation_posture',
                    'visual_impairment',
                    'fieldIndividualTheme1_1',
                    'fieldIndividualTheme1_2',
                    'fieldIndividualTheme1_3',
                    'fieldIndividualTheme2_1',
                    'fieldIndividualTheme2_2',
                    'fieldIndividualTheme2_3',
                    'fieldIndividualTheme3_1',
                    'fieldIndividualTheme3_2',
                    'fieldIndividualTheme4_1',
                    'fieldIndividualTheme4_2',
                    'fieldIndividualTheme5_1',
                    'fieldIndividualTheme5_2',
                    'fieldIndividualTheme6_1',
                    'fieldIndividualTheme6_2',
                    'risk_assessment_individual',
                    'risk_assessment_individual_y',
                    'risk_assessment_individual_y_1',
                    'risk_assessment_individual_y_2',
                    'risk_assessment_individual_y_3',
                    'risk_assessment_individual_y_4',
                    'risk_assessment_individual_y_5',
                    'risk_assessment_individual_z',
                    'risk_assessment_individual_kv',
                    'create_at',
                    'class_number',
                    'dis_sahar',
                    'dis_ovz',
                    'dis_cialic',
                    'dis_fenilketon',
                    'dis_mukovis',
                    'allergy_status',
                    'al_moloko',
                    'al_yico',
                    'al_fish',
                    'al_chocolad',
                    'al_orehi',
                    'al_citrus',
                    'al_med',
                    'al_pshenica',
                    'al_arahis',
                ];

                foreach ($rows2 as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                        //$row
                        if (
                            $row['class_individual'] == '1' ||
                            $row['class_individual'] == '2' ||
                            $row['class_individual'] == '3' ||
                            $row['class_individual'] == '4'
                        ) {
                            $classIndikator = '342';
                        } else if (
                            $row['class_individual'] == '5' ||
                            $row['class_individual'] == '6' ||
                            $row['class_individual'] == '7' ||
                            $row['class_individual'] == '8' ||
                            $row['class_individual'] == '9'
                        ) {
                            $classIndikator = '486';
                        } else {
                            $classIndikator = '2819';
                        }
                        if ($resultList[$row['organization_id']][$classIndikator] && $resultList[$row['organization_id']][$classIndikator] != []) {
                            $resultList22['organization'][] = [
                                'class_individual' => $row['class_individual'],
                                'violation_posture' => Yii::$app->riskComponent->fieldBBBB2($row['violation_posture']),
                                'visual_impairment' => Yii::$app->riskComponent->fieldBBBB2($row['visual_impairment']),
                                'fieldIndividualTheme1_1' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_1']),
                                'fieldIndividualTheme1_2' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_2']),
                                'fieldIndividualTheme1_3' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_3']),
                                'fieldIndividualTheme2_1' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_1']),
                                'fieldIndividualTheme2_2' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_2']),
                                'fieldIndividualTheme2_3' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_3']),
                                'fieldIndividualTheme3_1' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_1']),
                                'fieldIndividualTheme3_2' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_2']),
                                'fieldIndividualTheme4_1' => Yii::$app->riskComponent->fieldTheme41IndividualDecoding($row['fieldIndividualTheme4_1']),
                                'fieldIndividualTheme4_2' => Yii::$app->riskComponent->fieldTheme42IndividualDecoding($row['fieldIndividualTheme4_2']),
                                'fieldIndividualTheme5_1' => Yii::$app->riskComponent->fieldTheme51IndividualDecoding($row['fieldIndividualTheme5_1']),
                                'fieldIndividualTheme5_2' => Yii::$app->riskComponent->fieldTheme52IndividualDecoding($row['fieldIndividualTheme5_2']),
                                'fieldIndividualTheme6_1' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_1']),
                                'fieldIndividualTheme6_2' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_2']),
                                'risk_assessment_individual' => $row['risk_assessment_individual'],
                                'risk_assessment_individual_y' => $row['risk_assessment_individual_y'],
                                'risk_assessment_individual_y_1' => $row['risk_assessment_individual_y_1'],
                                'risk_assessment_individual_y_2' => $row['risk_assessment_individual_y_2'],
                                'risk_assessment_individual_y_3' => $row['risk_assessment_individual_y_3'],
                                'risk_assessment_individual_y_4' => $row['risk_assessment_individual_y_4'],
                                'risk_assessment_individual_y_5' => $row['risk_assessment_individual_y_5'],
                                'risk_assessment_individual_z' => $row['risk_assessment_individual_z'],
                                'risk_assessment_individual_kv' => $row['risk_assessment_individual_kv'],
                                'name_responsible_person_individual' => $row['name_responsible_person_individual'],
                                'name_responsible_person' => $row['name_responsible_person'],
                                'create_at' => $row['create_at'],
                                'federal_district_id' => $resultList[$row['organization_id']][$classIndikator]['federal_district_id'],
                                'region_id' => $resultList[$row['organization_id']][$classIndikator]['region_id'],
                                'municipality_id' => $resultList[$row['organization_id']][$classIndikator]['municipality_id'],
                                'organization_id' => $resultList[$row['organization_id']][$classIndikator]['organization_id'],
                                'title' => $resultList[$row['organization_id']][$classIndikator]['title'],
                                'short_title' => $resultList[$row['organization_id']][$classIndikator]['short_title'],
                                'user_id' => $resultList[$row['organization_id']][$classIndikator]['user_id'],
                                'fieldTheme1_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme1_1'],
                                'fieldTheme1_2' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme1_2'],
                                'fieldTheme1_3' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme1_3'],
                                'fieldTheme1_4' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme1_4'],
                                'fieldTheme1_5' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme1_5'],
                                'fieldTheme2_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme2_1'],
                                'fieldTheme2_2' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme2_2'],
                                'fieldTheme2_3' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme2_3'],
                                'fieldTheme2_4' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme2_4'],
                                'fieldTheme3_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme3_1'],
                                'fieldTheme3_2' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme3_2'],
                                'fieldTheme4_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme4_1'],
                                'fieldTheme5_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_1'],
                                'fieldTheme5_2' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_2'],
                                'fieldTheme5_3' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_3'],
                                'fieldTheme5_4_1' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_4_1'],
                                'fieldTheme5_4_2' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_4_2'],
                                'fieldTheme5_4_3' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_4_3'],
                                'fieldTheme5_4_4' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_4_4'],
                                'fieldTheme5_4_5' => $resultList[$row['organization_id']][$classIndikator]['fieldTheme5_4_5'],
                                'risk_assessment_1' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_1'],
                                'risk_assessment_2' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_2'],
                                'risk_assessment_3' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_3'],
                                'risk_assessment_4' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_4'],
                                'risk_assessment_5' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_5'],
                                'risk_assessment_g' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment_g'],
                                'risk_assessment' => $resultList[$row['organization_id']][$classIndikator]['risk_assessment'],
                                '1risk_assessment_individual' => $model->contributionControlledFactors4($row['risk_assessment_individual']),
                                '1risk_assessment_individual_kv' => $model->contributionControlledFactors4($row['risk_assessment_individual_kv']),
                            ];
                        }
                    }
                }
                //print_r('<pre>');
                //print_r('Мониторинг питания');
                //print_r('<br><br><br>');
                //print_r($resultList22);
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('</pre>');
                //exit();
            }

            $arr3 = [
                'violation_posture',
                'visual_impairment',
                'fieldIndividualTheme1_1',
                'fieldIndividualTheme1_2',
                'fieldIndividualTheme1_3',
                'fieldIndividualTheme2_1',
                'fieldIndividualTheme2_2',
                'fieldIndividualTheme2_3',
                'fieldIndividualTheme3_1',
                'fieldIndividualTheme3_2',
                'fieldIndividualTheme4_1',
                'fieldIndividualTheme4_2',
                'fieldIndividualTheme5_1',
                'fieldIndividualTheme5_2',
                'fieldIndividualTheme6_1',
                'fieldIndividualTheme6_2',
                'risk_assessment_individual',
                'risk_assessment_individual_y',
                'risk_assessment_individual_y_1',
                'risk_assessment_individual_y_2',
                'risk_assessment_individual_y_3',
                'risk_assessment_individual_y_4',
                'risk_assessment_individual_y_5',
                'risk_assessment_individual_z',
                'risk_assessment_individual_kv',
                '1risk_assessment_individual',
                '1risk_assessment_individual_kv',
                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'fieldTheme5_4_5',
                'risk_assessment_1',
                'risk_assessment_2',
                'risk_assessment_3',
                'risk_assessment_4',
                'risk_assessment_5',
                'risk_assessment_g',
                'risk_assessment',
            ];

            foreach ($resultList22['organization'] as $row) {
                $resultList22['region'][$row['region_id']]['count'] += 1;
                $resultList22['okrug'][$row['federal_district_id']]['count'] += 1;
                $resultList22['itog']['count'] += 1;
                //print_r('<pre>');
                //print_r($row['fieldTheme5_4_5']);
                //print_r('<br>');
                foreach ($arr3 as $key => $one) {
                    $resultList22['region'][$row['region_id']][$one] += ($row[$one] != '') ? $row[$one] : 0;
                    $resultList22['okrug'][$row['federal_district_id']][$one] += ($row[$one] != '') ? $row[$one] : 0;
                    $resultList22['itog'][$one] += ($row[$one] != '') ? $row[$one] : 0;
                }
            }
            //exit();
        }


        return $this->render('/risk-common/report-individual-risk', [
            'model' => $model,
            'result' => $resultList22,
            'district_items' => $district_items,
            'region_items' => $region_items,
        ]);

    }

    public function actionReportAggressionRisk($key = 1)
    {
        $model = new RiskAssessmentOrganizationCommon();
        $model->key = 'net';
        $modelIndividual = new RiskAssessmentIndividualCommon();

        $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name'));
        //$region_items = ArrayHelper::merge(['' => 'Выберите регион ...','0'=>'Все'], ArrayHelper::map(Region::find()->where(['district_id' => 1])->all(), 'id', 'name'));
        $region_items = ['0' => 'Все'];

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            //federal_district_id
            //region_id
            $model->federal_district_id = $post['federal_district_id'];
            $model->region_id = $post['region_id'];
            $model->key = $post['key'];
            $where = [];
            $where += ($post['federal_district_id'] != '0') ? ['organization.federal_district_id' => $post['federal_district_id']] : [];
            $where += ($post['region_id'] != '0') ? ['organization.region_id' => $post['region_id']] : [];
            $where2 = [];
            $where2 += ($post['federal_district_id'] != '0') ? ['federal_district_id' => $post['federal_district_id']] : [];
            $where2 += ($post['region_id'] != '0') ? ['region_id' => $post['region_id']] : [];
            $where3 = [];
            $where3 += ($post['federal_district_id'] != '0') ? ['risk_assessment_organization_common.federal_district_id' => $post['federal_district_id']] : [];
            $where3 += ($post['region_id'] != '0') ? ['risk_assessment_organization_common.region_id' => $post['region_id']] : [];

            $wherefederal_district_id = ($post['federal_district_id'] != '0') ? ['id' => $post['federal_district_id']] : [];
            $whereregion_id = ($post['region_id'] != '0') ? ['id' => $post['region_id']] : [];
            $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->where($wherefederal_district_id)->all(), 'id', 'name'));
            $region_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(Region::find()->where($whereregion_id)->all(), 'id', 'name'));
            $resultList22 = [];

            $where2223 = [];
            if ($key == 2) {
                $where2223 = ['in', 'risk_assessment_organization_common.key', ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2']];
            }

            $row22s = (new \yii\db\Query())
                ->from('risk_assessment_organization_common')
                ->join('left JOIN', 'risk_assessment_individual_common', 'risk_assessment_individual_common.key = risk_assessment_organization_common.key')
                ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                ->andWhere($where3)
                ->andWhere($where2223)
                ->orderBy([
                    'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                    'risk_assessment_organization_common.region_id' => SORT_ASC,
                    'risk_assessment_organization_common.municipality_id' => SORT_ASC,
                ])
                ->createCommand(Yii::$app->db)->queryAll();


            foreach ($row22s as $row) {
                if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {

                    $modelRiskChildrenList = (new \yii\db\Query())
                        ->select([
                            'risk_children_list.id_children_list as id',
                            'risk_children_list.name_responsible_person_individual as name_responsible_person_individual',
                            'risk_children_list.class as class',
                            'risk_questionnaire_one.estimation as estimation_one',
                            'risk_questionnaire_two.estimation as estimation_two',
                            'risk_questionnaire_three.estimation as estimation_three',
                            'risk_questionnaire_four.estimation as estimation_four',
                            'risk_questionnaire_five.estimation as estimation_five',
                            'risk_questionnaire_six.estimation as estimation_six',
                            'risk_questionnaire_spielberger.rt as rt',
                            'risk_questionnaire_spielberger.lt as lt',
                            'risk_questionnaire_bass_darck.aggressiveness_index as aggressiveness_index',
                            'risk_questionnaire_bass_darck.includes_index as includes_index',
                        ])
                        ->from('risk_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_one', 'risk_questionnaire_one.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_two', 'risk_questionnaire_two.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_three', 'risk_questionnaire_three.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_four', 'risk_questionnaire_four.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_five', 'risk_questionnaire_five.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_six', 'risk_questionnaire_six.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_spielberger', 'risk_questionnaire_spielberger.id_children_list =	risk_children_list.id_children_list')
                        ->join('inner JOIN', 'risk_questionnaire_bass_darck', 'risk_questionnaire_bass_darck.id_children_list = risk_children_list.id_children_list')
                        //->where(['like', 'risk_children_list.name_responsible_person_individual', trim($row['name_responsible_person_individual'])])
                        ->where(['like', 'risk_children_list.key', trim($row['key'])])
                        ->one();
                    //print_r('<pre>');
                    //print_r($row);
                    //print_r('<br><br>');
                    //print_r($modelRiskChildrenList);
                    //exit();
                    if($modelRiskChildrenList){
                        $row['class_individual'] = Yii::$app->riskComponent->trainingClassIndividualDecoding($row['class_individual']);
                        $item = [
                            '1' => '342',
                            '2' => '342',
                            '3' => '342',
                            '4' => '342',
                            '5' => '486',
                            '6' => '486',
                            '7' => '486',
                            '8' => '486',
                            '9' => '486',
                            '10' => '2819',
                            '11' => '2819',
                        ];
                        $classIndikator = $item[$row['class_individual']];
                        $resultList22['organization'][] = [
                            'class_individual' => $classIndikator,
                            'violation_posture' => Yii::$app->riskComponent->fieldBBBB2($row['violation_posture']),
                            'visual_impairment' => Yii::$app->riskComponent->fieldBBBB2($row['visual_impairment']),
                            'fieldIndividualTheme1_1' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_1']),
                            'fieldIndividualTheme1_2' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_2']),
                            'fieldIndividualTheme1_3' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($row['fieldIndividualTheme1_3']),
                            'fieldIndividualTheme2_1' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_1']),
                            'fieldIndividualTheme2_2' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_2']),
                            'fieldIndividualTheme2_3' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($row['fieldIndividualTheme2_3']),
                            'fieldIndividualTheme3_1' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_1']),
                            'fieldIndividualTheme3_2' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($row['fieldIndividualTheme3_2']),
                            'fieldIndividualTheme4_1' => Yii::$app->riskComponent->fieldTheme41IndividualDecoding($row['fieldIndividualTheme4_1']),
                            'fieldIndividualTheme4_2' => Yii::$app->riskComponent->fieldTheme42IndividualDecoding($row['fieldIndividualTheme4_2']),
                            'fieldIndividualTheme5_1' => Yii::$app->riskComponent->fieldTheme51IndividualDecoding($row['fieldIndividualTheme5_1']),
                            'fieldIndividualTheme5_2' => Yii::$app->riskComponent->fieldTheme52IndividualDecoding($row['fieldIndividualTheme5_2']),
                            'fieldIndividualTheme6_1' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_1']),
                            'fieldIndividualTheme6_2' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($row['fieldIndividualTheme6_2']),
                            'risk_assessment_individual' => $row['risk_assessment_individual'],
                            'risk_assessment_individual_y' => $row['risk_assessment_individual_y'],
                            'risk_assessment_individual_y_1' => $row['risk_assessment_individual_y_1'],
                            'risk_assessment_individual_y_2' => $row['risk_assessment_individual_y_2'],
                            'risk_assessment_individual_y_3' => $row['risk_assessment_individual_y_3'],
                            'risk_assessment_individual_y_4' => $row['risk_assessment_individual_y_4'],
                            'risk_assessment_individual_y_5' => $row['risk_assessment_individual_y_5'],
                            'risk_assessment_individual_z' => $row['risk_assessment_individual_z'],
                            'risk_assessment_individual_kv' => $row['risk_assessment_individual_kv'],
                            'create_at' => $row['create_at'],
                            'federal_district_id' => $row['federal_district_id'],
                            'region_id' => $row['region_id'],
                            'name_responsible_person_individual' => $row['name_responsible_person_individual'],
                            'name_responsible_person' => $row['name_responsible_person'],
                            'municipality_id' => $row['municipality_id'],
                            'organization_id' => $row['organization_id'],
                            'title' => $row['title'],
                            'short_title' => $row['short_title'],
                            'user_id' => $row['user_id'],
                            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_1']),
                            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_2']),
                            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_3']),
                            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_4']),
                            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_4_5']),
                            'risk_assessment_1' => $row['risk_assessment_1'],
                            'risk_assessment_2' => $row['risk_assessment_2'],
                            'risk_assessment_3' => $row['risk_assessment_3'],
                            'risk_assessment_4' => $row['risk_assessment_4'],
                            'risk_assessment_5' => $row['risk_assessment_5'],
                            'risk_assessment_g' => $row['risk_assessment_g'],
                            'risk_assessment' => $row['risk_assessment'],
                            '1risk_assessment_individual' => $model->contributionControlledFactors4($row['risk_assessment_individual']),
                            '1risk_assessment_individual_kv' => $model->contributionControlledFactors4($row['risk_assessment_individual_kv']),

                            'estimation_one' =>$modelRiskChildrenList['estimation_one'],
                            'estimation_two' =>$modelRiskChildrenList['estimation_two'],
                            'estimation_three' =>$modelRiskChildrenList['estimation_three'],
                            'estimation_four' =>$modelRiskChildrenList['estimation_four'],
                            'estimation_five' =>$modelRiskChildrenList['estimation_five'],
                            'estimation_six' =>$modelRiskChildrenList['estimation_six'],
                            'rt' => $modelRiskChildrenList['rt'],
                            'lt' => $modelRiskChildrenList['lt'],
                            'aggressiveness_index' =>$modelRiskChildrenList['aggressiveness_index'],
                            'includes_index' =>$modelRiskChildrenList['includes_index'],

                        ];
                    }

                }
            }


            $arr3 = [
                'violation_posture',
                'visual_impairment',
                'fieldIndividualTheme1_1',
                'fieldIndividualTheme1_2',
                'fieldIndividualTheme1_3',
                'fieldIndividualTheme2_1',
                'fieldIndividualTheme2_2',
                'fieldIndividualTheme2_3',
                'fieldIndividualTheme3_1',
                'fieldIndividualTheme3_2',
                'fieldIndividualTheme4_1',
                'fieldIndividualTheme4_2',
                'fieldIndividualTheme5_1',
                'fieldIndividualTheme5_2',
                'fieldIndividualTheme6_1',
                'fieldIndividualTheme6_2',
                'risk_assessment_individual',
                'risk_assessment_individual_y',
                'risk_assessment_individual_y_1',
                'risk_assessment_individual_y_2',
                'risk_assessment_individual_y_3',
                'risk_assessment_individual_y_4',
                'risk_assessment_individual_y_5',
                'risk_assessment_individual_z',
                'risk_assessment_individual_kv',
                '1risk_assessment_individual',
                '1risk_assessment_individual_kv',
                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'fieldTheme5_4_5',
                'risk_assessment_1',
                'risk_assessment_2',
                'risk_assessment_3',
                'risk_assessment_4',
                'risk_assessment_5',
                'risk_assessment_g',
                'risk_assessment',

                'estimation_one',
                'estimation_two',
                'estimation_three',
                'estimation_four',
                'estimation_five',
                'estimation_six',
                'rt',
                'lt',
                'aggressiveness_index',
                'includes_index',
            ];

            foreach ($resultList22['organization'] as $row) {
                $resultList22['region'][$row['region_id']]['count'] += 1;
                $resultList22['okrug'][$row['federal_district_id']]['count'] += 1;
                $resultList22['itog']['count'] += 1;

                foreach ($arr3 as $key => $one) {
                    $resultList22['region'][$row['region_id']][$one] += ($row[$one] != '') ? $row[$one] : 0;
                    $resultList22['okrug'][$row['federal_district_id']][$one] += ($row[$one] != '') ? $row[$one] : 0;
                    $resultList22['itog'][$one] += ($row[$one] != '') ? $row[$one] : 0;
                }
            }
            //exit();
        }
/*        print_r('<pre>');
        print_r('Общая база');
        print_r('<br><br><br>');
        print_r($resultList22);
        print_r('<br><br><br>');
        print_r('<br><br><br>');
        print_r('<br><br><br>');
        print_r('</pre>');
        exit();*/

        return $this->render('/risk-common/report-aggression-risk', [
            'model' => $model,
            'result' => $resultList22,
            'district_items' => $district_items,
            'region_items' => $region_items,
        ]);

    }

    public function actionReportAggressionRisk2($key = 1)
    {
        $model = new RiskAssessmentOrganizationCommon();
        $model->key = 'net';
        $modelIndividual = new RiskAssessmentIndividualCommon();

        $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name'));
        //$region_items = ArrayHelper::merge(['' => 'Выберите регион ...','0'=>'Все'], ArrayHelper::map(Region::find()->where(['district_id' => 1])->all(), 'id', 'name'));
        $region_items = ['0' => 'Все'];

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            //federal_district_id
            //region_id
            $model->federal_district_id = $post['federal_district_id'];
            $model->region_id = $post['region_id'];
            $model->key = $post['key'];
            $where = [];
            $where += ($post['federal_district_id'] != '0') ? ['organization.federal_district_id' => $post['federal_district_id']] : [];
            $where += ($post['region_id'] != '0') ? ['organization.region_id' => $post['region_id']] : [];
            $where2 = [];
            $where2 += ($post['federal_district_id'] != '0') ? ['federal_district_id' => $post['federal_district_id']] : [];
            $where2 += ($post['region_id'] != '0') ? ['region_id' => $post['region_id']] : [];
            $where3 = [];
            $where3 += ($post['federal_district_id'] != '0') ? ['risk_assessment_organization_common.federal_district_id' => $post['federal_district_id']] : [];
            $where3 += ($post['region_id'] != '0') ? ['risk_assessment_organization_common.region_id' => $post['region_id']] : [];

            $wherefederal_district_id = ($post['federal_district_id'] != '0') ? ['id' => $post['federal_district_id']] : [];
            $whereregion_id = ($post['region_id'] != '0') ? ['id' => $post['region_id']] : [];
            $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->where($wherefederal_district_id)->all(), 'id', 'name'));
            $region_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(Region::find()->where($whereregion_id)->all(), 'id', 'name'));
            $resultList22 = [];

            $where2223 = [];
            if ($key == 2) {
                $where2223 = ['in', 'risk_assessment_organization_common.key', ['1e3a0f-9e4d4b-9df806-b1a252-c150ca', '6c84fa-5a9c08-dae1e7-219d3a-3314fc', '5aa821-693426-a53e66-df9153-6c39a2']];
            }

            $row22s = (new \yii\db\Query())

                ->from('risk_assessment_organization_common')
                ->join('left JOIN', 'risk_children_list', 'risk_assessment_organization_common.key = risk_children_list.key')
                ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                ->andWhere($where3)
                ->andWhere($where2223)
                ->orderBy([
                    'risk_assessment_organization_common.federal_district_id' => SORT_ASC,
                    'risk_assessment_organization_common.region_id' => SORT_ASC,
                    'risk_assessment_organization_common.municipality_id' => SORT_ASC,
                ])
                ->createCommand(Yii::$app->db)->queryAll();
            $modelСhild = new RiskChildrenList();
            $modelRiskQuestionnaireOne = new RiskQuestionnaireOne();
            $modelRiskQuestionnaireTwo = new RiskQuestionnaireTwo();
            $modelRiskQuestionnaireThree = new RiskQuestionnaireThree();
            $modelRiskQuestionnaireFour = new RiskQuestionnaireFour();
            $modelRiskQuestionnaireFive = new RiskQuestionnaireFive();
            $modelRiskQuestionnaireSix = new RiskQuestionnaireSix();
            $modelRiskQuestionnaireSpielberger = new RiskQuestionnaireSpielberger();
            $modelRiskQuestionnaireBassDarck = new RiskQuestionnaireBassDarck();

            $result = [];
            $i = 1;
            foreach ($row22s as $row) {

                $RiskQuestionnaireOne = RiskQuestionnaireOne::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireTwo = RiskQuestionnaireTwo::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireThree = RiskQuestionnaireThree::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireFour = RiskQuestionnaireFour::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireFive = RiskQuestionnaireFive::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireSix = RiskQuestionnaireSix::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireSpielberger = RiskQuestionnaireSpielberger::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                $RiskQuestionnaireBassDarck = RiskQuestionnaireBassDarck::find()->where(['id_children_list' => $row['id_children_list']])->asArray()->one();
                if (
                    $RiskQuestionnaireOne &&
                    $RiskQuestionnaireTwo &&
                    $RiskQuestionnaireThree &&
                    $RiskQuestionnaireFour &&
                    $RiskQuestionnaireFive &&
                    $RiskQuestionnaireSix &&
                    $RiskQuestionnaireSpielberger &&
                    $RiskQuestionnaireBassDarck
                ) {

                    //print_r('<pre>');
                    //print_r($modelRiskQuestionnaireOne);print_r('<br>');
                    //print_r($modelRiskQuestionnaireTwo);print_r('<br>');
                    //print_r($modelRiskQuestionnaireThree);print_r('<br>');
                    //print_r($modelRiskQuestionnaireFour);print_r('<br>');
                    //print_r($modelRiskQuestionnaireFive);print_r('<br>');
                    //print_r($modelRiskQuestionnaireSix);print_r('<br>');
                    //print_r($modelRiskQuestionnaireSpielberger);print_r('<br>');
                    //print_r($modelRiskQuestionnaireBassDarck);print_r('<br>');
                    //exit();
                   // $result[$i]['id_children_list'] = $row['id_children_list'];
                    $result[$i]['conti'] = Yii::$app->riskComponent->trainingClass($row['class_individual']);
                    $result[$i]['class'] = Yii::$app->riskComponent->trainingClassIndividualName($row['class']);
                    $result[$i]['name_responsible_person_individual'] = $row['name_responsible_person_individual'];


                    $result[$i]['SpielbergerField_1'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_1']);
                    $result[$i]['SpielbergerField_2'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_2']);
                    $result[$i]['SpielbergerField_3'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_3']);
                    $result[$i]['SpielbergerField_4'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_4']);
                    $result[$i]['SpielbergerField_5'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_5']);
                    $result[$i]['SpielbergerField_6'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_6']);
                    $result[$i]['SpielbergerField_7'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_7']);
                    $result[$i]['SpielbergerField_8'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_8']);
                    $result[$i]['SpielbergerField_9'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_9']);
                    $result[$i]['SpielbergerField_10'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_10']);
                    $result[$i]['SpielbergerField_11'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_11']);
                    $result[$i]['SpielbergerField_12'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_12']);
                    $result[$i]['SpielbergerField_13'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_13']);
                    $result[$i]['SpielbergerField_14'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_14']);
                    $result[$i]['SpielbergerField_15'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_15']);
                    $result[$i]['SpielbergerField_16'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_16']);
                    $result[$i]['SpielbergerField_17'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_17']);
                    $result[$i]['SpielbergerField_18'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_18']);
                    $result[$i]['SpielbergerField_19'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_19']);
                    $result[$i]['SpielbergerField_20'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_20']);
                    $result[$i]['SpielbergerField_21'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_21']);
                    $result[$i]['SpielbergerField_22'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_22']);
                    $result[$i]['SpielbergerField_23'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_23']);
                    $result[$i]['SpielbergerField_24'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_24']);
                    $result[$i]['SpielbergerField_25'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_25']);
                    $result[$i]['SpielbergerField_26'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_26']);
                    $result[$i]['SpielbergerField_27'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_27']);
                    $result[$i]['SpielbergerField_28'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_28']);
                    $result[$i]['SpielbergerField_29'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_29']);
                    $result[$i]['SpielbergerField_30'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_30']);
                    $result[$i]['SpielbergerField_31'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_31']);
                    $result[$i]['SpielbergerField_32'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_32']);
                    $result[$i]['SpielbergerField_33'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_33']);
                    $result[$i]['SpielbergerField_34'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_34']);
                    $result[$i]['SpielbergerField_35'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_35']);
                    $result[$i]['SpielbergerField_36'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_36']);
                    $result[$i]['SpielbergerField_37'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_37']);
                    $result[$i]['SpielbergerField_38'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_38']);
                    $result[$i]['SpielbergerField_39'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_39']);
                    $result[$i]['SpielbergerField_40'] = $modelRiskQuestionnaireSpielberger->decodingValues($RiskQuestionnaireSpielberger['field_40']);
                    $result[$i]['SpielbergerRT'] = $RiskQuestionnaireSpielberger['rt'];
                    $result[$i]['SpielbergerRT1'] = Yii::$app->riskComponent->interpretation($RiskQuestionnaireSpielberger['rt']);
                    $result[$i]['SpielbergerLT'] = $RiskQuestionnaireSpielberger['lt'];
                    $result[$i]['SpielbergerLT1'] = Yii::$app->riskComponent->interpretation($RiskQuestionnaireSpielberger['lt']);

                    $result[$i]['SpielbergerField_1_1'] = $RiskQuestionnaireSpielberger['field_1'];
                    $result[$i]['SpielbergerField_2_1'] = $RiskQuestionnaireSpielberger['field_2'];
                    $result[$i]['SpielbergerField_3_1'] = $RiskQuestionnaireSpielberger['field_3'];
                    $result[$i]['SpielbergerField_4_1'] = $RiskQuestionnaireSpielberger['field_4'];
                    $result[$i]['SpielbergerField_5_1'] = $RiskQuestionnaireSpielberger['field_5'];
                    $result[$i]['SpielbergerField_6_1'] = $RiskQuestionnaireSpielberger['field_6'];
                    $result[$i]['SpielbergerField_7_1'] = $RiskQuestionnaireSpielberger['field_7'];
                    $result[$i]['SpielbergerField_8_1'] = $RiskQuestionnaireSpielberger['field_8'];
                    $result[$i]['SpielbergerField_9_1'] = $RiskQuestionnaireSpielberger['field_9'];
                    $result[$i]['SpielbergerField_10_1'] = $RiskQuestionnaireSpielberger['field_10'];
                    $result[$i]['SpielbergerField_11_1'] = $RiskQuestionnaireSpielberger['field_11'];
                    $result[$i]['SpielbergerField_12_1'] = $RiskQuestionnaireSpielberger['field_12'];
                    $result[$i]['SpielbergerField_13_1'] = $RiskQuestionnaireSpielberger['field_13'];
                    $result[$i]['SpielbergerField_14_1'] = $RiskQuestionnaireSpielberger['field_14'];
                    $result[$i]['SpielbergerField_15_1'] = $RiskQuestionnaireSpielberger['field_15'];
                    $result[$i]['SpielbergerField_16_1'] = $RiskQuestionnaireSpielberger['field_16'];
                    $result[$i]['SpielbergerField_17_1'] = $RiskQuestionnaireSpielberger['field_17'];
                    $result[$i]['SpielbergerField_18_1'] = $RiskQuestionnaireSpielberger['field_18'];
                    $result[$i]['SpielbergerField_19_1'] = $RiskQuestionnaireSpielberger['field_19'];
                    $result[$i]['SpielbergerField_20_1'] = $RiskQuestionnaireSpielberger['field_20'];
                    $result[$i]['SpielbergerField_21_1'] = $RiskQuestionnaireSpielberger['field_21'];
                    $result[$i]['SpielbergerField_22_1'] = $RiskQuestionnaireSpielberger['field_22'];
                    $result[$i]['SpielbergerField_23_1'] = $RiskQuestionnaireSpielberger['field_23'];
                    $result[$i]['SpielbergerField_24_1'] = $RiskQuestionnaireSpielberger['field_24'];
                    $result[$i]['SpielbergerField_25_1'] = $RiskQuestionnaireSpielberger['field_25'];
                    $result[$i]['SpielbergerField_26_1'] = $RiskQuestionnaireSpielberger['field_26'];
                    $result[$i]['SpielbergerField_27_1'] = $RiskQuestionnaireSpielberger['field_27'];
                    $result[$i]['SpielbergerField_28_1'] = $RiskQuestionnaireSpielberger['field_28'];
                    $result[$i]['SpielbergerField_29_1'] = $RiskQuestionnaireSpielberger['field_29'];
                    $result[$i]['SpielbergerField_30_1'] = $RiskQuestionnaireSpielberger['field_30'];
                    $result[$i]['SpielbergerField_31_1'] = $RiskQuestionnaireSpielberger['field_31'];
                    $result[$i]['SpielbergerField_32_1'] = $RiskQuestionnaireSpielberger['field_32'];
                    $result[$i]['SpielbergerField_33_1'] = $RiskQuestionnaireSpielberger['field_33'];
                    $result[$i]['SpielbergerField_34_1'] = $RiskQuestionnaireSpielberger['field_34'];
                    $result[$i]['SpielbergerField_35_1'] = $RiskQuestionnaireSpielberger['field_35'];
                    $result[$i]['SpielbergerField_36_1'] = $RiskQuestionnaireSpielberger['field_36'];
                    $result[$i]['SpielbergerField_37_1'] = $RiskQuestionnaireSpielberger['field_37'];
                    $result[$i]['SpielbergerField_38_1'] = $RiskQuestionnaireSpielberger['field_38'];
                    $result[$i]['SpielbergerField_39_1'] = $RiskQuestionnaireSpielberger['field_39'];
                    $result[$i]['SpielbergerField_40_1'] = $RiskQuestionnaireSpielberger['field_40'];
                    $result[$i]['SpielbergerRT_1'] = $RiskQuestionnaireSpielberger['rt'];
                    $result[$i]['SpielbergerRT1_1'] = Yii::$app->riskComponent->interpretation($RiskQuestionnaireSpielberger['rt']);
                    $result[$i]['SpielbergerLT_1'] = $RiskQuestionnaireSpielberger['lt'];
                    $result[$i]['SpielbergerLT1_1'] = Yii::$app->riskComponent->interpretation($RiskQuestionnaireSpielberger['lt']);

                    $arrName = [
                        'field_1_teacher',
                        'field_2_teacher',
                        'field_3_teacher',
                        'field_4_teacher',
                        'field_5_teacher',
                        'field_6_teacher',
                        'field_7_teacher',
                    ];
                    $strItogTab1 = 0;
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireOne[$arrName[$i2]] == '2' || $RiskQuestionnaireOne[$arrName[$i2]] == '3') ? 1 : 0;
                        $strStroka = ($aa1 * 7.14);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireOne'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['RiskQuestionnaireOneestimation_teacher'] = $RiskQuestionnaireOne['estimation_teacher'];
                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                        'field_7_parent',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireOne[$arrName[$i2]] == '2' || $RiskQuestionnaireOne[$arrName[$i2]] == '3') ? 1 : 0;
                        $strStroka = ($aa1 * 7.14);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireOne'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['RiskQuestionnaireOneestimation_parent'] = $RiskQuestionnaireOne['estimation_parent'];
                    $result[$i]['modelRiskQuestionnaireOneOnestrItogTab1'] = $RiskQuestionnaireOne['estimation'];
                    $result[$i]['modelRiskQuestionnaireOneOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireOne['estimation']);
                    $result[$i]['modelRiskQuestionnaireOneOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireOne['estimation'], $RiskQuestionnaireOne['estimation_teacher']);
                    $result[$i]['modelRiskQuestionnaireOneOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireOne['estimation'], $RiskQuestionnaireOne['estimation_parent']);



                    $arrName = [
                        'field_1_teacher',
                        'field_2_teacher',
                        'field_3_teacher',
                        'field_4_teacher',
                        'field_5_teacher',
                        'field_6_teacher',
                        'field_7_teacher',
                        'field_8_teacher',
                    ];

                    $strItogTab1 = 0;
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireTwo[$arrName[$i2]] != '' && $RiskQuestionnaireTwo[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 4.16);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireTwo'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireTwo_teacher'] = $RiskQuestionnaireTwo['estimation_teacher'];
                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                        'field_7_parent',
                        'field_8_parent',
                    ];

                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireTwo[$arrName[$i2]] != '' && $RiskQuestionnaireTwo[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 4.16);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireTwo'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireTwoestimation_parent'] = $RiskQuestionnaireTwo['estimation_parent'];
                    $arrName = [
                        'field_1_chile',
                        'field_2_chile',
                        'field_3_chile',
                        'field_4_chile',
                        'field_5_chile',
                        'field_6_chile',
                        'field_7_chile',
                        'field_8_chile',
                    ];

                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireTwo[$arrName[$i2]] != '' && $RiskQuestionnaireTwo[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 4.16);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireTwo'.$arrName[$i2]] = $strStroka;

                    }

                    $result[$i]['modelRiskQuestionnaireTwoestimation_chile'] = $RiskQuestionnaireTwo['estimation_chile'];
                    $result[$i]['modelRiskQuestionnaireTwostrItogTab1'] = $RiskQuestionnaireTwo['estimation'];

                    $result[$i]['modelRiskQuestionnaireTwoOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireTwo['estimation']);
                    $result[$i]['modelRiskQuestionnaireTwoOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireTwo['estimation'], $RiskQuestionnaireTwo['estimation_teacher']);
                    $result[$i]['modelRiskQuestionnaireTwoOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireTwo['estimation'], $RiskQuestionnaireTwo['estimation_parent']);
                    $result[$i]['modelRiskQuestionnaireTwoOnestrItogTab1_3'] = $modelСhild->percentage_of_number2($RiskQuestionnaireTwo['estimation'], $RiskQuestionnaireTwo['estimation_chile']);


                    $arrName = [
                        'field_1_teacher',
                        'field_2_teacher',
                        'field_3_teacher',
                        'field_4_teacher',
                        'field_5_teacher',
                        'field_6_teacher',
                        'field_7_teacher',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireThree[$arrName[$i2]] != '' && $RiskQuestionnaireThree[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 3.57);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireThree'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireThreeestimation_teacher'] = $RiskQuestionnaireThree['estimation_teacher'];

                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                        'field_7_parent',
                    ];

                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireThree[$arrName[$i2]] != '' && $RiskQuestionnaireThree[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 3.57);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireThree'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireThreeestimation_parent'] = $RiskQuestionnaireThree['estimation_parent'];
                    $result[$i]['modelRiskQuestionnaireThrestrItogTab1'] = $RiskQuestionnaireThree['estimation'];

                    $result[$i]['modelRiskQuestionnaireThreOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireThree['estimation']);
                    $result[$i]['modelRiskQuestionnaireThreOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireThree['estimation'], $RiskQuestionnaireThree['estimation_teacher']);
                    $result[$i]['modelRiskQuestionnaireThreOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireThree['estimation'], $RiskQuestionnaireThree['estimation_parent']);

                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                        'field_7_parent',
                        'field_8_parent',
                        'field_9_parent',
                        'field_10_parent',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireFour[$arrName[$i2]] != '' && $RiskQuestionnaireFour[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 2.5);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireFour'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireFourestimation_parent'] = $RiskQuestionnaireFour['estimation_parent'];
                    $arrName = [
                        'field_1_chile',
                        'field_2_chile',
                        'field_3_chile',
                        'field_4_chile',
                        'field_5_chile',
                        'field_6_chile',
                        'field_7_chile',
                        'field_8_chile',
                        'field_9_chile',
                         'field_10_chile',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireFour[$arrName[$i2]] != '' && $RiskQuestionnaireFour[$arrName[$i2]] != '0') ? 1 : 0;
                        $strStroka = ($aa1 * 2.5);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireFour'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireFourestimation_chile'] = $RiskQuestionnaireFour['estimation_chile'];
                    $result[$i]['modelRiskQuestionnaireFourestrItogTab1'] = $RiskQuestionnaireFour['estimation'];

                    $result[$i]['modelRiskQuestionnaireFourOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireFour['estimation']);
                    $result[$i]['modelRiskQuestionnaireFourOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireFour['estimation'], $RiskQuestionnaireFour['estimation_parent']);
                    $result[$i]['modelRiskQuestionnaireFourOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireFour['estimation'], $RiskQuestionnaireFour['estimation_chile']);


                    $arrName = [
                        'field_1_teacher',
                        'field_2_teacher',
                        'field_3_teacher',
                        'field_4_teacher',
                        'field_5_teacher',
                        'field_6_teacher',
                        'field_7_teacher',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireFive[$arrName[$i2]] == '1') ? 1 : 0;
                        $aa12 = ($RiskQuestionnaireFive[$arrName[$i2]] == '2') ? 1 : 0;
                        $strStroka = ($aa1 * 7.14) + ($aa12 * 3.57);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireFive'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireFiveestimation_teacher'] = $RiskQuestionnaireFive['estimation_teacher'];
                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                        'field_7_parent',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireFive[$arrName[$i2]] == '1') ? 1 : 0;
                        $aa12 = ($RiskQuestionnaireFive[$arrName[$i2]] == '2') ? 1 : 0;
                        $strStroka = ($aa1 * 7.14) + ($aa12 * 3.57);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireFive'.$arrName[$i2]] = $strStroka;

                    }
                    $result[$i]['modelRiskQuestionnaireFiveestimation_parent'] = $RiskQuestionnaireFive['estimation_parent'];
                    $result[$i]['modelRiskQuestionnaireFiveestrItogTab1'] = $RiskQuestionnaireFive['estimation'];

                    $result[$i]['modelRiskQuestionnaireFiveOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireFive['estimation']);
                    $result[$i]['modelRiskQuestionnaireFiveOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireFive['estimation'], $RiskQuestionnaireFive['estimation_teacher']);
                    $result[$i]['modelRiskQuestionnaireFiveOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireFive['estimation'], $RiskQuestionnaireFive['estimation_parent']);

                    $arrName = [
                        'field_1_teacher',
                        'field_2_teacher',
                        'field_3_teacher',
                        'field_4_teacher',
                        'field_5_teacher',
                        'field_6_teacher',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireSix[$arrName[$i2]] === '1') ? 1 : 0;
                        $aa12 = ($RiskQuestionnaireSix[$arrName[$i2]] === '2') ? 1 : 0;
                        $strStroka = ($aa1 * 5.55) + ($aa12 * 2.77);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireSix'.$arrName[$i2]] = $strStroka;
                    }
                    $result[$i]['modelRiskQuestionnaireSixestimation_teacher'] = $RiskQuestionnaireSix['estimation_teacher'];
                    $arrName = [
                        'field_1_parent',
                        'field_2_parent',
                        'field_3_parent',
                        'field_4_parent',
                        'field_5_parent',
                        'field_6_parent',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireSix[$arrName[$i2]] === '1') ? 1 : 0;
                        $aa12 = ($RiskQuestionnaireSix[$arrName[$i2]] === '2') ? 1 : 0;
                        $strStroka = ($aa1 * 5.55) + ($aa12 * 2.77);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireSix'.$arrName[$i2]] = $strStroka;
                    }
                    $result[$i]['modelRiskQuestionnaireSixestimation_parent'] = $RiskQuestionnaireSix['estimation_parent'];
                    $arrName = [
                        'field_1_chile',
                        'field_2_chile',
                        'field_3_chile',
                        'field_4_chile',
                        'field_5_chile',
                        'field_6_chile',
                    ];
                    for ($i2 = 0; $i2 < count($arrName); $i2++) {
                        $strStroka = 0;
                        $aa1 = ($RiskQuestionnaireSix[$arrName[$i2]] === '1') ? 1 : 0;
                        $aa12 = ($RiskQuestionnaireSix[$arrName[$i2]] === '2') ? 1 : 0;
                        $strStroka = ($aa1 * 5.55) + ($aa12 * 2.77);
                        $strItogTab1 = $strItogTab1 + $strStroka;
                        $result[$i]['modelRiskQuestionnaireSix'.$arrName[$i2]] = $strStroka;
                    }
                    $result[$i]['modelRiskQuestionnaireSixestimation_chile'] = $RiskQuestionnaireSix['estimation_chile'];
                    $result[$i]['modelRiskQuestionnaireSixestrItogTab1'] = $RiskQuestionnaireSix['estimation'];

                    $result[$i]['modelRiskQuestionnaireSixOnestrItogTab1_fff'] = $modelСhild->scoringDescriptionText($RiskQuestionnaireSix['estimation']);
                    $result[$i]['modelRiskQuestionnaireSixOnestrItogTab1_1'] = $modelСhild->percentage_of_number2($RiskQuestionnaireSix['estimation'], $RiskQuestionnaireSix['estimation_teacher']);
                    $result[$i]['modelRiskQuestionnaireSixOnestrItogTab1_2'] = $modelСhild->percentage_of_number2($RiskQuestionnaireSix['estimation'], $RiskQuestionnaireSix['estimation_parent']);
                    $result[$i]['modelRiskQuestionnaireSixOnestrItogTab1_3'] = $modelСhild->percentage_of_number2($RiskQuestionnaireSix['estimation'], $RiskQuestionnaireSix['estimation_chile']);


                    $result[$i]['RiskQuestionnaireBassDarckfield_1'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_1']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_2'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_2']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_3'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_3']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_4'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_4']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_5'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_5']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_6'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_6']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_7'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_7']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_8'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_8']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_9'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_9']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_10'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_10']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_11'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_11']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_12'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_12']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_13'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_13']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_14'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_14']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_15'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_15']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_16'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_16']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_17'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_17']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_18'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_18']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_19'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_19']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_20'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_20']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_21'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_21']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_22'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_22']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_23'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_23']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_24'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_24']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_25'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_25']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_26'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_26']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_27'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_27']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_28'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_28']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_29'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_29']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_30'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_30']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_31'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_31']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_32'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_32']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_33'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_33']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_34'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_34']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_35'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_35']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_36'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_36']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_37'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_37']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_38'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_38']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_39'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_39']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_40'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_40']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_41'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_41']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_42'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_42']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_43'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_43']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_44'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_44']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_45'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_45']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_46'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_46']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_47'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_47']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_48'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_48']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_49'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_49']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_50'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_50']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_51'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_51']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_52'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_52']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_53'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_53']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_54'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_54']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_55'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_55']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_56'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_56']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_57'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_57']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_58'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_58']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_59'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_59']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_60'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_60']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_61'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_61']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_62'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_62']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_63'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_63']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_64'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_64']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_65'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_65']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_66'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_66']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_67'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_67']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_68'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_68']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_69'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_69']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_70'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_70']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_71'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_71']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_72'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_72']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_73'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_73']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_74'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_74']);
                    $result[$i]['RiskQuestionnaireBassDarckfield_75'] = $modelRiskQuestionnaireBassDarck->decodingValues($RiskQuestionnaireBassDarck['field_75']);
                    $result[$i]['RiskQuestionnaireBassDarckphysical_aggression_1'] = $RiskQuestionnaireBassDarck['physical_aggression_1'];
                    $result[$i]['RiskQuestionnaireBassDarckindirect_aggression_2'] = $RiskQuestionnaireBassDarck['indirect_aggression_2'];
                    $result[$i]['RiskQuestionnaireBassDarckirritation_3'] = $RiskQuestionnaireBassDarck['irritation_3'];
                    $result[$i]['RiskQuestionnaireBassDarcknegativism_4'] = $RiskQuestionnaireBassDarck['negativism_4'];
                    $result[$i]['RiskQuestionnaireBassDarckresentment_5'] = $RiskQuestionnaireBassDarck['resentment_5'];
                    $result[$i]['RiskQuestionnaireBassDarcksuspicion_6'] = $RiskQuestionnaireBassDarck['suspicion_6'];
                    $result[$i]['RiskQuestionnaireBassDarckverbal_aggression_7'] = $RiskQuestionnaireBassDarck['verbal_aggression_7'];
                    $result[$i]['RiskQuestionnaireBassDarckfeeling_guilty_8'] = $RiskQuestionnaireBassDarck['feeling_guilty_8'];
                    $result[$i]['RiskQuestionnaireBassDarckaggressiveness_index'] = $RiskQuestionnaireBassDarck['aggressiveness_index'];
                    $result[$i]['RiskQuestionnaireBassDarckaggressiveness_index_1'] = $modelСhild->scoringDescriptionTextDec50111($RiskQuestionnaireBassDarck['aggressiveness_index']);
                    $result[$i]['RiskQuestionnaireBassDarckincludes_index'] = $RiskQuestionnaireBassDarck['includes_index'];
                    $result[$i]['RiskQuestionnaireBassDarckincludes_index_1'] = $modelСhild->scoringDescriptionTextDec50222($RiskQuestionnaireBassDarck['includes_index']);


                    // $result[$i]['Onefield_1_teacher'] = $modelRiskQuestionnaireOne->field_1_teacher;
                   // $result[$i]['Onefield_2_teacher'] = $modelRiskQuestionnaireOne->field_2_teacher;
                   // $result[$i]['Onefield_3_teacher'] = $modelRiskQuestionnaireOne->field_3_teacher;
                   // $result[$i]['Onefield_4_teacher'] = $modelRiskQuestionnaireOne->field_4_teacher;
                   // $result[$i]['Onefield_5_teacher'] = $modelRiskQuestionnaireOne->field_5_teacher;
                   // $result[$i]['Onefield_6_teacher'] = $modelRiskQuestionnaireOne->field_6_teacher;
                   // $result[$i]['Onefield_7_teacher'] = $modelRiskQuestionnaireOne->field_7_teacher;

                   // $result[$i]['Onefield_1_parent'] = $modelRiskQuestionnaireOne->field_1_parent;
                   // $result[$i]['Onefield_2_parent'] = $modelRiskQuestionnaireOne->field_2_parent;
                   // $result[$i]['Onefield_3_parent'] = $modelRiskQuestionnaireOne->field_3_parent;
                   // $result[$i]['Onefield_4_parent'] = $modelRiskQuestionnaireOne->field_4_parent;
                   // $result[$i]['Onefield_5_parent'] = $modelRiskQuestionnaireOne->field_5_parent;
                   // $result[$i]['Onefield_6_parent'] = $modelRiskQuestionnaireOne->field_6_parent;
                   // $result[$i]['Onefield_7_parent'] = $modelRiskQuestionnaireOne->field_7_parent;
                   // $result[$i]['Oneteacherestimation_parent'] = $modelRiskQuestionnaireOne->estimation_parent;
                   // $result[$i]['One$strItogTab1'] = $modelRiskQuestionnaireOne->estimation_teacher + $modelRiskQuestionnaireOne->estimation_parent;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    //$result[$i][''] = ;
                    ++$i;
                }
            }
           // print_r('<pre>');
           // print_r($result);
           // exit();
            //print_r('<pre>');
            //print_r($result);
            //exit();
        }
         //
         //
         //
/*        print_r('<pre>');
        print_r('Общая база');
        print_r('<br><br><br>');
        print_r($resultList22);
        print_r('<br><br><br>');
        print_r('<br><br><br>');
        print_r('<br><br><br>');
        print_r('</pre>');
        exit();*/

        return $this->render('/risk-common/report-aggression-risk2', [
            'model' => $model,
            'result' => $result,
            'district_items' => $district_items,
            'region_items' => $region_items,
        ]);

    }

    public function actionReportCollectiveRisk($key = 1)
    {
        $model = new RiskAssessmentOrganizationCommon();
        $modelR = new RiskAssessmentCollective();
        $model->key = 'net';

        $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->all(), 'id', 'name'));
        //$region_items = ArrayHelper::merge(['' => 'Выберите регион ...','0'=>'Все'], ArrayHelper::map(Region::find()->where(['district_id' => 1])->all(), 'id', 'name'));
        $region_items = ['0' => 'Все'];

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post()['RiskAssessmentOrganizationCommon'];
            //federal_district_id
            //region_id
            $model->federal_district_id = $post['federal_district_id'];
            $model->region_id = $post['region_id'];
            $model->key = $post['key'];
            $where = [];
            $where += ($post['federal_district_id'] != '0') ? ['organization.federal_district_id' => $post['federal_district_id']] : [];
            $where += ($post['region_id'] != '0') ? ['organization.region_id' => $post['region_id']] : [];
            $where2 = [];
            $where2 += ($post['federal_district_id'] != '0') ? ['federal_district_id' => $post['federal_district_id']] : [];
            $where2 += ($post['region_id'] != '0') ? ['region_id' => $post['region_id']] : [];
            $where3 = [];
            $where3 += ($post['federal_district_id'] != '0') ? ['risk_assessment_key.federal_district_id' => $post['federal_district_id']] : [];
            $where3 += ($post['region_id'] != '0') ? ['risk_assessment_key.region_id' => $post['region_id']] : [];

            $where3123 = [];
            if ($key == 2) {
                $where3123 = ['key_1_4' => '1e3a0f-9e4d4b-9df806-b1a252-c150ca', 'key_5_9' => '6c84fa-5a9c08-dae1e7-219d3a-3314fc', 'key_10_11' => '5aa821-693426-a53e66-df9153-6c39a2'];
            }

            $wherefederal_district_id = ($post['federal_district_id'] != '0') ? ['id' => $post['federal_district_id']] : [];
            $whereregion_id = ($post['region_id'] != '0') ? ['id' => $post['region_id']] : [];
            $district_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(FederalDistrict::find()->where($wherefederal_district_id)->all(), 'id', 'name'));
            $region_items = ArrayHelper::merge(['0' => 'Все'], ArrayHelper::map(Region::find()->where($whereregion_id)->all(), 'id', 'name'));
            $arr = [
                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'fieldTheme5_4_5',
                'risk_assessment_1',
                'risk_assessment_2',
                'risk_assessment_3',
                'risk_assessment_4',
                'risk_assessment_5',
                'risk_assessment_g',
                'risk_assessment',
            ];
            $arr2 = [
                'field_1',
                'field_2',
                'field_3',
                'field_4',
                'field_5',
                'field_6',
                'field_7',
                'field_8',
                'field_9',
                'field_10',
                'field_11',
                'field_12',
                'field_13',
                'field_14',
                'field_15',
                'field_16',
                'field_17',
                'field_18',
                'field_19',
                'field_20',
                'field_21',
                'field_22',
                'field_23',
                'field_24',
            ];
            $resultList2 = [];
            if ($post['key'] == 'da') {

                $rows = (new \yii\db\Query())
                    /*->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.year AS year',
                        'risk_assessment_organization_common.class AS class',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])*/
                    ->from('risk_assessment_key')
                    ->where(['risk_assessment_key.year' => '2023/2024',])
                    ->andWhere($where3)
                    ->andWhere($where3123)
                    ->orderBy([
                        'risk_assessment_key.federal_district_id' => SORT_ASC,
                        'risk_assessment_key.region_id' => SORT_ASC,
                        'risk_assessment_key.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db)->queryAll();

                foreach ($rows as $key => $one) {
                    if ($one['federal_district_id'] != '0' && $one['federal_district_id'] != '' && $one['region_id'] != '0' && $one['region_id'] != '' && $one['municipality_id'] != '0' && $one['municipality_id'] != '') {
                        $resultList2['result'][$key]['title'] = $one['name_responsible_person'];
                        $resultList2['result'][$key]['create_at'] = $one['create_at'];
                        $resultList2['result'][$key]['federal_district_id'] = $one['federal_district_id'];
                        $resultList2['result'][$key]['region_id'] = $one['region_id'];
                        $resultList2['result'][$key]['municipality_id'] = $one['municipality_id'];
                        $resultList2['result'][$key]['name_responsible_person'] = $one['name_responsible_person'];
                        $resultList2['result'][$key]['key'] = $one['key_1_4'];

                        $common = RiskAssessmentOrganizationCommon::find()->where(['key' => $one['key_1_4']])->one();
                        $collective = RiskAssessmentCollective::find()->where(['key' => $one['key_1_4']])->one();
                        $resultList2['result'][$key]['fieldTheme1_1_common_342'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_1']);
                        $resultList2['result'][$key]['fieldTheme1_2_common_342'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_2']);
                        $resultList2['result'][$key]['fieldTheme1_3_common_342'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_3']);
                        $resultList2['result'][$key]['fieldTheme1_4_common_342'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_4']);
                        $resultList2['result'][$key]['fieldTheme1_5_common_342'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_5']);
                        $resultList2['result'][$key]['fieldTheme2_1_common_342'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_1']);
                        $resultList2['result'][$key]['fieldTheme2_2_common_342'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_2']);
                        $resultList2['result'][$key]['fieldTheme2_3_common_342'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_3']);
                        $resultList2['result'][$key]['fieldTheme2_4_common_342'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_4']);
                        $resultList2['result'][$key]['fieldTheme3_1_common_342'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_1']);
                        $resultList2['result'][$key]['fieldTheme3_2_common_342'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_2']);
                        $resultList2['result'][$key]['fieldTheme4_1_common_342'] = Yii::$app->riskComponent->fieldTheme4Decoding($common['fieldTheme4_1']);
                        $resultList2['result'][$key]['fieldTheme5_1_common_342'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_1']);
                        $resultList2['result'][$key]['fieldTheme5_2_common_342'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_2']);
                        $resultList2['result'][$key]['fieldTheme5_3_common_342'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_1_common_342'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_1']);
                        $resultList2['result'][$key]['fieldTheme5_4_2_common_342'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_2']);
                        $resultList2['result'][$key]['fieldTheme5_4_3_common_342'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_4_common_342'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_4']);
                        $resultList2['result'][$key]['fieldTheme5_4_5_common_342'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_5']);
                        $resultList2['result'][$key]['risk_assessment_1_common_342'] = $common['risk_assessment_1'];
                        $resultList2['result'][$key]['risk_assessment_2_common_342'] = $common['risk_assessment_2'];
                        $resultList2['result'][$key]['risk_assessment_3_common_342'] = $common['risk_assessment_3'];
                        $resultList2['result'][$key]['risk_assessment_4_common_342'] = $common['risk_assessment_4'];
                        $resultList2['result'][$key]['risk_assessment_5_common_342'] = $common['risk_assessment_5'];
                        $resultList2['result'][$key]['risk_assessment_g_common_342'] = $common['risk_assessment_g'];
                        $resultList2['result'][$key]['risk_assessment_common_342'] = $common['risk_assessment'];
                        $resultList2['result'][$key]['name_responsible_person'] = $common['name_responsible_person'];

                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_342'] = ($collective[$one2]) ? $collective[$one2] : 0;
                        }
                        $common = RiskAssessmentOrganizationCommon::find()->where(['key' => $one['key_5_9']])->one();
                        $collective = RiskAssessmentCollective::find()->where(['key' => $one['key_5_9']])->one();

                        $resultList2['result'][$key]['fieldTheme1_1_common_486'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_1']);
                        $resultList2['result'][$key]['fieldTheme1_2_common_486'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_2']);
                        $resultList2['result'][$key]['fieldTheme1_3_common_486'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_3']);
                        $resultList2['result'][$key]['fieldTheme1_4_common_486'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_4']);
                        $resultList2['result'][$key]['fieldTheme1_5_common_486'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_5']);
                        $resultList2['result'][$key]['fieldTheme2_1_common_486'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_1']);
                        $resultList2['result'][$key]['fieldTheme2_2_common_486'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_2']);
                        $resultList2['result'][$key]['fieldTheme2_3_common_486'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_3']);
                        $resultList2['result'][$key]['fieldTheme2_4_common_486'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_4']);
                        $resultList2['result'][$key]['fieldTheme3_1_common_486'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_1']);
                        $resultList2['result'][$key]['fieldTheme3_2_common_486'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_2']);
                        $resultList2['result'][$key]['fieldTheme4_1_common_486'] = Yii::$app->riskComponent->fieldTheme4Decoding($common['fieldTheme4_1']);
                        $resultList2['result'][$key]['fieldTheme5_1_common_486'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_1']);
                        $resultList2['result'][$key]['fieldTheme5_2_common_486'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_2']);
                        $resultList2['result'][$key]['fieldTheme5_3_common_486'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_1_common_486'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_1']);
                        $resultList2['result'][$key]['fieldTheme5_4_2_common_486'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_2']);
                        $resultList2['result'][$key]['fieldTheme5_4_3_common_486'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_4_common_486'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_4']);
                        $resultList2['result'][$key]['fieldTheme5_4_5_common_486'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_5']);
                        $resultList2['result'][$key]['risk_assessment_1_common_486'] = $common['risk_assessment_1'];
                        $resultList2['result'][$key]['risk_assessment_2_common_486'] = $common['risk_assessment_2'];
                        $resultList2['result'][$key]['risk_assessment_3_common_486'] = $common['risk_assessment_3'];
                        $resultList2['result'][$key]['risk_assessment_4_common_486'] = $common['risk_assessment_4'];
                        $resultList2['result'][$key]['risk_assessment_5_common_486'] = $common['risk_assessment_5'];
                        $resultList2['result'][$key]['risk_assessment_g_common_486'] = $common['risk_assessment_g'];
                        $resultList2['result'][$key]['risk_assessment_common_486'] = $common['risk_assessment'];
                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_486'] = ($collective[$one2]) ? $collective[$one2] : 0;
                        }
                        $common = RiskAssessmentOrganizationCommon::find()->where(['key' => $one['key_10_11']])->one();
                        $collective = RiskAssessmentCollective::find()->where(['key' => $one['key_10_11']])->one();
                        $resultList2['result'][$key]['fieldTheme1_1_common_2819'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_1']);
                        $resultList2['result'][$key]['fieldTheme1_2_common_2819'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_2']);
                        $resultList2['result'][$key]['fieldTheme1_3_common_2819'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_3']);
                        $resultList2['result'][$key]['fieldTheme1_4_common_2819'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_4']);
                        $resultList2['result'][$key]['fieldTheme1_5_common_2819'] = Yii::$app->riskComponent->fieldTheme1Decoding($common['fieldTheme1_5']);
                        $resultList2['result'][$key]['fieldTheme2_1_common_2819'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_1']);
                        $resultList2['result'][$key]['fieldTheme2_2_common_2819'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_2']);
                        $resultList2['result'][$key]['fieldTheme2_3_common_2819'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_3']);
                        $resultList2['result'][$key]['fieldTheme2_4_common_2819'] = Yii::$app->riskComponent->fieldTheme2Decoding($common['fieldTheme2_4']);
                        $resultList2['result'][$key]['fieldTheme3_1_common_2819'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_1']);
                        $resultList2['result'][$key]['fieldTheme3_2_common_2819'] = Yii::$app->riskComponent->fieldTheme3Decoding($common['fieldTheme3_2']);
                        $resultList2['result'][$key]['fieldTheme4_1_common_2819'] = Yii::$app->riskComponent->fieldTheme4Decoding($common['fieldTheme4_1']);
                        $resultList2['result'][$key]['fieldTheme5_1_common_2819'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_1']);
                        $resultList2['result'][$key]['fieldTheme5_2_common_2819'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_2']);
                        $resultList2['result'][$key]['fieldTheme5_3_common_2819'] = Yii::$app->riskComponent->fieldTheme5Decoding($common['fieldTheme5_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_1_common_2819'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_1']);
                        $resultList2['result'][$key]['fieldTheme5_4_2_common_2819'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_2']);
                        $resultList2['result'][$key]['fieldTheme5_4_3_common_2819'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_3']);
                        $resultList2['result'][$key]['fieldTheme5_4_4_common_2819'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_4']);
                        $resultList2['result'][$key]['fieldTheme5_4_5_common_2819'] = Yii::$app->riskComponent->fieldTheme6Decoding($common['fieldTheme5_4_5']);
                        $resultList2['result'][$key]['risk_assessment_1_common_2819'] = $common['risk_assessment_1'];
                        $resultList2['result'][$key]['risk_assessment_2_common_2819'] = $common['risk_assessment_2'];
                        $resultList2['result'][$key]['risk_assessment_3_common_2819'] = $common['risk_assessment_3'];
                        $resultList2['result'][$key]['risk_assessment_4_common_2819'] = $common['risk_assessment_4'];
                        $resultList2['result'][$key]['risk_assessment_5_common_2819'] = $common['risk_assessment_5'];
                        $resultList2['result'][$key]['risk_assessment_g_common_2819'] = $common['risk_assessment_g'];
                        $resultList2['result'][$key]['risk_assessment_common_2819'] = $common['risk_assessment'];
                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_2819'] = ($collective[$one2]) ? $collective[$one2] : 0;
                        }


                    }
                }
                //ПЕРЕСОБРАТЬ МАССИВ ИЗ ОДНОГО ЗАПРОСА ЕСЛИ ВЫГРУЖАЕМ ИЗ АНКЕТИРОВАНИЯ
                //print_r('<pre>');
                //print_r($resultList2);
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('<br><br><br>');
                //print_r('</pre>');
                //exit();

            } else {
                $rows = (new \yii\db\Query())
                    ->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.year AS year',
                        'risk_assessment_organization_common.class AS class',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])
                    ->from('risk_assessment_organization_common')
                    ->join('inner JOIN', 'organization', 'organization.id = risk_assessment_organization_common.organization_id')
                    ->where(['risk_assessment_organization_common.year' => '2023/2024',])
                    ->andWhere($where)
                    ->orderBy([
                        'organization.federal_district_id' => SORT_ASC,
                        'organization.region_id' => SORT_ASC,
                        'organization.municipality_id' => SORT_ASC,
                    ])
                    ->createCommand(Yii::$app->db_anket)->queryAll();
                $rows2 = (new \yii\db\Query())
                    /*->select([
                        'risk_assessment_organization_common.fieldTheme1_1 AS fieldTheme1_1',
                        'risk_assessment_organization_common.fieldTheme1_2 AS fieldTheme1_2',
                        'risk_assessment_organization_common.fieldTheme1_3 AS fieldTheme1_3',
                        'risk_assessment_organization_common.fieldTheme1_4 AS fieldTheme1_4',
                        'risk_assessment_organization_common.fieldTheme1_5 AS fieldTheme1_5',
                        'risk_assessment_organization_common.fieldTheme2_1 AS fieldTheme2_1',
                        'risk_assessment_organization_common.fieldTheme2_2 AS fieldTheme2_2',
                        'risk_assessment_organization_common.fieldTheme2_3 AS fieldTheme2_3',
                        'risk_assessment_organization_common.fieldTheme2_4 AS fieldTheme2_4',
                        'risk_assessment_organization_common.fieldTheme3_1 AS fieldTheme3_1',
                        'risk_assessment_organization_common.fieldTheme3_2 AS fieldTheme3_2',
                        'risk_assessment_organization_common.fieldTheme4_1 AS fieldTheme4_1',
                        'risk_assessment_organization_common.fieldTheme5_1 AS fieldTheme5_1',
                        'risk_assessment_organization_common.fieldTheme5_2 AS fieldTheme5_2',
                        'risk_assessment_organization_common.fieldTheme5_3 AS fieldTheme5_3',
                        'risk_assessment_organization_common.fieldTheme5_4_1 AS fieldTheme5_4_1',
                        'risk_assessment_organization_common.fieldTheme5_4_2 AS fieldTheme5_4_2',
                        'risk_assessment_organization_common.fieldTheme5_4_3 AS fieldTheme5_4_3',
                        'risk_assessment_organization_common.fieldTheme5_4_4 AS fieldTheme5_4_4',
                        'risk_assessment_organization_common.fieldTheme5_4_5 AS fieldTheme5_4_5',
                        'risk_assessment_organization_common.risk_assessment_1 AS risk_assessment_1',
                        'risk_assessment_organization_common.risk_assessment_2 AS risk_assessment_2',
                        'risk_assessment_organization_common.risk_assessment_3 AS risk_assessment_3',
                        'risk_assessment_organization_common.risk_assessment_4 AS risk_assessment_4',
                        'risk_assessment_organization_common.risk_assessment_5 AS risk_assessment_5',
                        'risk_assessment_organization_common.risk_assessment_g AS risk_assessment_g',
                        'risk_assessment_organization_common.risk_assessment AS risk_assessment',
                        'risk_assessment_organization_common.user_id AS user_id',
                        'risk_assessment_organization_common.organization_id AS organization_id',
                        'risk_assessment_organization_common.create_at AS create_at',
                        'risk_assessment_organization_common.year AS year',
                        'risk_assessment_organization_common.class AS class',
                        'risk_assessment_organization_common.name_responsible_person AS name_responsible_person',
                        'organization.federal_district_id AS federal_district_id',
                        'organization.region_id AS region_id',
                        'organization.municipality_id AS municipality_id',
                        'organization.title AS title',
                        'organization.short_title AS short_title',
                    ])*/
                    ->from('risk_assessment_collective')
                    ->join('inner JOIN', 'organization', 'organization.id = risk_assessment_collective.organization_id')
                    //->where(['risk_assessment_collective.year' => '2023/2024'])
                    ->andWhere($where)
                    ->orderBy([
                        'organization.federal_district_id' => SORT_ASC,
                        'organization.region_id' => SORT_ASC,
                        'organization.municipality_id' => SORT_ASC,
                    ])
                    ->all();
                $resultList = [];
                foreach ($rows as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                        $resultList[$row['organization_id']]['common'][$row['class']] = [
                            'federal_district_id' => $row['federal_district_id'],
                            'region_id' => $row['region_id'],
                            'municipality_id' => $row['municipality_id'],
                            'organization_id' => $row['organization_id'],
                            'title' => $row['title'],
                            'short_title' => $row['short_title'],
                            'user_id' => $row['user_id'],
                            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_1']),
                            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_2']),
                            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_3']),
                            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_4']),
                            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($row['fieldTheme1_5']),
                            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_1']),
                            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_2']),
                            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_3']),
                            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($row['fieldTheme2_4']),
                            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_1']),
                            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($row['fieldTheme3_2']),
                            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($row['fieldTheme4_1']),
                            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_1']),
                            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_2']),
                            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($row['fieldTheme5_3']),
                            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_1']),
                            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_2']),
                            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_3']),
                            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_4']),
                            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme6Decoding($row['fieldTheme5_4_5']),
                            'risk_assessment_1' => $row['risk_assessment_1'],
                            'risk_assessment_2' => $row['risk_assessment_2'],
                            'risk_assessment_3' => $row['risk_assessment_3'],
                            'risk_assessment_4' => $row['risk_assessment_4'],
                            'risk_assessment_5' => $row['risk_assessment_5'],
                            'risk_assessment_g' => $row['risk_assessment_g'],
                            'risk_assessment' => $row['risk_assessment'],
                            'create_at' => $row['create_at'],
                            'name_responsible_person' => $row['name_responsible_person'],
                        ];
                        $resultList[$row['organization_id']]['title'] = $row['title'];
                    }
                }

                foreach ($rows2 as $row) {
                    if ($row['federal_district_id'] != '0' && $row['region_id'] != '0' && $row['municipality_id'] != '0') {
                        $resultList[$row['organization_id']]['collective'][$row['class_collective']] = [
                            'federal_district_id' => $row['federal_district_id'],
                            'class_collective' => $row['class_collective'],
                            'field_1' => $row['field_1'],
                            'field_2' => $row['field_2'],
                            'field_3' => $row['field_3'],
                            'field_4' => $row['field_4'],
                            'field_5' => $row['field_5'],
                            'field_6' => $row['field_6'],
                            'field_7' => $row['field_7'],
                            'field_8' => $row['field_8'],
                            'field_9' => $row['field_9'],
                            'field_10' => $row['field_10'],
                            'field_11' => $row['field_11'],
                            'field_12' => $row['field_12'],
                            'field_13' => $row['field_13'],
                            'field_14' => $row['field_14'],
                            'field_15' => $row['field_15'],
                            'field_16' => $row['field_16'],
                            'field_17' => $row['field_17'],
                            'field_18' => $row['field_18'],
                            'field_19' => $row['field_19'],
                            'field_20' => $row['field_20'],
                            'field_21' => $row['field_21'],
                            'field_22' => $row['field_22'],
                            'field_23' => $row['field_23'],
                            'field_24' => $row['field_24'],
                        ];
                    }
                }


                foreach ($resultList as $key => $one) {
                    if ($one['common']['342']['federal_district_id'] != '0' && $one['common']['342']['federal_district_id'] != '' && $one['common']['342']['region_id'] != '0' && $one['common']['342']['region_id'] != '' && $one['common']['342']['municipality_id'] != '0' && $one['common']['342']['municipality_id'] != '') {
                        $resultList2['result'][$key]['title'] = ($one['common']['342']['title'] !== '') ? $one['common']['342']['title'] : '';
                        $resultList2['result'][$key]['create_at'] = ($one['common']['342']['create_at'] !== '') ? $one['common']['342']['create_at'] : '';
                        $resultList2['result'][$key]['federal_district_id'] = ($one['common']['342']['federal_district_id'] !== '') ? $one['common']['342']['federal_district_id'] : '';
                        $resultList2['result'][$key]['region_id'] = ($one['common']['342']['region_id'] !== '') ? $one['common']['342']['region_id'] : '';
                        $resultList2['result'][$key]['municipality_id'] = ($one['common']['342']['municipality_id'] !== '') ? $one['common']['342']['municipality_id'] : '';
                        $resultList2['result'][$key]['create_at'] = ($one['common']['342']['create_at'] !== '') ? $one['common']['342']['create_at'] : '';
                        $resultList2['result'][$key]['name_responsible_person'] = ($one['common']['name_responsible_person'] !== '') ? $one['common']['name_responsible_person'] : '';
                        foreach ($arr as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_common_342'] = ($one['common']['342'] != []) ? $one['common']['342'][$one2] : 0;
                        }
                        foreach ($arr as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_common_486'] = ($one['common']['486'] != []) ? $one['common']['486'][$one2] : 0;
                        }
                        foreach ($arr as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_common_2819'] = ($one['common']['2819'] != []) ? $one['common']['2819'][$one2] : 0;
                        }
                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_342'] = ($one['collective']['342'] != []) ? $one['collective']['342'][$one2] : 0;
                        }
                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_486'] = ($one['collective']['486'] != []) ? $one['collective']['486'][$one2] : 0;
                        }
                        foreach ($arr2 as $key2 => $one2) {
                            $resultList2['result'][$key][$one2 . '_collective_2819'] = ($one['collective']['2819'] != []) ? $one['collective']['2819'][$one2] : 0;
                        }
                    }
                }
            }


            //print_r('<pre>');
            //print_r($resultList);
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r($rows2);
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r('<pre>');
            //print_r($resultList2['result']);
            //print_r('</pre>');
            //exit();
            $arr3 = [
                'fieldTheme1_1_common_342',
                'fieldTheme1_2_common_342',
                'fieldTheme1_3_common_342',
                'fieldTheme1_4_common_342',
                'fieldTheme1_5_common_342',
                'fieldTheme2_1_common_342',
                'fieldTheme2_2_common_342',
                'fieldTheme2_3_common_342',
                'fieldTheme2_4_common_342',
                'fieldTheme3_1_common_342',
                'fieldTheme3_2_common_342',
                'fieldTheme4_1_common_342',
                'fieldTheme5_1_common_342',
                'fieldTheme5_2_common_342',
                'fieldTheme5_3_common_342',
                'fieldTheme5_4_1_common_342',
                'fieldTheme5_4_2_common_342',
                'fieldTheme5_4_3_common_342',
                'fieldTheme5_4_4_common_342',
                'fieldTheme5_4_5_common_342',
                'risk_assessment_1_common_342',
                'risk_assessment_2_common_342',
                'risk_assessment_3_common_342',
                'risk_assessment_4_common_342',
                'risk_assessment_5_common_342',
                'risk_assessment_g_common_342',
                'risk_assessment_common_342',
                'fieldTheme1_1_common_486',
                'fieldTheme1_2_common_486',
                'fieldTheme1_3_common_486',
                'fieldTheme1_4_common_486',
                'fieldTheme1_5_common_486',
                'fieldTheme2_1_common_486',
                'fieldTheme2_2_common_486',
                'fieldTheme2_3_common_486',
                'fieldTheme2_4_common_486',
                'fieldTheme3_1_common_486',
                'fieldTheme3_2_common_486',
                'fieldTheme4_1_common_486',
                'fieldTheme5_1_common_486',
                'fieldTheme5_2_common_486',
                'fieldTheme5_3_common_486',
                'fieldTheme5_4_1_common_486',
                'fieldTheme5_4_2_common_486',
                'fieldTheme5_4_3_common_486',
                'fieldTheme5_4_4_common_486',
                'fieldTheme5_4_5_common_486',
                'risk_assessment_1_common_486',
                'risk_assessment_2_common_486',
                'risk_assessment_3_common_486',
                'risk_assessment_4_common_486',
                'risk_assessment_5_common_486',
                'risk_assessment_g_common_486',
                'risk_assessment_common_486',
                'fieldTheme1_1_common_2819',
                'fieldTheme1_2_common_2819',
                'fieldTheme1_3_common_2819',
                'fieldTheme1_4_common_2819',
                'fieldTheme1_5_common_2819',
                'fieldTheme2_1_common_2819',
                'fieldTheme2_2_common_2819',
                'fieldTheme2_3_common_2819',
                'fieldTheme2_4_common_2819',
                'fieldTheme3_1_common_2819',
                'fieldTheme3_2_common_2819',
                'fieldTheme4_1_common_2819',
                'fieldTheme5_1_common_2819',
                'fieldTheme5_2_common_2819',
                'fieldTheme5_3_common_2819',
                'fieldTheme5_4_1_common_2819',
                'fieldTheme5_4_2_common_2819',
                'fieldTheme5_4_3_common_2819',
                'fieldTheme5_4_4_common_2819',
                'fieldTheme5_4_5_common_2819',
                'risk_assessment_1_common_2819',
                'risk_assessment_2_common_2819',
                'risk_assessment_3_common_2819',
                'risk_assessment_4_common_2819',
                'risk_assessment_5_common_2819',
                'risk_assessment_g_common_2819',
                'risk_assessment_common_2819',
                'field_1_collective_342',
                'field_2_collective_342',
                'field_3_collective_342',
                'field_4_collective_342',
                'field_5_collective_342',
                'field_6_collective_342',
                'field_7_collective_342',
                'field_8_collective_342',
                'field_9_collective_342',
                'field_10_collective_342',
                'field_11_collective_342',
                'field_12_collective_342',
                'field_13_collective_342',
                'field_14_collective_342',
                'field_15_collective_342',
                'field_16_collective_342',
                'field_17_collective_342',
                'field_18_collective_342',
                'field_19_collective_342',
                'field_20_collective_342',
                'field_21_collective_342',
                'field_22_collective_342',
                'field_23_collective_342',
                'field_24_collective_342',
                'field_1_collective_486',
                'field_2_collective_486',
                'field_3_collective_486',
                'field_4_collective_486',
                'field_5_collective_486',
                'field_6_collective_486',
                'field_7_collective_486',
                'field_8_collective_486',
                'field_9_collective_486',
                'field_10_collective_486',
                'field_11_collective_486',
                'field_12_collective_486',
                'field_13_collective_486',
                'field_14_collective_486',
                'field_15_collective_486',
                'field_16_collective_486',
                'field_17_collective_486',
                'field_18_collective_486',
                'field_19_collective_486',
                'field_20_collective_486',
                'field_21_collective_486',
                'field_22_collective_486',
                'field_23_collective_486',
                'field_24_collective_486',
                'field_1_collective_2819',
                'field_2_collective_2819',
                'field_3_collective_2819',
                'field_4_collective_2819',
                'field_5_collective_2819',
                'field_6_collective_2819',
                'field_7_collective_2819',
                'field_8_collective_2819',
                'field_9_collective_2819',
                'field_10_collective_2819',
                'field_11_collective_2819',
                'field_12_collective_2819',
                'field_13_collective_2819',
                'field_14_collective_2819',
                'field_15_collective_2819',
                'field_16_collective_2819',
                'field_17_collective_2819',
                'field_18_collective_2819',
                'field_19_collective_2819',
                'field_20_collective_2819',
                'field_21_collective_2819',
                'field_22_collective_2819',
                'field_23_collective_2819',
                'field_24_collective_2819',
            ];
            foreach ($resultList2['result'] as $row) {
                $resultList2['region'][$row['region_id']]['count'] += 1;
                $resultList2['okrug'][$row['federal_district_id']]['count'] += 1;
                $resultList2['itog']['count'] += 1;
                foreach ($arr3 as $key => $one) {
                    $resultList2['region'][$row['region_id']][$one] += $row[$one];
                    $resultList2['okrug'][$row['federal_district_id']][$one] += $row[$one];
                    $resultList2['itog'][$one] += $row[$one];
                }
            }


            //print_r('<pre>');
            //print_r($resultList2);
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r('<br><br><br>');
            //print_r($resultList);
            //print_r('</pre>');
            //exit();
        }


        return $this->render('/risk-common/report-collective-risk', [
            'model' => $model,
            'modelR' => $modelR,
            'result' => $resultList2,
            'district_items' => $district_items,
            'region_items' => $region_items,
        ]);

    }

    /* public function actionReportPrintContentQuestionnaire($idKeyAccess)
    {
https://anket.demography.site/risk-common/risk-common/report-print-content-questionnaire?idKeyAccess=4J8kazM9
        if($idKeyAccess == '4J8kazM9'){

            $modelСhilds = RiskChildrenList::find()->all();
            $modelСhilds2 = new RiskChildrenList();
            $result = [];
            foreach ($modelСhilds as $oneСhild){
                $riskCommon = RiskAssessmentOrganizationCommon::find()->where(['key' => $oneСhild['key']])->one();
                $modelRiskQuestionnaireOne = $this->findRiskQuestionnaireOneId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireTwo = $this->findRiskQuestionnaireTwoId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireThree = $this->findRiskQuestionnaireThreeId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireFour = $this->findRiskQuestionnaireFourId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireFive = $this->findRiskQuestionnaireFiveId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireSix = $this->findRiskQuestionnaireSixId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireSpielberger = $this->findRiskQuestionnaireSpielbergerId($oneСhild['id_children_list']);
                $modelRiskQuestionnaireBassDarck = $this->findRiskQuestionnaireBassDarckId($oneСhild['id_children_list']);

                //anxiety тревожность
                $anxiety = Yii::$app->riskComponent->interpretationArr($modelRiskQuestionnaireSpielberger->rt, $modelRiskQuestionnaireSpielberger->lt);
                //приложение 1
                $estimation1 = $modelСhilds2->scoringDescriptionTextDec($modelRiskQuestionnaireOne->estimation);
                $estimation2 = $modelСhilds2->scoringDescriptionTextDec($modelRiskQuestionnaireTwo->estimation);
                $estimation3 = $modelСhilds2->scoringDescriptionTextDec50($modelRiskQuestionnaireThree->estimation);
                $estimation4 = $modelСhilds2->scoringDescriptionTextDec50($modelRiskQuestionnaireFour->estimation);
                $estimation5 = $modelСhilds2->scoringDescriptionTextDec($modelRiskQuestionnaireFive->estimation);
                $estimation6 = $modelСhilds2->scoringDescriptionTextDec($modelRiskQuestionnaireSix->estimation);

                $strItogTab5 = 0;
                $arrName = [
                    ['1. Физическая агрессия к сверстникам (стремление причинить вред с помощью силы)', 'field_1_teacher', 'field_1_parent', ],
                    ['2. Физическая агрессия к учителям', 'field_2_teacher', 'field_2_parent', ],
                    ['3. Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам', 'field_3_teacher', 'field_3_parent', ],
                    ['4. Вербальная агрессия к сверстникам (через угрозы и оскорбления)', 'field_4_teacher', 'field_4_parent', ],
                    ['5. Вербальная агрессия к учителям', 'field_5_teacher', 'field_5_parent', ],
                    ['6. Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам', 'field_6_teacher', 'field_6_parent', ],
                    ['7. Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей', 'field_7_teacher', 'field_7_parent', ],
                ];
                for($i = 0; $i < count($arrName); $i++){
                    $strStroka = 0;
                    $aa1 = ($modelRiskQuestionnaireFive[$arrName[$i][1]] === '1') ? 1 : 0;
                    $aa2 = ($modelRiskQuestionnaireFive[$arrName[$i][2]] === '1') ? 1 : 0;
                    $aa12 = ($modelRiskQuestionnaireFive[$arrName[$i][1]] === '2') ? 1 : 0;
                    $aa22 = ($modelRiskQuestionnaireFive[$arrName[$i][2]] === '2') ? 1 : 0;
                    $strStroka = ($aa1 * 7.14) + ($aa2 * 7.14) + ($aa12 * 3.57) + ($aa22 * 3.57);
                    $strItogTab5 = $strItogTab5 + $strStroka;
                }

                $arrName = [
                    ['1. Агрессивное поведение родителей ', 'field_1_teacher', 'field_1_parent',  'field_1_chile', ],
                    ['2. Агрессивное поведение учителей', 'field_2_teacher', 'field_2_parent',  'field_2_chile', ],
                    ['3. Агрессивное поведение сверстников', 'field_3_teacher', 'field_3_parent',  'field_3_chile', ],
                    ['4. Использование агрессивной информационной среды', 'field_4_teacher', 'field_4_parent',  'field_4_chile', ],
                    ['5. Использование агрессивной игровой среды ', 'field_5_teacher', 'field_5_parent',  'field_5_chile', ],
                    ['6. Иные причины ', 'field_6_teacher', 'field_6_parent',  'field_6_chile', ],
                ];
                $strItogTab6 = 0;
                for($i = 0; $i < count($arrName); $i++){
                    $strStroka = 0;
                    $aa1 = ($modelRiskQuestionnaireSix[$arrName[$i][1]] === '1') ? 1 : 0;
                    $aa2 = ($modelRiskQuestionnaireSix[$arrName[$i][2]] === '1') ? 1 : 0;
                    $aa3 = ($modelRiskQuestionnaireSix[$arrName[$i][3]] === '1') ? 1 : 0;
                    $aa12 = ($modelRiskQuestionnaireSix[$arrName[$i][1]] === '2') ? 1 : 0;
                    $aa22 = ($modelRiskQuestionnaireSix[$arrName[$i][2]] === '2') ? 1 : 0;
                    $aa23 = ($modelRiskQuestionnaireSix[$arrName[$i][3]] === '2') ? 1 : 0;
                    $strStroka = ($aa1 * 5.55) + ($aa2 * 5.55) + ($aa3 * 5.55) + ($aa12 * 2.77) + ($aa22 * 2.77) + ($aa23 * 2.77);
                    $strItogTab6 = $strItogTab6 + $strStroka;
                }
                $arrName = [
                    ['1. Родители как правило не повышают голос на ребенка при общении с ним ', 'field_1_parent', 'field_1_chile', ],
                    ['2. Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах ', 'field_2_parent', 'field_2_chile', ],
                    ['3. Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают ', 'field_3_parent', 'field_3_chile', ],
                    ['4. Родители всегда корректно отзываются об учителях, не давая им негативных оценок ', 'field_4_parent', 'field_4_chile', ],
                    ['5. Родители не запрещают без всяких причин делать то, что разрешалось делать раньше ', 'field_5_parent', 'field_5_chile', ],
                    ['6. Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации ', 'field_6_parent', 'field_6_chile', ],
                    ['7. У ребенка есть любимое занятие по душе ', 'field_7_parent', 'field_7_chile', ],
                    ['8. Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься ', 'field_8_parent', 'field_8_chile', ],
                    ['9. Родители владеют навыками игр и упражнений для снятия тревожности ', 'field_9_parent', 'field_9_chile', ],
                    ['10. Родители умеют спокойно справляться с повышенной тревожностью ребенка ', 'field_10_parent', 'field_10_chile', ],

                ];
                $strItogTab4 = 0;
                for($i = 0; $i < count($arrName); $i++){
                    $strStroka = 0;
                    $aa1 = ($modelRiskQuestionnaireFour[$arrName[$i][1]] !== '' && $modelRiskQuestionnaireFour[$arrName[$i][1]] !== '0') ? 1 : 0;
                    $aa2 = ($modelRiskQuestionnaireFour[$arrName[$i][2]] !== '' && $modelRiskQuestionnaireFour[$arrName[$i][2]] !== '0') ? 1 : 0;
                    $strStroka = ($aa1 * 2.5) + ($aa2 * 2.5);
                    $strItogTab4 = $strItogTab4 + $strStroka;
                }

                $estimation_fin = $modelСhilds2->finalAssessmentText($strItogTab5, $strItogTab6, $strItogTab4);

                $result[$oneСhild['id_children_list']] = [
                    'id_children_list' => $oneСhild['id_children_list'],
                    'federal_district_id' => Yii::$app->myComponent->get_federal_name($riskCommon['federal_district_id']),
                    'region_id' => Yii::$app->myComponent->get_region_name($riskCommon['region_id']),
                    'municipality_id' => Yii::$app->myComponent->get_municipality_name($riskCommon['municipality_id']),
                    'year' => $riskCommon['year'],
                    'class_individual' => Yii::$app->riskComponent->trainingClass($oneСhild['class_individual']),
                    'class' => Yii::$app->riskComponent->trainingClassIndividualName($oneСhild['class']),
                    'classA' => Yii::$app->riskComponent->trainingClassLetter($oneСhild['class_letter']),
                    'testing_date' => $oneСhild['testing_date'],
                    'name_responsible_person_individual' => $oneСhild['name_responsible_person_individual'],


                    'estimation_11111' => ($estimation_fin === 'ОТРИЦАТЕЛЬНО') ? 1 : 0,
                    'estimation_22222' => ($estimation_fin === 'ПОЛОЖИТЕЛЬНО') ? 1 : 0,



                    'anxiety_1' => ($anxiety === 'низкая тревожность') ? 1 : 0,
                    'anxiety_2' => ($anxiety === 'умеренная тревожность') ? 1 : 0,
                    'anxiety_3' => ($anxiety === 'высокая тревожность') ? 1 : 0,
                    'rt' => $modelRiskQuestionnaireSpielberger->rt,
                    'lt' => $modelRiskQuestionnaireSpielberger->lt,

                    'estimation_1' => $modelRiskQuestionnaireOne->estimation,
                    'estimation_1_1_0_28' => ($estimation1 === '0 - 28,55 ') ? 1 : 0,
                    'estimation_1_2_28_71' => ($estimation1 === '28,56 - 71,44') ? 1 : 0,
                    'estimation_1_3_71_100' => ($estimation1 === '71,45 - 100') ? 1 : 0,
                    'estimation_2' => $modelRiskQuestionnaireTwo->estimation,
                    'estimation_2_1_0_28' => ($estimation2 === '0 - 28,55 ') ? 1 : 0,
                    'estimation_2_2_28_71' => ($estimation2 === '28,56 - 71,44') ? 1 : 0,
                    'estimation_2_3_71_100' => ($estimation2 === '71,45 - 100') ? 1 : 0,
                    'estimation_3' => $modelRiskQuestionnaireThree->estimation,
                    'estimation_3_1_0_14' =>   ($estimation3 === '0 - 14.275') ? 1 : 0,
                    'estimation_3_2_14_35' =>  ($estimation3 === '14.276 - 35.72') ? 1 : 0,
                    'estimation_3_3_71_50' => ($estimation3 === '35.73 - 50') ? 1 : 0,
                    'estimation_4' => $modelRiskQuestionnaireFour->estimation,
                    'estimation_4_1_0_14' =>   ($estimation4 === '0 - 14.275') ? 1 : 0,
                    'estimation_4_2_14_35' =>  ($estimation4 === '14.276 - 35.72') ? 1 : 0,
                    'estimation_4_3_71_50' => ($estimation4 === '35.73 - 50') ? 1 : 0,
                    'estimation_5' => $modelRiskQuestionnaireFive->estimation,
                    'estimation_5_1_0_28' => ($estimation5 === '0 - 28,55 ') ? 1 : 0,
                    'estimation_5_2_28_71' => ($estimation5 === '28,56 - 71,44') ? 1 : 0,
                    'estimation_5_3_71_100' => ($estimation5 === '71,45 - 100') ? 1 : 0,
                    'estimation_6' => $modelRiskQuestionnaireSix->estimation,
                    'estimation_6_1_0_28' => ($estimation6 === '0 - 28,55 ') ? 1 : 0,
                    'estimation_6_2_28_71' => ($estimation6 === '28,56 - 71,44') ? 1 : 0,
                    'estimation_6_3_71_100' => ($estimation6 === '71,45 - 100') ? 1 : 0,
                    'aggressiveness_index' => $modelRiskQuestionnaireBassDarck->aggressiveness_index,
                    'includes_index' => $modelRiskQuestionnaireBassDarck->includes_index,




                    //'name_responsible_person_individual' => $modelСhilds->finalAssessmentText($strItogTab5, $strItogTab6, $strItogTab4),
                ];
            }
            //print_r('<pre>');
            //print_r($result);
            //print_r('</pre>');
            //exit();

            return $this->render('/office-child/report', [
                'result' => $result,
              ]);
        } else {
            print_r('поробуй заного');
            exit();
        }


    }*/

    public function actionPrintContentQuestionnairePattern($key, $class)
    {
        $modelСhild = new RiskChildrenList();
        $modelСhild->key = $key;
        $modelСhild->class_individual = $class;
        $modelRiskQuestionnaireOne = new RiskQuestionnaireOne();
        $modelRiskQuestionnaireTwo = new RiskQuestionnaireTwo();
        $modelRiskQuestionnaireThree = new RiskQuestionnaireThree();
        $modelRiskQuestionnaireFour = new RiskQuestionnaireFour();
        $modelRiskQuestionnaireFive = new RiskQuestionnaireFive();
        $modelRiskQuestionnaireSix = new RiskQuestionnaireSix();
        $modelRiskQuestionnaireSpielberger = new RiskQuestionnaireSpielberger();
        $modelRiskQuestionnaireBassDarck = new RiskQuestionnaireBassDarck();
        $this->layout = false;
        $html = '
            <br>
            <div align="center" ><b>ФБУН «Новосибирский НИИ гигиены» Роспотребнадзора в соответствии с МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</b></div>
        ';
        $html .= '</b><h5>Ваш Ключ - ' . $modelСhild->key . '<br>';
        $html .= 'Выборка класса: ' . Yii::$app->riskComponent->trainingClass($modelСhild->class_individual) . '<br>';
        $html .= 'Класс: ' . Yii::$app->riskComponent->trainingClassIndividual($modelСhild->class) . '</h5>';

        $html .= '<div align="center"><b>Оценка уровня реактивной и личностной тревожности (по Ч.Д. Спилбергеру, ЮЛ. Ханину):</b><br>';
        $html .= '<i>Возможные варианты: А - нет, это не так; В - пожалуй, так; С – верно; D - совершенно верно;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы</th>
            </tr>
        ';
        $html .= '
            <tr><td>1. Я спокоен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_1) . '</td></tr> 
            <tr><td>2. Мне ничто не угрожает: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_2) . '</td></tr> 
            <tr><td>3. Я нахожусь в напряжении: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_3) . '</td></tr> 
            <tr><td>4. Я испытываю сожаление: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_4) . '</td></tr> 
            <tr><td>5. Я чувствую себя свободно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_5) . '</td></tr> 
            <tr><td>6. Я расстроен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_6) . '</td></tr> 
            <tr><td>7. Меня волнуют возможные неудачи: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_7) . '</td></tr> 
            <tr><td>8. Я чувствую себя отдохнувшим: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_8) . '</td></tr> 
            <tr><td>9. Я не доволен собой: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_9) . '</td></tr> 
            <tr><td>10. Я испытываю чувство внутреннего удовлетворения: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_10) . '</td></tr> 
            <tr><td>11. Я уверен в себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_11) . '</td></tr> 
            <tr><td>12. Я нервничаю: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_12) . '</td></tr> 
            <tr><td>13. Я не нахожу себе места: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_13) . '</td></tr> 
            <tr><td>14. Я взвинчен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_14) . '</td></tr> 
            <tr><td>15. Я не чувствую скованности, напряженности: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_15) . '</td></tr> 
            <tr><td>16. Я доволен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_16) . '</td></tr> 
            <tr><td>17. Я озабочен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_17) . '</td></tr> 
            <tr><td>18. Я слишком возбужден и мне не по себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_18) . '</td></tr> 
            <tr><td>19. Мне радостно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_19) . '</td></tr> 
            <tr><td>20. Мне приятно: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_20) . '</td></tr> 
            <tr><td>21. Я испытываю удовольствие: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_21) . '</td></tr> 
            <tr><td>22. Я очень быстро устаю: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_22) . '</td></tr> 
            <tr><td>23. Я легко могу заплакать: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_23) . '</td></tr> 
            <tr><td>24. Я хотел бы быть таким же счастливым, как и другие: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_24) . '</td></tr> 
            <tr><td>25. Я проигрываю потому, что недостаточно быстро принимаю решения: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_25) . '</td></tr> 
            <tr><td>26. Обычно я чувствую себя бодрым: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_26) . '</td></tr> 
            <tr><td>27. Я спокоен, хладнокровен и собран: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_27) . '</td></tr> 
            <tr><td>28. Ожидаемые трудности обычно тревожат меня: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_28) . '</td></tr> 
            <tr><td>29. Я слишком переживаю из-за пустяков: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_29) . '</td></tr> 
            <tr><td>30. Я вполне счастлив: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_30) . '</td></tr> 
            <tr><td>31. Я принимаю все слишком близко к сердцу: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_31) . '</td></tr> 
            <tr><td>32. Мне не хватает уверенности в себе: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_32) . '</td></tr> 
            <tr><td>33. Обычно я чувствую себя в безопасности: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_33) . '</td></tr> 
            <tr><td>34. Я стараюсь избегать критических ситуаций: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_34) . '</td></tr> 
            <tr><td>35. У меня бывает хандра: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_35) . '</td></tr> 
            <tr><td>36. Я доволен: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_36) . '</td></tr> 
            <tr><td>37. Всякие пустяки отвлекают и волнуют меня: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_37) . '</td></tr> 
            <tr><td>38. Я так сильно переживаю свои разочарования, что потом долго не могу о них забыть: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_38) . '</td></tr> 
            <tr><td>39. Я уравновешенный человек: </td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_39) . '</td></tr> 
            <tr><td>40. Меня охватывает сильное беспокойство, когда я думаю о своих делах и заботах:</td><td  align="center">' . $modelRiskQuestionnaireSpielberger->decodingValues($modelRiskQuestionnaireSpielberger->field_40) . '</td></tr>

            <tr>
                <th colspan="2">Обработка и интерпретация результатов:</th>
            </tr> 
            <tr>
                <th>Показатель РТ (реактивная тревожность)</th>
                <th align="center">' . $modelRiskQuestionnaireSpielberger->rt . '</th>
            </tr> 
            <tr>
                <th>Показатель ЛТ (личностная тревожность)</th>
                <th align="center">' . $modelRiskQuestionnaireSpielberger->lt . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<div align="center"><b>Опросник на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учителей, родителей (законных представителей), особенно при коротких сроках выполнения:</b><br>';
        $html .= '<i>Возможные варианты: НЕТ; ИНОГДА; почти всегда; всегда;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Учащение дыхания</td>
                <td  align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_1_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_1_parent) . '</td>
            </tr> 
            <tr>
                <td>2. Учащение пульса</th>
                <td align="center" class="text-center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_2_teacher) . '</td>
                <td align="center" class="text-center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_2_parent) . '</td>
            </tr> 
            <tr>
                <td>3. Повышенная потливость</th>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_3_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_3_parent) . '</td>
            </tr> 
            <tr>
                <td>4. Покраснение отдельных участков кожных покровов</th>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_4_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_4_parent) . '</td>
            </tr> 
            <tr>
                <td>5. Нервные тики</th>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_5_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_5_parent) . '</td>
            </tr> 
            <tr>
                <td>6. Навязчивые не контролируемыми повторяющимися движениями (ребёнок постоянно крутит что-то в руках, теребит волосы, грызёт ручку, ногти и т.д.)</th>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_6_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_6_parent) . '</td>
            </tr> 
            <tr>
                <td>7. Иные проявления беспокойства и нервозности </th>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_7_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireOne->decodingValues($modelRiskQuestionnaireOne->field_7_parent) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="2">' . $modelRiskQuestionnaireOne->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<div align="center"><b>Опросник индикации возможных причин тревожности:</b><br>';
        $html .= '<i>Возможные варианты: ДА; НЕТ;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Завышенные требования учителей, не адекватные возможностям </td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_1_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_1_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_1_chile) . '</td>
            </tr> 
            <tr>
                <td>2. Завышенные требования родителей, не адекватные возможностям </td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_2_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_2_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_2_chile) . '</td>
            </tr> 
            <tr>
                <td>3. Грубость и приказной тон в общении со стороны учителей </td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_3_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_3_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_3_chile) . '</td>
            </tr> 
            <tr>
                <td>4. Грубость и приказной тон в общении со родителей (законных представителей)</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_4_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_4_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_4_chile) . '</td>
            </tr> 
            <tr>
                <td>5. Грубость и приказной тон в общении со сверстниками</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_5_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_5_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_5_chile) . '</td>
            </tr> 
            <tr>
                <td>6. Противоречивость предъявляемых к ребенку требований со стороны учителей</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_6_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_6_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_6_chile) . '</td>
            </tr> 
            <tr>
                <td>7. Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей)</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_7_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_7_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_7_chile) . '</td>
            </tr> 
            <tr>
                <td>8. Иные причины</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_8_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_8_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireTwo->decodingValues($modelRiskQuestionnaireTwo->field_8_chile) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="3">' . $modelRiskQuestionnaireTwo->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<br><br><br><br><br><div align="center"><b>Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя):</b><br>';
        $html .= '<i>Возможные варианты: ДА; НЕТ;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы респондента</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Учителя преимущественно обращается к ребенку по имени</td>
                <td  align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_1_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_1_parent) . '</td>
            </tr> 
            <tr>
                <td>2. Учителя объясняет новый материал на понятных примерах</th>
                <td align="center" class="text-center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_2_teacher) . '</td>
                <td align="center" class="text-center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_2_parent) . '</td>
            </tr> 
            <tr>
                <td>3. При объяснении нового материала ученик как правило испытывает интерес к процессу освоения новых знаний</th>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_3_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_3_parent) . '</td>
            </tr> 
            <tr>
                <td>4. Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения</th>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_4_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_4_parent) . '</td>
            </tr> 
            <tr>
                <td>5. При опросе ребенка учителя, как правило, не спрашивают его первым</th>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_5_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_5_parent) . '</td>
            </tr> 
            <tr>
                <td>6. Учителя регулярно хвалят ребенка при всех, даже за небольшие успехи</th>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_6_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_6_parent) . '</td>
            </tr> 
            <tr>
                <td>7. Учителя как правило, не акцентирует внимание коллектива на слабых сторонах ребенка </th>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_7_teacher) . '</td>
                <td align="center">' . $modelRiskQuestionnaireThree->decodingValues($modelRiskQuestionnaireThree->field_7_parent) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="2">' . $modelRiskQuestionnaireThree->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<div align="center"><b>Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей:</b><br>';
        $html .= '<i>Возможные варианты: ДА; НЕТ;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Родители как правило не повышают голос на ребенка при общении с ним</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_1_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_1_parent) . '</td>
            </tr> 
            <tr>
                <td>2. Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_2_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_2_parent) . '</td>
            </tr> 
            <tr>
                <td>3. Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_3_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_3_parent) . '</td>
            </tr>
            <tr>
                <td>4. Родители всегда корректно отзываются об учителях, не давая им негативных оценок</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_4_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_4_parent) . '</td>
            </tr> 
            <tr>
                <td>5. Родители не запрещают без всяких причин делать то, что разрешалось делать раньше</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_5_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_5_parent) . '</td>
            </tr> 
            <tr>
                <td>6. Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_6_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_6_parent) . '</td>
            </tr> 
            <tr>
                <td>7. У ребенка есть любимое занятие по душе</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_7_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_7_parent) . '</td>
            </tr> 
            <tr>
                <td>8. Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_8_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_8_parent) . '</td>
            </tr> 
            <tr>
                <td>9. Родители владеют навыками игр и упражнений для снятия тревожности</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_9_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_9_parent) . '</td>
            </tr> 
            <tr>
                <td>10. Родители умеют спокойно справляться с повышенной тревожностью ребенка</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_10_chile) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFour->decodingValues($modelRiskQuestionnaireFour->field_10_parent) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="2">' . $modelRiskQuestionnaireFour->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<br><br><br><br><br><br><div align="center"><b>Опросник формы проявления агрессии у ребенка:</b><br>';
        $html .= '<i>Возможные варианты: ДА; НЕТ;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
             <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Физическая агрессия к сверстникам (стремление причинить вред с помощью силы)</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_1_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_1_parent) . '</td>
            </tr> 
            <tr>
                <td>2. Физическая агрессия к учителям</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_2_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_2_parent) . '</td>
            </tr> 
            <tr>
                <td>3. Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_3_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_3_parent) . '</td>
            </tr> 
            <tr>
                <td>4. Вербальная агрессия к сверстникам (через угрозы и оскорбления)</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_4_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_4_parent) . '</td>
            </tr> 
            <tr>
                <td>5. Вербальная агрессия к учителям</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_5_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_5_parent) . '</td>
            </tr> 
            <tr>
                <td>6. Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_6_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_6_parent) . '</td>
            </tr>
            <tr>
                <td>7. Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_7_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireFive->decodingValues($modelRiskQuestionnaireFive->field_7_parent) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="2">' . $modelRiskQuestionnaireFive->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';


        $html .= '<div align="center"><b>Опросник индикации возможных причин агрессивности ребенка:</b><br>';
        $html .= '<i>Возможные варианты: ДА; НЕТ; затрудняюсь с ответом;</i></div>';
        $html .= '<table border="1" style="border-collapse: collapse;">
             <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы классного руководителя</th>
                 <th class="text-center">Ответы родителей</th>
                 <th class="text-center">Ответы респондента</th>
            </tr>
        ';
        $html .= '
            <tr>
                <td>1. Агрессивное поведение родителей</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_1_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_1_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_1_chile) . '</td>
            </tr> 
            <tr>
                <td>2. Агрессивное поведение учителей</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_2_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_2_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_2_chile) . '</td>
            </tr> 
            <tr>
                <td>3. Агрессивное поведение сверстников</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_3_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_3_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_3_chile) . '</td>
            </tr> 
            <tr>
                <td>4. Использование агрессивной информационной среды</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_4_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_4_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_4_chile) . '</td>
            </tr> 
            <tr>
                <td>5. Использование агрессивной игровой среды</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_5_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_5_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_5_chile) . '</td>
            </tr> 
            <tr>
                <td>6. Иные причины</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_6_teacher) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_6_parent) . '</td>
                <td  align="center">' . $modelRiskQuestionnaireSix->decodingValues($modelRiskQuestionnaireSix->field_6_chile) . '</td>
            </tr> 
            <tr>
                <th>Оценка</th>
                <th align="center" colspan="3">' . $modelRiskQuestionnaireSix->estimation . '</th>
            </tr> 
        ';
        $html .= '</table>';

        $html .= '<br><h5 align="center">Опросник индикации возможных причин агрессивности ребенка:</h5>';
        $html .= '<table border="1" style="border-collapse: collapse; //убираем пустые промежутки между ячейками margin-top: -50px;">
            <tr>
                 <th class="text-center">Вопрос</th>
                 <th class="text-center">Ответы</th>
            </tr>
        ';

        $html .= '
            <tr><td>1. Временами я не могу справиться с желанием причинить вред другим</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_1) . '</td></tr> 
            <tr><td>2. Иногда сплетничаю о людях, которых не люблю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_2) . '</td></tr> 
            <tr><td>3. Я легко раздражаюсь, но быстро успокаиваюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_3) . '</td></tr> 
            <tr><td>4. Если меня не попросят по-хорошему, я не выполню</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_4) . '</td></tr> 
            <tr><td>5. Я не всегда получаю то, что мне положено</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_5) . '</td></tr> 
            <tr><td>6. Я не знаю, что люди говорят обо мне за моей спиной</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_6) . '</td></tr> 
            <tr><td>7. Если я не одобряю поведение друзей, я даю им это почувствовать</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_7) . '</td></tr> 
            <tr><td>8. Когда мне случалось обмануть кого-нибудь, я испытывал мучительные угрызения совести</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_8) . '</td></tr> 
            <tr><td>9. Мне кажется, что я не способен ударить человека</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_9) . '</td></tr> 
            <tr><td>10. Я никогда не раздражаюсь настолько, чтобы кидаться предметами</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_10) . '</td></tr> 
            <tr><td>11. Я всегда снисходителен к чужим недостаткам</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_11) . '</td></tr> 
            <tr><td>12. Если мне не нравится установленное правило, мне хочется нарушить его</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_12) . '</td></tr> 
            <tr><td>13. Другие умеют почти всегда пользоваться благоприятными обстоятельствами</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_13) . '</td></tr> 
            <tr><td>14. Я держусь настороженно с людьми, которые относятся ко мне несколько более дружественно, чем я ожидал</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_14) . '</td></tr> 
            <tr><td>15. Я часто бываю несогласен с людьми</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_15) . '</td></tr> 
            <tr><td>16. Иногда мне на ум приходят мысли, которых я стыжусь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_16) . '</td></tr> 
            <tr><td>17. Если кто-нибудь первым ударит меня, я не отвечу ему</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_17) . '</td></tr> 
            <tr><td>18. Когда я раздражаюсь, я хлопаю дверями</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_18) . '</td></tr> 
            <tr><td>19. Я гораздо более раздражителен, чем кажется</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_19) . '</td></tr> 
            <tr><td>20. Если кто-то воображает себя начальником, я всегда поступаю ему наперекор</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_20) . '</td></tr> 
            <tr><td>21. Меня немного огорчает моя судьба</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_21) . '</td></tr> 
            <tr><td>22. Я думаю, что многие люди не любят меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_22) . '</td></tr> 
            <tr><td>23. Я не могу удержаться от спора, если люди не согласны со мной</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_23) . '</td></tr> 
            <tr><td>24. Люди, увиливающие от работы, должны испытывать чувство вины</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_24) . '</td></tr> 
            <tr><td>25. Тот, кто оскорбляет меня и мою семью, напрашивается на драку</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_25) . '</td></tr> 
            <tr><td>26. Я не способен на грубые шутки</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_26) . '</td></tr> 
            <tr><td>27. Меня охватывает ярость, когда надо мной насмехаются</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_27) . '</td></tr> 
            <tr><td>28. Когда люди строят из себя начальников, я делаю все, чтобы они не зазнавались</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_28) . '</td></tr> 
            <tr><td>29. Почти каждую неделю я вижу кого-нибудь, кто мне не нравится</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_29) . '</td></tr> 
            <tr><td>30. Довольно многие люди завидуют мне</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_30) . '</td></tr> 
            <tr><td>31. Я требую, чтобы люди уважали меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_31) . '</td></tr> 
            <tr><td>32. Меня угнетает то, что я мало делаю для своих родителей</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_32) . '</td></tr> 
            <tr><td>33. Люди, которые постоянно изводят вас, стоят того, чтобы их "щелкнули по носу"</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_33) . '</td></tr> 
            <tr><td>34. Я никогда не бываю мрачен от злости</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_34) . '</td></tr> 
            <tr><td>35. Если ко мне относятся хуже, чем я того заслуживаю, я не расстраиваюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_35) . '</td></tr> 
            <tr><td>36. Если кто-то выводит меня из себя, я не обращаю внимания</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_36) . '</td></tr> 
            <tr><td>37. Хотя я и не показываю этого, меня иногда гложет зависть</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_37) . '</td></tr> 
            <tr><td>38. Иногда мне кажется, что надо мной смеются</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_38) . '</td></tr> 
            <tr><td>39. Даже если я злюсь, я не прибегаю к "сильным" выражениям</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_39) . '</td></tr> 
            <tr><td>40. Мне хочется, чтобы мои грехи были прощены</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_40) . '</td></tr> 
            <tr><td>41. Я редко даю сдачи, даже если кто-нибудь ударит меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_41) . '</td></tr> 
            <tr><td>42. Когда получается не, по-моему, я иногда обижаюсь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_42) . '</td></tr> 
            <tr><td>43. Иногда люди раздражают меня одним своим присутствием</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_43) . '</td></tr> 
            <tr><td>44. Нет людей, которых бы я по-настоящему ненавидел</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_44) . '</td></tr> 
            <tr><td>45. Мой принцип: "Никогда не доверять "чужакам"</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_45) . '</td></tr> 
            <tr><td>46. Если кто-нибудь раздражает меня, я готов сказать, что я о нем думаю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_46) . '</td></tr> 
            <tr><td>47. Я делаю много такого, о чем впоследствии жалею</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_47) . '</td></tr> 
            <tr><td>48. Если я разозлюсь, я могу ударить кого-нибудь</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_48) . '</td></tr> 
            <tr><td>49. С детства я никогда не проявлял вспышек гнева</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_49) . '</td></tr> 
            <tr><td>50. Я часто чувствую себя как пороховая бочка, готовая взорваться</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_50) . '</td></tr> 
            <tr><td>51. Если бы все знали, что я чувствую, меня бы считали человеком, с которым нелегко работать</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_51) . '</td></tr> 
            <tr><td>52. Я всегда думаю о том, какие тайные причины заставляют людей делать что-нибудь приятное для меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_52) . '</td></tr> 
            <tr><td>53. Когда на меня кричат, я начинаю кричать в ответ</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_53) . '</td></tr> 
            <tr><td>54. Неудачи огорчают меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_54) . '</td></tr> 
            <tr><td>55. Я дерусь не реже и не чаще чем другие</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_55) . '</td></tr> 
            <tr><td>56. Я могу вспомнить случаи, когда я был настолько зол, что хватал попавшуюся мне под руку вещь и ломал ее</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_56) . '</td></tr> 
            <tr><td>57. Иногда я чувствую, что готов первым начать драку</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_57) . '</td></tr> 
            <tr><td>58. Иногда я чувствую, что жизнь поступает со мной несправедливо</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_58) . '</td></tr> 
            <tr><td>59. Раньше я думал, что большинство людей говорит правду, но теперь я в это не верю</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_59) . '</td></tr> 
            <tr><td>60. Я ругаюсь только со злости</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_60) . '</td></tr> 
            <tr><td>61. Когда я поступаю неправильно, меня мучает совесть</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_61) . '</td></tr> 
            <tr><td>62. Если для защиты своих прав мне нужно применить физическую силу, я применяю ее</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_62) . '</td></tr> 
            <tr><td>63. Иногда я выражаю свой гнев тем, что стучу кулаком по столу</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_63) . '</td></tr> 
            <tr><td>64. Я бываю грубоват по отношению к людям, которые мне не нравятся</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_64) . '</td></tr> 
            <tr><td>65. У меня нет врагов, которые бы хотели мне навредить</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_65) . '</td></tr> 
            <tr><td>66. Я не умею поставить человека на место, даже если он того заслуживает</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_66) . '</td></tr> 
            <tr><td>67. Я часто думаю, что жил неправильно</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_67) . '</td></tr> 
            <tr><td>68. Я знаю людей, которые способны довести меня до драки</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_68) . '</td></tr> 
            <tr><td>69. Я не огорчаюсь из-за мелочей</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_69) . '</td></tr> 
            <tr><td>70. Мне редко приходит в голову, что люди пытаются разозлить или оскорбить меня</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_70) . '</td></tr> 
            <tr><td>71. Я часто только угрожаю людям, хотя и не собираюсь приводить угрозы в исполнение</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_71) . '</td></tr> 
            <tr><td>72. В последнее время я стал занудой</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_72) . '</td></tr> 
            <tr><td>73. В споре я часто повышаю голос</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_73) . '</td></tr> 
            <tr><td>74. Я стараюсь обычно скрывать свое плохое отношение к людям</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_74) . '</td></tr> 
            <tr><td>75. Я лучше соглашусь с чем-либо, чем стану спорить</td><td  align="center">' . $modelRiskQuestionnaireBassDarck->decodingValues($modelRiskQuestionnaireBassDarck->field_75) . '</td></tr> 
       
            <tr>
                <th colspan="2">Оценка</th>
            </tr> 
            
            <tr><td>Физическая агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->physical_aggression_1 . '</th></tr> 
            <tr><td>Косвенная агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->indirect_aggression_2 . '</th></tr> 
            <tr><td>Раздражение:</td><th>' . $modelRiskQuestionnaireBassDarck->irritation_3 . '</th></tr> 
            <tr><td>Негативизм:</td><th>' . $modelRiskQuestionnaireBassDarck->negativism_4 . '</th></tr> 
            <tr><td>Обида:</td><th>' . $modelRiskQuestionnaireBassDarck->resentment_5 . '</th></tr> 
            <tr><td>Подозрительность:</td><th>' . $modelRiskQuestionnaireBassDarck->suspicion_6 . '</th></tr> 
            <tr><td>Вербальная агрессия:</td><th>' . $modelRiskQuestionnaireBassDarck->verbal_aggression_7 . '</th></tr> 
            <tr><td>Чувство вины:</td><th>' . $modelRiskQuestionnaireBassDarck->feeling_guilty_8 . '</th></tr>
            <tr><td><b>Индекс агрессивности:</b></td><th>' . $modelRiskQuestionnaireBassDarck->aggressiveness_index . '</th></tr>
            <tr><td><b>Индекс враждебности:</b></td><th>' . $modelRiskQuestionnaireBassDarck->includes_index . '</th></tr>
        ';
        $html .= '</table>';
        $mpdf = new Mpdf([
            'margin_top' => 5,
            'margin_left' => 20,
            'margin_right' => 10,
            //'mirrorMargins' => true
            //Установлено значение 1, в документе будут отображаться значения левого и правого полей на нечетных и четных страницах, т. е. они станут внутренними и внешними полями.
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Оценка уровня агрессии Шаблон.pdf', 'I'); //D - скачает файл!

        //Yii::$app->session->setFlash('error', 'Данных не найдены!');
        //return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findRiskQuestionnaireSpielbergerId($id)
    {
        if (($model = RiskQuestionnaireSpielberger::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireBassDarckId($id)
    {
        if (($model = RiskQuestionnaireBassDarck::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskChildrenListId($id)
    {
        if (($model = RiskChildrenList::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireOneId($id)
    {
        if (($model = RiskQuestionnaireOne::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireTwoId($id)
    {
        if (($model = RiskQuestionnaireTwo::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireThreeId($id)
    {
        if (($model = RiskQuestionnaireThree::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireFourId($id)
    {
        if (($model = RiskQuestionnaireFour::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireFiveId($id)
    {
        if (($model = RiskQuestionnaireFive::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskQuestionnaireSixId($id)
    {
        if (($model = RiskQuestionnaireSix::find()->where(['id_children_list' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Возникла ошибка, обновите страницу.');
    }

    protected function findRiskChildrenList($key, $class)
    {
        if (($model = RiskChildrenList::find()->where([])->one()) !== null) {
            return $model;
        } else {
            return new RiskChildrenList();
        }

    }

    protected function findRiskChildrenListKey($key, $class)
    {
        if (($model = RiskChildrenList::find()->where(['key' => $key])->one()) !== null) {
            return $model;
        } else {
            return new RiskChildrenList();
        }

    }

    protected function findRiskQuestionnaireOne($key, $class)
    {
        if (($model = RiskQuestionnaireOne::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_one' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireOne();
        }

    }

    protected function findRiskQuestionnaireTwo($key, $class)
    {
        if (($model = RiskQuestionnaireTwo::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_two' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireTwo();
        }

    }

    protected function findRiskQuestionnaireThree($key, $class)
    {
        if (($model = RiskQuestionnaireThree::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_three' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireThree();
        }

    }

    protected function findRiskQuestionnaireFour($key, $class)
    {
        if (($model = RiskQuestionnaireFour::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_four' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireFour();
        }

    }

    protected function findRiskQuestionnaireFive($key, $class)
    {
        if (($model = RiskQuestionnaireFive::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_five' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireFive();
        }

    }

    protected function findRiskQuestionnaireSix($key, $class)
    {
        if (($model = RiskQuestionnaireSix::find()->where(['class_individual' => $class, 'key' => $key])->orderBy(['id_questionnaire_six' => SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            return new RiskQuestionnaireSix();
        }

    }

    protected function findModelId($id)
    {
        if (($model = RiskAssessmentOrganizationCommon::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelIdIndividual($id)
    {
        if (($model = RiskAssessmentIndividualCommon::find()->where(['id_individual' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelKey($key)
    {
        if (($model = RiskAssessmentOrganizationCommon::find()->where(['key' => $key])->one()) !== null) {
            return $model;
        } else {
            return;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
