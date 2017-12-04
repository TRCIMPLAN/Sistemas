--
-- TrcIMPLAN Central
--
-- Desagregación Catálogos
--

CREATE TABLE dag_catalogos (
    id             serial               PRIMARY KEY,
    eje            integer              REFERENCES dag_ejes NOT NULL,

    nivel          smallint             UNIQUE NOT NULL,
    nombre         character varying    NOT NULL,
    nom_corto      character varying    UNIQUE NOT NULL,
    dato_tipo      character(1)         NOT NULL,
    formula        character varying,

    visibilidad    character(1)         DEFAULT 'V'::bpchar NOT NULL,
    estatus        character(1)         DEFAULT 'A'::bpchar NOT NULL
);

-- dato_tipo
--   E => Cantidad
--   D => Decimal
--   M => Dinero
--   P => Porcentaje
--   C => Caracter
--   S => Texto

-- visibilidad en ficha de conglomerado
--   O => Oculto
--   V => Visible
