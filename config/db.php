<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'pgsql:host=172.27.9.162;dbname=sasycdev', //Servidor Fundación
    'dsn' => 'pgsql:host=localhost;dbname=sasycdevprod', //Prueba
    'username' => 'postgres',
    //'password' => 'postgres',  //Password Produccion
    'password' => 'pueblosoberano', //Password Localhost
    'charset' => 'utf8',
    'schemaMap' => [
    'pgsql'=> [
      'class'=>'yii\db\pgsql\Schema',
      'defaultSchema' => 'public' //specify your schema here
    ],
  ], // PostgreSQL
];
