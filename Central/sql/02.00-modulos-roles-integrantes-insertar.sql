--
-- TrcIMPLAN Central
--
-- Módulos, roles insertar
--

-- Módulos en rama Indicadores
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (153, 'ind_matriz',     'Matriz',     'gnome-iagno.png',           'indmatriz.php',     14); -- 20
INSERT INTO adm_modulos (orden, clave, nombre, icono, pagina, padre) VALUES (151, 'ind_categorias', 'Categorías', 'applications-graphics.png', 'indcategorias.php', 14); -- 21

-- Desarrolo de Sistemas(1)
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 20, 1);
INSERT INTO adm_roles (departamento, modulo, permiso_maximo) VALUES (1, 21, 1);
