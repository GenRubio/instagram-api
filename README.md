# Laravel Instagram API

Código para conectarse a la API de Instagram para obtener los datos de un usuario determinado y guardar sus últimas 12 publicaciones en la base de datos.<br/> 
El perfil de la compañía o usuario debe ser accesible públicamente para poder recuperar los datos.

## Install
1) En la terminal:

``` bash
composer install
npm install
npm run dev
```

2) Ejecutar las migraciones:
```bash
php artisan migrate
```

## Configuración
1) Cofiguracion del usuario se encuntra en:
```bash
App\Services\InstagramUserService.php
self::$instagramUser = 'gen_rubio';
```

2) Obtener los ultimos 12 posts del usuario y guardarlos en la base de datos:
```bash
php artisan import:instagram-posts
```
## Archivos usados en la app
1) Instagram User Service
```bash
App\Services\InstagramUserService.php
```

2) Instagram Post Service
```bash
App\Services\InstagramPostService.php
```

3) Instagram Data Trait
```bash
App\Traits\InstagramDataTrait.php
```

4) Comando de importación
```bash
App\Console\Commands\ImportInstagramPosts.php
```

5) Configuracion del Storage
```bash
config\filesystems.php
-> instagram-imports
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
