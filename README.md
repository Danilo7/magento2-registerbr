# Registro Brasileiro para Magento 2  
  
Módulo para cadastro de usuários no padrão Brasil, CPF/CNPJ
  
## Pre-requisitos  
O módulo é compatível apenas com Magento 2.2  
  
# Recursos  
 - Configuração de Admin 
 - Máscara de CPF/CNPJ
 - Atualmente utilizando TAXVAT como CPF/CNPJ para funcionar corretamente com módulos de Pagamentos
 - compos incluidos em Customer Edit, Customer Address e Customer Create
    
  
# Instalação via composer  
Na pasta do projeto execute:  
  

    composer require fcamara/register-brazil  
    php bin/magento setup:upgrade

