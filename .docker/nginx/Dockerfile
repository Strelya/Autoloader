FROM nginx:1.17.8

COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY . /src/app/

WORKDIR /src/app/

RUN chown -R www-data:www-data /src/app