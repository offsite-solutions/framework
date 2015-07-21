<?php
$config = [
    'name' => getenv('APP_NAME') ? : 'Offsite Framework',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'sourceLanguage' => getenv('APP_LANGUAGE') ? : 'en-US',
    'language' => getenv('APP_LANGUAGE') ? : 'en-US',
    'bootstrap' => ['log'],
    'components' => [

        // Database configuration based on environment variables
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DB_DSN'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'tablePrefix' => getenv('DB_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],

        // Caching is disabled by default
        // When in production, FileCache will be used
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],

        // Logging configuration
        // Errors and warnings will be logged into a database table called system_log
        // HTTP exceptions and i18n-related messages will be discarded
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db' => [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except' => ['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix' => function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars' => [],
                    'logTable' => '{{%system_log}}'
                ]
            ],
        ],

        // From the book: Formatter class is designed to format values according to the app locale.
        // For this feature to work the PHP intl extension has to be installed

        'formatter' => [
            'class' => 'yii\i18n\Formatter'
        ],

        // Mailer configuration using Swift Mailer
        // When in debug mode, all emails will be logged in files under @runtime
        // In production mode real emails will be sent
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => YII_ENV_DEV,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => getenv('ROBOT_EMAIL')
            ]
        ],

        // Configure URL managers for frontend, backend and storage

        'urlManagerBackend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => Yii::getAlias('@backendUrl')
            ],
            require(Yii::getAlias('@backend/config/_urlManager.php'))
        ),
        'urlManagerFrontend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => Yii::getAlias('@frontendUrl')
            ],
            require(Yii::getAlias('@frontend/config/_urlManager.php'))
        ),
        'urlManagerStorage' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => Yii::getAlias('@storageUrl')
            ],
            require(Yii::getAlias('@storage/config/_urlManager.php'))
        ),
    ],

    // Parameter configuration section
    'params' => [
        'adminEmail' => getenv('ADMIN_EMAIL'),
        'robotEmail' => getenv('ROBOT_EMAIL'),
    ],
];

if (YII_ENV_PROD) {
    // Configure FileCache in production environment
    // FileCache performs automatic garbage collection to remove expired cache files
    $config['components']['cache'] = [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@common/runtime/cache',
        'cacheFileSuffix' => '.cachefile'
    ];

    // Configure logging in production environment
    // Emails will be sent to ADMIN_EMAIL in case of error or warning events
    $config['components']['log']['targets']['email'] = [
        'class' => 'yii\log\EmailTarget',
        'except' => ['yii\web\HttpException:*'],
        'levels' => ['error', 'warning'],
        'message' => ['from' => getenv('ROBOT_EMAIL'), 'to' => getenv('ADMIN_EMAIL')]
    ];
}

// When in dev mode, initialize gii generator
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module'
    ];
}

return $config;
