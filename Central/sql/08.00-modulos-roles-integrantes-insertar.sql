--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Catálogos
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (841, 'dag_catalogos_menu',         '-Microdatos',    'bug-buddy.png',             'dagejes.php',                  null); -- 54
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (842, 'dag_ejes',                   'Ejes',           'folder.png',                'dagejes.php',                    54); -- 55
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (843, 'dag_catalogos',              'Catálogos',      'folder.png',                'dagcatalogos.php',               54); -- 56
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (844, 'dag_entidades',              'Entidades',      'folder.png',                'dagentidades.php',               54); -- 57
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (845, 'dag_municipios',             'Municipios',     'folder.png',                'dagmunicipios.php',              54); -- 58
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (846, 'dag_localidades',            'Localidades',    'folder.png',                'daglocalidades.php',             54); -- 59
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (847, 'dag_agebs',                  'AGEBs',          'folder.png',                'dagagebs.php',                   54); -- 60
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (848, 'dag_manzanas',               'Manzanas',       'folder.png',                'dagmanzanas.php',                54); -- 61
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (849, 'dag_manzanas_componentes',   'Componentes',    'gnome-sudoku.png',          'dagmanzanascomponentes.php',     54); -- 62

-- Módulos en rama Desagregación
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (201, 'dag_menu',                   '-Desagregación', 'supertux.png',              'dagconglomerados.php',         null); -- 63
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (211, 'dag_regiones',               'Regiones',       'applications-internet.png', 'dagregiones.php',                63); -- 64
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (223, 'dag_conglomerados',          'Conglomerados',  'gnome-robots.png',          'dagconglomerados.php',           63); -- 65
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (225, 'dag_conglomerados_manzanas', 'Manzanas',       'text-css.png',              'dagconglomeradosmanzanas.php',   63); -- 66

-- Roles para IMPLAN Desarrollo(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 54, 1); -- Rama Catálogos
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 55, 5); --      Ejes
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 56, 5); --      Catálogos
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 57, 1); --      Entidades    <--+
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 58, 1); --      Municipios   <  |
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 59, 1); --      Localidades  <  | INEGI
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 60, 1); --      AGEBs        <  |
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 61, 1); --      Manzanas     <--+
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 62, 3); --      Componentes
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 63, 1); -- Rama Desagregación
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 64, 5); --      Regiones
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 65, 5); --      Conglomerados
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 66, 5); --      Manzanas
