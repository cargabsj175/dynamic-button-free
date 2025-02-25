<?php
/*
Plugin Name: Dynamic Link Button (Free version)
Plugin URI: https://github.com/cargabsj175/dynamic-button-free
Description: Añade un botón dinámico que vincula el contenido con otro dominio manteniendo la misma estructura de URL.
Version: 1.0
Author: Carlos Sánchez
Author URI: https://cargabsj175.github.io
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dlb
*/

// Prevenir acceso directo al archivo
if (!defined("ABSPATH")) {
    exit();
}

// Activación del plugin
register_activation_hook(__FILE__, "dlb_activate");
function dlb_activate()
{
    add_option("dlb_source_domain", "https://dominio-origen.com");
    add_option("dlb_source_domain_index", "https://dominio-visor.com");
    add_option("dlb_source_textbtn", "Ir al visor");
    add_option("dlb_custom_css", "");
}

// Desactivación del plugin
register_deactivation_hook(__FILE__, "dlb_deactivate");
function dlb_deactivate()
{
    // Limpiar cualquier dato temporal si es necesario
}

// Desinstalación del plugin
register_uninstall_hook(__FILE__, "dlb_uninstall");
function dlb_uninstall()
{
    delete_option("dlb_source_domain");
    delete_option("dlb_source_domain_index");
    delete_option("dlb_source_textbtn");
    delete_option("dlb_source_textbtn_txtcol");
    delete_option("dlb_source_textbtn_btncol");
    delete_option("dlb_custom_css");
}

// Añadir el menú de configuración en el panel de administración
function dlb_add_menu_page()
{
    add_menu_page(
        "Dynamic Link Button Settings",
        "Dynamic Button Settings",
        "manage_options",
        "dlb_settings",
        "dlb_settings_page",
        "dashicons-admin-links",
        20
    );
}
add_action("admin_menu", "dlb_add_menu_page");

// Registrar configuraciones
function dlb_register_settings()
{
    register_setting("dlb_settings_group", "dlb_source_domain", "sanitize_url");
    register_setting(
        "dlb_settings_group",
        "dlb_source_domain_index",
        "sanitize_url"
    );
    register_setting(
        "dlb_settings_group",
        "dlb_source_textbtn",
        "sanitize_text_field"
    );
    register_setting(
        "dlb_settings_group",
        "dlb_source_textbtn_txtcol",
        "sanitize_hex_color"
    );
    register_setting(
        "dlb_settings_group",
        "dlb_source_textbtn_btncol",
        "sanitize_hex_color"
    );
    register_setting(
        "dlb_settings_group",
        "dlb_custom_css",
        "sanitize_textarea_field"
    );
}
add_action("admin_init", "dlb_register_settings");

