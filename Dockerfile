
# build docker : docker build -t upload_command .
# run docker : docker run upload_command
# get list containers : docker ps
# get id container example: 4554546565
# execute some command  : docker exec -it 4554546565 php -v

# other

# remove image : docker image rm 6565767676
# remove container : docker rm 77878787

# remove all containers: docker container prune
# remove all images none: docker image prune

# stop container : docker stop  77878787

# copy changes from container to localhost: docker cp 61ed611042fc:/app/. /var/www/upload_file/



FROM php:8.1-fpm

# RUN groupadd damian

RUN useradd -ms /bin/bash damian
USER damian

COPY --chown=damian . /var/www/upload_file

RUN chown -R damian:damian  /var/www/upload_file

WORKDIR /var/www/upload_file




# CMD php index.php