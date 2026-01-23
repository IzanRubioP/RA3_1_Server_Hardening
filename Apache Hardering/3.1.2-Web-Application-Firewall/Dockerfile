# Imagen de la actividad anterior
FROM pps10711933/pr1

# Evitar preguntas durante la instalación
ENV DEBIAN_FRONTEND=noninteractive

# Actualizar e instalar ModSecurity y CRS
RUN apt-get update && \
    apt-get install -y \
    libapache2-mod-security2 \
    modsecurity-crs && \
    rm -rf /var/lib/apt/lists/*

# Activar ModSecurity copiando el archivo recomendado
RUN cp /etc/modsecurity/modsecurity.conf-recommended \
       /etc/modsecurity/modsecurity.conf

# Activar el motor de ModSecurity
RUN sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' \
    /etc/modsecurity/modsecurity.conf

# Activar las reglas OWASP CRS
RUN cp /usr/share/modsecurity-crs/base_rules/* \
       /usr/share/modsecurity-crs/activated_rules/ || true

# Habilitar el módulo de seguridad en Apache
RUN a2enmod security2

# Copiar el post.php al document_root
COPY post.php /var/www/html/post.php

# Asegurar permisos correctos
RUN chown www-data:www-data /var/www/html/post.php

# Reiniciar Apache al arrancar el contenedor
CMD ["apachectl", "-D", "FOREGROUND"]
