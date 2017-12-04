--
-- TrcIMPLAN Central
--
-- Desagregación Conglomerados
--

CREATE TABLE dag_conglomerados (
    id                serial               PRIMARY KEY,
    region            integer              REFERENCES dag_regiones NOT NULL,

    nombre            character varying    NOT NULL,
    nom_corto         character varying    NOT NULL,

    pobtot            integer,
    porpobmas         numeric(5,2),
    porpobfem         numeric(5,2),
    porpobne          numeric(5,2),
    porpob0a14        numeric(5,2),
    porpob15a64       numeric(5,2),
    porpob65ymas      numeric(5,2),
    porpobrne         numeric(5,2),
    promhnv           numeric(5,2),
    porpobnacoe       numeric(5,2),
    porpobclim        numeric(5,2),

    gpe               numeric(5,2),
    gpemas            numeric(5,2),
    gpefem            numeric(5,2),
    porpob15ymasanalf numeric(5,2),
    porpob18ymas      numeric(5,2),
    porpob18ymaspb    numeric(5,2),

    pea               numeric(5,2),
    peamas            numeric(5,2),
    peafem            numeric(5,2),
    pobocu            numeric(5,2),
    pobocumas         numeric(5,2),
    pobocufem         numeric(5,2),
    pobdesocu         numeric(5,2),
    derechohab        numeric(5,2),

    hogares           integer,
    hogjefmas         numeric(5,2),
    hogjeffem         numeric(5,2),
    ocuviv            numeric(5,2),
    vivelect          numeric(5,2),
    vivagua           numeric(5,2),
    vivdrenaje        numeric(5,2),
    vivtv             numeric(5,2),
    vivauto           numeric(5,2),
    vivcompu          numeric(5,2),
    vivcelular        numeric(5,2),
    vivinternet       numeric(5,2),

    aetot             integer,
    aetop1            character varying,
    aetop1actividad   character varying,
    aetop1valor       numeric(5,2),
    aetop2            character varying,
    aetop2actividad   character varying,
    aetop2valor       numeric(5,2),
    aetop3            character varying,
    aetop3actividad   character varying,
    aetop3valor       numeric(5,2),
    aetop4            character varying,
    aetop4actividad   character varying,
    aetop4valor       numeric(5,2),
    aetop5            character varying,
    aetop5actividad   character varying,
    aetop5valor       numeric(5,2),

    cp                character varying(64),
    cp_codigo         character(1),
    cp_notas          text,
    url               character varying,
    notas             text,

    creado            timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    modificado        timestamp without time zone    DEFAULT ('now'::text)::timestamp without time zone,
    visibilidad       character(1)                   DEFAULT 'V'::bpchar NOT NULL,
    estatus           character(1)                   DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE(region, nom_corto)
);

-- Polígonos de manzanas derivados de INEGI SRID(97999)
SELECT AddGeometryColumn('', 'dag_conglomerados', 'geom', '97999', 'MULTIPOLYGON', 2);

-- Centro con WGS84 = SRID(4326) porque es latitud y longitud tradicional, vea IBC5ActualizarCentroides.py
SELECT AddGeometryColumn('', 'dag_conglomerados', 'centro', '4326', 'POINT', 2);

-- visibilidad
--   O => Oculto
--   V => Visible

--
-- Que al agregar un conglomerado...
--   Actualice el tiempo de modificación de la región
--
CREATE OR REPLACE FUNCTION dag_conglomerados_agregar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE dag_regiones SET modificado = now() WHERE id=new.region;
        RETURN NULL;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_conglomerados_agregar_trigger
    AFTER INSERT ON dag_conglomerados
    FOR EACH ROW EXECUTE PROCEDURE dag_conglomerados_agregar();

--
-- Que al actualizar un conglomerado...
--   Actualice el tiempo de modificación de la región
--   Y actualice su propio tiempo de modificación
--
CREATE OR REPLACE FUNCTION dag_conglomerados_modificar() RETURNS TRIGGER AS $nulo$
    BEGIN
        UPDATE dag_regiones SET modificado = now() WHERE id=old.region;
        NEW.modificado = now();
        RETURN NEW;
    END;
$nulo$ LANGUAGE plpgsql;

CREATE TRIGGER dag_conglomerados_modificar_trigger
    BEFORE UPDATE ON dag_conglomerados
    FOR EACH ROW EXECUTE PROCEDURE dag_conglomerados_modificar();

-- DESHABILITADO: Agregar nuevas columnas en Servidora
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop1actividad character varying;
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop1valor     numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop2actividad character varying;
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop2valor     numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop3actividad character varying;
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop3valor     numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop4actividad character varying;
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop4valor     numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop5actividad character varying;
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN aetop5valor     numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD   COLUMN creado     timestamp without time zone;
-- ~ ALTER TABLE dag_conglomerados ALTER COLUMN creado     SET DEFAULT ('now'::text)::timestamp without time zone;
-- ~ ALTER TABLE dag_conglomerados ADD   COLUMN modificado timestamp without time zone;
-- ~ ALTER TABLE dag_conglomerados ALTER COLUMN modificado SET DEFAULT ('now'::text)::timestamp without time zone;

-- DESHABILITADO: Agregar nuevas columnas en Servidora
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN porpob15ymasanalf numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN porpob18ymas      numeric(5,2);
-- ~ ALTER TABLE dag_conglomerados ADD COLUMN porpob18ymaspb    numeric(5,2);
