--
-- TrcIMPLAN Central
--
-- Proyectos Factores
--

CREATE TABLE pro_factores (
    id          serial               PRIMARY KEY,
    criterio    integer              REFERENCES pro_criterios NOT NULL,

    nombre      character varying    NOT NULL,

    notas       text,
    estatus     character(1)         DEFAULT 'A'::bpchar NOT NULL
);

-- Factores Técnicos (1)
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Análisis Costo Beneficio (Factibilidad)'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Polígono de Pobreza'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Polígono de Delincuencia'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Polígono de Actuación PRDU'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Plan Nacional de Desarrollo'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Plan Estatal de Desarrollo'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Plan Municipal de Desarrollo'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (1, 'Plan Estratégico Metropolitano'); --

-- Competitividad Global (2)
INSERT INTO pro_factores (criterio, nombre) VALUES (2, 'Ciudades Inteligentes'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (2, 'Innovación y Sofisticación'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (2, 'Factores Precursores de Clase Mundial'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (2, 'Estándares Internacionales'); --

-- Impacto (3)
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Impacto Social'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Impacto Urbano'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Sustentabilidad'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Movilidad Urbana'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Impacto Económico'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Impacto Sectorial'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Salud'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Educación'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Cultura'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Seguridad'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (3, 'Buen Gobierno'); --

-- Plus (4)
INSERT INTO pro_factores (criterio, nombre) VALUES (4, 'Estudio de Expertos'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (4, 'Concenso Social'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (4, 'Liderazgo Social'); --
INSERT INTO pro_factores (criterio, nombre) VALUES (4, 'Recursos Público - Privados'); --

--
-- Que al eliminar (estatus a B) un criterio, elimine (estatus a B) también sus factores.
--

CREATE OR REPLACE FUNCTION pro_criterios_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE pro_factores SET estatus='B' WHERE responsable=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER pro_criterios_eliminar_trigger
    AFTER UPDATE ON pro_criterios
    FOR EACH ROW EXECUTE PROCEDURE pro_criterios_eliminar();
