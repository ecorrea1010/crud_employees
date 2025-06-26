# Proyecto Gestión de Empleados con PHP y Docker

Este proyecto es una aplicación web para gestionar empleados. Permite crear, listar, editar y eliminar empleados a través de un CRUD, desarrollada en PHP y ejecutada usando Docker.

## Requisitos

- Tener instalado **Docker** y **Docker Compose** en tu equipo.

## Iniciar el proyecto

1. Clona este repositorio.
2. En la raíz del proyecto, ejecuta:

```bash
docker-compose up -d --build
```

## Iniciar la base de datos
Una vez levantados los contenedores, por favor sigue estos pasos para crear las tablas de la base de datos:

1. Ingresa al contenedor de la base de datos
```bash
docker exec -it mariadb_db bash
```

2. Accede a MariaDB
```bash
mysql -u root -p
```
Se le pedirá la contraseña, ingresa: root_password

3. Cambia a la base de datos del proyecto
```bash
USE crud_app;
```

Una vez en la base de datos del proyecto copia los scripts del archivo init.sql ubicado en la raiz del proyecto y ejecutalos para crear las tablas y realizar inserts en las tablas maestro

## Endpoints disponibles
Estos son los endpoints disponibles

/list_employees.php GET
/register_employee.php POST
/edit_employee.php?id=id POST
