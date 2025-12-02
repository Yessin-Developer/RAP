SSL Certificate Information
===========================

Location: .docker/nginx/certs/
Files:
  - rap.local.crt (certificate)
  - rap.local.key (private key)

This is a self-signed SSL certificate valid for 365 days.

Regenerate certificate:
  cd .docker/nginx/certs
  openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout rap.local.key -out rap.local.crt \
    -subj "/C=NL/ST=State/L=City/O=Organization/CN=rap.local"

After regenerating, restart containers:
  docker-compose restart nginx

