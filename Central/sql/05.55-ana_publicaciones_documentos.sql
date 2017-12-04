--
-- TrcIMPLAN Central
--
-- Análisis Publicaciones Documentos
--

CREATE TABLE ana_publicaciones_documentos (
    id                 serial                         PRIMARY KEY,
    publicacion        integer                        REFERENCES ana_publicaciones NOT NULL,

    caracteres_azar    character(8)                   NOT NULL,

    creado             timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    estatus            character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

--
-- Que al eliminar (estatus a B) una publicación,
--     elimine (estatus a B) también sus imágenes
--     elimine (estatus a B) también sus documentos
--

CREATE OR REPLACE FUNCTION ana_publicaciones_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE ana_publicaciones_imagenes   SET estatus='B' WHERE publicacion=old.id;
            UPDATE ana_publicaciones_documentos SET estatus='B' WHERE publicacion=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ana_publicaciones_eliminar_trigger
    AFTER UPDATE ON ana_publicaciones
    FOR EACH ROW EXECUTE PROCEDURE ana_publicaciones_eliminar();
