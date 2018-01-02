#!/usr/bin/env python3
# -*- coding: utf-8 -*-
#
# SMIContarIndicadores.py
#
# Cuenta la cantidad de indicadores de cada eje y calcula un gran total
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


# Liberías
import psycopg2  # Adaptador para la BD PostgreSQL       https://pypi.python.org/pypi/psycopg2
import sys       # Estándar de término usado en sys.exit https://docs.python.org/3.4/library/sys.html

# Definir constantes sobre la BD
bd_nombre = "trcimplan_central"
bd_usuario = "trcimplan"
bd_contrasena = "loquesea"

# Definir conector a la BD
conexion = None


try:
    print("Contar Indicadores")
    # Puntero a la BD
    conexion = psycopg2.connect("host=127.0.0.1 dbname='%s' user='%s' password='%s'" % (bd_nombre, bd_usuario, bd_contrasena))
    cursor   = conexion.cursor()
    # Iniciar acumulador
    total = 0
    # Consultar los ejes
    cursor.execute(" SELECT id, nom_corto FROM ind_subindices WHERE estatus = 'A' ORDER BY nom_corto ASC")
    renglones = cursor.fetchall()
    # Bucle por los ejes
    print("Ejes")
    for renglon in renglones:
        # Tomar los datos del eje en turno
        subindice           = renglon[0]
        subindice_nom_corto = renglon[1]
        # Consultar la cantidad de indicadores
        cursor.execute(" SELECT count(*) FROM ind_indicadores WHERE subindice = %s AND estatus = 'A'" % (subindice,))
        cantidad = cursor.fetchone()[0]
        # Imprimir la cantidad por eje
        print("  %s = %s" % (subindice_nom_corto, cantidad))
        # Acumular
        total = total + cantidad
    # Imprimir el gran total
    print("Total = %s" % total)

except Exception as e:
    print("Error %s" % e)
    sys.exit(1)

finally:
    if conexion:
        conexion.close()
