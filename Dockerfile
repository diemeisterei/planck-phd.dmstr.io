FROM dmstr/phd5-app:5.0.0-beta37

# Additional packages
COPY ./composer.* /app/
RUN composer install --prefer-dist

RUN cp src/app.env-dist src/app.env
ENV APP_CONFIG_FILE=/app/src/modules/config.php

COPY ./src /app/src

RUN chown www-data /usr/local/bin/docker-entrypoint.sh