--
-- TrcIMPLAN Central
--
-- Catálogos Investigaciones Alcances
--

CREATE TABLE cat_investigaciones_alcances (
    id             serial                PRIMARY KEY,

    nombre         character varying,
    descripcion    character varying,

    notas          text,
    estatus        character(1)          DEFAULT 'A'::bpchar NOT NULL
);

-- Clasificación de las Investigaciones
--   Según su alcance o grado
--     Exploratoria: Se realiza sobre el objeto total o sobre una parte de él.
--     Descriptiva: Presenta aspectos diversos del objeto.
--     Explicativa: Logra establecer sus causas, lo que origina esa realidad.
-- Fuente: http://www.slideshare.net/khrisfer82/clasificacin-de-las-investigaciones

INSERT INTO cat_investigaciones_alcances (nombre, descripcion) VALUES ('00) Sin clasificar', '');
INSERT INTO cat_investigaciones_alcances (nombre, descripcion) VALUES ('Exploratoria', 'Se realiza sobre el objeto total o sobre una parte de él.');
INSERT INTO cat_investigaciones_alcances (nombre, descripcion) VALUES ('Descriptiva',  'Presenta aspectos diversos del objeto.');
INSERT INTO cat_investigaciones_alcances (nombre, descripcion) VALUES ('Explicativa',  'Logra establecer sus causas, lo que origina esa realidad.');
