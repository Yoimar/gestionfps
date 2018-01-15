<?php
use yii\bootstrap\Progress;
use yii\bootstrap\Tabs;
use yii\widgets\Pjax;
/* 
 * Proyecto Hecho Por Yoimar Urbina
 */
if(Yii::$app->request->post()){

}else {
    $seleccion =0;
}
?>
</div>

<div class="row">
    <!-- Container para Información -->
    <div class="col-md-2">
        <!-- Panel para Información general del Caso -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h6 class="panel-title text-center">Información</h6>
            </div>
            <ul class="list-group">
                <li class="list-group-item">solicitante</li>
                <li class="list-group-item">beneficiario</li>
                <li class="list-group-item">requerimiento</li>
                <li class="list-group-item">tipoayuda</li>
                <li class="list-group-item">area</li>
                <li class="list-group-item">necesidad</li>
                <li class="list-group-item">descripcion</li>
            </ul>
        <!-- Fin del Panel para Información general del Caso -->    
        </div>
        
    </div>
    <!-- Container para Modificacion de Solicitudes -->
  <div class="col-md-8">
      <div class="panel panel-primary">
      <div class="panel-heading">
                <h6 class="panel-title text-center">Solicitud N° <?= $model->id ?></h6>
            </div>
          
          <?php Pjax::begin();
          /**Para Activar las Vistas Tab a Medidas que comenzemos**/
        $referencia1=false;
        $referencia2=false;
        $referencia3=false;
        $referencia4=false;
        $referencia5=false;
        $referencia6=false;
        $referencia7=false;
        $referencia8=false;
        $referencia9=false;
        $referencia10=false;  
       
        switch ($referencia) {
            case 2:
                $referencia2=true;
                break;
            case 3:
                $referencia3=true;
                break;
            case 4:
                $referencia4=true;
                break;
            case 5:
                $referencia5=true;
                break;
            case 6:
                $referencia6=true;
                break;
            case 7:
                $referencia7=true;
                break;
            case 8:
                $referencia8=true;
                break;
            case 9:
                $referencia9=true;
                break;
            case 10:
                $referencia10=true;
                break;
            default:
                $referencia1=true;
                break;
        }
        ?>
                   <?= Tabs::widget([
    'items' => [
        [
            'label' => 'One',
            'content' => $this->render('tab1', ['model' => $model]),
            'options' => ['id' => 'tab1'],
            'active' => $referencia1,
        ],
        [
            'label' => 'Two',
            'content' => $this->render('tab2', ['model' => $model]),
            'options' => ['id' => 'tab2'],
            'active' => $referencia2,
        ],
        [
            'label' => 'Tree',
            'content' => 'Anim pariatur33333333333333 cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'tab3'],
            'active' => $referencia3,
        ],
        [
            'label' => 'Cuatro',
            'content' => 'Anim4444 pariatur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myveryo4wnID'],
            'active' => $referencia4,
        ],
        [
            'label' => 'Cinco',
            'content' => 'Anim pariatur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myveryo5wnID'],
            'active' => $referencia5,
        ],
        [
            'label' => 'Seis',
            'content' => '6666666666666666Anim pariatur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myve6ryownID'],
            'active' => $referencia6,
        ],
        [
            'label' => 'Seven',
            'content' => 'Anim pariat7ur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myver7yownID'],
            'active' => $referencia7,
        ],
        [
            'label' => 'Ocho',
            'content' => 'Anim 8ur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myveryown8ID'],
            'active' => $referencia8,
        ],
        [
            'label' => 'Nine',
            'content' => Progress::widget([
            'percent' => 70,
            'barOptions' => ['class' => 'progress-bar-info'],
            'label' => '70%',
            ]),
//            'headerOptions' => [...],
            'options' => ['id' => 'myvery9ownID'],
            'active' => $referencia9,
        ],
        [
            'label' => 'Ten',
            'content' => 'Anim 10101010101010101pariatur cliche...',
//            'headerOptions' => [...],
            'options' => ['id' => 'myveryo10wnID'],
            'active' => $referencia10,
        ],
        
    ],
    
    'options' => ['class' => 'nav-justified'],
    'renderTabContent' => true,
]); 
?>
          <?php Pjax::end(); ?>
      </div>
  
  </div>
    <!-- Container para Bitacora e Historial Solicitudes -->
  <div class="col-md-2">
        <!-- Panel para Información general del Caso -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h6 class="panel-title text-center">Seguimiento</h6>
                
            </div>
            <?= Tabs::widget([
                    'items' => [
                    [
                        'label' => 'One',
                        'content' => 'Anim pariatss111111111111ur cliche...',
                        'active' => true,
                        'options' => ['id' => 'myve2qwxownID'],
                    ],
                    [
                        'label' => 'Two',
                        'content' => 'Anim pariasatu22222222222r cliche...',
                        'options' => ['id' => 'myve2rycxownID'],
                    ],
                    ],
                'options' => ['class' => 'nav-justified'],
                ]); 
                ?>
            
        <!-- Fin del Panel para Información general del Caso -->    
        </div>
  
  
  </div> 
  
  
  
 
  
</div>
<?= Progress::widget([
    'percent' => 50,
    'barOptions' => ['class' => 'progress-bar-danger'],
    'label' => '50%',
]);?>

 <?php



$this->registerJs(<<<JS
   
   $(function () {
   $('[data-toggle="tooltip"]').tooltip()
   })
   
    $(function () {
    $('[data-toggle="popover"]').popover()
    })
        
JS

);
?>