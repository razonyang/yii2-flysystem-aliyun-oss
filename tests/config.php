<?php

return [
    'id' => 'test',
    'basePath' => __DIR__,
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationNamespaces' => [
            ],
        ],
    ],
    'components' => [
    ],
];
