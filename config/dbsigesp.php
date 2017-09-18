<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=db_pueblosoberano_2017',
    'username' => 'pueblosoberano',
    'password' => 'pueblosoberano',
    'charset' => 'utf8',
    'schemaMap' => [
    'pgsql'=> [
      'class'=>'yii\db\pgsql\Schema',
      'defaultSchema' => 'public' //specify your schema here
    ]
  ], // PostgreSQL
];
