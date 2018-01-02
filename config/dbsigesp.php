<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=192.168.250.7;dbname=db_fps_2018',
    'username' => 'postgres',
    'password' => 'pueblosoberano',
    'charset' => 'latin9',
    'schemaMap' => [
    'pgsql'=> [
      'class'=>'yii\db\pgsql\Schema',
      'defaultSchema' => 'public' //specify your schema here
    ]
  ], // PostgreSQL
];
