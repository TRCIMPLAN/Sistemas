--
-- TrcIMPLAN Central
--
-- Organizador Fuentes
--

CREATE TABLE org_fuentes (
    id         serial               PRIMARY KEY,

    nombre     character varying    UNIQUE NOT NULL,

    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);

INSERT INTO org_fuentes (nombre) VALUES ('SIN FUENTE');

INSERT INTO org_fuentes (nombre) VALUES ('Ayuntamiento de Torreón');
INSERT INTO org_fuentes (nombre) VALUES ('Banco Mundial');
INSERT INTO org_fuentes (nombre) VALUES ('CIDE');
INSERT INTO org_fuentes (nombre) VALUES ('CIESLAG-FOMEC');
INSERT INTO org_fuentes (nombre) VALUES ('Comisión Nacional Bancaria y de Valores (CNBV)');
INSERT INTO org_fuentes (nombre) VALUES ('CONACULTA-IMPLAN');
INSERT INTO org_fuentes (nombre) VALUES ('CONACYT');
INSERT INTO org_fuentes (nombre) VALUES ('CONAPO');
INSERT INTO org_fuentes (nombre) VALUES ('CONEVAL');
INSERT INTO org_fuentes (nombre) VALUES ('Doing Business');
INSERT INTO org_fuentes (nombre) VALUES ('Elaboración propia con datos obtenidos del INEGI');
INSERT INTO org_fuentes (nombre) VALUES ('Elaboración propia con datos obtenidos del INEGI y la Secretaría de Economía');
INSERT INTO org_fuentes (nombre) VALUES ('Encuesta Nacional de Ocupación y Empleo (ENOE) Microdatos');
INSERT INTO org_fuentes (nombre) VALUES ('ICAI-IDAIP');
INSERT INTO org_fuentes (nombre) VALUES ('IMCO');
INSERT INTO org_fuentes (nombre) VALUES ('IMCO-CONAGUA');
INSERT INTO org_fuentes (nombre) VALUES ('IMPLAN');
INSERT INTO org_fuentes (nombre) VALUES ('IMSS Subdelegación Torreón');
INSERT INTO org_fuentes (nombre) VALUES ('INAFED-PNUD');
INSERT INTO org_fuentes (nombre) VALUES ('INEGI');
INSERT INTO org_fuentes (nombre) VALUES ('INE-IEPCC');
INSERT INTO org_fuentes (nombre) VALUES ('Logit');
INSERT INTO org_fuentes (nombre) VALUES ('Operadora Mexicana de Aeropuertos (OMA)');
INSERT INTO org_fuentes (nombre) VALUES ('Plan Estratégico Metropolitano');
INSERT INTO org_fuentes (nombre) VALUES ('Programa de Naciones Unidas para el Desarrollo (PNUD)');
INSERT INTO org_fuentes (nombre) VALUES ('RFOSC');
INSERT INTO org_fuentes (nombre) VALUES ('SCT');
INSERT INTO org_fuentes (nombre) VALUES ('Secretaría de Economía');
INSERT INTO org_fuentes (nombre) VALUES ('Secretariado Ejecutivo del Sistema Nacional de Seguridad Pública');
INSERT INTO org_fuentes (nombre) VALUES ('SEP');
INSERT INTO org_fuentes (nombre) VALUES ('SIMAS');
INSERT INTO org_fuentes (nombre) VALUES ('SINAIS (SSA)');
INSERT INTO org_fuentes (nombre) VALUES ('Sistema de Información Empresarial Mexicano (SIEM)');
INSERT INTO org_fuentes (nombre) VALUES ('SNSP');
INSERT INTO org_fuentes (nombre) VALUES ('Ventanilla Universal, Dirección de Desarrollo Económico del Municipio de Torreón');
