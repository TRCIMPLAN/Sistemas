--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Catálogos
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (801, 'cat_menu',              '-Catálogos',        'multimedia-player-ipod-touch.png', 'catfuentes.php',  null); -- 10
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (811, 'cat_fuentes',           'Fuentes',           'gnome-do.png',                     'catfuentes.php',    10); -- 11
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (813, 'cat_regiones',          'Regiones',          'applications-internet.png',        'catregiones.php',   11); -- 12
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (815, 'cat_unidades',          'Unidades',          'accessories-calculator.png',       'catunidades.php',   12); -- 13

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 10, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 11, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 12, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 13, 5);

-- Módulos en rama Indicadores
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre)          VALUES (101, 'ind_menu',              '-Indicadores',      'applications-office.png',      'indindicadores.php',      null); -- 14
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre)          VALUES (111, 'ind_subindices',        'Subíndices',        'gnome-glchess.png',            'indsubindices.php',         14); -- 15
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (121, 'ind_subindices_pesos',  'Pesos'    ,         'transmission.png',             'indsubindicespesos.php',    14, 'B'); -- 16
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre)          VALUES (131, 'ind_indicadores',       'Indicadores',       'gnome-do.png',                 'indindicadores.php',        14); -- 17
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre)          VALUES (141, 'ind_indicadores_datos', 'Indicadores datos', 'applications-accessories.png', 'indindicadoresdatos.php',   14); -- 18
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre)          VALUES (143, 'ind_indicadores_mapas', 'Indicadores mapas', 'applications-internet.png',    'indindicadoresmapas.php',   14); -- 19

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 14, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 15, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 16, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 17, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 18, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 19, 5);
