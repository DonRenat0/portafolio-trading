# Portafolio de Trading

Sistema de gestión y seguimiento de operaciones desarrollado con Laravel.

---

## 🚀 Guía de Instalación Local

Sigue los pasos a continuación para clonar y ejecutar este proyecto en tu computadora.

### 1. Requisitos previos
- PHP (>= 8.2)
- Composer
- Node.js & NPM

---

### 2. Pasos de Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/TU-USUARIO/portafolio-trading.git](https://github.com/TU-USUARIO/portafolio-trading.git)
   cd portafolio-trading
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript:**
   ```bash
   npm install
   ```

4. **Configurar las variables de entorno:**
   ```bash
   cp .env.example .env
   ```

5. **Generar la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar migraciones y datos iniciales:**
   ```bash
   php artisan migrate --seed
   ```

7. **Compilar assets y levantar el servidor:**
   ```bash
   npm run dev
   ```
   En otra ventana de la terminal:
   ```bash
   php artisan serve
   ```

Accede desde tu navegador a `http://127.0.0.1:8000`.
