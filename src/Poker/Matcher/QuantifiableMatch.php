<?php

namespace Poker\Matcher;

class QuanitfiableMatch extends Match {
    private $value;

    public function __construct(int $rank, int $value)
    {
        $this->value = $value;
        parent::__construct($rank);
    }
    public function getValue(): int
    {
        return $this->value;
    }
}
