/*
 * Este arquivo faz parte do pacote de códigos "Sistema de avaliação de fotos" (github.com/gurideprograma/ilikeyou).
 * E está sob a licença GPLv2, localizada no diretório "licenca" (sem aspas) deste pacote de códigos.
 * Copyright (C) 2012 @_gurideprograma
 */

CREATE USER 'ilikeu'@'%' IDENTIFIED BY  '***';

GRANT USAGE ON * . * TO  'ilikeu'@'%' IDENTIFIED BY  '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT SELECT , INSERT , UPDATE ON  `ilikeyou` . * TO  'ilikeu'@'%';
