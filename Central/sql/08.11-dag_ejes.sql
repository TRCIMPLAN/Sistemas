--
-- TrcIMPLAN Central
--
-- Desagregación Ejes
--

CREATE TABLE dag_ejes (
    id           serial               PRIMARY KEY,

    nivel        smallint             UNIQUE NOT NULL,
    nombre       character varying    NOT NULL,
    nom_corto    character varying    UNIQUE NOT NULL,

    estatus      character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (100, 'Demografía',    'Demografía');                 -- 1
INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (200, 'Educación',     'Educación');                  -- 2
INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (300, 'Economía',      'Características Económicas'); -- 3
INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (400, 'Salud',         'Servicios de Salud');         -- 4
INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (500, 'Viviendas',     'Viviendas');                  -- 5
INSERT INTO dag_ejes (nivel, nom_corto, nombre) VALUES (600, 'U. Económicas', 'Unidades Económicas');        -- 6
