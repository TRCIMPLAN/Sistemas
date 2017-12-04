--
-- TrcIMPLAN Central
--
-- Catálogos Investigaciones Calidades
--

CREATE TABLE cat_investigaciones_calidades (
    id             serial                PRIMARY KEY,

    nombre         character varying,
    descripcion    character varying,

    notas          text,
    estatus        character(1)          DEFAULT 'A'::bpchar NOT NULL
);

-- Clasificación de las Investigaciones
--   Según su calidad
--     Vulgar o común: Respuesta inmediata a una inquietud.
--     Conocimiento científico
--       Desarrollo teórico: Sirven para el desarrollo de una ciencia, nuevas teorías o hipótesis, se establecen las leyes que rigen la realidad.
--       Aplicación teórica
--         Fundamento empírico
--           Observación simple: Observación del objeto de investigación. Son participativas y no participativas. Fundamento empírico.
--           Correlacionales: Establecen la relación entre una o más variables.
--         Fundamento teórico
--           Experimentales: Experimento sobre el objeto.
--           Diagnóstico: Buscan diagnosticar al objeto. Investiga qué tiene y cómo funciona.
--           Descubrimiento:
-- Fuente: http://www.slideshare.net/khrisfer82/clasificacin-de-las-investigaciones

INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('00) Sin clasificar', '');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Vulgar o común', 'Respuesta inmediata a una inquietud.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Desarrollo Teórico', 'Sirven para el desarrollo de una ciencia, nuevas teorías o hipótesis, se establecen las leyes que rigen la realidad.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Aplicación Teórica, F. Empírico, Observación Simple', 'Observación del objeto de investigación. Son participativas y no participativas.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Aplicación Teórica, F. Empírico, Correlacionales',    'Establecen la relación entre una o más variables.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Aplicación Teórica, F. Teórico, Experimental',   'Experimento sobre el objeto.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Aplicación Teórica, F. Teórico, Diagnóstico',    'Buscan diagnosticar al objeto. Investiga qué tiene y cómo funciona.');
INSERT INTO cat_investigaciones_calidades (nombre, descripcion) VALUES ('Científico, Aplicación Teórica, F. Teórico, Descubrimiento', '');
