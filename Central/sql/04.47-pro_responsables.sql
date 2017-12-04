--
-- TrcIMPLAN Central
--
-- Proyectos Responsables
--

CREATE TABLE pro_responsables (
    id         serial               PRIMARY KEY,

    nombre     character varying    NOT NULL,
    tipo       character(1)         NOT NULL,

    notas      text,
    estatus    character(1)         DEFAULT 'A'::bpchar NOT NULL
);

-- Tipos
--  M -> Dirección Municipal
--  C -> Organización Civil
--  O -> Otro
