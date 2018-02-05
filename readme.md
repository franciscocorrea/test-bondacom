#Test api restFul bondacom

##pasos para la instalación del proyecto

- Luego de clonar el proyecto.
	> $composer install.

- Copiar el archivo .env.example en un archivo .env y reemplazar por las variables de entornos de su maquina local.
	> $cp .env.example .env.

- Ejecutar las migraciones.

   > $php artisan migrate.

- Correr el server localhost.

   > $php artisan serve.


##Endpoints del API

- Para observar las rutas del api se puede correr el siguiente comando.

 > $php artisan route:list.