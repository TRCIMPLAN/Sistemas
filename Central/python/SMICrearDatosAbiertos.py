#!/usr/bin/env python3
# -*- coding: utf-8 -*-
#
# SMICrearDatosAbiertos.py
#
# Copyright (C) 2017 Guillermo Valdes Lozano <guillermo@movimientolibre.com>
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#


import csv
import datetime
import re
import unicodedata
import sys

_re_no_permitidos = re.compile(r'[^ a-zA-Z0-9(),.]') # Sólo permite espacio, numero, letras, paréntesis, coma, punto


def convertir_texto_a_mayusculas(texto):
    """ Convertir texto a mayúsculas sin acentos """
    texto_unicode = unicode(texto, "utf-8")
    sin_tildes = ''.join((c for c in unicodedata.normalize('NFD', texto_unicode) if unicodedata.category(c) != 'Mn'))
    solo_permitidos = _re_no_permitidos.sub(' ', sin_tildes) # eliminar_no_permitidos(sin_tildes)
    return solo_permitidos.upper()


class BaseDatos:

    def __init__(self):
        import psycopg2
        import psycopg2.extras
        self.conexion = psycopg2.connect("host=127.0.0.1 dbname='{0}' user='{1}' password='{2}'".format('trcimplan_central', 'trcimplan', 'loquesea'))
        self.cursor = self.conexion.cursor(cursor_factory=psycopg2.extras.DictCursor)
        self.prueba = 777

    def __enter__(self):
        return(self)

    def __exit__(self, exc_type, exc_value, traceback):
        self.conexion.close()


class DatosAbiertos(BaseDatos):

    def consultar(self):
        self.cursor.execute("SELECT * FROM ind_indicadores_datos_abiertos")
        self.consulta = self.cursor.fetchall()
        print("  La consulta Datos Abiertos obtuvo {0} registros.".format(self.cantidad()))

    def cantidad(self):
        return(len(self.consulta))

    def mostrar(self):
        for r in self.consulta:
            print("  {0}, {1}, {2}, {3}".format(r['subindice'], r['indicador'], r['region'], r['fecha']))

    def escribir_csv(self, destino):
        columnas = list()
        columnas.append('SUBINDICE')
        columnas.append('INDICADOR')
        columnas.append('REGION')
        columnas.append('FECHA')
        columnas.append('CANTIDAD')
        columnas.append('DECIMAL')
        columnas.append('DINERO')
        columnas.append('PORCENTAJE')
        columnas.append('CARACTER')
        columnas.append('UNIDAD')
        columnas.append('FUENTE')
        columnas.append('CATEGORIAS')
        with open(destino, 'w') as archivo_csv:
            escritor = csv.DictWriter(archivo_csv, fieldnames=columnas, quoting=csv.QUOTE_MINIMAL)
            escritor.writeheader()
            for r in self.consulta:
                d = dict()
                d['SUBINDICE']  = convertir_texto_a_mayusculas(r['subindice'])
                d['INDICADOR']  = convertir_texto_a_mayusculas(r['indicador'])
                d['REGION']     = convertir_texto_a_mayusculas(r['region'])
                d['FECHA']      = r['fecha']
                d['CANTIDAD']   = r['cantidad']
                d['DECIMAL']    = r['decimal']
                d['DINERO']     = r['dinero']
                d['PORCENTAJE'] = r['porcentaje']
                d['CARACTER']   = r['caracter']
                d['UNIDAD']     = convertir_texto_a_mayusculas(r['unidad'])
                d['FUENTE']     = convertir_texto_a_mayusculas(r['fuente'])
                d['CATEGORIAS'] = convertir_texto_a_mayusculas(r['categorias'])
                escritor.writerow(d)
        print("  Escribí archivo CSV {0}".format(destino))


class DatosAbiertosAdicionales(BaseDatos):

    def consultar(self):
        self.cursor.execute("""
            SELECT
                s.nom_corto AS subindice,
                i.nombre AS indicador,
                i.descripcion,
                i.notas,
                i.categorias
            FROM
                ind_subindices as s,
                ind_indicadores as i
            WHERE
                s.estatus = 'A'
                AND i.subindice = s.id
                AND i.estatus = 'A'
            ORDER BY
                s.nom_corto,
                i.nombre""")
        self.consulta = self.cursor.fetchall()
        print("  La consulta Datos Abiertos Adicionales obtuvo {0} registros.".format(self.cantidad()))

    def cantidad(self):
        return(len(self.consulta))

    def mostrar(self):
        for r in self.consulta:
            print("  {0}, {1}".format(r['subindice'], r['indicador']))

    def escribir_csv(self, destino):
        columnas = list()
        columnas.append("SUBINDICE")
        columnas.append("INDICADOR")
        columnas.append("DESCRIPCION")
        columnas.append("NOTAS")
        columnas.append("CATEGORIAS")
        with open(destino, 'w') as archivo_csv:
            escritor = csv.DictWriter(archivo_csv, fieldnames=columnas, quoting=csv.QUOTE_MINIMAL)
            escritor.writeheader()
            for r in self.consulta:
                d = dict()
                d['SUBINDICE'] = r['subindice']
                d['INDICADOR'] = r['indicador']
                d['DESCRIPCION'] = r['descripcion']
                d['NOTAS'] = r['notas']
                d['CATEGORIAS'] = r['categorias']
                escritor.writerow(d)
        print("  Escribí archivo CSV {0}".format(destino))


