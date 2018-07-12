<?php

declare(strict_types=1);

namespace AppBundle\Manager;

use AppBundle\Entity\ContactRequest;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContactRequestManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    private $logger;

    public function __construct(RegistryInterface $registry, LoggerInterface $logger)
    {
        $this->entityManager = $registry->getManager();
        $this->logger = $logger;
    }

    public function persistContactRequest(ContactRequest $contactRequest)
    {
        $this->entityManager->persist($contactRequest);

        try {
            $this->entityManager->flush();
        } catch (OptimisticLockException $e) {
            return false;
        }

        $this->logger->info('There is a new contact request.');

        return true;
    }
}