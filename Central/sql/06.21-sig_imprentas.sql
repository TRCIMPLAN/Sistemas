--
-- TrcIMPLAN Central
--
-- SIG Imprentas
--

CREATE TABLE sig_imprentas (
    id                          serial                   PRIMARY KEY,

    nombre                      character varying        UNIQUE NOT NULL,
    nombre_menu                 character varying(64)           NOT NULL,
    directorio                  character varying(64)    UNIQUE NOT NULL,
    publicaciones_directorio    character varying(64)    UNIQUE NOT NULL,
    encabezado_color            character(7),

    estatus                     character(1)             DEFAULT 'A'::bpchar NOT NULL
);
