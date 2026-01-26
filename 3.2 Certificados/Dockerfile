FROM pps10711933/pr4

# Copiar configuración de redirección HTTP -> HTTPS
COPY redirect-http.conf /etc/apache2/sites-available/redirect-http.conf

# Activar el sitio y desactivar el default HTTP
RUN a2ensite redirect-http.conf \
    && a2dissite 000-default.conf

