--
-- TrcIMPLAN Central
--
-- Catálogos Categorías Vínculos
--

CREATE TABLE cat_categorias_vinculos (
    id               serial                         PRIMARY KEY,
    categoria        integer                        REFERENCES cat_categorias ON DELETE CASCADE NOT NULL,

    nombre           character varying              NOT NULL,
    descripcion      text,
    imagen_previa    character varying,
    vinculo          character varying              NOT NULL,

    region_nivel     smallint,
    tipo             character(1)                   NOT NULL,
    creado           timestamp without time zone    NOT NULL,
    estatus          character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

-- CREATE INDEX cat_categorias_vinculos_index ON cat_categorias_vinculos (categoria);

-- Tipos:
--  A -> Análisis
--  I -> Indicador
--  G -> Geográfica
--  P -> Proyecto
--  O -> Otro
