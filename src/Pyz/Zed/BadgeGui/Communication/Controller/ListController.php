<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\BadgeGui\Communication\Controller;

use Pyz\Zed\BadgeGui\Communication\Table\BadgesTable;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

class ListController extends AbstractController
{
    /**
     * @var string
     */
    public const PARAM_ID = 'id';

    /**
     * @var string
     */
    public const REDIRECT_URL_DEFAULT = '/badge-gui';

    /**
     * @return array
     */
    public function indexAction()
    {
        $badgesTable = new BadgesTable();

        return $this->viewResponse([
            'badgesTable' => $badgesTable->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $badgesTable = new BadgesTable();

        return $this->jsonResponse(
            $badgesTable->fetchData(),
        );
    }

}