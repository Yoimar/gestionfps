<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Centro */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Centros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'centro_tipo_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>


<!--
Sql para creacion de tablas centro_tipo centro centro_clasificacion y lugar

Centro
CREATE TABLE public.centro
(
  id integer NOT NULL DEFAULT nextval('centro_id_seq'::regclass),
  nombre character varying(50) NOT NULL,
  centro_tipo_id integer NOT NULL,
  created_at timestamp without time zone,
  created_by integer,
  updated_at timestamp without time zone,
  updated_by integer,
  CONSTRAINT id_centro PRIMARY KEY (id),
  CONSTRAINT centro_tipo_id FOREIGN KEY (centro_tipo_id)
      REFERENCES public.centro_tipo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT created_by_user_centro FOREIGN KEY (created_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT updated_by_id_centro FOREIGN KEY (updated_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.centro
  OWNER TO postgres;

Centro Clasificacion
CREATE TABLE public.centro_clasificacion
(
  id integer NOT NULL DEFAULT nextval('centro_clasificacion_id_seq'::regclass),
  nombre character varying(50) NOT NULL,
  centro_id integer NOT NULL,
  created_at time without time zone,
  created_by integer,
  updated_at timestamp without time zone,
  updated_by integer,
  CONSTRAINT centro_clasificacion_id PRIMARY KEY (id),
  CONSTRAINT centro_id FOREIGN KEY (centro_id)
      REFERENCES public.centro (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT created_by_centro_clasificacion_user FOREIGN KEY (created_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT updated_by_centro_clasificacion_user FOREIGN KEY (updated_by)
      REFERENCES public."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.centro_clasificacion
  OWNER TO postgres;

Centro_tipo
CREATE TABLE public.centro_tipo
(
  id integer NOT NULL DEFAULT nextval('centro_tipo_id_seq'::regclass),
  nombre character varying(50) NOT NULL,
  CONSTRAINT id_centro_tipo PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.centro_tipo
  OWNER TO postgres;

Lugar
  CREATE TABLE public.lugar
  (
    id integer NOT NULL DEFAULT nextval('lugar_id_seq'::regclass),
    nombre character varying(200) NOT NULL,
    centro_clasificacion_id integer NOT NULL,
    google_place_gps point NOT NULL,
    nombre_slug character varying,
    parroquia_id integer NOT NULL,
    direccion character varying(500),
    telefono1 character varying(12),
    telefono2 character varying(12),
    telefono3 character varying(12),
    notas text,
    created_at timestamp without time zone,
    created_by integer,
    updated_at time without time zone,
    updated_by integer,
    CONSTRAINT id_lugar PRIMARY KEY (id),
    CONSTRAINT centro_clasificacion_id FOREIGN KEY (centro_clasificacion_id)
        REFERENCES public.centro_clasificacion (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT created_by_id_lugar FOREIGN KEY (created_by)
        REFERENCES public."user" (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT parroquia_id FOREIGN KEY (parroquia_id)
        REFERENCES public.parroquias (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT updated_by_id_lugar FOREIGN KEY (updated_by)
        REFERENCES public."user" (id) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT nombre_slug_unique UNIQUE (nombre_slug)
  )
  WITH (
    OIDS=FALSE
  );
  ALTER TABLE public.lugar
    OWNER TO postgres;


-->
