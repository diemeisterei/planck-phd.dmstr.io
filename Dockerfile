FROM dmstr/phd5-app

# Additional packages
COPY ./composer.* /app/
RUN composer install --prefer-dist

RUN cp src/app.env-dist src/app.env
ENV APP_CONFIG_FILE=/app/src/modules/config.php

COPY ./src /app/src