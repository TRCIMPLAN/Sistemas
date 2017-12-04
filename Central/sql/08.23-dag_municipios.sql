--
-- TrcIMPLAN Central
--
-- Desagregación Municipios
--

CREATE TABLE dag_municipios (
    id          serial               PRIMARY KEY,
    entidad     integer              REFERENCES dag_entidades NOT NULL,

    clave       character(5)         UNIQUE NOT NULL,
    nombre      character varying    NOT NULL,

    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX dag_municipios_clave_index ON dag_municipios (clave);

SELECT AddGeometryColumn('', 'dag_municipios', 'geom', '97999', 'MULTIPOLYGON', 2);

--
-- Que al eliminar (estatus a B) una entidad, elimine (estatus a B) también todos sus municipios
--

CREATE OR REPLACE FUNCTION dag_entidades_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_municipios SET estatus='B' WHERE entidad=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_entidades_eliminar_trigger
    AFTER UPDATE ON dag_entidades
    FOR EACH ROW EXECUTE PROCEDURE dag_entidades_eliminar();
