--
-- TrcIMPLAN Central
--
-- Catálogos Unidades
--

CREATE TABLE cat_unidades (
    id             serial                    PRIMARY KEY,

    nombre         character varying         NOT NULL,

    notas          text,
    estatus        character(1)              DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO cat_unidades (nombre) VALUES ('00) SIN UNIDAD');                             --  1
--~ INSERT INTO cat_unidades (nombre) VALUES ('CANTIDAD');                                   --  2
--~ INSERT INTO cat_unidades (nombre) VALUES ('PORCENTAJE');                                 --  3
--~ INSERT INTO cat_unidades (nombre) VALUES ('PROMEDIO');                                   --  4
--~ INSERT INTO cat_unidades (nombre) VALUES ('POR CADA MIL');                               --  5
--~ INSERT INTO cat_unidades (nombre) VALUES ('POR CADA 10 MIL');                            --  6
--~ INSERT INTO cat_unidades (nombre) VALUES ('POR CADA 100 MIL');                           --  7
--~ INSERT INTO cat_unidades (nombre) VALUES ('M3 PER CAPITA');                              --  8
--~ INSERT INTO cat_unidades (nombre) VALUES ('M3 COMBUSTIBLES POR CADA MILLON DE PIB');     --  9
--~ INSERT INTO cat_unidades (nombre) VALUES ('M3 DIESEL/10 MIL HAB/KM RED CARRETERA');      -- 10
--~ INSERT INTO cat_unidades (nombre) VALUES ('DIFERENCIA DE VOTOS ENTRE EL 1° Y 2° LUGAR'); -- 11
--~ INSERT INTO cat_unidades (nombre) VALUES ('HABITANTES POR KM2');                         -- 12
--~ INSERT INTO cat_unidades (nombre) VALUES ('1)SI TIENE, 0)NO TIENE');                     -- 13
