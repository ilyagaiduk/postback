<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Таблица постбеков';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <table class="table table-responsive">
        <th>ID</th>
        <th>Clicks</th>
        <th>Installs</th>
        <th>CRI,%</th>
        <th>Trials</th>
        <th>CRti, %</th>
        <?php
        foreach($data as $key=>$value) {
               echo "<tr><td>{$key}</td>";
               echo "<td>{$value[0]}</td>";
                echo "<td>{$value[1]}</td>";
                echo "<td>".number_format($value[3], 2, '.', '')."</td>";
                echo "<td>{$value[2]}</td>";
                echo "<td>".number_format($value[4], 2, '.', '')."</td></tr>";



        }
        ?>
    </table>
    </p>


</div>
