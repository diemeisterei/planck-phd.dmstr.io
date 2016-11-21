FROM registry-v2.hrzg.de/hrzg/ee:0.9.0-alpha2

# Additional packages
COPY ./composer.* /app/
RUN composer install --prefer-dist

RUN cp src/app.env-dist src/app.env
ENV APP_CONFIG_FILE=/app/src/modules/config.php

COPY ./src /app/src