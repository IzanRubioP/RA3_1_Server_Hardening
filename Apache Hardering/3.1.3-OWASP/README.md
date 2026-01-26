# Apartado 3.1.3 OWASP

## Introducción

En este apartado se amplía la protección de la aplicación web mediante un Web Application Firewall (WAF) con ModSecurity sobre Apache, incorporando reglas del OWASP Core Rule Set (CRS) oficial.

El WAF permite detectar y bloquear ataques web comunes, como XSS, inyección SQL, command injection o path traversal.

## Imagen base utilizada

Se parte de la imagen Docker de la actividad anterior

```bash
pps10711933/pr2
```

A esta imagen se ha añadido:

1. Eliminación de reglas CRS de Debian que causaban duplicados.
1. Clonado del CRS oficial desde GitHub.
1. Configuración de reglas personalizadas de prueba.

## Instalación y configuración de ModSecurity

1. Limpieza de reglas CRS de Debian

    Para evitar conflictos de IDs duplicados:
    ```bash
    rm -rf /usr/share/modsecurity-crs \
       /usr/share/modsecurity-crs/base_rules \
       /usr/share/modsecurity-crs/activated_rules
    ```
1. Clonado del CRS oficial:
    ```bash
    git clone https://github.com/SpiderLabs/owasp-modsecurity-crs.git /opt/owasp-crs
    mv /opt/owasp-crs/crs-setup.conf.example /etc/modsecurity/crs-setup.conf
    mkdir -p /etc/modsecurity/rules
    cp /opt/owasp-crs/rules/*.conf /etc/modsecurity/rules/
    ```
1. Regla personalizada de prueba:
    ```bash
    cat <<'EOF' > /etc/modsecurity/custom-rules.conf
    SecRule ARGS:testparam "@contains test" "id:1234,phase:2,deny,status:403,msg:'Cazado por Ciberseguridad'"
    EOF
    ```
1. Activación de ModSecurity y módulos Apache:
    ```bash
    a2enmod security2 ssl
    a2ensite default-ssl
    ```

## Archivo Dockerfile

Se ha creado un Dockerfile específico que hereda de PR2 y realiza la configuración anterior.

![Contenido Dockerfile](img/Dockerfile.png)

## Recreación de la práctica

1. Construir la imagen localmente:
    ```bash
    docker pull pps10711933/pr3
    ```
1. Ejecutar el contenedor, mapeando puertos HTTP y HTTPS:
    ```bash
    docker run -d --rm -p 8080:80 -p 8081:443 --name PR3 pps10711933/pr3
    ```
1. Comprobar que funciona el WAF con la regla personalizada:
    ```bash
    curl -k "https://localhost:8081/index.html?testparam=test"
    ```
- Resultado esperado: **403 Forbidden**, confirmando que ModSecurity intercepta la petición.
![403 Forbidden](img/CurlReglaPersonalizada.png)

## Conclusión

Se ha configurado un WAF sobre Apache utilizando ModSecurity y el OWASP CRS oficial, integrándolo en una imagen Docker heredada de PR2. Las pruebas realizadas muestran que:

- Las peticiones que cumplen con las reglas personalizadas son bloqueadas correctamente (403 Forbidden).

- El WAF añade una capa de protección frente a ataques comunes, como XSS y otros intentos maliciosos.

La práctica demuestra cómo se puede endurecer una aplicación web con un WAF funcional y seguro, listo para entornos de producción o laboratorios de ciberseguridad.

## Autor

**Izan Rubio Palau**

Estudiante del módulo PPS 25_26