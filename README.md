# pruebaU2Soft

Paso a Paso Inicio Proyecto

1. Realizar Clone del repositorio con git clone https://github.com/hom669/pruebaU2Soft.git
2. Ingresar a la carpeta cd pruebaU2Soft/orders_fronted y correr el comando npm install
3. Despues ejecutar el servicio con el comando npx vue-cli-service serve
4. Ingresar a la carpeta cd pruebaU2Soft/orders_backend
5. Editar archivo de 
 .env con la conexion a base de datos escogida en mi caso Postgresql.
7. Cambiar las lines del 10 - 15:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pruebaU2soft
DB_USERNAME=postgres
DB_PASSWORD=pasword

con la informacion de su Base de Datos

8. Ejecutar Comando para realizar las migraciones y seeders especificas con php artisan migrate:refresh --seed
9. Ejecutar el comando php artisan serve asegurarse que la url este corriendo sobre el puerto 8000 o cambiar archivo pruebaU2Soft/orders_fronted/src/main.js
10. Cambiar Line 13 el puerto si es necesario axios.defaults.baseURL = 'http://localhost:8000/api';
11. Ingresar a la url dada despues del npx vue-cli-service serve normalmente http://localhost:8080/ 
12. Al iniciar el Aplicativo nos encontramos el modulo SING UP para crear el usuario el cual sera validado por medio de JWT.
13. En la Pestaña SIGN IN podremos logearnos con nuestro usuario Creado validado con JWT.
14.  Dentro de la aplicacion desplegamos el menu a mano Izquierda en cual apareceran los modulos de Pedidos Actuales, Consulta Por Fecha, Consulta por ID, Salir.

CONSTRUCCION APLICATIVO:

El aplicativo se encuentra dividido en tres servicios:

BACKEND --> API Construida en PHP Laravel.
FRONTEND --> Front Construdido en VUE.JS y VUETIFY.
BASE DE DATOS --> Postgresql Version 

MODELO BASE DE DATOS

Tablas:

orders[id_order,applicant,date_order,date_delivery]
ordes_products[id_orders_products,id_order,id_product]
products[id_product,name_product,codbar_product,id_vendor,description_product]
vendors[id_vendor,name_vendor]
inventorys[id_inventory,id_product,quiantity]








