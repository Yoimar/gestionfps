<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
if ($model->recepcioninicial!=''){

}else{
	$this->title = 'Reporte Por Unidad';
	$filtrounidad = '';
}
$stylecabecera = 'style="text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

$styleceldas = '"text-align:center; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;"';

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
	"Instrucción Presidencial",
	"Atención al Soberano",
	"Atención Institucional",
	"Total");
?>
</div>
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
    <th <?= $stylecabecera?>>Unidad</th>
    <th <?= $stylecabecera?>>Casos</th>
    <th <?= $stylecabecera?>>Casos Resue</th>
    <th <?= $stylecabecera?>>Casos ArtRe</th>
    <th <?= $stylecabecera?>>Casos Artic</th>
    <th <?= $stylecabecera?>>Casos Anula</th>
    <th <?= $stylecabecera?>>Casos Pendi</th>
    <th <?= $stylecabecera?>>Art Tram</th>
    <th <?= $stylecabecera?>>Sin Comun</th>
    <th <?= $stylecabecera?>>Por Llama</th>
    <th <?= $stylecabecera?>>Por Recau</th>
    <th <?= $stylecabecera?>>Por Conve</th>
    <th <?= $stylecabecera?>>Por Conso</th>
    <th <?= $stylecabecera?>>P/APR Eco</th>
    <th <?= $stylecabecera?> width="200" nowrap>Monto Económico</th>
    <th <?= $stylecabecera?>>P/APR Sal</th>
    <th <?= $stylecabecera?> width="200" nowrap>Monto Salud</th>
    <th <?= $stylecabecera?>>En Admin</th>
</tr>
</thead>
<tbody>
	<?php for ($i = 0; $i < 3; $i ++) : ?>
		<?php
		$filtrounidad = ' s1.recepcion_id = '. ($i+1) .' and ';
		?>

		<tr style="vertical-align:middle;">
			<td><?= $meses[$i];?></td>
				<td style="text-align:center; vertical-align:middle;" class="info"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad."  extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(year from s1.created_at) = ".$model->ano." and e2.id <> 15")->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 2 and extract(year from s1.created_at) = ".$model->ano." and e2.id = 15")->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 4 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e1.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;" class="info"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 14 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 9 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 7 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                <td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style="text-align:center; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle;"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where ".$filtrounidad." e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style="text-align:center; vertical-align:middle;" class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where ".$filtrounidad." e2.id = 18 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
		</tr>
	<?php endfor; ?>
    	<tr style="vertical-align:middle;">
                <td style="vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger">Total</td>
				<td style=<?= $styleceldas?> class="danger totaltabla"><p  style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and extract(year from s1.created_at) = 2018 and e2.id <> 15")->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 2 and extract(year from s1.created_at) = 2018 and e2.id = 15")->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 4 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e1.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 14 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 9 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 1 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 2 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 7 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                <td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 3 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
				<td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 11 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
                <td style="text-align:right; vertical-align:middle; font-weight: bold; font-size: 1em; background-color: #585858; color: white;" class="danger"><p style="margin: 0;"><?= Yii::$app->formatter->asCurrency(Yii::$app->db->createCommand("select sum(p1.montoapr) from ".$tablasconjoinpresupuesto." where  e3.id = 10 and extract(year from s1.created_at) = ".$model->ano)->queryscalar());?></p></td>
				<td style=<?= $styleceldas?> class="danger"><p style="margin: 0;"><?= Yii::$app->db->createCommand("select count(*) from ".$tablasconjoin."  where  e2.id = 18 and extract(year from s1.created_at) = ".$model->ano)->queryscalar();?></p></td>
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
<center>
<div class="row">
	<div class="col-md-2 col-lg-2">
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Consolidado '.($model->ano-1), ['tablareportemando',
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
	<?= Html::a('<span class="glyphicon glyphicon-align-justify"></span>Consolidado '.($model->ano+1), ['tablareportemando',
	                'ano' => $model->ano+1,],
					['class'=>'btn btn-info',
					'data-container' => 'body',
					'data-toggle' => 'tooltip',
					'data-placement'=> 'bottom',
					'title'=>'Reporte General '.($model->ano+1)]) ?>
	</div>
</div>
</center>
