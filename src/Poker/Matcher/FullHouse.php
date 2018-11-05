<?php

namespace Poker\Matcher;

class FullHouse extends NPairs {
    public function __construct()
    {
        parent::__construct(0);
    }

    public function matches(): bool
    {
        return count($this->matches) === 2 && count($this->pairs) === 2;
    }
}
