<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PokerTest;

use PHPUnit\Framework\TestCase;
use Poker\GameFactory;

class GameTest extends TestCase
{
    public function testVariousCases() {
        $gameFactory = new GameFactory();
        $game = $gameFactory->create();
        $game->play(4);
    }
}