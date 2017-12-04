--
-- TrcIMPLAN Central
--
-- Análisis Publicaciones Imágenes
--

CREATE TABLE ana_publicaciones_imagenes (
    id                 serial                         PRIMARY KEY,
    publicacion        integer                        REFERENCES ana_publicaciones NOT NULL,

    caracteres_azar    character(8)                   NOT NULL,

    creado             timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    estatus            character(1)                   DEFAULT 'A'::bpchar NOT NULL
);
