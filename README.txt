PASOS PARA PONER EN MARCHA EL SISTEMA
1 - utilizar la herramienta xamp
2 - reemplazar el archivo php.ini en la carpeta de instalaci�n xamp /php/
por el que se encuentra en la carpeta del proyecto /phpini
3 - crear una base de datos 'cbDatabase' en postgres
4 - en la carpeta del proyecto /.env colocar usuario y contrase�a de la base de datos
utilizar para generar las tablas necesarias en la base de datos
5 - utilizar en linea de comandos 'php artisan migrate'
6 - insertar art�culos a la tabla 'items' de la base de datos
ejemplo:
	INSERT INTO items("description","model","pu") VALUES('TAZA', 'APPLE', 40.00);
	INSERT INTO items("description","model","pu") VALUES('MESA', 'TOSHIBA', 360.00);
	INSERT INTO items("description","model","pu") VALUES('CAMA', 'SONY', 1024.60);

7 - utilizar en linea de comandos 'php artisan serve'
8 - ingresar a localhost:8000



ROLLBACK A MIGRACI�N
en caso de errores al eliminar la migraci�n realizada utilizar comando 'composer dump-autoload'
despu�s continuar con normalidad 'php artisan migrate:rollback'