--
-- TrcIMPLAN Central
--
-- Proyectos Proyectos Calificaciones
--

CREATE TABLE pro_proyectos_calificaciones (
    id              serial                         PRIMARY KEY,
    proyecto        integer                        REFERENCES pro_proyectos   NOT NULL,
    evaluador       integer                        REFERENCES pro_evaluadores NOT NULL,
    factor          integer                        REFERENCES pro_factores    NOT NULL,

    calificacion    integer                        NOT NULL,

    creado          timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    notas           text,
    estatus         character(1)                   DEFAULT 'A'::bpchar NOT NULL
);

CREATE INDEX pro_calificaciones_proyecto_index  ON pro_proyectos_calificaciones (proyecto);
CREATE INDEX pro_calificaciones_evaluador_index ON pro_proyectos_calificaciones (evaluador);
CREATE INDEX pro_calificaciones_factor_index    ON pro_proyectos_calificaciones (factor);

--
-- Que al eliminar (estatus a B) un proyecto, elimine (estatus a B) también todos sus calificaciones.
--

CREATE OR REPLACE FUNCTION pro_proyectos_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE pro_proyectos_calificaciones SET estatus='B' WHERE proyecto=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER pro_proyectos_eliminar_trigger
    AFTER UPDATE ON pro_proyectos
    FOR EACH ROW EXECUTE PROCEDURE pro_proyectos_eliminar();

--
-- Que al eliminar (estatus a B) un evaluador, elimine (estatus a B) también todos sus calificaciones.
--

CREATE OR REPLACE FUNCTION pro_evaluadores_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE pro_proyectos_calificaciones SET estatus='B' WHERE evaluador=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER pro_evaluadores_eliminar_trigger
    AFTER UPDATE ON pro_evaluadores
    FOR EACH ROW EXECUTE PROCEDURE pro_evaluadores_eliminar();

--
-- Que al eliminar (estatus a B) un factor, elimine (estatus a B) también sus calificaciones
--

CREATE OR REPLACE FUNCTION pro_factores_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE pro_proyectos_calificaciones SET estatus='B' WHERE factor=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER pro_factores_eliminar_trigger
    AFTER UPDATE ON pro_factores
    FOR EACH ROW EXECUTE PROCEDURE pro_factores_eliminar();
