<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Using Amazon SES SMTP
 */
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.mandrillapp.com';
$config['smtp_user'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
$config['smtp_pass'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
$config['smtp_port'] = 587;
$config['smtp_timeout'] = '30';
$config['useragent'] = 'domain.com';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
?>
