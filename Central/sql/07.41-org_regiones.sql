--
-- TrcIMPLAN Central
--
-- Organizador Regiones
--

CREATE TABLE org_regiones (
    id         serial               PRIMARY KEY,

    nivel      smallint             DEFAULT 0 NOT NULL,
    nombre     character varying    UNIQUE NOT NULL,

    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO org_regiones (nombre) VALUES ('SIN REGIÓN');

INSERT INTO org_regiones (nivel, nombre) VALUES (101, 'Torreón');
INSERT INTO org_regiones (nivel, nombre) VALUES (111, 'Gómez Palacio');
INSERT INTO org_regiones (nivel, nombre) VALUES (121, 'Lerdo');
INSERT INTO org_regiones (nivel, nombre) VALUES (131, 'Matamoros');
INSERT INTO org_regiones (nivel, nombre) VALUES (401, 'La Laguna');

INSERT INTO org_regiones (nivel, nombre) VALUES (601, 'Coahuila');
INSERT INTO org_regiones (nivel, nombre) VALUES (611, 'Durango');

INSERT INTO org_regiones (nivel, nombre) VALUES (901, 'Nacional');
