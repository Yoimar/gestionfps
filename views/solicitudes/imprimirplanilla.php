<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\MaskedInput;
error_reporting(0);
$label = 'style="border-left: solid 1px black;
border-top: solid 1px black;
border-right: solid 1px black;
border-bottom: none;
text-align:left;
margin: 0px; padding: 0px;
font-size:10px;"';
$dato = 'style="border-left: solid 1px black;
border-bottom: solid 1px black;
border-right: solid 1px black;
border-top: none;
text-align:right; margin: 0px; padding: 0px; font-size:10px;"';
?>
<div class="row">

<table class="table table-bordered table-condensed col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 0mm; margin-bottom: 0mm;" >
    <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
            <strong>INFORME SOCIAL</strong>
        </td>
    </tr>
    <tr>
        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <strong>DESCRIPCIÓN</strong>
        </td>
        <td colspan="5" class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <?= strtoupper($solicitudessearch->descripcion) ?>

        </td>
    </tr>
    <tr>
        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <strong>NECESIDAD</strong>
        </td>
        <td colspan="5" class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <?= strtoupper($solicitudessearch->necesidad) ?>
        </td>
    </tr>

    <tr>
        <td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <strong>UNIDAD:</strong> <?= strtoupper($solicitudessearch->recepcion->nombre) ?>

        </td>
        <td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <strong>TIPO DE AYUDA:</strong>
            <?= strtoupper($solicitudessearch->area->tipoAyuda->nombre) ?>

        </td>
        <td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
            <strong>ÁREA:</strong>
            <?= strtoupper($solicitudessearch->area->nombre) ?>

        </td>
    </tr>
    <?php if ($solicitudessearch->personabeneficiario->id!=$solicitudessearch->personasolicitante->id): ?>
        <tr>
            <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
                <strong>SOLICITANTE:</strong> <?= strtoupper($solicitudessearch->personasolicitante->nombrecompleto) ?>
            </td>
        </tr>
        <!-- Primera Linea de Datos -->
        <tr>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>NACIONALIDAD:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>C.I.:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>CIUDAD:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>APTO-N° CASA:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>ESTADO:</strong></small>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
            <small><strong>TELÉFONO FIJO:</strong></small><br/>
        </td>
        </tr>
        <tr>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= $solicitudessearch->personasolicitante->tipoNacionalidades->id == 1 ? "VENEZOLANO(A)": "EXTRANJERO(A)" ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= Yii::$app->formatter->asDecimal($solicitudessearch->personasolicitante->ci,0) ?>
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personasolicitante->ciudad) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personasolicitante->apto_casa) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?= strtoupper($solicitudessearch->personasolicitante->parroquia->estado->nombre) ?>&nbsp;
        </td>
        <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
            <?=
            $solicitudessearch->personasolicitante->telefono_fijo
            ?> &nbsp;
        </td>
    </tr>
    <!-- Segunda Linea de Datos -->
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>FECHA DE NACIMIENTO:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>EDAD:</strong></small>
    </td>
    <td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
        <small><strong>ZONA O SECTOR:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>MUNICIPIO:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>TELÉFONO CELULAR:</strong></small><br/>
    </td>
    </tr>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= Yii::$app->formatter->asDate($solicitudessearch->personasolicitante->fecha_nacimiento) ?>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= $solicitudessearch->personasolicitante->edad ?>
    </td>
    <td colspan="2" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->zona_sector) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->parroquia->municipio->nombre) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?=
        $solicitudessearch->personasolicitante->telefono_celular
        ?> &nbsp;
    </td>
    </tr>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>SEXO:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>ESTADO CIVIL:</strong></small>
    </td>
    <td colspan="2" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>CALLE AVENIDA:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>PARROQUIA:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>TELÉFONO OTRO:</strong></small><br/>
    </td>
    </tr>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->sexopersona) ?>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->estadoCivil->nombre) ?>
    </td>
    <td colspan="2" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->calle_avenida) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->parroquia->nombre) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?=
        $solicitudessearch->personasolicitante->telefono_otro
        ?> &nbsp;
    </td>
    </tr>
    <!-- Linea de Datos de Si trabaja -->
    <?php if($solicitudessearch->personasolicitante->ind_trabaja == TRUE):?>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>TRABAJA:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>NIVEL ACADÉMICO:</strong></small>
    </td>
    <td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $label ?> >
        <small><strong>OCUPACIÓN:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>INGRESO MENSUAL:</strong></small><br/>
    </td>
    </tr>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= $solicitudessearch->personasolicitante->ind_trabaja == TRUE ? "SI": "NO" ?>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->nivelesAcademicos->nombre) ?>
    </td>
    <td colspan="3" class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personasolicitante->ocupacion) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= Yii::$app->formatter->asDecimal($solicitudessearch->personasolicitante->ingreso_mensual,2) ?> &nbsp;
    </td>
