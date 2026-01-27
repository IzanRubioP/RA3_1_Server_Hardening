FROM pps10711933/pr6

# Evitar que haga preguntas al construir la imagen
ENV DEBIAN_FRONTEND=noninteractive

# Copiar configuraciones
COPY conf/hardening.conf /etc/apache2/conf-available/hardening.conf
COPY conf/security-headers.conf /etc/apache2/conf-available/security-headers.conf
COPY conf/directory-security.conf /etc/apache2/conf-available/directory-security.conf

# Habilitar configuraciones
RUN a2enconf hardening \
    && a2enconf security-headers \
    && a2enconf directory-security

# Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]
