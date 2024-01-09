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

$GLOBALS['BE_MOD']['system']['plakartConnector'] = array(
    'callback' => 'Plakart\ContaoPlakartConnectorBundle\Backend\GenerateConnectorToken'
);