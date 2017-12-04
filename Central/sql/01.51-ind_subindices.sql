--
-- TrcIMPLAN Central
--
-- Indicadores Subíndices
--

CREATE TABLE ind_subindices (
    id             serial                    PRIMARY KEY,

    nom_corto      character varying(48)     NOT NULL,
    nombre         character varying         NOT NULL,

    notas          text,
    estatus        character(1)              DEFAULT 'A'::bpchar NOT NULL
);
