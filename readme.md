# Test api restFul bondacom

## pasos para la instalación del proyecto

- Luego de clonar el proyecto.
	> $composer install.

- Copiar el archivo .env.example en un archivo .env y reemplazar por las variables de entornos de su maquina local.
	> $cp .env.example .env.

- Ejecutar las migraciones.

   > $php artisan migrate.

- Correr el server localhost.

   > $php artisan serve.


# Endpoints del API

- Para observar las rutas del api se puede correr el siguiente comando.

   > $php artisan route:list.


## Endpoints Country

- Endpoint para administrar los paises.

- parametros.
    - name
    - acronym = siglas ARG, USA, URG

> POST /countries .
> GET /countries .
> GET /countries/{country}.
> PUT /countries/{country}.
> DELETE /countries/{country}

## Endpoints State

- Endpoint para administrar los estados/provincias.

- parametros.
    - name
    - acronym_country = siglas ARG, USA, URG a donde pertenece el estado

> POST /states .
> GET /states .
> GET /states/{state}.
> PUT /states/{state}.
> DELETE /states/{state}

## Endpoints County

- Endpoint para administrar los condados o tambien departamentos, partidos etc.

- parametros.
    - name
    - state_id = id del estado o provincia donde pertenece el condado/departamento/partido

> POST /states .
> GET /states .
> GET /states/{state}.
> PUT /states/{state}.
> DELETE /states/{state}

## Endpoints City

- Endpoint para administrar los ciudades o municipios.

- parametros.
    - name
    - state_id = id del estado o provincia donde pertenece el condado/departamento/partido

> POST /states .
> GET /states .
> GET /states/{state}.
> PUT /states/{state}.
> DELETE /states/{state}