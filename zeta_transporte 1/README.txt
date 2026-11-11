ZETA TRANSPORTE - PROJETO PHP + MARIADB

REQUISITOS
- XAMPP (Apache e MySQL/MariaDB)
- PHP 8 ou superior
- Navegador e internet para carregar Bootstrap/imagens externas

COMO INSTALAR
1. Extraia a pasta zeta_transporte dentro de C:\xampp\htdocs\
2. Abra o XAMPP e inicie Apache e MySQL.
3. Acesse http://localhost/phpmyadmin
4. Importe o arquivo database.sql.
5. Confira usuário e senha do banco em config.php (padrão XAMPP: root e senha vazia).
6. Acesse http://localhost/zeta_transporte/setup_admin.php uma única vez.
7. Entre em http://localhost/zeta_transporte/login.php
8. Login inicial: admin
   Senha inicial: admin123
9. APAGUE setup_admin.php depois de criar o usuário.

PÁGINAS
- login.php: autenticação com sessão e senha protegida por password_hash/password_verify.
- dashboard.php: painel com seis cards de serviços organizados em quatro linhas/categorias.
- compra.php: resumo, desconto demonstrativo e seleção de pagamento.
- curriculos.php: formulário de currículo em PDF.
- logout.php: encerra a sessão.
- database.sql: cria o banco e as tabelas.

OBSERVAÇÕES IMPORTANTES
- A tela de pagamento é uma demonstração escolar. Mercado Pago, PayPal e Santander não estão conectados a contas reais. Para pagamentos reais, configure as integrações oficiais, credenciais, URLs de retorno e ambiente seguro.
- PIX comum é pagamento à vista. A opção parcelada depende de uma oferta de crédito de instituição/provedor parceiro; não é uma função nativa do PIX.
- O cartão aparece com condição demonstrativa de até 6x sem juros. A condição real depende do contrato e da configuração do provedor.
- Os currículos são salvos na pasta uploads e os dados ficam na tabela curriculos. Restrinja o acesso a essa pasta em uma implantação real.
- Faça backup exportando o banco pelo phpMyAdmin (Exportar > SQL) e copiando também a pasta uploads. Não apague dados sem guardar uma cópia.
- Para uso real, adicione HTTPS, proteção CSRF, limite de tentativas de login, política de privacidade/LGPD e validação adicional de arquivos.
