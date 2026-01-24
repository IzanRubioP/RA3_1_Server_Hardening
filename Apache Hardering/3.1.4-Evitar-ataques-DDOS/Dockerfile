FROM pps10711933/pr3

ENV DEBIAN_FRONTEND=noninteractive

# Instalar mod_evasive y apache bench
RUN apt-get update && \
    apt-get install -y \
    libapache2-mod-evasive \
    apache2-utils && \
    rm -rf /var/lib/apt/lists/*

# Crear directorio de logs para mod_evasive
RUN mkdir -p /var/log/mod_evasive && \
    chown www-data:www-data /var/log/mod_evasive

# Copiar la configuración de mod_evasive
COPY evasive.conf /etc/apache2/mods-available/evasive20.conf

# Habilitar el módulo CORRECTO
RUN a2enmod evasive

# Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]
