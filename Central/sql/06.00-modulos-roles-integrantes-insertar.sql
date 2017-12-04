--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama SIG
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (501, 'sig_menu',      '-SIG',      'midori.png',               'sigmapas.php',   null); -- 41
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (511, 'sig_autores',   'Autores',   'system-users.png',         'sigautores.php',   41); -- 42
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (521, 'sig_imprentas', 'Imprentas', 'internet-news-reader.png', 'sigimprentas.php', 41); -- 43
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (551, 'sig_mapas',     'Mapas',     'eog.png',                  'sigmapas.php',     41); -- 44

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 41, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 42, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 43, 5);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 44, 5);
