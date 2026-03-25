# Generador de Números Aleatorios

Aplicación PHP orientada a objetos que solicita al usuario N elementos y muestra N números aleatorios en una tabla.

## Requisitos

- Docker + docker-compose
- Puerto mapeado: 8082

## Instrucciones de despliegue

1. Colocar esta carpeta en `./html/noo/` del proyecto que contiene `docker-compose.yml`
2. Ejecutar `docker-compose up -d`
3. Abrir http://localhost:8082/noo/
4. PHP 7.4 es el target; la app evita sintaxis de PHP 8+

## Notas

- No se requiere Composer; todas las clases se incluyen con `require_once`
- Implementa patrón PRG (Post/Redirect/Get) para prevenir reenvíos accidentales
- Validación servidor: n entero positivo entre 1 y 1000
- Campos opcionales para rango mínimo y máximo
