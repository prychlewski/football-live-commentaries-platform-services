<?php

namespace App\Handler\Comment;

use App\Command\Comment\CreateCommentCommand;
use App\Entity\Comment;
use App\Repository\CommentRepository;

class CreateCommentHandler
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function handle(CreateCommentCommand $command): void
    {
        $comment = new Comment(
            $command->getFootballMatchId(),
            $command->getComment(),
            new \DateTime()
        );

        $this->commentRepository->add($comment);
    }
}
