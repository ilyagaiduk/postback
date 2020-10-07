<?php
namespace app\models;

use Yii;
use yii\base\Model;
class Postback extends Model
{
public function SavePostback() {
    $data = [
        "/postback.php?cid=4440974dsye2sy0256&campaign_id=211&time=1596407855299333&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
        "/postback.php?cid=0984dsye2sy0256&campaign_id=211&time=1596407855299999&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
        "/postback.php?cid=0984dsye2sy0256&campaign_id=211&time=1596407855299444&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
        "/postback.php?cid=0984dsye2sy0256&campaign_id=211&time=1596407855299&sub1=20080217370005d310ff014bf7bd58add6cf&event=install",
        "/postback.php?cid=0984dsye2sy0256&campaign_id=211&time=1596407855299&sub1=20080217370005d310ff014bf7bd58add6cf&event=trial",
        "/postback.php?cid=2220974dsye2sy0256&campaign_id=212&time=1596407855299333&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
    "/postback.php?cid=0974dsye2sy0256&campaign_id=212&time=1596407855299999&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
    "/postback.php?cid=0974dsye2sy0256&campaign_id=212&time=1596407855299444&sub1=20080217370005d310ff014bf7bd58add6cf&event=click",
    "/postback.php?cid=0974dsye2sy0256&campaign_id=212&time=1596407855299&sub1=20080217370005d310ff014bf7bd58add6cf&event=install",
    "/postback.php?cid=0974dsye2sy0256&campaign_id=212&time=1596407855299&sub1=20080217370005d310ff014bf7bd58add6cf&event=trial"
    ];
    foreach ($data as $value) {
        $query = parse_url($value, PHP_URL_QUERY);
        parse_str($query, $result);
        if ($result['event'] == 'click') {
            $clikId = Sumback::find()
                ->select('cid')
                ->where(['cid' => $result['cid']])
                ->exists();
            if (empty($clikId)) {
                // вставить новую строку данных
                $newClick = new Sumback();
                $newClick->cid = $result['cid'];
                $newClick->campaign_id = $result['campaign_id'];
                $newClick->clicks = 1;
                $newClick->trials = 0;
                $newClick->installs = 0;
                $newClick->save();
            } else {
                    Sumback::updateAllCounters(['clicks' => 1]);

            }
        }
        elseif ($result['event'] == 'install') {
            $upCount = Sumback::find()->where(['cid' => $result['cid']])->one();
           if(isset($upCount)) $upCount->updateAllCounters(['installs' => 1]);
        } elseif ($result['event'] == 'trial') {
            $upCount = Sumback::find()->where(['cid' => $result['cid']])->one();
            if(isset($upCount)) $upCount->updateAllCounters(['trials' => 1]);
        }


    }


return "Данные обновлены";

}
}