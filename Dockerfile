FROM php:7.4.8-cli-alpine

COPY . .

RUN apk add sqlite bash
RUN php composer.phar install
RUN bin/console d:m:m -n
RUN bin/console do:fi:lo -n

CMD ["./symfony", "server:start"]
