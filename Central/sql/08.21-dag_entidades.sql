--
-- TrcIMPLAN Central
--
-- Desagregación Entidades
--

CREATE TABLE dag_entidades (
    id          serial               PRIMARY KEY,

    clave       character(2)         UNIQUE NOT NULL,
    nombre      character varying    NOT NULL,

    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX dag_entidades_clave_index ON dag_entidades (clave);

SELECT AddGeometryColumn('', 'dag_entidades', 'geom', '97999', 'MULTIPOLYGON', 2);
