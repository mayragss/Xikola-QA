-- Script SQL para atualizar o título da seção de features para português
-- Execute este script no banco de dados do servidor

-- Verificar o registro atual
SELECT id, title, type, JSON_EXTRACT(settings, '$.feature_title') as current_feature_title 
FROM posts 
WHERE id = 1;

-- Atualizar o campo feature_title no JSON settings
UPDATE posts 
SET settings = JSON_SET(
    settings, 
    '$.feature_title', 
    'Revolucione a forma como você estuda com Software de Produtividade integrado com IA de Ponta!'
) 
WHERE id = 1;

-- Verificar se a alteração foi aplicada
SELECT id, title, type, JSON_EXTRACT(settings, '$.feature_title') as new_feature_title 
FROM posts 
WHERE id = 1;

-- Resultado esperado:
-- O campo feature_title deve mostrar: "Revolucione a forma como você estuda com Software de Produtividade integrado com IA de Ponta!"

