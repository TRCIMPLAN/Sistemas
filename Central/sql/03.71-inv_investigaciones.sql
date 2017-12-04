--
-- TrcIMPLAN Central
--
-- Investigaciones
--

CREATE TABLE inv_investigaciones (
    id                       serial                PRIMARY KEY,
    fuente                   integer               REFERENCES cat_fuentes DEFAULT 1 NOT NULL,

    fecha                    date                  NOT NULL,
    titulo                   character varying     NOT NULL,
    autor                    character varying,

    prefacio                 text,
    contenido                text,
    conclusiones             text,

    categorias               character varying,
    url                      character varying,

    investigacion_calidad    integer               REFERENCES cat_investigaciones_calidades DEFAULT 1 NOT NULL,
    investigacion_fuente     integer               REFERENCES cat_investigaciones_fuentes   DEFAULT 1 NOT NULL,
    investigacion_alcance    integer               REFERENCES cat_investigaciones_alcances  DEFAULT 1 NOT NULL,

    notas                    text,
    estatus                  character(1)          DEFAULT 'A'::bpchar NOT NULL
);
