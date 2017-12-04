--
-- TrcIMPLAN Central
--
-- Vista Indicadores Datos Abiertos
--

CREATE VIEW ind_indicadores_datos_abiertos AS
    SELECT
        s.nombre AS subindice,
        i.nombre AS indicador,
        r.nombre AS region,
        d.fecha, d.cantidad, d.decimal, d.dinero, d.porcentaje, d.caracter,
        u.nombre AS unidad,
        f.nombre AS fuente,
        i.categorias
    FROM
        ind_subindices s,
        ind_indicadores i,
        ind_indicadores_datos d,
        cat_fuentes f,
        cat_unidades u,
        cat_regiones r
    WHERE
        i.subindice = s.id
        AND d.indicador = i.id
        AND s.estatus = 'A'
        AND i.estatus = 'A'
        AND d.estatus = 'A'
        AND i.unidad = u.id
        AND d.fuente = f.id
        AND d.region = r.id
    ORDER BY
        subindice, indicador, region, fecha ASC;
