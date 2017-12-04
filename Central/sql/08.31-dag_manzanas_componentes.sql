--
-- TrcIMPLAN Central
--
-- Desagregación Manzanas Componentes
--

CREATE TABLE dag_manzanas_componentes (
    id            serial            PRIMARY KEY,
    manzana       integer           REFERENCES dag_manzanas  NOT NULL,
    catalogo      integer           REFERENCES dag_catalogos NOT NULL,

    fecha         date              NOT NULL,
    dato          numeric(16,4),    -- 123,456;789,012.3456

    estatus       character(1)      DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE (manzana, catalogo, fecha)
);

--
-- Que al eliminar (estatus a B) una manzana, elimine (estatus a B) también todos sus componentes
--

CREATE OR REPLACE FUNCTION dag_manzanas_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_manzanas_componentes SET estatus='B' WHERE manzana=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_manzanas_eliminar_trigger
    AFTER UPDATE ON dag_manzanas
    FOR EACH ROW EXECUTE PROCEDURE dag_manzanas_eliminar();

--
-- Que al eliminar (estatus a B) una catálogo, elimine (estatus a B) también todos sus componentes
--

CREATE OR REPLACE FUNCTION dag_catalogos_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE dag_manzanas_componentes SET estatus='B' WHERE catalogo=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_catalogos_eliminar_trigger
    AFTER UPDATE ON dag_catalogos
    FOR EACH ROW EXECUTE PROCEDURE dag_catalogos_eliminar();