</tr>
<?php endif;?>
<!-- Linea de Datos de Asegurado u Otro Apoyo-->
<?php if($solicitudessearch->personasolicitante->ind_asegurado == TRUE):?>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>ASEGURADO:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>EMPRESA SEGURO:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>COBERTURA:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>OTRO APOYO:</strong></small>
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= $solicitudessearch->personasolicitante->ind_asegurado == true ? "SI": "NO" ?>
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personasolicitante->seguros->nombre) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= Yii::$app->formatter->asDecimal($solicitudessearch->personasolicitante->cobertura,2) ?>&nbsp;
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personasolicitante->otro_apoyo) ?>&nbsp;
</td>
</tr>
<?php endif; ?>
<?php endif; ?>
    <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
            <strong>BENEFICIARIO:</strong> <?= strtoupper($solicitudessearch->personabeneficiario->nombrecompleto) ?>
        </td>
    </tr>
    <!-- Primera Linea de Datos -->
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>NACIONALIDAD:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>C.I.:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>CIUDAD:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>APTO-N° CASA:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>ESTADO:</strong></small>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
        <small><strong>TELÉFONO FIJO:</strong></small><br/>
    </td>
    </tr>
    <tr>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= $solicitudessearch->personabeneficiario->tipoNacionalidades->id == 1 ? "VENEZOLANO(A)": "EXTRANJERO(A)" ?>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= Yii::$app->formatter->asDecimal($solicitudessearch->personabeneficiario->ci,0) ?>
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personabeneficiario->ciudad) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personabeneficiario->apto_casa) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?= strtoupper($solicitudessearch->personabeneficiario->parroquia->estado->nombre) ?>&nbsp;
    </td>
    <td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
        <?=
        $solicitudessearch->personabeneficiario->telefono_fijo
        ?> &nbsp;
    </td>
</tr>
<!-- Segunda Linea de Datos -->
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>FECHA DE NACIMIENTO:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>EDAD:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>ZONA O SECTOR:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>MUNICIPIO:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>TELÉFONO CELULAR:</strong></small><br/>
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= Yii::$app->formatter->asDate($solicitudessearch->personabeneficiario->fecha_nacimiento) ?>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= $solicitudessearch->personabeneficiario->edad ?>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->zona_sector) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->parroquia->municipio->nombre) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?=
    $solicitudessearch->personabeneficiario->telefono_celular
    ?> &nbsp;
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>SEXO:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>ESTADO CIVIL:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>CALLE AVENIDA:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>PARROQUIA:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>TELÉFONO OTRO:</strong></small><br/>
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->sexopersona) ?>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->estadoCivil->nombre) ?>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->calle_avenida) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->parroquia->nombre) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?=
    $solicitudessearch->personabeneficiario->telefono_otro
    ?> &nbsp;
</td>
</tr>
<!-- Linea de Datos de Si trabaja -->
<?php if($solicitudessearch->personabeneficiario->ind_trabaja == TRUE):?>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>TRABAJA:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>NIVEL ACADÉMICO:</strong></small>
</td>
<td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $label ?> >
    <small><strong>OCUPACIÓN:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
    <small><strong>INGRESO MENSUAL:</strong></small><br/>
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= $solicitudessearch->personabeneficiario->ind_trabaja == TRUE ? "SI": "NO" ?>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->nivelesAcademicos->nombre) ?>
</td>
<td colspan="3" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->personabeneficiario->ocupacion) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
    <?= Yii::$app->formatter->asDecimal($solicitudessearch->personabeneficiario->ingreso_mensual,2) ?> &nbsp;
