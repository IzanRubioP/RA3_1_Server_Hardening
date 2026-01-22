# Imagen de la actividad anterior
FROM pps10711933/pr1

#Instalar lo que necesito
RUN apt update && apt install -y \
    apache2 \
    libapache2-mod-security2 \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Activar mod_security
RUN cp /etc/modsecurity/modsecurity.conf-recommended \
       /etc/modsecurity/modsecurity.conf

# Asegurarnos de que lo bloquea
RUN sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' \
    /etc/modsecurity/modsecurity.conf

# Añadir regla simple
RUN cat <<EOF >> /etc/apache2/sites-available/000-default.conf
SecRuleEngine On
SecRule ARGS:testparam "@contains test" "id:1234,deny,status:403,msg:'Bloqueado por mod_security'"
EOF

# Puerto y arranque
EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]