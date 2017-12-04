--
-- TrcIMPLAN Central
--
-- Proyectos Llaves (Los Factores de cada Evaluador)
--

CREATE TABLE pro_llaves (
    id           serial          PRIMARY KEY,

    evaluador    integer         NOT NULL,
    factor       integer         NOT NULL,

    estatus      character(1)    DEFAULT 'A'::bpchar NOT NULL,

    UNIQUE (evaluador, factor)
);
