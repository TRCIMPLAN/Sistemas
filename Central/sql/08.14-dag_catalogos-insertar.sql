--
-- TrcIMPLAN Central
--
-- Desagregación Catálogos insertar
--

-- Eje 1) Demografía

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (1, 101, 'PobTot',            'Población total',                                 'E');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 102, 'PobTotMas',         'Población total masculina',                       'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 103, 'PobTotFem',         'Población total femenina',                        'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 104, 'PobTotNE',          'Población total no especificada',                 'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 105, 'PorPobMas',         'Porcentaje de población masculina',               'P', 'PobTotMas / PobTot');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 106, 'PorPobFem',         'Porcentaje de población femenina',                'P', 'PobTotFem / PobTot');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (1, 107, 'PorPobNE',          'Porcentaje de población no especificada',         'P', 'PobTotNE / PobTot',          'O');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 111, 'Pob0a14',           'Población de 0 a 14 años',                        'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 112, 'Pob15a64',          'Población de 15 a 64 años',                       'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 113, 'Pob65yMas',         'Población de 65 y más años',                      'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (1, 114, 'PobRNE',            'Población no especificada',                       'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 115, 'PorPob0a14',        'Porcentaje de población de 0 a 14 años',          'P', 'Pob0a14 / PobTot');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 116, 'PorPob15a64',       'Porcentaje de población de 15 a 64 años',         'P', 'Pob15a64 / PobTot');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 117, 'PorPob65yMas',      'Porcentaje de población de 65 y más años',        'P', 'Pob65yMas / PobTot');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 118, 'PorPobRNE',         'Porcentaje de población no especificada',         'P', 'PobRNE / PobTot');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 121, 'PobFem12yMas',      'Población femenina 12 y más años',                'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 122, 'HNVins',            'Fecundidad insumo',                               'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 123, 'PromHNV',           'Fecundidad promedio',                             'D', 'HNVins / PobFem12yMas');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 131, 'PobNacOE',          'Población nacida en otro estado',                 'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (1, 132, 'PorPobNacOE',       'Porcentaje de población nacida en otro estado',   'P', 'PobNacOE / PobTot',          'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 141, 'PobCLim',           'Población con discapacidad',                      'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (1, 142, 'PorPobCLim',        'Porcentaje de población con discapacidad',        'P', 'PNacOE / PobTot');

-- Eje 2) Educación

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 201, 'Pob15ymas',         'Población 15 y más',                              'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 202, 'Pob15ymasMas',      'Población 15 y más masculina',                    'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 203, 'Pob15ymasFem',      'Población 15 y más femenina',                     'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 204, 'GPEins',            'Grado Promedio de Escolaridad insumo',            'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 205, 'GPEMasins',         'Grado Promedio de Escolaridad masculina insumo',  'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (2, 206, 'GPEFemins',         'Grado Promedio de Escolaridad femenina insumo',   'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (2, 207, 'GPE',               'Grado Promedio de Escolaridad',                   'D', 'GPEins / Pob15ymas',         'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (2, 208, 'GPEMas',            'Grado Promedio de Escolaridad masculina',         'D', 'GPEMasins / Pob15ymasMas',   'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (2, 209, 'GPEFem',            'Grado Promedio de Escolaridad femenina',          'D', 'GPEFemins / Pob15ymasFem',   'O');

-- Eje 3) Características Económicas

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 301, 'PEAins',            'P.E.A. insumo',                                   'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 302, 'PEAMasins',         'P.E.A. masculina insumo',                         'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 303, 'PEAFemins',         'P.E.A. femenina insumo',                          'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 304, 'Pob12ymas',         'Población 12 y más',                              'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 305, 'PEA',               'Población Económicamente Activa',                 'P', 'PEAins / Pob12ymas');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 306, 'PEAMas',            'Población Económicamente Activa masculina',       'P', 'PEAMasins / PEAins');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 307, 'PEAFem',            'Población Económicamente Activa femenina',        'P', 'PEAFemins / PEAins');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 311, 'PobOcuins',         'Población Ocupada insumo',                        'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 312, 'PobOcuMasins',      'Población Ocupada masculina insumo',              'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 313, 'PobOcuFemins',      'Población Ocupada femenina insumo',               'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 314, 'PobOcu',            'Población Ocupada',                               'P', 'PobOcuins / PEAins');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 315, 'PobOcuMas',         'Población Ocupada masculina',                     'P', 'PobOcuMas / PobOcuins');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 316, 'PobOcuFem',         'Población Ocupada femenina',                      'P', 'PobOcuFem / PobOcuins');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 321, 'PobDesocuins',      'Población Desocupada insumo',                     'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 322, 'PobDesocu',         'Población Desocupada',                            'P', 'PobDesocuins / PobOcuins');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (3, 331, 'PDerSS',            'Derechohabiencia insumo',                         'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (3, 332, 'Derechohab',        'Derechohabiencia',                                'P', 'PDerSS / PobTot');

-- Eje 4) Servicios de Salud

