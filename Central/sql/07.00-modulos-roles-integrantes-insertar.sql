--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (901, 'org_menu',       '-Organizador', 'system-file-manager.png',     'orgarboles.php',   null); -- 45
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (911, 'org_arboles',    'Árboles',      'system-file-manager.png',     'orgarboles.php',     45); -- 46
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (915, 'org_ramas',      'Ramas',        'opera-extension.png',         'orgramas.php',       45); -- 47
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (925, 'org_vinculos',   'Vínculos',     'gnome-panel-launcher.png',    'orgvinculos.php',    45); -- 48
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (931, 'org_autores',    'Autores',      'gbrainy.png',                 'orgautores.php',     45); -- 49
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (933, 'org_categorias', 'Categorías',   'text-css.png',                'orgcategorias.php',  45); -- 50
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (935, 'org_regiones',   'Regiones',     'applications-internet.png',   'orgregiones.php',    45); -- 51
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (937, 'org_fuentes',    'Fuentes',      'opera-unite-application.png', 'orgfuentes.php',     45); -- 52
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (945, 'org_elementos',  'Elementos',    'gnome-glines.png',            'orgelementos.php',   45); -- 53

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 45, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 46, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 47, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 48, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 49, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 50, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 51, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 52, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 53, 5);
