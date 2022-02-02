<?php

use zhuravljov\yii\queue\serializers\JsonSerializer;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap'=>[
        'queue',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@common/runtime/cache'
        ],
       /* 'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached'=>true,
        ],*/
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_items}}',
            'itemChildTable' => '{{%auth_item_children}}',
            'assignmentTable' => '{{%auth_assignments}}',
            'ruleTable' => '{{%auth_rules}}',
        ],
        'queue' => [
            'class' => 'zhuravljov\yii\queue\db\Queue',
            'db' => 'db', // Компонент подключения к БД или его конфиг
            'tableName' => '{{%queue}}', // Имя таблицы
            'channel' => 'default', // Выбранный для очереди канал
            'mutex'=>\yii\mutex\MysqlMutex::class,

            'as log' => 'zhuravljov\yii\queue\LogBehavior',
        ],
    ],

];
