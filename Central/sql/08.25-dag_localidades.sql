--
-- TrcIMPLAN Central
--
-- Desagregación Localidades
--

CREATE TABLE dag_localidades (
    id          serial               PRIMARY KEY,
    municipio   integer              REFERENCES dag_municipios NOT NULL,

    clave       character(9)         UNIQUE NOT NULL,
    nombre      character varying    NOT NULL,

    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX dag_localidades_clave_index ON dag_localidades (clave);

SELECT AddGeometryColumn('', 'dag_localidades', 'geom', '97999', 'MULTIPOLYGON', 2);

--
-- Que al eliminar (estatus a B) un municipio, elimine (estatus a B) también todos sus localidades
--

CREATE OR REPLACE FUNCTION dag_municipios_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_localidades SET estatus='B' WHERE municipio=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_municipios_eliminar_trigger
    AFTER UPDATE ON dag_municipios
    FOR EACH ROW EXECUTE PROCEDURE dag_municipios_eliminar();
