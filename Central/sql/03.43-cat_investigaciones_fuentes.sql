--
-- TrcIMPLAN Central
--
-- Catálogos Investigaciones Fuentes
--

CREATE TABLE cat_investigaciones_fuentes (
    id             serial                PRIMARY KEY,

    nombre         character varying,
    descripcion    character varying,

    notas          text,
    estatus        character(1)          DEFAULT 'A'::bpchar NOT NULL
);

-- Clasificación de las Investigaciones
--   Según su fuente
--     Primarias
--       Cosas materiales: Informan de una realidad o una situación material.
--       Ámbito social: Se relacionan con el hombre en su vivir.
--     Secundarias
--       Inv. Bibliográfica
--       Inv. Periódicos y Revistas
--       Inv. en Documentos
--       Inv. en otros Medios
--       Inv. en Internet
-- Fuente: http://www.slideshare.net/khrisfer82/clasificacin-de-las-investigaciones

INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('00) Sin clasificar', '');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Primarias, Cosas Materiales', 'Informan de una realidad o una situación material.');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Primarias, Ámbito Social',    'Se relacionan con el hombre en su vivir.');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Secundarias, Inv. Bibliográfica',         '');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Secundarias, Inv. Periódicos y Revistas', '');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Secundarias, Inv. en Documentos',         '');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Secundarias, Inv. en otros Medios',       '');
INSERT INTO cat_investigaciones_fuentes (nombre, descripcion) VALUES ('Fuentes Secundarias, Inv. en Internet',           '');
