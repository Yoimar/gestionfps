<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Recepciones;

/* @var $this yii\web\View */
if ($model->recepcioninicial!=''){
	$this->title = Recepciones::findOne($model->recepcioninicial)->nombre;
	$filtrounidad = ' s1.recepcion_id = '. $model->recepcioninicial .' and ';
}else{
	$this->title = 'Reporte General';
	$filtrounidad = '';
}
$stylecabecera = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$styleceldas = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1.1em; background-color: #585858; color: white;"';

$tablasconjoin = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
			    .' join estatus2 e2 on e3.estatus2_id = e2.id '
				.' join estatus1 e1 on e2.estatus1_id = e1.id '
				.' join solicitudes s1 on s1.id = g1.solicitud_id ';

$tablasconjoinpresupuesto = ' gestion g1 join estatus3 e3 on g1.estatus3_id = e3.id '
						   .' join estatus2 e2 on e3.estatus2_id = e2.id '
						   .' join estatus1 e1 on e2.estatus1_id = e1.id '
						   .' join solicitudes s1 on s1.id = g1.solicitud_id '
						   .' join presupuestos p1 on p1.solicitud_id = s1.id ';

$meses = array(
	"Enero",
	"Febrero",
	"Marzo",
	"Abril",
	"Mayo",
	"Junio",
	"Julio",
	"Agosto",
	"Septiembre",
	"Octubre",
	"Noviembre",
	"Diciembre",
	"Total");


?>
<div class="row" style="font-size: 1em;" >
	<div class="col-lg-12">
		<div class="box">
<div class="box-header">
	<h3>
		<?= $this->title ?> - Año <?= $model->ano ?>
        <small><p id="reloj" name="reloj" style="float:right; padding-top: 10px;"></p></small>
	</h3>
</div>
<div class="box-body">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<table class="table table-bordered table-hover table-striped table-condensed">
<thead>
	<tr>
        <th style=<?= $stylecabecera?>>Mes</th>
		<th style=<?= $stylecabecera?>>Casos</th>
        <th style=<?= $stylecabecera?>>Casos Resue</th>
        <th style=<?= $stylecabecera?>>Casos ArtRe</th>
		<th style=<?= $stylecabecera?>>Casos Artic</th>
		<th style=<?= $stylecabecera?>>Casos Anula</th>
		<th style=<?= $stylecabecera?>>Casos Pendi</th>
		<th style=<?= $stylecabecera?>>Art Tram</th>
		<th style=<?= $stylecabecera?>>Sin Comun</th>
		<th style=<?= $stylecabecera?>>Por Llama</th>
        <th style=<?= $stylecabecera?>>Por Recau</th>
        <th style=<?= $stylecabecera?>>Por Conve</th>
        <th style=<?= $stylecabecera?>>Por Conso</th>
		<th style=<?= $stylecabecera?>>P/APR Eco</th>
		<th style=<?= $stylecabecera?> width="200" nowrap>Monto Económico</th>
		<th style=<?= $stylecabecera?>>P/APR Sal</th>
		<th style=<?= $stylecabecera?> width="200" nowrap>Monto Salud</th>
	</tr>
</thead>
<tbody>
	<?php for ($i = 0; $i < 12; $i ++) : ?>
		<tr>
			<td><?= $meses[$i];?></td>
				<td style="text-align:center" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2018 and e2.id <> 15")->queryscalar();?></p></td>
				<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = 2018 and e2.id = 15")->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 4 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 3 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 1 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 14 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 9 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 1 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 2 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 7 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                                                                <td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 3 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 11 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 11 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style="text-align:center"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 10 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 10 and extract(month from s1.created_at)=".($i+1)." and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
		</tr>
	<?php endfor; ?>
    	<tr>
                <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
				<td style=<?= $styleceldas?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(year from s1.created_at) = 2018 and e2.id <> 15")->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(year from s1.created_at) = 2018 and e2.id = 15")->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 4 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 14 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 9 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 7 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                <td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
		</tr>
</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Consolidado '.($model->ano-1), ['tablareporte',
	                'ano' => $model->ano-1,],
					['class'=>'btn btn-info',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte General '.($model->ano-1)]) ?>
	</div>
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Instrucción Presidencial', ['tablareporte',
	                'ano' => $model->ano,
	                'recepcion' => 1],
					['class'=>'btn btn-primary',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte de Instrucción Presidencial' ]) ?>
	</div>
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Atención al Soberano', ['tablareporte',
	                'ano' => $model->ano,
	                'recepcion' => 2],
					['class'=>'btn btn-primary',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte de Atención al Soberano' ]) ?>
	</div>
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Atención Institucional', ['tablareporte',
	                'ano' => $model->ano,
	                'recepcion' => 3],
					['class'=>'btn btn-primary',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte de Atención Institucional' ]) ?>
	</div>
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Consolidado '.$model->ano, ['tablareporte',
	                'ano' => $model->ano,],
					['class'=>'btn btn-primary',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte General'.$model->ano ]) ?>
	</div>
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Consolidado '.($model->ano+1), ['tablareporte',
	                'ano' => $model->ano+1,],
					['class'=>'btn btn-info',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte General '.($model->ano+1)]) ?>
	</div>
</div>
