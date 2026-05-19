📸 Calendario Fotográfico Automático

Proyecto desarrollado en PHP + HTML + CSS que genera un calendario fotográfico dinámico leyendo automáticamente las imágenes almacenadas dentro de una carpeta del sistema.

El objetivo del proyecto es mostrar una fotografía diferente para cada día del mes, seleccionando las imágenes de forma aleatoria y organizándolas automáticamente dentro del calendario.

✨ Características
📂 Lectura automática de carpetas mediante PHP.
🖼️ Interpretación de archivos de imagen existentes.
🎲 Selección aleatoria de fotografías.
📅 Generación automática de un calendario mensual.
🎨 Interfaz visual creada con HTML y CSS.
⚡ Proyecto ligero y fácil de personalizar.
🔄 Cambio dinámico de imágenes día a día.
🛠️ Tecnologías utilizadas
PHP
HTML5
CSS3
📁 Funcionamiento

El sistema analiza automáticamente el contenido de una carpeta específica donde se almacenan las fotografías.

Cada archivo encontrado es interpretado por PHP y posteriormente asignado aleatoriamente a los distintos días del mes dentro del calendario visual.

El proceso general funciona así:

PHP escanea la carpeta de imágenes.
Detecta los archivos disponibles.
Selecciona imágenes de forma aleatoria.
Genera el calendario mensual.
Muestra cada día acompañado de una fotografía.

📂 Estructura del proyecto
/
├── index.php
├── controlador
├── vista
├──modelo
│   ├── mes.php
│   ├── calendario.php
│   ├── imagen.php
│   └── ...


🚀 Instalación
Clona este repositorio:
git clone https://github.com/usuario/calendario-fotografico.git
Coloca tus imágenes dentro de la carpeta:
/images
Ejecuta el proyecto en un servidor local compatible con PHP.

Ejemplo:

XAMPP
Laragon
Apache
Nginx
Abre el navegador:
http://localhost/calendario-fotografico
🎨 Personalización

Puedes modificar:

El diseño del calendario desde style.css
La lógica de selección aleatoria en index.php
El formato visual de las imágenes
Los estilos responsive para móviles
📌 Objetivo del proyecto

Este proyecto busca combinar:

Automatización
Organización visual
Gestión dinámica de imágenes
Diseño web interactivo

Ideal para:

Álbumes fotográficos
Calendarios personalizados
Galerías dinámicas
Proyectos creativos con PHP
📄 Licencia

Este proyecto es de uso libre para fines educativos y personales.

👨‍💻 Autor

Desarrollado con PHP, HTML y CSS para la creación de un calendario fotográfico automático y dinámico.