// Mostrar la página de configuración
// Modificar la función dlb_settings_page para añadir la sección de generación de código
function dlb_settings_page()
{
    // Verificar permisos
    if (!current_user_can("manage_options")) {
        wp_die("No tienes suficientes permisos para acceder a esta página.");
    }

    // Guardar cambios si se ha enviado el formulario
    if (
        isset($_POST["submit"]) &&
        check_admin_referer("dlb_settings_nonce", "dlb_nonce")
    ) {
        update_option(
            "dlb_source_domain",
            sanitize_url($_POST["dlb_source_domain"])
        );
        update_option(
            "dlb_source_domain_index",
            sanitize_url($_POST["dlb_source_domain_index"])
        );
        update_option(
            "dlb_source_textbtn",
            sanitize_text_field($_POST["dlb_source_textbtn"])
        );
        update_option(
            "dlb_source_textbtn_txtcol",
            sanitize_hex_color($_POST["dlb_source_textbtn_txtcol"])
        );
        update_option(
            "dlb_source_textbtn_btncol",
            sanitize_hex_color($_POST["dlb_source_textbtn_btncol"])
        );
        update_option(
            "dlb_custom_css",
            sanitize_textarea_field($_POST["dlb_custom_css"])
        );
        echo '<div class="updated"><p>Configuración guardada.</p></div>';
    }

    // Obtener valores actuales
    $source_domain = get_option(
        "dlb_source_domain",
        "https://dominio-origen.com"
    );
    $source_domain_index = get_option(
        "dlb_source_domain_index",
        "https://dominio-visor.com"
    );
    $dlb_source_textbtn = get_option("dlb_source_textbtn", "Ir al visor");
    $dlb_source_textbtn_txtcol = get_option(
        "dlb_source_textbtn_txtcol",
        "#ffffff"
    );
    $dlb_source_textbtn_btncol = get_option(
        "dlb_source_textbtn_btncol",
        "#0073aa"
    );
    $custom_css = get_option("dlb_custom_css", "");
    ?>
    <div class="wrap">
        <h1>Dynamic Link Button Settings (by <a href="https://cargabsj175.github.io">@cargabsj175</a>)</h1>
        <p>Añade un botón dinámico que vincula el contenido con otro dominio manteniendo la misma estructura de URL.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field("dlb_settings_nonce", "dlb_nonce"); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="dlb_source_domain">Dominio de Origen</label>
                    </th>
                    <td>
                        <input type="url" 
                               id="dlb_source_domain" 
                               name="dlb_source_domain" 
                               value="<?php echo esc_attr($source_domain); ?>" 
                               class="regular-text" 
                               required />
                        <p class="description">Introduce el dominio de origen (ejemplo: https://dominio-origen.com)</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="dlb_source_domain_index">Dominio de Destino</label>
                    </th>
                    <td>
                        <input type="url" 
                               id="dlb_source_domain_index" 
                               name="dlb_source_domain_index" 
                               value="<?php echo esc_attr(
                                   $source_domain_index
                               ); ?>" 
                               class="regular-text" 
                               required />
                        <p class="description">Introduce el dominio de destino (ejemplo: https://dominio-visor.com)</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="dlb_source_textbtn">Texto del boton</label>
                    </th>
                    <td>
                        <input type="text" 
                               id="dlb_source_textbtn" 
                               name="dlb_source_textbtn" 
                               value="<?php echo esc_attr(
                                   $dlb_source_textbtn
                               ); ?>" 
                               class="regular-text" 
                               required />
                        <p class="description">Introduce el texto para el boton (ejemplo: Ir al visor)</p>
                    </td>
                    
                </tr>
                <tr>
                    <th scope="row">
                        <label for="dlb_source_textbtn">Estilos del botón</label>
                    </th>
                    <td>
                        <input type="color" 
                               id="dlb_source_textbtn_txtcol" 
                               name="dlb_source_textbtn_txtcol" 
                               value="<?php echo esc_attr(
                                   $dlb_source_textbtn_txtcol
                               ); ?>" 
                               class="regular-text" 
                               required />
                        <p class="description">Color del texto</p>
                    </td>
                    <td>
                        <input type="color" 
                               id="dlb_source_textbtn_btncol" 
                               name="dlb_source_textbtn_btncol" 
                               value="<?php echo esc_attr(
                                   $dlb_source_textbtn_btncol
                               ); ?>" 
                               class="regular-text" 
                               required />
                        <p class="description">Color del botón</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="dlb_custom_css">CSS Personalizado</label>
                    </th>
                    <td>
                        <textarea id="dlb_custom_css" 
                                  name="dlb_custom_css" 
                                  rows="10" 
                                  class="large-text code"><?php echo esc_textarea(
                                      $custom_css
                                  ); ?></textarea>
                        <p class="description">Introduce CSS personalizado para el visor del dominio de destino</p>
                    </td>
                </tr>
                
            </table>
            
            <?php submit_button("Guardar Cambios"); ?>
        </form>

        <hr>

    <?php // Ruta del archivo de plantilla (asegúrate de ajustar la ruta según tu estructura)


    $template_path = __DIR__ . "/template-index.php";

    // Leer el archivo de plantilla
    $template_content = "";
    if (file_exists($template_path)) {
        $template_content = file_get_contents($template_path);
    } else {
        $template_content = "No se encontró el archivo de plantilla.";
    }
    ?>


