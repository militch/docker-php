FROM alpine:3.14

RUN set -eux; \
    apk add --no-cache \
        bash \
        curl \
    ;

RUN set -eux; \
    apk add --no-cache \
        autoconf \
        build-base \
        pkgconfig \
    ;

RUN set -eux; \
    apk add --no-cache \
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
ENV PREFIX="/usr/local"
ENV PHPCONFIG_DIR="/etc/php"
ENV PHP_SRC_DIR="/usr/local/src/php"

COPY download_github_by_tag.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/download_github_by_tag.sh

RUN set -eux; \
	adduser -u 82 -D -S -G www-data www-data

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
    rm configure; \
    ./buildconf --force; \
    ./configure --prefix=$PREFIX \
    --bindir=$PREFIX/bin \
    --libdir=$PREFIX/lib \
    --sbindir=$PREFIX/sbin \
    --includedir=$PREFIX/include \
    --sysconfdir=$PHPCONFIG_DIR \
    --localstatedir=/var \
    --runstatedir=/var/run \
    --with-config-file-path=$PHPCONFIG_DIR \
    --mandir=$PREFIX/man \
    --disable-cgi \
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
    --disable-phpdbg \
    --enable-mbregex \
    --with-pdo-mysql \
    --with-openssl \
    --enable-mbstring \
    --with-mhash \
    --with-readline \
    ; \
    make && make install; \
    php --version; \
    cp php.ini-production "${PHPCONFIG_DIR}/php.ini"; \
    rm -rf "$PHP_SRC_DIR" \
    ; 

RUN set -eux; \
    cd "$PHPCONFIG_DIR"; \
    cp php-fpm.conf.default php-fpm.conf; \
    cp php-fpm.d/www.conf.default php-fpm.d/www.conf \
    ; \
    { \
		echo '[global]'; \
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

