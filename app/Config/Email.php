<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'sales@foundrybiz.com';
    public string $fromName   = 'FoundryBiz Sales';
    public string $recipients = '';

    public string $userAgent  = 'CodeIgniter';
    public string $protocol   = 'smtp';
    public string $mailPath   = '/usr/sbin/sendmail';

    public string $SMTPHost   = 'smtp.gmail.com';
    public string $SMTPUser   = 'sales@foundrybiz.com';           // Workspace mailbox
    public string $SMTPPass   = 'rhaefstpbvnngeyb';                // App Password (NO spaces)
    public int    $SMTPPort   = 587;                               // TLS port
    public int    $SMTPTimeout= 60;
    public bool   $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';                             // ✅ TLS with 587

    public bool   $wordWrap   = true;
    public int    $wrapChars  = 76;
    public string $mailType   = 'html';
    public string $charset    = 'UTF-8';
    public bool   $validate   = false;
    public int    $priority   = 3;
    public string $CRLF       = "\r\n";
    public string $newline    = "\r\n";
    public bool   $BCCBatchMode = false;
    public int    $BCCBatchSize  = 200;
    public bool   $DSN        = false;
}