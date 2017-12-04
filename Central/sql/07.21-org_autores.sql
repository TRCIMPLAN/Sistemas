--
-- TrcIMPLAN Central
--
-- Organizador Autores
--

CREATE TABLE org_autores (
    id               serial               PRIMARY KEY,

    nombre           character varying    UNIQUE NOT NULL,
    puesto           character varying,
    imagen           character varying,
    imagen_previa    character varying,
    email            character varying,
    twitter          character varying,

    estatus          character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO org_autores (nombre) VALUES ('SIN AUTOR');

INSERT INTO org_autores (nombre) VALUES ('IMPLAN Torreón Staff');
INSERT INTO org_autores (nombre) VALUES ('Dirección de Investigación Estratégica');

INSERT INTO org_autores (nombre) VALUES ('Arq. Cecilio Pedro Secunza Schott');
INSERT INTO org_autores (nombre) VALUES ('Arq. Daniela Patricia Corral Hernández');
INSERT INTO org_autores (nombre) VALUES ('Arq. Ilse Ávila García');
INSERT INTO org_autores (nombre) VALUES ('Arq. Jair Miramontes Chávez');
INSERT INTO org_autores (nombre) VALUES ('Arq. Susana Montano');
INSERT INTO org_autores (nombre) VALUES ('Arq. Teresita Benítez Saludado');
INSERT INTO org_autores (nombre) VALUES ('Arq. Victoria Aranzábal');
INSERT INTO org_autores (nombre) VALUES ('Arq. Ángeles Melisa Rodríguez Salas');
INSERT INTO org_autores (nombre) VALUES ('Ing. Guillermo Valdés Lozano');
INSERT INTO org_autores (nombre) VALUES ('Ing. Luis Campos Hinojosa');
INSERT INTO org_autores (nombre) VALUES ('Lic. Alfredo Viesca Domínguez');
INSERT INTO org_autores (nombre) VALUES ('Lic. Alicia Valdez Ibarra');
INSERT INTO org_autores (nombre) VALUES ('Lic. Eduardo Holguín Zehfuss');
INSERT INTO org_autores (nombre) VALUES ('Lic. Luis A. Gutiérrez Arizpe');
INSERT INTO org_autores (nombre) VALUES ('Lic. Rodrigo González Morales');
