FROM alpine:3.14

ARG CNBUILD="0"

RUN set -eux; \
    if [ -z "$CNBUILD" ]; then \
    sed -i 's/dl-cdn.alpinelinux.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apk/repositories; \
    fi

RUN set -eux; \
    apk add --no-cache --virtual .runtime-deps \
        ca-certificates \
        tar \
        xz \
        bash \
        openssl \
        curl \
    ;

RUN set -eux; \
    apk add --no-cache --virtual .build-base \
        autoconf \
        build-base \
        pkgconfig \
    ;

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
        openssl-dev \
        libpng-dev \
        jpeg-dev \
        freetype-dev \
        imagemagick-dev \
        icu-dev \
        libzip-dev \
        libwebp-dev \
        curl-dev \
        libxml2-dev \
        readline-dev \
        oniguruma-dev \
    ;


ENV PHP_URL="https://www.php.net/distributions/php-8.2.4.tar.gz"
ENV GITHUB_HOST="https://github.com"
ENV PHP_PREFIX="/usr/local"
ENV PHPCONFIG_DIR="/etc/php"
ENV PHP_SRC_DIR="/usr/local/src/php"

COPY download_github_by_tag.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/download_github_by_tag.sh

RUN set -eux; \
	adduser -u 82 -D -S -G www-data www-data

RUN set -eux; \
	mkdir -p "$PHPCONFIG_DIR/conf.d"; \
	[ ! -d /var/www/html ]; \
	mkdir -p /var/www/html; \
	chown www-data:www-data /var/www/html; \
	chmod 1777 /var/www/html

# download php source
RUN set -eux; \
    mkdir -p "${PHP_SRC_DIR}"; \
    echo "Download the PHP source: ${PHP_URL}"; \
    curl -sL -o- "${PHP_URL}" | tar -xz --strip-components 1 -C "${PHP_SRC_DIR}";

RUN set -eux; \
    ext_dir="${PHP_SRC_DIR}/ext/imagick"; \
    mkdir -p "${ext_dir}"; \
    download_github_by_tag.sh "Imagick/imagick" "3.7.0" "${ext_dir}"

RUN set -eux; \
    ext_dir="${PHP_SRC_DIR}/ext/phpredis"; \
    mkdir -p "${ext_dir}"; \
    download_github_by_tag.sh "phpredis/phpredis" "5.3.7" "${ext_dir}"

RUN set -eux; \
    cd ${PHP_SRC_DIR}; \
    rm configure && ./buildconf --force; \
    ./configure \
    --prefix=$PHP_PREFIX \
    --bindir=$PHP_PREFIX/bin \
    --libdir=$PHP_PREFIX/lib \
    --sbindir=$PHP_PREFIX/sbin \
    --includedir=$PHP_PREFIX/include \
    --mandir=$PHP_PREFIX/man \
    --localstatedir=/var \
    --runstatedir=/var/run \
    --sysconfdir=$PHPCONFIG_DIR \
    --with-config-file-path=$PHPCONFIG_DIR \
    --with-config-file-scan-dir="$PHPCONFIG_DIR/conf.d" \
    --disable-cgi \
    --disable-phpdbg \
    --without-pdo-sqlite \
    --without-sqlite3 \
    --enable-fpm \
    --enable-soap \
    --with-fpm-user=www-data \
    --with-fpm-group=www-data \
    --with-curl \
    --with-zlib \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    --with-imagick \
    --enable-intl \
    --enable-exif \
    --enable-bcmath \
    --with-mysqli \
    --with-zip \
    --enable-gd \
    --with-jpeg \
    --enable-redis \
    --enable-intl \
    --enable-mbregex \
    --with-pdo-mysql \
    --with-openssl \
    --enable-sockets \
    --enable-mbstring \
    --with-mhash \
    --with-readline \
    ; \
    make -j $(nproc) && make install; \
    php --version; \
    cp -v php.ini-* "$PHPCONFIG_DIR/"; \
    rm -rf "$PHP_SRC_DIR";

RUN set -eux; \
    cd "$PHPCONFIG_DIR"; \
    sed 's!=NONE/!=\/!g' php-fpm.conf.default | tee php-fpm.conf > /dev/null; \
	cp php-fpm.d/www.conf.default php-fpm.d/www.conf; \
    { \
		echo '[global]'; \
        echo 'log_limit = 8192'; \
		echo 'error_log = /proc/self/fd/2'; \
		echo; \
		echo '[www]'; \
		echo 'access.log = /proc/self/fd/2'; \
		echo; \
		echo 'clear_env = no'; \
		echo; \
		echo 'catch_workers_output = yes'; \
		echo 'decorate_workers_output = no'; \
	} | tee php-fpm.d/docker.conf; \
    { \
		echo '[global]'; \
		echo 'daemonize = no'; \
		echo; \
		echo '[www]'; \
		echo 'listen = 9000'; \
	} | tee php-fpm.d/zz-docker.conf; \
    mkdir -p "$PHPCONFIG_DIR/conf.d"; \
	{ \
		echo 'fastcgi.logging = Off'; \
	} > "$PHPCONFIG_DIR/conf.d/docker-fpm.ini"

COPY docker_php_entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/docker_php_entrypoint.sh
ENTRYPOINT ["docker_php_entrypoint.sh"]

STOPSIGNAL SIGQUIT
EXPOSE 9000

WORKDIR /var/www/html

CMD ["php-fpm", "-c /etc/php/php-fpm.conf"]

