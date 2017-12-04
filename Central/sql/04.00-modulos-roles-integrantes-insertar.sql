--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Catálogos
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (831, 'cat_categorias',          'Categorías', 'gnome-iagno.png', 'catcategorias.php',         10); -- 26
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (833, 'cat_categorias_vinculos', 'Vínculos',   'midori.png',      'catcategoriasvinculos.php', 10); -- 27

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 26, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 27, 1);

-- Módulos en rama Proyectos
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (301, 'pro_menu',                     '-Proyectos',     'applications-system.png',      'proproyectos.php',             null); -- 28
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (311, 'pro_criterios',                'Criterios',      'gnome-glchess.png',            'procriterios.php',               28); -- 29
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (321, 'pro_factores',                 'Factores',       'transmission.png',             'profactores.php',                28); -- 30
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (331, 'pro_evaluadores',              'Evaluadores',    'eog.png',                      'proevaluadores.php',             28); -- 31
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (341, 'pro_responsables',             'Responsables',   'applications-development.png', 'proresponsables.php',            28); -- 32
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (351, 'pro_proyectos',                'Proyectos',      'applications-system.png',      'proproyectos.php',               28); -- 33
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (361, 'pro_proyectos_calificaciones', 'Calificaciones', 'gnome-sudoku.png',             'proproyectoscalificaciones.php', 28); -- 34

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 28, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 29, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 30, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 31, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 32, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 33, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 34, 5);
