--
-- TrcIMPLAN Central
--
-- Proyectos Criterios
--

CREATE TABLE pro_criterios (
    id         serial               PRIMARY KEY,

    nombre     character varying    UNIQUE NOT NULL,

    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO pro_criterios (nombre) VALUES ('Factores Técnicos'); -- 1
INSERT INTO pro_criterios (nombre) VALUES ('Competitividad Global'); -- 2
INSERT INTO pro_criterios (nombre) VALUES ('Impacto'); -- 3
INSERT INTO pro_criterios (nombre) VALUES ('Plus'); -- 4
