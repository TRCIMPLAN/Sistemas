--
-- TrcIMPLAN Central
--
-- Desagregación Regiones
--

CREATE TABLE dag_regiones (
    id            serial                         PRIMARY KEY,

    nivel         smallint                       UNIQUE NOT NULL,
    nombre        character varying                     NOT NULL,
    nom_corto     character varying              UNIQUE NOT NULL,

    creado        timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    modificado    timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    estatus       character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

--
-- Que al cambiar el nivel, nombre, nom_corto o estatus...
--   Actualizar el tiempo de modificación
--
CREATE OR REPLACE FUNCTION dag_regiones_actualizar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND (old.nivel<>new.nivel OR old.nombre<>new.nombre OR old.nom_corto<>new.nom_corto OR old.estatus<>new.estatus) THEN
            NEW.modificado = now();
            RETURN NEW;
        ELSE
            RETURN NULL;
        END IF;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_regiones_actualizar_trigger
    BEFORE UPDATE ON dag_regiones
    FOR EACH ROW EXECUTE PROCEDURE dag_regiones_actualizar();

-- Agregar nuevas columnas en Servidora
-- ~ ALTER TABLE dag_regiones ADD   COLUMN creado     timestamp without time zone;
-- ~ ALTER TABLE dag_regiones ALTER COLUMN creado     SET DEFAULT ('now'::text)::timestamp without time zone;
-- ~ ALTER TABLE dag_regiones ADD   COLUMN modificado timestamp without time zone;
-- ~ ALTER TABLE dag_regiones ALTER COLUMN modificado SET DEFAULT ('now'::text)::timestamp without time zone;
