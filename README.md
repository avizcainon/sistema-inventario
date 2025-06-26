<h1>Sistema básico de inventario</h1>

## Funcionalidades

<p dir="auto">Modulos:</p>
<ul dir="auto">
    <li>Clientes</li>
    <li>Productos</li>
    <li>Facturas</li>
    <li>Reporte</li>
     <li>Registro de usuarios (Adminsitrador y Asesor)</li>


## Requerimientos minimos

<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
        PHP Version >= 8.2
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
       Laravel Framework 12.10.2
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
       XAMPP
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
       Composer
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
      Git
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
       Nodejs
    </pre>
</div>


<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
       Visual Studio Code
    </pre>
</div>


## Instalación

<p>
   Clonar el repositorio github
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto" >
    <pre>
        git clone https://github.com/avizcainon/sistema-inventario.git
    </pre>
</div>

<p>
    Cambiar la consola al directorio donde se encuentra el proyecto
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
        <span class="pl-k">cd</span> inventario
    </pre>
</div>

<p>
   Instalar composer al proyecto para que se pueda instalar los recursos
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
        composer install
    </pre>
</div>




<p>
    Crear archivo .env y tomar como ejemplo .env.example, este paso es importante para seguir con el siguiente. Se debe configurar la conexión de la base de datos
</p>

<p>
    Crear la base de datos <b>"<em>inventario</em>"</b>  en el <b>"<em>phpmyadmin</em>"</b>
</p>

<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
        php artisan key:generate
    </pre>
</div>
<p>
    Crear las migraciones en la base de datos gecre ya configurada en phpmyadmin
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
       php artisan migrate:install
    </pre>
</div>

<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
      php artisan migrate
    </pre>
</div>

<p>
    Insertar los valores por defecto en las tablas. Se debe visulizar en la tabla status_accounts 2 registros
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
       php artisan db:seed
    </pre>
</div>


<p>
    Activar el servidor
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
      php artisan serve
    </pre>
</div>

<p>
    Si no se visualiza el sistema se debe probar activando tambien
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
     npm install
    </pre>
    <pre>
     npm run dev
    </pre>
</div>

<b>NOTA</b>: Recuerda para un optimo funcionamiento en modo PRODUCCION en el archivo .env establece los siguientes valores de esta manera se desactiva los logs.
    <pre>
     APP_ENV=production
    </pre>
    <pre>
     APP_DEBUG=false
    </pre>

<p>
   Configurar php php.ini
</p>
<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
       extension=zip
    </pre>
</div>

<div class="highlight highlight-source-batchfile notranslate position-relative overflow-auto" dir="auto">
    <pre>
        extension=gd
    </pre>
</div>
