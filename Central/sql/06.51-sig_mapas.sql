--
-- TrcIMPLAN Central
--
-- SIG Mapas
--

CREATE TABLE sig_mapas (
    id                            serial                         PRIMARY KEY,
    autor                         integer                        REFERENCES sig_autores   NOT NULL,
    imprenta                      integer                        REFERENCES sig_imprentas NOT NULL,
    region                        integer                        REFERENCES cat_regiones  NOT NULL,

    fecha                         timestamp without time zone    NOT NULL,
    nombre                        character varying              UNIQUE NOT NULL,
    descripcion                   text,
    categorias                    character varying,
    palabras_clave                character varying,

    imagen                        character varying,
    imagen_previa                 character varying,

    tipo                          character(1)                   DEFAULT 'V'::bpchar NOT NULL,
    pantalla_completa_url         character varying,
    pantalla_completa_etiqueta    character varying,
    caja_html                     text,
    caja_js                       text,

    creado                        timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    modificado                    timestamp without time zone,
    procesado                     timestamp without time zone,

    para_compartir                character(1)                   DEFAULT 'C'::bpchar NOT NULL,
    estado                        character(1)                   DEFAULT 'I'::bpchar NOT NULL,
    estatus                       character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

--
-- Que al eliminar (estatus a B) una imprenta, elimine (estatus a B) también sus publicaciones
--

CREATE OR REPLACE FUNCTION sig_imprentas_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE sig_mapas SET estatus='B' WHERE imprenta=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER sig_imprentas_eliminar_trigger
    AFTER UPDATE ON sig_imprentas
    FOR EACH ROW EXECUTE PROCEDURE sig_imprentas_eliminar();

--
-- Que al eliminar (estatus a B) un autor, elimine (estatus a B) también sus publicaciones
--

CREATE OR REPLACE FUNCTION sig_autores_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE sig_mapas SET estatus='B' WHERE autor=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER sig_autores_eliminar_trigger
    AFTER UPDATE ON sig_autores
    FOR EACH ROW EXECUTE PROCEDURE sig_autores_eliminar();
