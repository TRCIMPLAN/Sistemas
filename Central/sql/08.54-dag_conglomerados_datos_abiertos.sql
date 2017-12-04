--
-- TrcIMPLAN Central
--
-- Desagregación Conglomerados datos abiertos
--

CREATE VIEW dag_conglomerados_datos_abiertos AS
    SELECT
        nombre,
        pobtot, porpobmas, porpobfem,
        porpob0a14, porpob15a64, porpob65ymas, porpobrne,
        promhnv, porpobclim,
        pea, peamas, peafem,
        pobocu, pobocumas, pobocufem,
        pobdesocu, derechohab,
        hogares, vivelect, vivagua, vivdrenaje, vivtv, vivauto, vivcompu,
        aetot,
        aetop1actividad, aetop1valor,
        aetop2actividad, aetop2valor,
        aetop3actividad, aetop3valor,
        aetop4actividad, aetop4valor,
        aetop5actividad, aetop5valor,
        cp, url, geom
    FROM dag_conglomerados
    WHERE
        estatus = 'A'
        AND visibilidad = 'V'
    ORDER BY nombre ASC;
