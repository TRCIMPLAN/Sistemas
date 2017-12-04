--
-- TrcIMPLAN Central
--
-- Organizador Vínculos
--

CREATE TABLE org_vinculos (
    id                serial                         PRIMARY KEY,
    rama              integer                        REFERENCES org_ramas NOT NULL,

    nivel             smallint                       DEFAULT 0 NOT NULL,
    nombre            character varying              NOT NULL,
    descripcion       text,
    creado            timestamp without time zone    NOT NULL,
    directorio        character varying              NOT NULL,
    archivo           character varying              NOT NULL,
    url               character varying              NOT NULL,
    imagen            character varying,
    imagen_previa     character varying,
    estado            character(1)                   DEFAULT 'P'::bpchar NOT NULL,
    para_compartir    character(1)                   DEFAULT 'S'::bpchar NOT NULL,

    estatus           character(1)                   DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE(rama,nombre)
);

--
-- estado
--   P Publicar
--   R Revisar
--   I Ignorar
--

--
-- para_compartir
--   S Sí
--   N No
--
