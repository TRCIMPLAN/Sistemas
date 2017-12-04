--
-- TrcIMPLAN Central
--
-- Indicadores Datos
--

CREATE TABLE ind_indicadores_datos (
    id             serial                      PRIMARY KEY,
    indicador      integer                     REFERENCES ind_indicadores NOT NULL,
    fuente         integer                     REFERENCES cat_fuentes     NOT NULL,
    region         integer                     REFERENCES cat_regiones    NOT NULL,

    fecha          date                        NOT NULL,

    cantidad       integer,
    decimal        numeric(16,4),
    dinero         numeric(16,2),
    porcentaje     numeric(7,4),
    caracter       character(1),

    creado         timestamp without time zone DEFAULT ('now'::text)::timestamp without time zone,
    notas          text,
    estatus        character(1)                DEFAULT 'A'::bpchar NOT NULL
);

--
-- Que al agregar un dato...
--     actualize el tiempo de modificación del indicador
--

CREATE OR REPLACE FUNCTION ind_indicadores_datos_agregar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE ind_indicadores SET modificado = now() WHERE id=new.indicador;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_indicadores_datos_agregar_trigger
    AFTER INSERT ON ind_indicadores_datos
    FOR EACH ROW EXECUTE PROCEDURE ind_indicadores_datos_agregar();

--
-- Que al modificar un dato...
--     actualize el tiempo de modificación del indicador
--

CREATE OR REPLACE FUNCTION ind_indicadores_datos_modificar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE ind_indicadores SET modificado = now() WHERE id=old.indicador;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_indicadores_datos_modificar_trigger
    AFTER UPDATE ON ind_indicadores_datos
    FOR EACH ROW EXECUTE PROCEDURE ind_indicadores_datos_modificar();

--
-- Que al eliminar (estatus a B) un indicador...
--     elimine (estatus a B) también todos sus datos
--     elimine (estatus a B) también todos sus mapas

CREATE OR REPLACE FUNCTION ind_indicadores_eliminar() RETURNS TRIGGER AS $nulo$
    BEGIN
        IF (TG_OP = 'UPDATE') AND old.estatus='A' AND new.estatus='B' THEN
            UPDATE ind_indicadores_datos SET estatus='B' WHERE indicador=old.id;
            UPDATE ind_indicadores_mapas SET estatus='B' WHERE indicador=old.id;
        END IF;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_indicadores_eliminar_trigger
    AFTER UPDATE ON ind_indicadores
    FOR EACH ROW EXECUTE PROCEDURE ind_indicadores_eliminar();