</td>
</tr>
<?php endif;?>
<!-- Linea de Datos de Asegurado u Otro Apoyo-->
<?php if($solicitudessearch->personabeneficiario->ind_asegurado == TRUE):?>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
<small><strong>ASEGURADO:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
<small><strong>EMPRESA SEGURO:</strong></small>
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $label ?> >
<small><strong>COBERTURA:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
<small><strong>OTRO APOYO:</strong></small>
</td>
</tr>
<tr>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
<?= $solicitudessearch->personabeneficiario->ind_asegurado == true ? "SI": "NO" ?>
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
<?= strtoupper($solicitudessearch->personabeneficiario->seguros->nombre) ?>&nbsp;
</td>
<td  class="col-xs-2 col-sm-2 col-md-2 col-lg-2" <?= $dato ?> >
<?= Yii::$app->formatter->asDecimal($solicitudessearch->personabeneficiario->cobertura,2) ?>&nbsp;
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
<?= strtoupper($solicitudessearch->personabeneficiario->otro_apoyo) ?>&nbsp;
</td>
</tr>
<?php endif; ?>
<tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>SITUACIÓN FISICO AMBIENTAL</strong>
</tr>
<tr>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>VIVIENDA:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>TENENCIA:</strong></small>
</td>
<td colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $label ?> >
    <small><strong>TOTAL INGRESOS HOGAR:</strong></small>
</td>
</tr>
<tr>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->tipovivienda->nombre) ?>
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= strtoupper($solicitudessearch->tenencia->nombre) ?>&nbsp;
</td>
<td  colspan="2" class="col-xs-4 col-sm-4 col-md-4 col-lg-4" <?= $dato ?> >
    <?= Yii::$app->formatter->asDecimal($solicitudessearch->total_ingresos,2) ?>&nbsp;
</td>
</tr>
<tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>DIAGNOSTICO SOCIAL</strong>
</tr>
<tr>
    <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: solid 1px black; text-align:justify; margin: 0px; padding: 2px; font-size:12px;">
        <?= $solicitudessearch->informe_social ?>

</td>
</tr>
<?php
    $modelos = $dataProvider->getModels();

    if ($dataProvider->getTotalcount()!=0):
        //If para el Data Provider por Estatus APR y Orden de Pago
        if($solicitudessearch->estatus == 'APR' && $modelos[0]['proceso_id']==1):
?>
<tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
</tr>
</table>



