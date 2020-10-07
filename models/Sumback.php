<?php


namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Sumback extends ActiveRecord
{
    public function getAll() {
        $allPostbeks = Sumback::find()
            ->all();
        return $allPostbeks;
    }
}