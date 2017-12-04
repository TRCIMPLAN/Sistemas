--
-- TrcIMPLAN Central
--
-- Proyectos Evaluadores
--

CREATE TABLE pro_evaluadores (
    id         serial               PRIMARY KEY,

    nombre     character varying    NOT NULL,
    puesto     character varying,
    tipo       character(1)         NOT NULL,

    notas      text,
    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);

-- Tipos
--  C -> Consejero
--  O -> Otro

INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Ing. Miguel Ángel Riquelme Solís', 'Presidente Municipal y Presidente del Consejo del IMPLAN', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Lic. Eduardo Holguín', 'Director Ejecutivo del IMPLAN', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Ing. Gabriel Calvillo Ceniceros', 'Titular Responsable del Área de Desarrollo Urbano del Ayuntamiento', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('M.C. Mario Valdez Garza', 'Presidente de la Comisión de Urbanismo y Obras Públicas del Ayuntamiento', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Lic. Miguel Mery Ayup', 'Presidente de la Comisión de Hacienda, Patrimonio y Cuenta Pública del Ayuntamiento', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('C. Sergio Lara Galván', 'Presidente de la Comisión de Desarrollo Económico del Ayuntamiento', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Ing. Hugo René Noe Lazcano', 'Colegio de Ingenieros Civiles de La Laguna A.C.', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Arq. Tomás Galván Camacho', 'Cámara Mexicana de la Industria de la Construcción', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Carlos Fernández Gómez', 'Fomento Económico Laguna de Coahuila A.C.', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Eduardo Castañeda Martínez', 'Consejo Lagunero de la Iniciativa Privada', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Cecilia del Carmen Cardiel Escamilla', 'Consejo ONG’s de La Laguna A.C.', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Ing. Ignacio Chong López', 'Consejo Lagunero del Agua A.C.', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('José Sánchez Izquierdo', 'Consejo Municipal de Desarrollo Urbano', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Miguel Ángel Cisneros Guerrero', 'CIESLAG', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Martha Silvia Argüelles Molina', 'CIESLAG', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Victor Hugo Torres Romo', 'Colegio de Arquitectos', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Javier Ramos Salas', 'Ciudadano Distinguido', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Martín López Méndez', 'ITESM', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Rafael Rebollar', 'Peñoles', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Hector Acuña Nogueira', 'Director UIA', 'C');
INSERT INTO pro_evaluadores (nombre, puesto, tipo) VALUES ('Francisco Valdés Pérez Gazga', 'PRODENAZAS', 'C');
