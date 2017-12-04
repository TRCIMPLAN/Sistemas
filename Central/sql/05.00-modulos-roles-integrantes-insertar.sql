--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Análisis
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (401, 'ana_menu',                     '-Análisis',     'folder.png', 'ana.php',                      null, 'B'); -- 35
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (411, 'ana_autores',                  'Autores',       'folder.png', 'anaautores.php',                 35, 'B'); -- 36
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (421, 'ana_imprentas',                'Imprentas',     'folder.png', 'anaimprentas.php',               35, 'B'); -- 37
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (451, 'ana_publicaciones',            'Publicaciones', 'folder.png', 'anapublicaciones.php',           35, 'B'); -- 38
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (461, 'ana_publicaciones_imagenes',   'Imágenes',      'folder.png', 'anapublicacionesimagenes.php',   35, 'B'); -- 39
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre, estatus) VALUES (471, 'ana_publicaciones_documentos', 'Documentos',    'folder.png', 'anapublicacionesdocumentos.php', 35, 'B'); -- 40

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 35, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 36, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 37, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 38, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 39, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 40, 5);
