# Apache Hardening – RA3.1

En este repositorio se encuentra la actividad **RA3.1 Apache Hardening** de **Puesta en Producción Segura** realizada por el alumno **Izan Rubio Palau**, todas las prácticas se han realizado utilizando contenedores Docker, las imágenes se encuentran públicas en pps10711933.

## 3.1 Apache Hardening

Guía utilizada:  
https://psegarrac.github.io/Ciberseguridad-PePS/tema3/seguridad/web/2021/03/01/Hardening-Servidor.html

Prácticas realizadas:

- **3.1.1 Práctica 1: CSP**
- **3.1.2 Práctica 2: Web Application Firewall**
- **3.1.3 Práctica 3: OWASP**
- **3.1.4 Práctica 4: Evitar ataques DDoS**

### Consideraciones Docker

- Se utilizará una estrategia de **capas en cascada**, donde cada contenedor incluye la información de los anteriores.  
  Ejemplo: el contenedor **3.1.3** contiene también **3.1.1** y **3.1.2**.
- Cada práctica dispone de su propio **README** con:
  - Explicación
  - Validación
  - Capturas de pantalla
  - URL para hacer el pull del contenedor

## 3.2 Certificados

Guía utilizada:  
https://psegarrac.github.io/Ciberseguridad-PePS/tema1/practicas/2020/11/08/P1-SSL.html

- **3.2.1** Instalación de un certificado digital en Apache y creación de la imagen Docker.

## 3.3 Apache Hardening Best Practices

Guía utilizada:  
https://geekflare.com/cybersecurity/apache-web-server-hardening-security/

- **3.3.1** Securización del servidor Apache y creación de la imagen Docker.

## Autor

**Izan Rubio Palau**

Estudiante del módulo PPS 25_26