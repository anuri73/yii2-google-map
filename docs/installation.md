# Getting started with sonkei/google-map

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