<?php
// Arquivo para limpar cache do Laravel via navegador
// Acesse: https://seudominio.com/clear_cache.php

// Verificar se é Laravel
if (!file_exists('artisan')) {
    die('Este arquivo deve estar na raiz do projeto Laravel');
}

echo "<h2>🧹 Limpando cache do Laravel...</h2>";

// Executar comandos de limpeza
$commands = [
    'php artisan config:clear',
    'php artisan cache:clear', 
    'php artisan view:clear',
    'php artisan route:clear'
];

foreach ($commands as $command) {
    echo "<p>Executando: <code>$command</code></p>";
    
    $output = [];
    $return_var = 0;
    exec($command, $output, $return_var);
    
    if ($return_var === 0) {
        echo "<p style='color: green;'>✅ Sucesso!</p>";
        if (!empty($output)) {
            echo "<pre>" . implode("\n", $output) . "</pre>";
        }
    } else {
        echo "<p style='color: red;'>❌ Erro!</p>";
        if (!empty($output)) {
            echo "<pre>" . implode("\n", $output) . "</pre>";
        }
    }
    echo "<hr>";
}

echo "<h3>✅ Cache limpo com sucesso!</h3>";
echo "<p><strong>IMPORTANTE:</strong> Delete este arquivo após usar por segurança!</p>";
?>
