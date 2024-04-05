echo 'Levantando entorno...espere'
docker-compose pull && docker-compose -f docker-compose.yml up -d #--remove-orphans

#docker-compose up --build