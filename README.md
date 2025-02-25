# Dynamic Link Button

Un plugin de WordPress que añade botones dinámicos para vincular contenido con otro dominio manteniendo la misma estructura de URL.

## 🚀 Características

### ✅ Versión Gratuita
- Añade un botón dinámico en tus posts y páginas que vincula a otro dominio
- Mantiene la misma estructura de URL entre dominios
- Personalización básica del texto del botón
- Personalización de colores básicos (fondo y texto)
- Fácil implementación mediante shortcode: `[dynamic_button]`
- Panel de administración simple para configurar dominios origen y destino
- Generador de código para crear el archivo index.php necesario en el dominio de destino
- Soporte para CSS personalizado en el dominio de destino

### ⭐ Versión Pro
Todo lo de la versión gratuita y además:
- **Interfaz mejorada con pestañas** para una mejor organización y gestión
- **Sistema avanzado de personalización de botones** con más opciones estéticas
- **Implementación avanzada** - Añade botones automáticamente según la ID o clase de un div en tipos específicos de posts
- **Documentación extendida** con ejemplos y guías de implementación
- **Sección de ayuda dedicada** para resolver problemas comunes
- **Mejor organización** de las opciones de configuración por categorías
- **Actualizaciones prioritarias**
- **Soporte premium**

## 📥 Instalación

1. Descarga el archivo zip del plugin
2. Sube el plugin a tu WordPress a través de la sección Plugins > Añadir nuevo > Subir plugin
3. Activa el plugin
4. Ve a "Dynamic Button Settings" en el menú de administración para configurar

## ⚙️ Configuración

### Configuración básica:
1. Configura el dominio de origen (tu sitio WordPress actual)
2. Configura el dominio de destino (donde se mostrará el contenido)
3. Personaliza el texto y los colores del botón
4. Genera y copia el código PHP para el archivo index.php
5. Sube el archivo index.php generado al dominio de destino

### Uso del shortcode:
```
[dynamic_button]
```

Con parámetros personalizados:
```
[dynamic_button text="Ver contenido" color="#ff0000" text_color="#ffffff"]
```

### PHP directo:
```php
echo do_shortcode('[dynamic_button]');
```

## 🔄 Cómo funciona

Este plugin crea un sistema de enlace inteligente entre dos dominios:

1. El usuario navega por tu sitio principal (dominio de origen)
2. Al hacer clic en el botón dinámico, es redirigido al dominio de destino
3. El contenido se carga en el dominio de destino manteniendo la misma estructura de URL
4. El CSS personalizado se aplica para mantener la coherencia visual

## 🌟 ¿Por qué actualizar a la versión Pro?

* **Ahorra tiempo** con la implementación automática en tipos específicos de contenido
* **Mejora la experiencia del usuario** con botones más personalizables y atractivos
* **Más opciones de personalización** para adaptar perfectamente el botón a tu diseño
* **Interfaz mejorada** con pestañas para una gestión más eficiente
* **Documentación detallada** y soporte premium

## 💡 Casos de uso comunes

- Sitios espejo para diferentes regiones o idiomas
- Crear una vista previa o "modo de lectura" alternativo
- Separar secciones de contenido en dominios diferentes
- Implementar sistemas de afiliados con vista previa
- Crear versiones para imprimir o visualizar en dispositivos específicos

## 📝 Licencia

Este plugin está licenciado bajo GPL v2 o posterior.

## 👨‍💻 Autor

Desarrollado por [Carlos Sánchez](https://cargabsj175.github.io)

## 📣 ¡Actualiza a la versión Pro hoy mismo!

No te pierdas todas las características avanzadas y la implementación mejorada de la versión Pro.

[¡Comprar Versión Pro!](https://vegnux.com/producto/plugin-para-corredores-inmobiliarios-compartir-propiedades-sin-mostrar-inmobiliarias/)
