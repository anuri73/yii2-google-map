<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 08.02.2017
 * Time: 13:11
 *
 * @var \yii\web\View $this
 * @var sonkei\gmap\Widget $widget
 * @var array $options
 */
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

$labelOptions = ArrayHelper::remove($options, 'labelOptions', []);
$label = ArrayHelper::remove($labelOptions, 'label', 'Location: ');
$id = ArrayHelper::remove($options, 'id', $widget->id . "-search-input");
$widget->setPluginOptions([
    'inputBinding' => [
        'locationNameInput' => new JsExpression("$('#{$id}')")
    ]
]);
$options['id'] = $id;
?>

<div class="form-group">
    <?= Html::label($label, $id, $labelOptions); ?>
    <?= Html::textInput($id, null, $options); ?>
</div>