<?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
        'layout' => "{items}\n{pager}",

        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        //'caption' => $titulotablacheques,

        'columns' => [
            [
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'tratamiento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'empresaoinstitucion',
             'width'=>'270px',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'rif',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'documento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'numop',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'cheque',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'montoapr',
            'label' => 'Monto',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ]

        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



    ]); ?>

    <?php
    //End If si es Aprobado y Es una Orden de Pago
    endif;

    //IF si esta procesado y es una orden de Pago

    if($solicitudessearch->estatus == 'PPA' && $modelos[0]['proceso_id']==1):
    ?>
    <tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
    <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
    </tr>
    </table>



    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,

    'showPageSummary' => true,
    'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
    'layout' => "{items}\n{pager}",

    'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
    'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
    'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    //'caption' => $titulotablacheques,

    'columns' => [
        [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
            'class'=>'kartik\grid\SerialColumn',
            'width'=>'10px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'tratamiento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'empresaoinstitucion',
         'width'=>'270px',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'rif',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'documento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'proceso',
         'pageSummary'=>'Total',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
        'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
        'attribute'=>'montoapr',
        'label' => 'Monto',
        'width'=>'120px',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'format'=>'currency',
        'pageSummary'=>true,
        'pageSummaryFunc'=>GridView::F_SUM,
        'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ]

    ],
    'responsive'=>true,
    'condensed'=>true,
    'bordered'=>true,



    ]); ?>

    <?php
    //End If si PPA Y Es una Orden de Pago
    endif;

    //If para determinar si es una solicitud diferente de Orden de Pago
    if(($solicitudessearch->estatus == 'PPA' || $solicitudessearch->estatus == 'APR') && $modelos[0]['proceso_id']!=1):
    ?>
    <tr>
    <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
    <strong>DETALLE DE LA SOLICITUD</strong>
    </td>
    </tr>
    </table>



    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,

    'showPageSummary' => true,
    'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
    'layout' => "{items}\n{pager}",

    'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
    'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
    'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
    //'caption' => $titulotablacheques,

    'columns' => [
        [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
            'class'=>'kartik\grid\SerialColumn',
            'width'=>'10px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'tratamiento',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
         'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
         'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
         'attribute'=>'proceso',
         'pageSummary'=>'Total',
         'hAlign'=>'center',
         'vAlign'=>'middle',
         'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
        ],

        [
        'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
        'attribute'=>'cantidad',
        'label' => 'Cantidad',
        'width'=>'120px',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'format'=>'decimal',
        'pageSummary'=>true,
        'pageSummaryFunc'=>GridView::F_SUM,
        'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ]

    ],
    'responsive'=>true,
    'condensed'=>true,
    'bordered'=>true,



    ]); ?>

    <?php
    //End If si PPA o APR Y Es diferente de Orden de Pago
    endif;

    //If PARA EL PERRAJE ELA, ACA, EAA, CER, ANU, DEV, ART, ELD Y Es una Orden de Pago
        if(
            $solicitudessearch->estatus == 'ELA'
            || $solicitudessearch->estatus == 'ACA'
            || $solicitudessearch->estatus == 'EAA'
            || $solicitudessearch->estatus == 'CER'
            || $solicitudessearch->estatus == 'ANU'
            || $solicitudessearch->estatus == 'DEV'
            || $solicitudessearch->estatus == 'ART'
            || $solicitudessearch->estatus == 'ELD'
            ):
        ?>
        <tr>
        <td colspan="6" class="text-center" style="background:#d8d8d8; border: solid 2px black; font-size:13px;">
        <strong>DETALLE DE LA SOLICITUD</strong>
        </td>
        </tr>
        </table>



        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //        'filterModel' => $searchModel,

        'showPageSummary' => true,
        'tableOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 0px; border: solid 1px black; font-size:11px;'],
        'layout' => "{items}\n{pager}",

        'headerRowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
        'captionOptions' => ['class' => 'text-center', 'style' => 'color: black; margin: 0px; padding: 2px; font-size:11px;'],
        'footerRowOptions'=> ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        'rowOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px;'],
        //'caption' => $titulotablacheques,

        'columns' => [
            [
                'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
                'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'10px',
                'hAlign'=>'center',
                'vAlign'=>'middle',
                'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'tratamiento',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'empresaoinstitucion',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'rif',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:12px; background: #FFFFFF;']

            ],



            [
             'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
             'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black!important; font-size:11px; background: #FFFFFF;'],
             'attribute'=>'proceso',
             'pageSummary'=>'Total',
             'hAlign'=>'center',
             'vAlign'=>'middle',
             'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;'],
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'cantidad',
            'label' => 'Cantidad',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'decimal',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'monto',
            'label' => 'Monto Solicitado',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
            ],

            [
            'headerOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; '],
            'contentOptions' => ['class' => 'text-center', 'style' => 'margin: 0px; padding: 2px; text-align:center; border: solid 1px black!important; font-size:11px;'],
            'attribute'=>'montoapr',
            'label' => 'Monto Aprobado',
            'width'=>'120px',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'format'=>'currency',
            'pageSummary'=>true,
            'pageSummaryFunc'=>GridView::F_SUM,
            'pageSummaryOptions'=>['class'=>'text-center', 'style' => 'margin: 0px; padding: 2px; border: solid 1px black; font-size:11px; background: #FFFFFF;']
        ],


        ],
        'responsive'=>true,
        'condensed'=>true,
        'bordered'=>true,



        ]); ?>

        <?php
        //End If si ELA, ACA, EAA, CER, ANU, DEV, ART, ELD Y Es una Orden de Pago
        endif;

    else:
    ?>
    </table>
    <?php
    //End If pertenece al vacio del Gridview
    endif;
    ?>

</div>
