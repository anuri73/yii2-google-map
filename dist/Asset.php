<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 08.02.2017
 * Time: 13:08
 */

namespace sonkei\gmap;

use yii\web\AssetBundle;

/**
 * Class Asset
 * @package sonkei\gmap
 */
class Asset extends AssetBundle
{
    /** @inheritdoc */
    public $css = [
        'css/style.css'
    ];
    /** @inheritdoc */
    public $js = [
        'js/locationpicker.jquery.min.js',
    ];
    /** @inheritdoc */
    public $sourcePath = "@sonkei/gmap/assets";
    /** @inheritdoc */
    public $depends = [
        'sonkei\gmap\GoogleAsset'
    ];
    /** @inheritdoc */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
}