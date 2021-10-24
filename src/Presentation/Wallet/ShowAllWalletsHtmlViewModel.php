<?php

declare(strict_types = 1);

namespace Cryptools\Presentation\Wallet;

use Cryptools\Presentation\Wallet\Model\WalletViewModel;

class ShowAllWalletsHtmlViewModel
{
    /**
     * @var WalletViewModel[]
     */
    public $wallets;
    /**
     * @var bool
     */
    public $displayDeleteModal = false;
    /**
     * @var string
     */
    public $deleteModalMessage = "";
}