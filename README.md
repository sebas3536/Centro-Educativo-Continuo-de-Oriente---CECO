
# Centro Educativo Continuo de Oriente - CECO
 
---
## Instalación y Configuración

### 1. Configurar las variables de entorno

1. Copia el archivo de plantilla `.env.example.php` y renómbralo como `.env.php`:

```bash
cp .env.example.php .env.php
```

2. Abre el archivo `.env.php` recién creado en un editor de texto y configura las credenciales de tu base de datos local:

```php
<?php
// Configuración de la aplicación
return [
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'ceco',
    'DB_USER' => 'root',
    'DB_PASS' => 'tu_contraseña_de_mysql',
];
```
  

### 3. Configurar e importar la Base de Datos

Debes inicializar la estructura y las relaciones en MySQL.

1. Abre tu herramienta de gestión de bases de datos.
2. Crea una nueva base de datos llamada `ceco`.
3. Ejecuta el siguiente script SQL para crear las tablas y poblar los roles y usuarios por defecto:

    

```sql

-- 1. Tabla de Roles (Almacena los perfiles del sistema)
CREATE  TABLE  roles (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(50) NOT NULL  UNIQUE,
descripcion VARCHAR(255) NULL,
fecha_creacion TIMESTAMP  DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabla de Usuarios (Autenticación y asignación de rol)
CREATE  TABLE  usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
rol_id INT  NOT NULL,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(150) NOT NULL  UNIQUE,
password_hash VARCHAR(255) NOT NULL,
activo TINYINT(1) DEFAULT  1,
fecha_creacion TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE RESTRICT ON UPDATE CASCADE,
INDEX idx_usuario_rol (rol_id),
INDEX idx_usuario_activo (activo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabla de Programas o Cursos (Información académica del sitio)
CREATE  TABLE  programas (
id INT AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(150) NOT NULL,
descripcion_corta VARCHAR(255) NULL,
contenido_detallado TEXT  NULL,
duracion VARCHAR(50) NULL, -- Ej: '40 horas', '3 meses'
modalidad VARCHAR(50) NULL, -- Ej: 'Presencial', 'Virtual'
estado ENUM('activo', 'inactivo', 'borrador') DEFAULT  'borrador',
fecha_creacion TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
INDEX idx_programa_estado (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabla de Multimedia / Fotos (Galería asociada a programas o general)
CREATE  TABLE  multimedia_fotos (
id INT AUTO_INCREMENT PRIMARY KEY,
programa_id INT  NULL, -- NULL si es una foto de la galería general del sitio
ruta_archivo VARCHAR(255) NOT NULL, -- Ruta de almacenamiento en el servidor
nombre_original VARCHAR(150) NULL,
peso_bytes INT  NULL,
orden INT  DEFAULT  0,
es_principal TINYINT(1) DEFAULT  0, -- Identifica la portada del curso
fecha_subida TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (programa_id) REFERENCES programas(id) ON DELETE CASCADE  ON UPDATE CASCADE,
INDEX idx_multimedia_programa (programa_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
  
-- Adicion de la tabla programas
ALTER  TABLE programas
ADD COLUMN destacado TINYINT(1) DEFAULT  0,
ADD COLUMN orden_inicio INT  DEFAULT  0;
-- INSERTAR LOS DATOS INICIALES

INSERT INTO roles (nombre, descripcion) VALUES
('Administrador', 'Acceso total al sistema y gestión de usuarios'),
('Editor Web', 'Gestión exclusiva de programas, cursos y contenidos multimedia');

-- Creacion de ususarios de la bd
INSERT INTO usuarios (rol_id, nombre, email, password_hash, activo)
VALUES (1, 'Administrador General', 'admin@ceco.com', '$2y$12$2.QxQ72jG27rdDfynKH.Cu5GZEfdrif5kBcqvk30d/mChocR22Jbq', 1);

INSERT INTO usuarios (rol_id, nombre, email, password_hash, activo)
VALUES ( 2, 'Editor Web', 'editor@ceco.com', '$2y$12$2.QxQ72jG27rdDfynKH.Cu5GZEfdrif5kBcqvk30d/mChocR22Jbq',1);
```
---
## Ejecutar el Proyecto

Puedes usar el servidor incorporado de PHP para arrancar la aplicación de manera rápida:

1. Abre tu terminal en la raíz del proyecto.
2. Ejecuta el servidor PHP:
```bash
php -S localhost:8000
```

3. Abre tu navegador web e ingresa a: [http://localhost:8000].

### Credenciales de acceso (Panel de Control)

Para acceder a la administración o edición de programas académicos, ingresa a la sección de login y utiliza las credenciales por defecto:

  
*  **Administrador:**
  **Correo:**  `admin@ceco.com`
 **Contraseña:**  `123456`
 
*  **Editor:**
**Correo:**  `editor@ceco.com`
**Contraseña:**  `123456`
---