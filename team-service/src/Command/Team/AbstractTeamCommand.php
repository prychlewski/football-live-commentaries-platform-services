<?php

namespace App\Command\Team;

abstract class AbstractTeamCommand
{
    /**
     * @var string
     */
    private $teamName;

    public function __construct(string $teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * @return string
     */
    public function getTeamName(): string
    {
        return $this->teamName;
    }
}
