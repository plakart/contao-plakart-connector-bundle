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

namespace Plakart\ContaoPlakartConnectorBundle\Backend;

use Contao\BackendModule;
use Contao\System;
use Contao\Input;
use Contao\Environment;
use Plakart\ContaoPlakartConnectorBundle\Helper\EnvHelper;

class GenerateConnectorToken extends BackendModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_plakart_gen_token';

    /**
     * Generate module
     */
    protected function compile()
    {
        $this->Template->request = Environment::get('requestUri');
        $this->Template->requestToken = System::getContainer()->get('contao.csrf.token_manager')->getDefaultTokenValue();

        $env = new EnvHelper();
        // check if a token exists
        if($env->checkIfTokenExists()) {
            $this->Template->tokenExists = true;
        }

        // generate token if form is submitted
        if('generateToken' === Input::post('FORM_SUBMIT') && !$env->checkIfTokenExists())
        {
            $this->Template->tokenExists = false;
            $this->Template->generatedToken = $env->setTokenVariable();
        }

    }

}