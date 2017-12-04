--
-- TrcIMPLAN Central
--
-- Proyectos Proyectos
--

CREATE TABLE pro_proyectos (
    id             serial                         PRIMARY KEY,
    responsable    integer                        REFERENCES pro_responsables ON DELETE CASCADE NOT NULL,

    fecha          date                           NOT NULL,
    nombre         character varying              NOT NULL,

    creado         timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    notas          text,
    estatus        character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

-- CREATE INDEX pro_proyectos_responsable_index ON pro_proyectos (responsable);
-- CREATE INDEX pro_proyectos_nombre_index      ON pro_proyectos (nombre);

--
-- Que al eliminar (estatus a B) un responsable, elimine (estatus a B) también sus proyectos.
--

CREATE OR REPLACE FUNCTION pro_responsables_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE pro_proyectos SET estatus='B' WHERE responsable=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER pro_responsables_eliminar_trigger
    AFTER UPDATE ON pro_responsables
    FOR EACH ROW EXECUTE PROCEDURE pro_responsables_eliminar();
