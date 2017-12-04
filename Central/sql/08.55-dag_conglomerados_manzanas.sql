--
-- TrcIMPLAN Central
--
-- Desagregación Conglomerados Manzanas
--

CREATE TABLE dag_conglomerados_manzanas (
    id              serial          PRIMARY KEY,
    conglomerado    integer         REFERENCES dag_conglomerados NOT NULL,
    manzana         integer         REFERENCES dag_manzanas      NOT NULL,

    estatus         character(1)    DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE (conglomerado, manzana)
);
