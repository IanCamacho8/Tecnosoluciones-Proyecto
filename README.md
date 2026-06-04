# Sistema de Gestion de Proyectos - TecnoSoluciones S.A.

Este es el repositorio creado para el trabajo final de Backend Developer Web, por la sala 4. En este repositorio está el código fuente, el README y la base de datos.
Desarrollado con PHP, MySQL, MVC y PDO.

## Requisitos

- XAMPP (Apache, MySQL)
- PHP 7.4 o superior
- Composer (para Dompdf)

## Instalacion

1. Copiar la carpeta del proyecto en `..:\xampp\htdocs\`

2. Importar la base de datos:
   - Abrir phpMyAdmin
   - Ejecutar el script `database.sql`
   - En `config/Database.php` utilizar el 'localhost' que funcione.

3. Instalar Dompdf con Composer:
   cd "..:\xampp\htdocs\Tecnosoluciones Proyecto"
   composer require dompdf/dompdf

4. Configurar la base de datos en config/Database.php si es necesario:
    host, dbname, username, password

Acceso:
    URL: http://localhost/Tecnosoluciones%20Proyecto/public/index.php

Credenciales de prueba
Usuario     	Email	                    Contraseña	Rol
Administrador   admin@tecnosoluciones.com   password	admin

Funcionalidades

    -Autenticacion de usuarios (login, registro, logout)
    -Gestion de clientes (CRUD completo)
    -Gestion de proyectos (CRUD completo)
    -Cambio de estado de proyectos (recibido, validado, en preparacion, despachado, confirmado)
    -Generacion de reportes en PDF

Estructura MVC

    -Modelos: Acceso a datos y logica de negocio
    -Vistas: Interfaz de usuario (HTML, CSS)
    -Controladores: Procesan peticiones y coordinan modelo/vista
    -Public: Front controller (punto de entrada unico)

Tecnologias

    -PHP con Programacion Orientada a Objetos
    -MySQL con PDO (prepared statements)
    -Dompdf para generacion de PDF
    -HTML5, CSS3 (diseno responsive)
    -Sesiones PHP para autenticacion
    -Patron de diseño MVC

---

## Instrucciones finales

1. Crear todos los archivos
Copia cada código en el archivo correspondiente según la estructura mostrada.

2. Instalar Dompdf
Abre el Shell de XAMPP y ejecuta:
cd "C:\xampp\htdocs\Tecnosoluciones Proyecto"
composer require dompdf/dompdf

3. Acceder al sistema

Abre tu navegador y ve a:
http://localhost/Tecnosoluciones%20Proyecto/public/index.php

4. Credenciales

Email: admin@tecnosoluciones.com
Contrasena: password
