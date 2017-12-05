
# Central 2017

Sistema administrador de la base de datos Central que funciona con GenesisPHP.

Objetivos:

* Administrar el Sistema Metropolitano de Indicadores (SMI).
* Administrar el Sistema de Información Geográfica (SGI).
* Administrar los Indicadores Básicos por Colonias (IBC).
* Organizar los datos para las publicaciones relacionadas.

### Requerimientos de software

Este es un sistema web programado en PHP 5, con scripts en Bash y algunos scripts en Python.

El servidor web es Apache HTTP versión 2.

### Repositorios adicionales que debe de tener listos para Central

Los archivos que genera van a parar a las copias locales de los siguientes repositorios en https://github.com/trcimplan

* TrcIMPLAN/beta
* TrcIMPLAN/canacoservyturtorreon
* TrcIMPLAN/cmiclaguna
* TrcIMPLAN/trcimplan.github.io

Vea y ajuste el script adan/bin/CrearExclusivos.sh

### Hecho con GenesisPHP

Comandos para construir el sistema:

    $ cd Central
    $ adan/bin/Dios.sh

Para aprender de GenesisPHP visite https://github.com/guivaloz/GenesisPHP

### Configuración del servidor Apache HTTP

Edite un archivo modular de configuración Apache HTTP

    $ nano /etc/apache2/vhosts.d/trcimplan_central.include

Con este contenido, cambie USUARIO por el suyo o use la ruta correcta

    Alias /trcimplan_central /home/USUARIO/Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs

    <Directory /home/USUARIO/Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs>
        Options -Indexes -FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>

    <Directory /home/USUARIO/Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin>
        Require all denied
    </Directory>

    <Directory /home/USUARIO/Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/lib>
        Require all denied
    </Directory>

    RewriteRule ^/trcimplan_central/([a-z]+)\.csv$ /home/USUARIO/Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/$1.php?csv=descargar [QSA]

### Configuración de PHP 5

### Enlaces a ejecutables

Para ejecutar con comodidad, cree enlaces a los siguientes programas en un directorio dentro de PATH

    $ cd ~/bin
    $ ln -s ../Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin/CrearSMI.php
    $ ln -s ../Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin/CrearSIG.php
    $ ln -s ../Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin/AlimentarOrganizador.php
    $ ln -s ../Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin/CrearPublicacionesRelacionadas.php
    $ ln -s ../Documentos/GitHub/TrcIMPLAN/Sistemas/Central/htdocs/bin/CrearIBC.php

La Plataforma del Conocimiento no está en este repositorio. Haga un acceso directo a Crear.php

    $ ln -s ../Documentos/GitHub/TrcIMPLAN/trcimplan.github.io/bin/Crear.php
