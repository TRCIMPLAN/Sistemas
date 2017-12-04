--
-- TrcIMPLAN Central
--
-- Catálogos Regiones
--

CREATE TABLE cat_regiones (
    id                   serial                    PRIMARY KEY,

    nivel                smallint                  UNIQUE NOT NULL,
    nombre               character varying         NOT NULL,

    esquema_pais         character(2),
    esquema_region       character varying(64),
    esquema_localidad    character varying(64),

    notas                text,
    estatus              character(1)              DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO cat_regiones (nivel, nombre, esquema_pais, esquema_region, esquema_localidad) VALUES (101, 'Torreón',       'MX', 'Coahuila de Zaragoza', 'Torreón');
INSERT INTO cat_regiones (nivel, nombre, esquema_pais, esquema_region, esquema_localidad) VALUES (111, 'Gómez Palacio', 'MX', 'Durango',              'Gómez Palacio');
INSERT INTO cat_regiones (nivel, nombre, esquema_pais, esquema_region, esquema_localidad) VALUES (121, 'Lerdo',         'MX', 'Durango',              'Lerdo');
INSERT INTO cat_regiones (nivel, nombre, esquema_pais, esquema_region, esquema_localidad) VALUES (131, 'Matamoros',     'MX', 'Coahuila de Zaragoza', 'Matamoros');
INSERT INTO cat_regiones (nivel, nombre, esquema_pais, esquema_region, esquema_localidad) VALUES (401, 'La Laguna',     'MX', '',                     '');

--~ ALTER TABLE cat_regiones ADD COLUMN esquema_pais      character(2);
--~ ALTER TABLE cat_regiones ADD COLUMN esquema_region    character varying(64);
--~ ALTER TABLE cat_regiones ADD COLUMN esquema_localidad character varying(64);

--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Coahuila de Zaragoza', esquema_localidad = 'Torreón'       WHERE nivel = 101; -- Torreón
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Durango',              esquema_localidad = 'Gómez Palacio' WHERE nivel = 111; -- Gómez Palacio
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Durango',              esquema_localidad = 'Lerdo'         WHERE nivel = 121; -- Lerdo
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Coahuila de Zaragoza', esquema_localidad = 'Matamoros'     WHERE nivel = 131; -- Matamoros
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = '',                     esquema_localidad = ''              WHERE nivel = 401; -- La Laguna
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Coahuila de Zaragoza', esquema_localidad = ''              WHERE nivel = 601; -- Coahuila
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = 'Durango',              esquema_localidad = ''              WHERE nivel = 611; -- Durango
--~ UPDATE cat_regiones SET esquema_pais = 'MX', esquema_region = '',                     esquema_localidad = ''              WHERE nivel = 901; -- Nacional
