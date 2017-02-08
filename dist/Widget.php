<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 08.02.2017
 * Time: 13:04
 */

namespace sonkei\gmap;

use yii\base\Widget as BaseWidget;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Class Widget
 * @package sonkei\gmap
 *
 * @property array $options Widget options
 * @property array $pluginOptions Plugin options
 */
class Widget extends BaseWidget
{
    #region Options
    public $template = "{beginContainer} {searchInput} {lat} {lon} {map} {endContainer}";
    /**
     * @var null|Callable
     */
    public $searchInputView = null;
    #endregion

    #region Core
    /** @inheritdoc */
    function init()
    {
        $this->registerAssets();
        if (null == $this->searchInputView) {
            $this->searchInputView = "renderSearchInput";
        }
    }

    /** @inheritdoc */
    function run()
    {
        $content = $this->wrapContainer($this->template);
        $content = $this->wrapSearchInput($content);
        $content = $this->wrapMap($content);
        $content = $this->renderHiddenInputs($content);
        $this->registerPlugin();
        return $content;
    }

    /**
     * Render search input
     * @param static $widget
     * @param array $options
     * @return string
     */
    function renderSearchInput($widget, $options)
    {
        return $this->render('search_input', [
            'widget' => $widget,
            'options' => $options
        ]);
    }

    #endregion

    #region Widget options
    protected $_options = [
        'container' => [
            'tag' => 'div'
        ],
        'searchInput' => [
            'labelOptions' => [
                'label' => 'Location: '
            ]
        ],
        'map' => [
            'class' => 'map-box'
        ],
        'latOptions' => [

        ]
    ];

    /**
     * Get widget options
     * @return array Options for the widget
     */
    function getOptions()
    {
        return $this->_options;
    }

    /**
     * Set widget options
     * @param array $options Options that should be applied
     */
    function setOptions($options)
    {
        $this->_options = ArrayHelper::merge($this->_options, $options);
    }
    #endregion

    #region Plugin options
    protected $_pluginOptions = [
        'radius' => 1,
        'enableAutocomplete' => true
    ];

    /**
     * Get plugin options
     * @return array Options for the widget
     */
    function getPluginOptions()
    {
        return $this->_pluginOptions;
    }

    /**
     * Set plugin options
     * @param array $options Options that should be applied
     */
    function setPluginOptions($options)
    {
        $this->_pluginOptions = ArrayHelper::merge($this->_pluginOptions, $options);
    }
    #endregion

    #region Widget parts
    /**
     * Wrap content to container
     * @param string $content
     * @return string
     */
    protected function wrapContainer(string $content = "")
    {
        $options = ArrayHelper::remove($this->_options, 'container', []);
        if (!array_key_exists('id', $options)) {
            $options['id'] = $this->id;
        }
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return strtr($content, [
            '{beginContainer}' => Html::beginTag($tag, $options),
            '{endContainer}' => Html::endTag($tag)
        ]);
    }

    /**
     * Wrap search input
     * @param string $content
     * @return string
     */
    protected function wrapSearchInput(string $content = "")
    {
        $options = ArrayHelper::remove($this->_options, 'searchInput', []);
        return strtr($content, [
            '{searchInput}' => call_user_func_array([$this, $this->searchInputView], [
                'widget' => $this,
                'options' => $options
            ])
        ]);
    }

    /**
     * Wrap map box
     * @param string $content
     * @return string
     */
    protected function wrapMap(string $content = "")
    {
        $options = ArrayHelper::remove($this->_options, 'map', []);
        if (!array_key_exists('id', $options)) {
            $options['id'] = $this->id . "-map";
        }
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return strtr($content, [
            '{map}' => Html::tag($tag, null, $options),
        ]);
    }

    /**
     * Wrap hidden inputs
     * @param string $content
     * @return string
     */
    protected function renderHiddenInputs(string $content = "")
    {
        $latOptions = ArrayHelper::remove($this->_options, 'latOptions', []);
        $latId = ArrayHelper::remove($latOptions, 'id', $this->id . "-lat");
        $latName = ArrayHelper::remove($latOptions, 'name', $this->id . "-lat");
        $latOptions['id'] = $latId;
        $latOptions['name'] = $latName;

        $lonOptions = ArrayHelper::remove($this->_options, 'lonOptions', []);
        $lonId = ArrayHelper::remove($lonOptions, 'id', $this->id . "-lon");
        $lonName = ArrayHelper::remove($lonOptions, 'name', $this->id . "-lon");
        $lonOptions['id'] = $lonId;
        $lonOptions['name'] = $lonName;

        $this->setPluginOptions([
            'inputBinding' => [
                'latitudeInput' => new JsExpression("$('#{$latId}')"),
                'longitudeInput' => new JsExpression("$('#{$lonId}')"),
            ]
        ]);

        return strtr($content, [
            '{lat}' => Html::hiddenInput($latName, null, $latOptions),
            '{lon}' => Html::hiddenInput($lonName, null, $lonOptions),
        ]);
    }
    #endregion

    #region Protected methods
    /**
     * Register assets
     * @return Asset
     */
    protected function registerAssets()
    {
        return Asset::register($this->view);
    }

    /**
     * Register Plugin assets
     */
    protected function registerPlugin()
    {
        return $this->view->registerJs("$('#{$this->id}-map').locationpicker(" . Json::encode($this->pluginOptions) . ");");
    }
    #endregion
}