PASOS PARA PONER EN MARCHA EL SISTEMA
1 	- contar con la herramienta xamp
2	- contar con herramienta composer
3	- cargar las dependencias "composer install"
4 	- reemplazar el archivo php.ini en la carpeta de instalación xamp ./php/ por el que se encuentra en la carpeta del proyecto ./phpini
4 	- crear una base de datos 'cbdatabase' en postgres
4 	- en la carpeta del proyecto ./.env colocar usuario y contraseña de la base de datos utilizar para generar las tablas necesarias en la base de datos
5 	- utilizar en linea de comandos 'php artisan migrate' para generar las tablas en la base de datos
6 	- utilizar en linea de comandos 'php artisan db:seed' para ingresar los datos pertinentes en la base de datos
7 	- utilizar en linea de comandos 'php artisan serve'
8 	- ingresar a localhost:8000


ROLLBACK A MIGRACIÓN
en caso de errores al eliminar la migración realizada utilizar comando 'composer dump-autoload'
después continuar con normalidad 'php artisan migrate:rollback'