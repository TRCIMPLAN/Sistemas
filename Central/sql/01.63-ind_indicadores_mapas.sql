--
-- TrcIMPLAN Central
--
-- Indicadores Mapas
--

CREATE TABLE ind_indicadores_mapas (
    id             serial                      PRIMARY KEY,
    indicador      integer                     REFERENCES ind_indicadores NOT NULL,
    region         integer                     REFERENCES cat_regiones,

    fecha          date                        NOT NULL,
    html           text,

    creado         timestamp without time zone DEFAULT ('now'::text)::timestamp without time zone,
    notas          text,
    estatus        character(1)                DEFAULT 'A'::bpchar NOT NULL
);

--
-- Que al agregar un mapa...
--     actualize el tiempo de modificación del indicador
--

CREATE OR REPLACE FUNCTION ind_indicadores_mapas_agregar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE ind_indicadores SET modificado = now() WHERE id=new.indicador;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_indicadores_mapas_agregar_trigger
    AFTER INSERT ON ind_indicadores_mapas
    FOR EACH ROW EXECUTE PROCEDURE ind_indicadores_mapas_agregar();

--
-- Que al modificar un mapa...
--     actualize el tiempo de modificación del indicador
--

CREATE OR REPLACE FUNCTION ind_indicadores_mapas_modificar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE ind_indicadores SET modificado = now() WHERE id=old.indicador;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER ind_indicadores_mapas_modificar_trigger
    AFTER UPDATE ON ind_indicadores_mapas
    FOR EACH ROW EXECUTE PROCEDURE ind_indicadores_mapas_modificar();