<!-- Añadir sección de generación de código -->
<h2>Generar Código PHP</h2>
<p>Copia el código generado en un archivo de nombre <strong>index.php</strong>. Este archivo debe ser instalado en el dominio que servirá como visor de los contenidos dinámicos.</p>
<div id="code-generator">
    <button id="generate-code" class="button button-primary">Generar Código PHP</button>
    
    <div id="generated-code" style="display: none; margin-top: 20px;">
        <h3>Código PHP Generado:</h3>
        <textarea id="php-code" style="width: 100%; height: 300px; font-family: monospace;" readonly></textarea>
        <button id="copy-code" class="button" style="margin-top: 10px;">Copiar al Portapapeles</button>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Plantilla cargada desde PHP
    var template = <?php echo json_encode($template_content); ?>;

    // Reemplazar variables dinámicas al generar el código
    $('#generate-code').on('click', function() {
        var code = template
            .replace(/{source_domain}/g, '<?php echo esc_js(
                $source_domain
            ); ?>')
            .replace(/{custom_css}/g, '<?php echo esc_js($custom_css); ?>')
            .replace(/{custom_js}/g, '<?php echo esc_js($custom_js); ?>');
        
        $('#php-code').val(code);
        $('#generated-code').show();
    });

    // Copiar el código generado al portapapeles
    $('#copy-code').on('click', function() {
        $('#php-code').select();
        document.execCommand('copy');
        var $this = $(this);
        $this.text('¡Copiado!');
        setTimeout(function() {
            $this.text('Copiar al Portapapeles');
        }, 2000);
    });
});
</script>
<h2>Cómo usar el shortcode</h2>
        <p>Usa el siguiente shortcode en tus posts o páginas:</p>
        <code>[dynamic_button]</code></br></br>
        <code>[dynamic_button text="Tu Texto" color="#ff0000" text_color="#ffffff"]</code>
        <p>O directo en código PHP:</p>
        <code>echo do_shortcode('[dynamic_button]');</code></br></br>
        <code>echo do_shortcode('[dynamic_button text="Tu Texto" color="#ff0000" text_color="#ffffff"]');</code>
        <p>Parámetros opcionales:</p>
        <ul>
            <li><code>text</code>: El texto del botón (por defecto: "Ir al visor")</li>
            <li><code>color</code>: Color de fondo del botón (por defecto: #0073aa)</li>
            <li><code>text_color</code>: Color del texto (por defecto: #ffffff)</li>
        </ul>
    </div>
    <?php
}

// Crear el shortcode para el botón dinámico
function generate_dynamic_button($atts)
{
    // Configurar atributos predeterminados y combinar con los proporcionados
    $atts = shortcode_atts(
        [
            "text" => get_option("dlb_source_textbtn", "Ir al visor"),
            "color" => get_option("dlb_source_textbtn_btncol", "#0073aa"),
            "text_color" => get_option("dlb_source_textbtn_txtcol", "#ffffff"),
        ],
        $atts,
        "dynamic_button"
    );

    // Obtener la URL actual y construir la URL de destino
    $post_url = get_permalink();
    $source_domain_index = get_option(
        "dlb_source_domain_index",
        "https://dominio-visor.com"
    );
    $slug = trim(parse_url($post_url, PHP_URL_PATH), "/");
    $target_url = $source_domain_index . "/?ruta=/" . $slug;

    // Construir el estilo del botón
    $button_style = sprintf(
        'background-color: %1$s; color: %2$s; padding: 10px 20px; ' .
            "text-decoration: none; border-radius: 5px; display: inline-block; " .
            "margin: 10px 0; font-weight: bold; transition: opacity 0.3s;",
        esc_attr($atts["color"]),
        esc_attr($atts["text_color"])
    );

    // Retornar el HTML del botón
    return sprintf(
        '<a href="%1$s" style="%2$s" class="dlb-button" target="_blank">%3$s</a>',
        esc_url($target_url),
        $button_style,
        esc_html($atts["text"])
    );
}
add_shortcode("dynamic_button", "generate_dynamic_button");

// Añadir enlace de configuración en la página de plugins
function dlb_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=dlb_settings">Configuración</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter(
    "plugin_action_links_" . plugin_basename(__FILE__),
    "dlb_add_settings_link"
);
?>
