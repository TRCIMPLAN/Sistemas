--
-- TrcIMPLAN Central
--
-- Indicadores Indicadores
--

CREATE TABLE ind_indicadores (
    id                 serial                         PRIMARY KEY,
    subindice          integer                        REFERENCES ind_subindices NOT NULL,
    unidad             integer                        REFERENCES cat_unidades NOT NULL,

    nombre             character varying              NOT NULL,
    descripcion        text,
    categorias         character varying,

    importancia        smallint                       DEFAULT 0,
    frecuencia_dias    smallint                       DEFAULT 0,
    calificacion       smallint                       DEFAULT 0,

    notas              text,
    creado             timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    modificado         timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    estatus            character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

-- Agregar nuevas columnas en Servidora
-- ~ ALTER TABLE ind_indicadores ADD   COLUMN importancia     smallint;
-- ~ ALTER TABLE ind_indicadores ALTER COLUMN importancia     SET DEFAULT 0;
-- ~ ALTER TABLE ind_indicadores ADD   COLUMN frecuencia_dias smallint;
-- ~ ALTER TABLE ind_indicadores ALTER COLUMN frecuencia_dias SET DEFAULT 0;
-- ~ ALTER TABLE ind_indicadores ADD   COLUMN calificacion    smallint;
-- ~ ALTER TABLE ind_indicadores ALTER COLUMN calificacion    SET DEFAULT 0;

--
-- Que al eliminar (estatus a B) un subíndice...
--     elimine (estatus a B) también todos sus pesos
--     elimine (estatus a B) también todos sus índices
--

CREATE OR REPLACE FUNCTION ind_subindices_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE ind_subindices_pesos SET estatus='B' WHERE subindice=old.id;
            UPDATE ind_indicadores      SET estatus='B' WHERE subindice=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_subindices_eliminar_trigger
    AFTER UPDATE ON ind_subindices
    FOR EACH ROW EXECUTE PROCEDURE ind_subindices_eliminar();
