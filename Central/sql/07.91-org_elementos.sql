--
-- TrcIMPLAN Central
--
-- Organizador Elementos
--

CREATE TABLE org_elementos (
    id           serial                         PRIMARY KEY,

    creado       timestamp without time zone    NOT NULL,

    vinculo      integer                        REFERENCES org_vinculos   NOT NULL,
    autor        integer                        REFERENCES org_autores    NOT NULL,
    categoria    integer                        REFERENCES org_categorias NOT NULL,
    region       integer                        REFERENCES org_regiones   NOT NULL,
    fuente       integer                        REFERENCES org_fuentes    NOT NULL,

    estatus      character(1)                   DEFAULT 'A'::bpchar NOT NULL
);
