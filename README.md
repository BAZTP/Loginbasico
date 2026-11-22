# Login Básico en PHP y MySQL

Sistema de autenticación y registro de administradores desarrollado en **PHP** y **MySQL / MariaDB**, con interfaz estilizada mediante **Bootstrap 5**. Implementa buenas prácticas de seguridad como sentencias preparadas contra inyección SQL y cifrado seguro de contraseñas.

---

## 🚀 Características

- **Inicio de sesión seguro:** Validación mediante `password_verify` y sentencias preparadas (`mysqli::prepare`).
- **Registro de usuarios:** Alta de administradores con validación de contraseñas coincidentes y hashing seguro mediante `password_hash()` con algoritmo BCRYPT.
- **Control de sesiones:** Protección de rutas mediante sesiones PHP (`$_SESSION`), evitando accesos no autorizados al panel.
- **Cierre de sesión:** Destrucción completa de la sesión activa.
- **Interfaz moderna y responsiva:** Diseñada con Bootstrap 5.
- **Base de datos incluida:** Script SQL listo para importar (`loginbasico.sql`).

---

## 📁 Estructura del Proyecto

```text
Loginbasico/
├── crearusuario.php    # Formulario y lógica de registro de nuevos administradores
├── dashboard.php       # Panel principal protegido por sesión
├── db.php              # Configuración y conexión a la base de datos MySQL
├── index.php           # Formulario principal de inicio de sesión
├── login.php           # Procesamiento y autenticación de credenciales
├── loginbasico.sql     # Volcado de la estructura y datos de la base de datos
├── logout.php          # Destrucción de la sesión y redirección
└── README.md           # Documentación del proyecto
```

---

## 🛠️ Requisitos Previos

- Entorno de desarrollo local como **[XAMPP](https://www.apachefriends.org/)**, WampServer o Laragon.
- **PHP** 7.4 o superior (compatible con PHP 8.x).
- **MySQL** 5.7+ o **MariaDB** 10.4+.
- Navegador web moderno.

---

## ⚙️ Instalación y Configuración

### 1. Clonar o copiar el proyecto
Ubica la carpeta del proyecto dentro del directorio raíz de tu servidor local (por ejemplo en XAMPP: `C:\xampp\htdocs\`):

```bash
cd C:\xampp\htdocs
git clone https://github.com/BAZTP/Loginbasico.git
```

### 2. Iniciar el servidor local
Abre el panel de control de **XAMPP** e inicia los módulos:
- **Apache**
- **MySQL**

### 3. Importar la base de datos
1. Ingresa a [phpMyAdmin](http://localhost/phpmyadmin).
2. Crea una nueva base de datos llamada:
   ```sql
   examen
   ```
3. Selecciona la base de datos `examen`, ve a la pestaña **Importar** y selecciona el archivo [`loginbasico.sql`](loginbasico.sql).
4. Haz clic en **Continuar** para ejecutar la importación.

> **Estructura de la tabla `admin`:**
> - `id`: Entero auto-incremental (Clave primaria).
> - `nombre`: Nombre del administrador (`VARCHAR(100)`).
> - `email`: Correo electrónico único (`VARCHAR(100)`).
> - `password`: Contraseña cifrada (`VARCHAR(255)`).

### 4. Configurar la conexión (Opcional)
Si tus credenciales de MySQL son diferentes a las predeterminadas de XAMPP, ajusta los valores en [`db.php`](db.php):

```php
$host = "localhost";
$user = "root";     // Tu usuario de MySQL
$pass = "";         // Tu contraseña de MySQL
$dbname = "examen"; // Nombre de la base de datos
```

### 5. Probar el sistema
Abre tu navegador e ingresa a:
```text
http://localhost/Loginbasico/
```

---

## 🔐 Seguridad Implementada

- **Cifrado de contraseñas:** Uso de `password_hash($password, PASSWORD_BCRYPT)` para almacenar credenciales seguras.
- **Prevención de inyección SQL:** Uso estricto de declaraciones preparadas de `mysqli` (`$conn->prepare()`, `bind_param()`).
- **Sanitización de salidas:** Protección contra ataques XSS mediante `htmlspecialchars()` al imprimir datos de usuario.
- **Restricción de acceso:** Verificación de `$_SESSION['admin_id']` en páginas restringidas.

---

## 📄 Licencia

Este proyecto se distribuye con fines educativos y de libre uso.
