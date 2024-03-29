<?php

declare(strict_types=1);

/*
 * This file is part of Plakart\ContaoPlakartConnectorBundle.
 *
 * (c) plakart GmbH & Co. KG (https://plakart.de)
 * author Jannik Nölke (https://jaynoe.de)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plakart\ContaoPlakartConnectorBundle\Helper;

use Contao\File;
use Symfony\Component\Dotenv\Dotenv;

class EnvHelper
{
    private string $tokenName = 'PLAKART_CONNECTOR_TOKEN';
    private string $envVariable;
    private File $envFile;

    public function __construct()
    {
        $this->envVariable = $this->tokenName.'=';
        $this->envFile = $this->getEnvFile();
    }

    public function setTokenVariable():string
    {
        $token = $this->createToken();
        $this->envFile->prepend($this->envVariable.$token);
        $this->envFile->close();

        return $token;
    }

    public function checkIfTokenExists():bool
    {
        // load .env variables via symfony
        $dotenv = new Dotenv();
        $dotenv->load($this->envFile->dirname.'.env');
        if(isset($_ENV['PLAKART_CONNECTOR_TOKEN'])) {
            return true;
        }

        return false;
    }

    private function getEnvFile():File
    {
        $file = new File('.env');
        if(!$file->exists()) {
            File::putContent('.env', '# generated by plakart/contao-plakart-connector-bundle');
        }

        return $file;
    }

    private function createToken():string
    {
        if(function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes(16));
        }

        return bin2hex(random_bytes(16));
    }
}