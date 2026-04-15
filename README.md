docker exec -it laravel_app php artisan optimize:clear

rutas:
php artisan route:list | grep filament


 Crear un nuevo panel Filament para usuarios

MONGODB
=======
 php artisan tinker

 DB::connection('mongodb')
    ->table('messages')
    ->get();

DB::connection('mongodb')
->table('documents')
->get();
