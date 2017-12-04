--
-- TrcIMPLAN Central
--
-- Catálogos Fuentes
--

CREATE TABLE cat_fuentes (
    id               serial                    PRIMARY KEY,

    nombre           character varying         NOT NULL,
    sitio_web        character varying,

    notas            text,
    estatus          character(1)              DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO cat_fuentes (nombre) VALUES ('00) DESCONOCIDA');
