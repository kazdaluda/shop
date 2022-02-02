<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'frontendHostInfo' => 'http://shop',
   // 'frontendHostInfo' => 'http://vova',
    //'backendHostInfo' => 'http://ura/backend/web',
    'backendHostInfo' => 'http://shopd',
    'user.passwordMinLength' => 6,

    //'staticHostInfo' => 'http://ura/static',
    'staticPath' => dirname(__DIR__ ,2) . '/backend/web/static',

    'user.rememberMeDuration' => 3600 * 24 * 30,
    'cookieDomain' => '.ura',


    'staticHostInfo' => 'http://ura/backend/web/static',
    //'staticPath' => dirname(__DIR__ ,2) . '/static',

    'mailChimpKey' => '',
    'mailChimpListId' => '',
    'smsRuKey' => '',
    'ftp'=>[],
];