-- Eje 5) Viviendas

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (5, 501, 'Hogares',           'Hogares',                                         'E');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 502, 'HogJefMasins',      'Hogares Jefatura masculina insumo',               'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (5, 503, 'HogJefMas',         'Hogares Jefatura masculina',                      'P', 'HogJefMasins / Hogares',     'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 504, 'HogJefFemins',      'Hogares Jefatura femenina insumo',                'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (5, 505, 'HogJefFem',         'Hogares Jefatura femenina',                       'P', 'HogJefFemins / Hogares',     'O');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 511, 'OcuViv',            'Ocupación por Vivienda',                          'D', 'PobTot / Hogares');

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 521, 'VivElectins',       'Viviendas con Electricidad insumo',               'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 522, 'VivElect',          'Viviendas con Electricidad',                      'P', 'VivElectins / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 523, 'VivAguains',        'Viviendas con Agua insumo',                       'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 524, 'VivAgua',           'Viviendas con Agua',                              'P', 'VivAguains / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 525, 'VivDrenajeins',     'Viviendas con Drenaje insumo',                    'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 526, 'VivDrenaje',        'Viviendas con Drenaje',                           'P', 'VivDrenajeins / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 527, 'VivTVins',          'Viviendas con Televisión insumo',                 'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 528, 'VivTV',             'Viviendas con Televisión',                        'P', 'VivTVins / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 531, 'VivAutoins',        'Viviendas con Automóvil insumo',                  'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 532, 'VivAuto',           'Viviendas con Automóvil',                         'P', 'VivAutoins / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 533, 'VivCompuins',       'Viviendas con Computadora insumo',                'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula)              VALUES (5, 534, 'VivCompu',          'Viviendas con Computadora',                       'P', 'VivCompuins / Hogares');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 535, 'VivCelularins',     'Viviendas con Celular insumo',                    'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (5, 536, 'VivCelular',        'Viviendas con Celular',                           'P', 'VivCelularins / Hogares',    'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (5, 537, 'VivInternetins',    'Viviendas con Internet insumo',                   'D',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (5, 538, 'VivInternet',       'Viviendas con Internet',                          'P', 'VivInternetins / Hogares',   'O');

-- Eje 6) Actividades Económicas

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 601, 'AETot',             'Total Actividades Económicas',                    'E');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 611, 'AEAgricultura',     'Agricultura',                                     'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 612, 'AEMineria',         'Minería',                                         'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 613, 'AEGenerales',       'Servicios Generales',                             'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 614, 'AEConstruccion',    'Construcción',                                    'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 615, 'AEManufactura',     'Industria Manufacturera',                         'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 616, 'AEComercioMayo',    'Comercio Mayoreo',                                'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 617, 'AEComercioMenu',    'Comercio Menudeo',                                'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 618, 'AETranspCorrAl',    'Transportes, Correo, Almacenamiento',             'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 619, 'AEInfoMedMasiv',    'Información Medios Masivos',                      'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 620, 'AEFinanSeguros',    'Financieros y Seguros',                           'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 621, 'AEInmobiliario',    'Inmobiliarios',                                   'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 622, 'AEProfesional',     'Profesionales, Científicos, Técnicos',            'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 623, 'AECorporativos',    'Corporativos',                                    'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 624, 'AEResiduos',        'Manejo de Residuos',                              'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 625, 'AEEducativos',      'Educativos',                                      'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 626, 'AESalud',           'Salud',                                           'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 627, 'AEEsparcimien',     'Esparcimiento, Culturales, Deportivos',           'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 628, 'AEAlimentos',       'Preparación de Alimentos y Bebidas',              'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 629, 'AEOtros',           'Otros servicios, excepto Gobierno',               'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 630, 'AEGobierno',        'Gubernamentales',                                 'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 651, 'AETop1',            'Primer actividad',                                'S',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 661, 'AETop1Actividad',   'Primer actividad nombre',                         'S');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 662, 'AETop1Valor',       'Primer actividad porcentaje',                     'P');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 652, 'AETop2',            'Segunda actividad',                               'S',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 663, 'AETop2Actividad',   'Segunda actividad nombre',                        'S');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 664, 'AETop2Valor',       'Segunda actividad porcentaje',                    'P');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 653, 'AETop3',            'Tercera actividad',                               'S',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 665, 'AETop3Actividad',   'Tercera actividad nombre',                        'S');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 666, 'AETop3Valor',       'Tercera actividad porcentaje',                    'P');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 654, 'AETop4',            'Cuarta actividad',                                'S',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 667, 'AETop4Actividad',   'Cuarta actividad nombre',                         'S');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 668, 'AETop4Valor',       'Cuarta actividad porcentaje',                     'P');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, visibilidad)          VALUES (6, 655, 'AETop5',            'Quinta actividad',                                'S',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 669, 'AETop5Actividad',   'Quinta actividad nombre',                         'S');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo)                       VALUES (6, 670, 'AETop5Valor',       'Quinta actividad porcentaje',                     'P');

-- NUEVOS

INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 151, 'Pob15ymasAnalf',    'Población de 15 y más analfabeta',                'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 152, 'Pob18ymas',         'Población de 18 y más',                           'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo,          visibilidad) VALUES (1, 153, 'Pob18ymasPB',       'Población de 18 y más postbásicos',               'E',                               'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (1, 161, 'PorPob15ymasAnalf', 'Porcentaje de población de 15 y más analfabeta',  'P', 'Pob15ymasAnalf / Pob15ymas', 'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (1, 162, 'PorPob18ymas',      'Porcentaje de población de 18 y más',             'P', 'Pob18ymas / PobTot',         'O');
INSERT INTO dag_catalogos (eje, nivel, nom_corto, nombre, dato_tipo, formula, visibilidad) VALUES (1, 163, 'PorPob18ymasPB',    'Porcentaje de población de 18 y más postbásicos', 'P', 'Pob18ymasPB / PobTot',       'O');
