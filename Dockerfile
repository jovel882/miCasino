FROM jovel882/latavel-octane-swoole:1.0

LABEL maintainer="John Fredy Velasco Bareño <jovel882@gmail.com>"
LABEL author="John Fredy Velasco Bareño <jovel882@gmail.com>"

COPY . /var/www/html
COPY --chmod=755 ./Docker/start.sh /start_octane.sh

CMD ["/start_octane.sh"]