<?php

return [
   'class' => 'yii\db\Connection',
   //'dsn' => 'pgsql:host=192.168.250.9;dbname=fps_2018', //Prueba casa
   //'dsn' => 'pgsql:host=172.27.14.221;dbname=prueba', //Prueba Fundacion
   'dsn' => 'pgsql:host=172.27.14.221;dbname=fps_2018',  //Produccion Fundacion
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
