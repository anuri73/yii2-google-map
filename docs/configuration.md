# Configuration

All available configuration options are listed below with their default values.

---

#### template (Type: `string`, Default value: `"{beginContainer} {searchInput} {navigator} {lat} {lon} {map} {endContainer}"`)

You can customize the options at its discretion. For example if you want to disable navigator link, you can simply remove `{navigator}` from the template

---

#### searchInputView (Type: `Callable`)

If you want to customize `search_input` view, you can simply change this property:

```php
'searchInputView'=>function($widget, $options){
    return $this->render("my_view", [
        'widget' => $this,
        'options' => $options
    ]);
}
```

> $widget and $options arguments will be sent to the view file

---

#### options (Type: `array`)

Html options for the widget

Default value:

```php
'container' => [
    'tag' => 'div'
],
'searchInput' => [
    'labelOptions' => [
        'label' => 'Location: '
    ],
    'class' => 'form-control',
],
'map' => [
    'class' => 'map-box'
],
'latOptions' => [

]
```

---

#### pluginOptions (Type: `array`)

Plugin options for the widget
[@see https://github.com/Logicify/jquery-locationpicker-plugin](https://github.com/Logicify/jquery-locationpicker-plugin) 08/02/2017