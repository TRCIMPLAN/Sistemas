--
-- TrcIMPLAN Central
--
-- Análisis Autores
--

CREATE TABLE ana_autores (
    id              serial               PRIMARY KEY,

    nombre          character varying    UNIQUE NOT NULL,
    puesto          character varying,
    departamento    character varying,

    estatus         character(1)         DEFAULT 'A'::bpchar NOT NULL
);
