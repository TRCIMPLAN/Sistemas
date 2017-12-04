--
-- TrcIMPLAN Central
--
-- Indicadores Subíndices Pesos
--

CREATE TABLE ind_subindices_pesos (
    id             serial                PRIMARY KEY,
    subindice      integer               REFERENCES ind_subindices NOT NULL,

    nombre         character varying     NOT NULL,
    ano            integer               NOT NULL,
    peso           numeric(5,4)          DEFAULT 0 NOT NULL,

    notas          text,
    estatus        character(1)          DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE(subindice,ano)
);
