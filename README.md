# HypixelViewer IESSERPIS 2023-2024
 
### Descarga e Instalación de Software
1. Descargar E instalar el IDE de su preferencia. Recomendamos [Visual Studio Code]
2. Descargar e instalar [XAMPP]
3. Descargar el [fichero comprimido del proyecto](https://github.com/Pablouraga/HypixelViewer-IESSERPIS-2023-2024/archive/refs/heads/main.zip)

### Preparación del entorno
1. Descomprimir el fichero del proyecto y abrirlo con Visual Studio Code
2. Abrir XAMPP e iniciar el servidor MySQL
3. Ejecutar el comando ```composer update```
4. Generar nuevas claves para el proyecto con ```php artisan key:generate```
5. En el navegador web, navegar a ```localhost/phpmyadmin``` y crear una base de datos. En este caso se llamara 'hypixelviewer'
   ![image](https://github.com/Pablouraga/HypixelViewer-IESSERPIS-2023-2024/assets/120651168/d2152e8f-ec0c-46c1-abb0-d09b8601ae99)
6. En el fichero .env del proyecto, en el campo 'DB_DATABASE' escribir el nombre de la base de datos creada
7. Ejecutar las migraciones con ```php artisan migrate```
8. Lanzar el servidor con ```php artisan serve```
9. Navegar a ```localhost:8000```

Ya deberías tener la base de datos creada con las tablas correspondientes y la aplicación en ejecución.
