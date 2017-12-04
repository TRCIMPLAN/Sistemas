--
-- TrcIMPLAN Central
--
-- Desagregación Manzanas
--

CREATE TABLE dag_manzanas (
    id          serial               PRIMARY KEY,
    ageb        integer              REFERENCES dag_agebs NOT NULL,

    clave       character(16)        UNIQUE NOT NULL,

    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX dag_manzanas_clave_index ON dag_manzanas (clave);

SELECT AddGeometryColumn('', 'dag_manzanas', 'geom', '97999', 'MULTIPOLYGON', 2);

--
-- Que al eliminar (estatus a B) un ageb, elimine (estatus a B) también todos sus manzanas
--

CREATE OR REPLACE FUNCTION dag_agebs_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_manzanas SET estatus='B' WHERE ageb=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_agebs_eliminar_trigger
    AFTER UPDATE ON dag_agebs
    FOR EACH ROW EXECUTE PROCEDURE dag_agebs_eliminar();
