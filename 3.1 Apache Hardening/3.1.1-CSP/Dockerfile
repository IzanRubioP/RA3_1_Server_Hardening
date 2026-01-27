FROM debian:11

ENV DEBIAN_FRONTEND=noninteractive

# Instalación de Apache y dependencias
RUN apt update && apt install -y \
    apache2 \
    curl \
    openssl \
    && rm -rf /var/lib/apt/lists/*

# Habilitar módulos necesarios y deshabilitar autoindex
RUN a2enmod ssl headers \
    && a2dismod -f autoindex

# Generación de certificado autofirmado
RUN mkdir -p /etc/apache2/ssl && \
    openssl req -x509 -nodes -days 365 \
    -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache.key \
    -out /etc/apache2/ssl/apache.crt \
    -subj "/C=ES/ST=Castellón/L=Castellón/O=PPS/OU=PR1_IzanRubioPalau/CN=localhost"

# Copiar página web
COPY index.html /var/www/html/index.html

# Endurecimiento de Apache (ocultar información)
RUN echo "ServerTokens ProductOnly\nServerSignature Off" >> /etc/apache2/apache2.conf

# Configuración del VirtualHost SSL con HSTS y CSP
COPY default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# Habilitar sitio SSL
RUN a2ensite default-ssl

# Exposición de puertos
EXPOSE 80 443

# Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]

