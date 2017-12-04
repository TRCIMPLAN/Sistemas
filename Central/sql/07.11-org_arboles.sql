--
-- TrcIMPLAN Central
--
-- Organizador Árboles
--

CREATE TABLE org_arboles (
    id           serial               PRIMARY KEY,

    nivel        smallint             DEFAULT 0 NOT NULL,
    nom_corto    character varying    UNIQUE NOT NULL,
    nombre       character varying    NOT NULL,

    estatus      character(1)         DEFAULT 'A'::bpchar NOT NULL
);

--
-- nivel es un número entero y positivo que sirve para establecer el orden
--

INSERT INTO org_arboles (nivel, nom_corto, nombre) VALUES (100, 'Análisis',          'Análisis Publicados'                 ); -- 1
INSERT INTO org_arboles (nivel, nom_corto, nombre) VALUES (200, 'Indicadores',       'Sistema Metropolitano de Indicadores'); -- 2
INSERT INTO org_arboles (nivel, nom_corto, nombre) VALUES (300, 'Georreferenciados', 'Sistema de Información Geográfica'   ); -- 3
INSERT INTO org_arboles (nivel, nom_corto, nombre) VALUES (400, 'Planes',            'Planes'                              ); -- 4
INSERT INTO org_arboles (nivel, nom_corto, nombre) VALUES (500, 'Proyectos',         'Banco de Proyectos'                  ); -- 5
