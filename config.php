<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

  define('_URL_', "http://localhost/api.rdstation.v3");
} else {
  define('_URL_', "https://seguidor.com.br/api.rdstation.v3");
}
define('APPSTORE_RDSTATION', "https://appstore.rdstation.com/pt-BR/publisher");
