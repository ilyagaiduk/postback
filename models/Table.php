<?php


namespace app\models;

use Yii;
use yii\base\Model;
class Table extends Model
{
    public function summaryTable() {
        $campaign = Sumback::find()
            ->select('campaign_id')
            ->groupBy('campaign_id')
            ->all();
        $arr = [];
        foreach($campaign as $key) {
            $sumClick = (new \yii\db\Query())->from('sumback')->where(['campaign_id' => $key->campaign_id]);
            $Clicks = $sumClick->sum('clicks');
            $sumInstalls = (new \yii\db\Query())->from('sumback')->where(['campaign_id' => $key->campaign_id]);
        $Installs = $sumInstalls->sum('installs');
            $sumTrials = (new \yii\db\Query())->from('sumback')->where(['campaign_id' => $key->campaign_id]);
            $Trials = $sumTrials->sum('trials');


            $CRi = ($Installs/$Clicks) * 100;
            $CRti = ($Trials/$Installs) * 100;
            $i = 0;
            $arr[$key->campaign_id][$i++] = $Clicks;
            $arr[$key->campaign_id][$i++] = $Installs;
            $arr[$key->campaign_id][$i++] = $Trials;
            $arr[$key->campaign_id][$i++] = $CRi;
            $arr[$key->campaign_id][$i++] = $CRti;
        }
        return $arr;
    }

}