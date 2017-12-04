--
-- TrcIMPLAN Central
--
-- SIG Mapas
--

CREATE TABLE sig_autores (
    id              serial               PRIMARY KEY,

    nombre          character varying    UNIQUE NOT NULL,
    puesto          character varying,
    departamento    character varying,

    estatus         character(1)         DEFAULT 'A'::bpchar NOT NULL
);
