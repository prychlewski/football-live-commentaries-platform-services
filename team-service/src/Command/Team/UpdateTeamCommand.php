<?php

namespace App\Command\Team;

use App\Command\UpdateCommandInterface;

class UpdateTeamCommand extends AbstractTeamCommand implements UpdateCommandInterface
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id, string $teamName)
    {
        $this->id = $id;

        parent::__construct($teamName);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
