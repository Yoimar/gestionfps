<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'pgsql:host=172.27.9.162;dbname=sasycdev',
    'dsn' => 'pgsql:host=localhost;dbname=sasycdev',
    'username' => 'postgres',
    'password' => 'pueblosoberano',
    'charset' => 'utf8',
    'schemaMap' => [
    'pgsql'=> [
      'class'=>'yii\db\pgsql\Schema',
      'defaultSchema' => 'public' //specify your schema here
    ]
  ], // PostgreSQL
];
