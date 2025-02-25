<?php
// Verificar si el parámetro 'ruta' está presente en la URL
if (isset($_GET['ruta']) && !empty($_GET['ruta'])) {
    // Obtener la ruta (eliminar la barra inicial si existe)
    $requested_slug = ltrim($_GET['ruta'], '/');  // Eliminar la barra al inicio

    // El dominio de destino (será reemplazado dinámicamente)
    $source_domain = '{source_domain}'; // Este será reemplazado por el dominio configurado

    // Construir la URL completa usando la ruta proporcionada
    $requested_url = $source_domain . '/' . $requested_slug;

    // Obtener el contenido de la página del dominio de destino
    $response = @file_get_contents($requested_url); // Usar '@' para suprimir errores
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Link Button - Visor</title>
    <style>
        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff; /* Fondo blanco */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Spinner */
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Ocultar contenido inicialmente */
        #contenido {
            display: none;
        }
      
        {custom_css}
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Contenido -->
    <div id="contenido">
        <?php
        // Mostrar el contenido de la página si la respuesta fue exitosa
        if (isset($response) && $response !== false) {
            echo $response; // Mostrar contenido
        } else {
            echo '<p>No se pudo obtener el contenido de la página solicitada.</p>';
        }
        ?>
    </div>

    <!-- JavaScript para ocultar el preloader -->
    <script>
        window.onload = function() {
            const preloader = document.getElementById('preloader');
            const contenido = document.getElementById('contenido');

            preloader.style.display = 'none'; // Ocultar preloader
            contenido.style.display = 'block'; // Mostrar contenido
        };
    </script>
</body>
</html>
