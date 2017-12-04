--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Categorías
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (821, 'cat_investigaciones_calidades', 'Clasif. Calidades', 'applications-utilities.png',     'catinvestigacionescalidades.php',   10); -- 22
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (823, 'cat_investigaciones_fuentes',   'Clasif. Fuentes',   'applications-games.png',         'catinvestigacionesfuentes.php',     10); -- 23
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (825, 'cat_investigaciones_alcances',  'Clasif. Alcances',  'preferences-desktop-locale.png', 'catinvestigacionesalcances.php',    10); -- 24

-- Módulos en rama Investigaciones
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (391, 'inv_investigaciones',           'Investigaciones',   'accessories-text-editor.png',    'invinvestigaciones.php',          null); -- 25

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 22, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 23, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 24, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 25, 5);
