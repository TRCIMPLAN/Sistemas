--
-- TrcIMPLAN Central
--
-- Organizador Ramas
--

CREATE TABLE org_ramas (
    id                  serial                   PRIMARY KEY,
    arbol               integer                  REFERENCES org_arboles  NOT NULL,

    nivel               smallint                 DEFAULT 0 NOT NULL,
    nom_corto           character varying        UNIQUE NOT NULL,
    nombre              character varying        NOT NULL,
    titulo              character varying        NOT NULL,
    descripcion         text,
    claves              character varying        NOT NULL,
    encabezado_color    character varying(16),
    nombre_menu         character varying        NOT NULL,
    concentrador        character(1)             DEFAULT 'I'::bpchar NOT NULL,
    directorio          character varying        NOT NULL,
    namespace           character varying        NOT NULL,

    estatus             character(1)             DEFAULT 'A'::bpchar NOT NULL
);

--
-- concentrador
--   G Galería
--   I Índice
--   T Tarjetas
--
-- nivel es un número entero y positivo que sirve para establecer el orden
--   n01 SIN región
--   n11 Torreón
--   n21 Gómez Palacio
--   n31 Lerdo
--   n41 Matamoros
--   n91 La Laguna
--

-- Árbol 1 Análisis
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (1, 101, 'Análisis', 'Análisis Publicados', 'Análisis Publicados', 'Descripción.', 'IMPLAN, Torreon, Analisis', '800000', 'Análisis Publicados', 'I', 'blog', 'Blog');

-- Árbol 2 Indicadores
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (2, 211, 'Indicadores Torreón', 'Indicadores de Torreón', 'Indicadores de Torreón', 'Descripción.', 'IMPLAN, Torreon, Indicadores', 'CA198A', 'Indicadores > Indicadores por Región', 'G', 'indicadores-torreon', 'SMIIndicadoresTorreon');
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (2, 221, 'Indicadores Gómez Palacio', 'Indicadores de Gómez Palacio', 'Indicadores de Gómez Palacio', 'Descripción.', 'IMPLAN, Torreon, Indicadores, Gomez Palacio', 'CA198A', 'Indicadores > Indicadores por Región', 'G', 'indicadores-gomez-palacio', 'SMIIndicadoresGomezPalacio');
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (2, 231, 'Indicadores Lerdo', 'Indicadores de Lerdo', 'Indicadores de Lerdo', 'Descripción.', 'IMPLAN, Torreon, Indicadores, Lerdo', 'CA198A', 'Indicadores > Indicadores por Región', 'G', 'indicadores-lerdo', 'SMIIndicadoresLerdo');
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (2, 241, 'Indicadores Matamoros', 'Indicadores de Matamoros', 'Indicadores de Matamoros', 'Descripción.', 'IMPLAN, Torreon, Indicadores, Matamoros', 'CA198A', 'Indicadores > Indicadores por Región', 'G', 'indicadores-matamoros', 'SMIIndicadoresMatamoros');
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (2, 291, 'Indicadores La Laguna', 'Indicadores de La Laguna', 'Indicadores de La Laguna', 'Descripción.', 'IMPLAN, Torreon, Indicadores, La Laguna', 'CA198A', 'Indicadores > Indicadores por Región', 'G', 'indicadores-la-laguna', 'SMIIndicadoresLaLaguna');

-- Árbol 3 Georreferenciados
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (3, 311, 'Georreferenciados Torreón', 'Sistema de Información Geográfica de Torreón', 'Sistema de Información Geográfica de Torreón', 'Descripción.', 'IMPLAN, SIG, Información, Geográfica, Torreón', '008000', 'Información Geográfica > S.I.G. de Torreón', 'T', 'sig-mapas-torreon', 'SIGMapasTorreon');

-- Árbol 4 Planes
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (4, 401, 'Planes', 'Planes', 'Planes', 'Descripción.', 'IMPLAN, Torreon, Planes, Documentos, Reglamentos', '008000', 'Información Geográfica > Planes', 'T', 'sig-planes', 'SIGPlanes');

-- Árbol 5 Proyectos
INSERT INTO org_ramas (arbol, nivel, nom_corto, nombre, titulo, descripcion, claves, encabezado_color, nombre_menu, concentrador, directorio, namespace)
    VALUES (5, 501, 'Proyectos', 'Proyectos Estratégicos', 'Proyectos Estratégicos', 'Descripción.', 'IMPLAN, Torreon, Banco, Municipal, Proyectos', '5A1E81', 'Proyectos Estratégicos', 'I', 'proyectos', 'Proyectos');
