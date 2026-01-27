FROM pps10711933/pr2

ENV DEBIAN_FRONTEND=noninteractive

# Limpiar reglas CRS instaladas por Debian para evitar duplicados
RUN rm -rf /usr/share/modsecurity-crs \
           /usr/share/modsecurity-crs/base_rules \
           /usr/share/modsecurity-crs/activated_rules

# Instalar git (para clonar CRS oficial)
RUN apt-get update && \
    apt-get install -y git && \
    rm -rf /var/lib/apt/lists/*

# Clonar CRS oficial
RUN git clone https://github.com/SpiderLabs/owasp-modsecurity-crs.git /opt/owasp-crs

# Copiar configuración base
RUN mv /opt/owasp-crs/crs-setup.conf.example /etc/modsecurity/crs-setup.conf

# Copiar reglas CRS oficial
RUN mkdir -p /etc/modsecurity/rules && cp /opt/owasp-crs/rules/*.conf /etc/modsecurity/rules/

# Regla personalizada de prueba
RUN cat <<'EOF' > /etc/modsecurity/custom-rules.conf
SecRule ARGS:testparam "@contains test" "id:1234,phase:2,deny,status:403,msg:'Cazado por Ciberseguridad'"
EOF

# Habilitar ModSecurity y SSL
RUN a2enmod security2 ssl
RUN a2ensite default-ssl

# Apache en primer plano
CMD ["apachectl", "-D", "FOREGROUND"]
