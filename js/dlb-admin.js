jQuery(document).ready(function($) {
    // Generar código PHP
    $('#generate-code').on('click', function(e) {
        e.preventDefault();
        
        // Usar variables localizadas
        var code = dlb_vars.template
            .replace(/{source_domain}/g, dlb_vars.source_domain)
            .replace(/{custom_css}/g, dlb_vars.custom_css);
        
        $('#php-code').val(code);
        $('#generated-code').show();
    });

    // Copiar al portapapeles
    $('#copy-code').on('click', function(e) {
        e.preventDefault();
        $('#php-code').select();
        document.execCommand('copy');
        
        // Feedback visual
        var $this = $(this);
        $this.text('¡Copiado!');
        setTimeout(function() {
            $this.text('Copiar al Portapapeles');
        }, 2000);
    });
});
