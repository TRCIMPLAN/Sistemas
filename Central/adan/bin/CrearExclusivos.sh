#!/bin/bash

#
# GenesisPHP - Crear Exclusivos
#
# Copyright (C) 2016 Guillermo Valdes Lozano guillermo@movimientolibre.com
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

# Yo soy
SOY="[Crear Exclusivos]"

# Constantes que definen los tipos de errores
EXITO=0
E_FATAL=99

# Nombres de los directorios
DESTINO_DIR="Demostracion"

# Validar que exista el directorio Eva
if [ ! -d ../Eva ]; then
    echo "$SOY ERROR: No existe el directorio Eva."
    echo "  Debe ejecutar este script en el directorio del sistema."
    echo "  O mejor con Dios.sh que se encarga de ésto."
    exit $E_FATAL
fi

#
# Escriba aquí los comandos exclusivos para este sistema
#

# Vínculos en htdocs/bin
cd htdocs/bin
echo "$SOY Creando enlace de beta en el directorio bin..."
ln -s ~/Documentos/GitHub/TrcIMPLAN/beta beta
echo "$SOY Creando enlace de canacoservyturtorreon en el directorio bin..."
ln -s ~/Documentos/GitHub/TrcIMPLAN/canacoservyturtorreon canacoservyturtorreon
echo "$SOY Creando enlace de cmiclaguna en el directorio bin..."
ln -s ~/Documentos/GitHub/TrcIMPLAN/cmiclaguna cmiclaguna
echo "$SOY Creando enlace de trcimplan.github.io en el directorio bin..."
ln -s ~/Documentos/GitHub/TrcIMPLAN/trcimplan.github.io trcimplan.github.io

# Depende del anterior Base
cd ../lib
echo "$SOY Copiando anterior Base..."
cp -r ../../../Eva/htdocs/lib/Base .
if [ "$?" -ne $EXITO ]; then
    echo "$SOY ERROR: No pude copiar Base."
    exit $E_FATAL
fi

# Vínculo al sitio web del IMPLAN Torreón en htdocs/lib
echo "$SOY Creando enlace de trcimplan.github.io en el directorio lib como OrgSitioWeb..."
ln -s ~/Documentos/GitHub/TrcIMPLAN/trcimplan.github.io OrgSitioWeb

echo "$SOY Script terminado."
exit $EXITO
