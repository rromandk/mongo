Ver log de Laravel
docker exec -it laravel_app tail -f storage/logs/laravel.log


Ver que este funcionando el servicio de REDIS

docker exec -it redis_microservice redis-cli ping
TIENE QUE DEVOLVER: PONG


Ver colas de mensajes:
docker exec -it redis_microservice redis-cli keys "*"
1) "laravel-database-queues:emails:notify"
2) "laravel-database-queues:emails"


¿Hay jobs en la cola?

docker exec -it redis_microservice redis-cli LLEN laravel-database-queues:emails