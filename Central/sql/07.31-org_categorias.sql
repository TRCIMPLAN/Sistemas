--
-- TrcIMPLAN Central
--
-- Organizador Categorías
--

CREATE TABLE org_categorias (
    id               serial               PRIMARY KEY,

    nombre           character varying    UNIQUE NOT NULL,
    imagen           character varying,
    imagen_previa    character varying,
    css_id           character varying,

    estatus          character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO org_categorias (nombre) VALUES ('SIN CATEGORÍA');

INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Bienestar', '/imagenes/categorias/bienestar.jpg', '/imagenes/categorias/bienestar.jpg', 'categorias-bienestar');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Competitividad', '/imagenes/categorias/competitividad.jpg', '/imagenes/categorias/competitividad.jpg', 'categorias-competitividad');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Cultura', '/imagenes/categorias/cultura.jpg', '/imagenes/categorias/cultura.jpg', 'categorias-cultura');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Delincuencia', '/imagenes/categorias/delincuencia.jpg', '/imagenes/categorias/delincuencia.jpg', 'categorias-delincuencia');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Doing Business', '/imagenes/categorias/doing-business.jpg', '/imagenes/categorias/doing-business.jpg', 'categorias-doing-business');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Educación', '/imagenes/categorias/educacion.jpg', '/imagenes/categorias/educacion.jpg', 'categorias-educacion');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Empleo', '/imagenes/categorias/empleo.jpg', '/imagenes/categorias/empleo.jpg', 'categorias-empleo');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Empresas', '/imagenes/categorias/empresas.jpg', '/imagenes/categorias/empresas.jpg', 'categorias-empresas');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Finanzas Públicas', '/imagenes/categorias/finanzas-publicas.jpg', '/imagenes/categorias/finanzas-publicas.jpg', 'categorias-finanzas-publicas');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Género', '/imagenes/categorias/genero.jpg', '/imagenes/categorias/genero.jpg', 'categorias-genero');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Gobierno', '/imagenes/categorias/gobierno.jpg', '/imagenes/categorias/gobierno.jpg', 'categorias-gobierno');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Gobierno Digital', '/imagenes/categorias/gobierno-digital.jpg', '/imagenes/categorias/gobierno-digital.jpg', 'categorias-gobierno-digital');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Grupos Vulnerables', '/imagenes/categorias/grupos-vulnerables.jpg', '/imagenes/categorias/grupos-vulnerables.jpg', 'categorias-grupos-vulnerables');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Índice de Competitividad Urbana', '/imagenes/categorias/indice-de-competitividad-urbana.jpg', '/imagenes/categorias/indice-de-competitividad-urbana.jpg', 'categorias-indice-de-competitividad-urbana');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Infraestructura', '/imagenes/categorias/infraestructura.jpg', '/imagenes/categorias/infraestructura.jpg', 'categorias-infraestructura');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Innovación', '/imagenes/categorias/innovacion.jpg', '/imagenes/categorias/innovacion.jpg', 'categorias-innovacion');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Macroeconomía', '/imagenes/categorias/macroeconomia.jpg', '/imagenes/categorias/macroeconomia.jpg', 'categorias-macroeconomia');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Mercados', '/imagenes/categorias/mercados.jpg', '/imagenes/categorias/mercados.jpg', 'categorias-mercados');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Movilidad', '/imagenes/categorias/movilidad.jpg', '/imagenes/categorias/movilidad.jpg', 'categorias-movilidad');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Objetivos del Milenio', '/imagenes/categorias/objetivos-del-milenio.jpg', '/imagenes/categorias/objetivos-del-milenio.jpg', 'categorias-objetivos-del-milenio');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Participación Ciudadana', '/imagenes/categorias/participacion-ciudadana.jpg', '/imagenes/categorias/participacion-ciudadana.jpg', 'categorias-participacion-ciudadana');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Población', '/imagenes/categorias/poblacion.jpg', '/imagenes/categorias/poblacion.jpg', 'categorias-poblacion');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Recursos Naturales', '/imagenes/categorias/recursos-naturales.jpg', '/imagenes/categorias/recursos-naturales.jpg', 'categorias-recursos-naturales');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Salud', '/imagenes/categorias/salud.jpg', '/imagenes/categorias/salud.jpg', 'categorias-salud');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Seguridad', '/imagenes/categorias/seguridad.jpg', '/imagenes/categorias/seguridad.jpg', 'categorias-seguridad');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Servicios Públicos', '/imagenes/categorias/servicios-publicos.jpg', '/imagenes/categorias/servicios-publicos.jpg', 'categorias-servicios-publicos');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Sistema de Indicadores de Desempeño (SINDES)', '/imagenes/categorias/sistema-de-indicadores-de-desempeno-sindes.jpg', '/imagenes/categorias/sistema-de-indicadores-de-desempeno-sindes.jpg', 'categorias-sistema-de-indicadores-de-desempeno-sindes');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Transparencia', '/imagenes/categorias/transparencia.jpg', '/imagenes/categorias/transparencia.jpg', 'categorias-transparencia');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Vialidad', '/imagenes/categorias/vialidad.jpg', '/imagenes/categorias/vialidad.jpg', 'categorias-vialidad');
INSERT INTO org_categorias (nombre, imagen, imagen_previa, css_id) VALUES ('Vivienda', '/imagenes/categorias/vivienda.jpg', '/imagenes/categorias/vivienda.jpg', 'categorias-vivienda');
