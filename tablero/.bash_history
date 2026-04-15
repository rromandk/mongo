php artisan make:migration add_deleted_at_to_posts_table
php artisan migrate
php artisan make:middleware LogRequests
exit
ping redis
redis-cli -h redis -p 6379 ping
apt update && apt install -y redis-tools
exit
composer require aws/aws-sdk-php
php artisan make:migration create_post_files_table
php artisan make:model PostFile
ls
docker-compose up -d docker-compose.localslack.yml 
docker compose up -d docker-compose.localslack.yml 
exit
composer require league/flysystem-aws-s3-v3
php artisan config:clear
php artisan cache:clear
composer show | grep flysystem
php  artisan migrate
php artisan config:clear
php artisan cache:clear
exit
php artisan tinker
php artisan cache:clear
php artisan config:clear
php artisan config:clear
php artisan cache:clear
composer require filament/filament
exit
curl
curl http://elasticsearch_service:9200
exit
php artisan optimize:clear
php artisan queue:work
exit
composer require mongodb/laravel-mongodb
exit
mongosh
php artisan tinker
php artisan make:model Document
php artisan make:filament-relation-manager MessageResource documents nombre
mv app/Filament/Resources/Messages/RelationManagers/DocumentsRelationManager.php    app/Filament/Resources/MessageResource/RelationManagers/
ls
cd ta
cd tablero
ls
cd ..
cd app/Filament/Resources/Messages/
ls
mkdir MessageResource
cd MessageResource
ks
ls
mkdir RelationManagers
cd ..
cd ..
ls
cd Messages/
ls
clear
mv app/Filament/Resources/Messages/RelationManagers/DocumentsRelationManager.php    app/Filament/Resources/MessageResource/RelationManagers/
cd RelationManagers/
ls
php artisan optimize:clear
composer dump-autoload
cd ..
cd ..
cd ..
cd ..
cd ..
php artisan optimize:clear
php artisan optimize:clear
php artisan optimize:clear
cd public/
ls
clear
cd ..
php artisan storage:link
php artisan optimize:clear
php artisan optimize:clear
php artisan make:controller DocumentController
php artisan optimize:clear
exit
