<?php

declare(strict_types=1);

/*
 * This file is part of Plakart\ContaoPlakartConnectorBundle.
 *
 * Taken with friendly permission from Clickpress Update
 * https://github.com/clickpress/contao-clickpress-update
 * author Clickpress (https://clickpress.de/)
 *
 * (c) plakart GmbH & Co. KG (https://plakart.de)
 * author Jannik Nölke (https://jaynoe.de)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plakart\ContaoPlakartConnectorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\System;

/**
 * @Route("/plakart/get/infos/{token}", name=GetInfosController::class, defaults={"_scope": "frontend"}, methods={"GET"})
 */
class GetInfosController extends AbstractController
{
    public function __invoke($token): JsonResponse
    {
        $bundleToken = System::getContainer()->getParameter('plakart_connector.token');
        if($bundleToken !== $token) {
            return new JsonResponse(['error' => 'Invalid token.', 'token' => $token, 'version' => null], 200);
        }

        $version = ContaoCoreBundle::getVersion();
        $php = phpversion();

        return new JsonResponse(['error' => null, 'version' => $version, 'php' => $php], 200);
    }
}