--
-- TrcIMPLAN Central
--
-- Desagregación AGEBs
--

CREATE TABLE dag_agebs (
    id          serial               PRIMARY KEY,
    localidad   integer              REFERENCES dag_localidades NOT NULL,

    clave       character(13)        UNIQUE NOT NULL,

    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX dag_agebs_clave_index ON dag_agebs (clave);

SELECT AddGeometryColumn('', 'dag_agebs', 'geom', '97999', 'MULTIPOLYGON', 2);

--
-- Que al eliminar (estatus a B) una localidad, elimine (estatus a B) también todos sus agebs
--

CREATE OR REPLACE FUNCTION dag_localidades_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_agebs SET estatus='B' WHERE localidad=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_localidades_eliminar_trigger
    AFTER UPDATE ON dag_localidades
    FOR EACH ROW EXECUTE PROCEDURE dag_localidades_eliminar();
