# ⚽ Fútbol Evolution

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![Platform](https://img.shields.io/badge/platform-Web%20App-blue.svg)]()

Plataforma web interactiva orientada a la gestión de partidos de fútbol recreativos y pickups (ej. en Texas y otras regiones), registro de jugadores con perfiles detallados (nivel, posición, pie dominante), inscripciones a equipos/ligas y un completo panel administrativo para el control de usuarios, partidos y torneos.

---

## 🚀 Características Principales

### 👤 Módulo de Usuarios y Autenticación
- **Registro completo de perfil:** Datos personales (Nombre, Apellidos, Género, Fecha de Nacimiento, País, Teléfono, Correo).
- **Perfil deportivo detallado:** 
  - Nivel de juego (`Rookie`, `Intermediate`, `Advanced`).
  - Posición principal y secundaria (`GK`, `DEF`, `MID`, `ATK`).
  - Pie dominante (`Left`, `Right`).
- **Autenticación segura:** Sistema de inicio de sesión (`Login`), recuperación/reinicio de contraseña (`Forgot Password`) y cierre de sesión de forma dinámica.
- **Gestión de Perfil:** Opciones para visualizar y editar la información personal y deportiva de manera autónoma.

### 🏟️ Gestión de Partidos y Eventos ("Play With Us")
- Listado interactivo de partidos y pickups disponibles con banners dinámicos y sliders.
- Visualización de detalles de los encuentros ("See List of Matches").
- Restricciones de seguridad: Validación de sesión activa obligatoria para inscripción de equipos o participación en ligas ("Para inscribirte a la liga, primero tienes que iniciar sesión").

### 🛡️ Panel Administrativo (Backend / Admin)
- **Gestión de Participantes y Equipos:** Control de capitanes, nombres de equipos, números de contacto y correos vinculados para las ligas.
- **Administración de Contenido y Partidos:** Creación, actualización y monitoreo de los eventos deportivos.
- **Soporte y Contacto:** Canales directos de atención y formularios automatizados para consultas generales y soporte técnico.

---

## 🛠️ Tecnologías y Arquitectura

- **Frontend:** HTML5, CSS3 / Frameworks de diseño responsivo, JavaScript moderno para la manipulación del DOM y control de modales interactivos (Login, Registro, Edición de Perfil, Inscripción a Ligas).
- **Backend & Base de Datos:** Arquitectura orientada a servicios web con panel de administración integrado para la persistencia y control de registros de usuarios y partidos.
- **Infraestructura / Alojamiento:** Configuración optimizada para despliegue web profesional.

---

## ⚙️ Estructura del Proyecto (Ejemplo)

```text
futbolevolution/
│
├── assets/                 # Imágenes, logos, estilos CSS y scripts JS
├── documentos/             # Términos y condiciones, Políticas de Privacidad (PDF)
├── index.html              # Vista principal / Landing page y modales de autenticación
└── README.md               # Documentación general del proyecto
```

---

## 📄 Documentación Legal
La plataforma cuenta con sus respectivas normativas de uso y privacidad integradas:
- [Terms & Conditions](https://futbolevolution.com/documentos/Terms%20%&%20Conditions.pdf)
- Privacy & Policy

---

## 📞 Contacto y Soporte
- **Sitio web:** [https://futbolevolution.com/](https://futbolevolution.com/)
- **Correo de soporte:** admin@futbolevolution.com
- **Teléfono:** +51 999999888