def escribir_md(cantidad, destino):
    """ Escribir archivo markdown """
    elaboracion = datetime.datetime.today()
    with open(destino, 'w') as f:
        f.write("\n")
        f.write("### Descargar los datos del SMI\n")
        f.write("\n")
        f.write("<div class=\"media\">\n")
        f.write("<div class=\"media-left\"><a class=\"pull-left\" href=\"trcimplan-smi.csv\"><img class=\"media-object\" src=\"datos-abiertos/faenza-csv-128.png\" alt=\"Descargar los datos del SMI\"></a></div>\n")
        f.write("<div class=\"media-body\">\n")
        f.write("<ul>\n")
        f.write("<li><a href=\"trcimplan-smi.csv\">De clic aquí para descargar el archivo trcimplan-smi.csv</a></li>\n")
        f.write("<li>Lea qué es el formato <a href=\"https://es.wikipedia.org/wiki/CSV\">texto separado por comas CSV</a> en Wikipedia.</li>\n")
        f.write("<li>La codificación de los caracteres es <a href=\"https://es.wikipedia.org/wiki/UTF-8\">UTF-8</a>.</li>\n")
        f.write("<li>La primera línea tiene los nombres de las columnas.</li>\n")
        f.write("<li>En mayúsculas y sin acentos.</li>\n")
        f.write("<li>Cantidad de filas: <b>{:,}.</b></li>\n".format(cantidad))
        f.write("<li>Elaboración: <b>{0}.</b></li>\n".format(elaboracion.strftime("%d/%m/%y %H:%M")))
        f.write("</ul>\n")
        f.write("</div>\n")
        f.write("</div>\n")
        f.write("\n")
        f.write("### ¿Qué son los datos abiertos?\n")
        f.write("\n")
        f.write("Los datos abiertos son los datos digitales de carácter público que son accesibles en línea, es decir, por Internet, y que también **pueden ser usados, reutilizados y redistribuidos por cualquier interesado.**\n")
        f.write("\n")
        f.write("Ampliando la definición anterior, los datos abiertos constituyen una poderosa herramienta que mejora la forma de trabajar, dentro y fuera del gobierno federal, estatal o municipal. Hacia el interior aumenta la eficiencia del trabajo entre las dependencias; hacia el exterior, se vuelven componentes básicos para resolver problemáticas del ciudadano, empresas y organizaciones civiles.\n")
        f.write("\n")
        f.write("### ¿Cual es el fin de publicarlos?\n")
        f.write("\n")
        f.write("La intensión es que los **datos** del Sistema Metropolitano de Indicadores no sólo sirvan para estar publicados en este sitio web, sino **que también sean libremente descargados y estudiados** por cualquier persona interesada en realizar un **análisis específico, respaldarlos o reutilizarlos para otro fin.**\n")
        f.write("\n")
        f.write("### ¿Hay restricciones en cuanto a su uso?\n")
        f.write("\n")
        f.write("Estos datos se ofrecen bajo los [Términos de Uso de la Información](http://www.trcimplan.gob.mx/terminos/terminos-informacion.html) publicados en este mismo sitio web.\n")
        f.write("\n")
        f.write("### ¿Porqué como archivo CSV y no como archivo XLSX de Microsoft Excel?\n")
        f.write("\n")
        f.write("Hay dos razones para usar **formatos abiertos.** Primero para cumplir con [la regulación en materia de datos abiertos](http://www.dof.gob.mx/nota_detalle.php?codigo=5382838&fecha=20/02/2015). Segundo porque **es importante estandarizar** la manera en que los datos serán utilizados y consumidos por el público en general y el propio gobierno. Al exportar los datos en formatos abiertos, **se facilita el consumo e interpretación de la información por terceros, así como por máquinas.**\n")
        f.write("\n")
        f.write("El **formato de archivo CSV es simple y universal,** estructura los datos en filas y columnas separadas por un caracter definido, en este caso la coma. Puede ser importado tanto por [LibreOffice](https://www.libreoffice.org/) Calc, por [Microsoft Office](https://www.office.com/) y prácticamente por cualquier base de datos. Cabe destacar, que también **al usar un formato abierto, no se está obligando a que se adquiera un software comercial costoso, o un número de versión específica,** para poder trabajar con éste.\n")
        f.write("\n")
        f.write("### Video demostrativo de uso con Microsoft Office\n")
        f.write("\n")
        f.write("<div class=\"videowrapper well\"><iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/ql0Kvx2Paa8?rel=0\" frameborder=\"0\" allowfullscreen></iframe></div>\n")
        f.write("\n")
        f.write("[Vea este mismo video en YouTube](https://www.youtube.com/watch?v=ql0Kvx2Paa8).\n")
        f.write("\n")
    print("  Escribí archivo markdown {0}".format(destino))

def main(args):
    print("SMI Datos Abiertos")
    try:
        with DatosAbiertos() as da:
            da.consultar()
            #~da.mostrar()
            da.escribir_csv('../htdocs/bin/trcimplan.github.io/smi/trcimplan-smi.csv')
            cantidad = da.cantidad()
        with DatosAbiertosAdicionales() as daa:
            daa.consultar()
            #~daa.mostrar()
            daa.escribir_csv('../htdocs/bin/trcimplan.github.io/smi/trcimplan-smi-adicionales.csv')
        escribir_md(cantidad, '../htdocs/bin/trcimplan.github.io/lib/SMI/DatosAbiertos.md')
        return(0)
    except Exception as e:
        print("Error: {0}".format(e))
        return 1

if __name__ == '__main__':
    import sys
    sys.exit(main(sys.argv))
