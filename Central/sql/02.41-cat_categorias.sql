--
-- TrcIMPLAN Central
--
-- Catálogos Categorías
--

CREATE TABLE cat_categorias (
    id         serial               PRIMARY KEY,

    nombre     character varying    UNIQUE NOT NULL,

    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);
