# sonkei/google-map
Yii2 implementation of google map

`sonkei/google-map` is designed to work out of the box. It means that installation requires minimal steps. Only one configuration step should be taken and you are ready to have google map on your Yii2 website.

## Installation:

### 1. Download

Yii2-user can be installed using composer. Run following command to download and install Yii2-user:

```bash
composer require sonkei/google-map
```

### 2. Configure

Add following lines to your main configuration file (components):

```php
'assetManager' => [
    'bundles' => [
        'sonkei\gmap\GoogleAsset' => [
            'options' => [
                'language' => 'ru',       # Preferred language
                'region' => 'KG',         # Preffered region
                'libraries' => 'places',  # Required by the plugin
                'googleMapsApiKey' => '', # Your google map api key
            ]
        ]
    ],
],
```

Or setup parameters of your application (config/params.php)

```php
return [
    'gmap' => [
        'language' => 'ru',       # Preferred language
        'region' => 'KG',         # Preffered region
        'libraries' => 'places',  # Required by the plugin
        'googleMapsApiKey' => '', # Your google map api key
    ],
];
```

## Where do I go now?

You have `sonkei/google-map` installed. Now you can use it by:
```php
echo \sonkei\gmap\Widget::widget([
    # Options
]);
```