<?php
//src/Service/NewsletterService.php
namespace App\Service;

use App\Entity\UserNewsletter;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;

class NewsletterService
{
    private $mailer;
    private $entityManager;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    public function sendNewsletter()
    {
        $subscribers = $this->entityManager->getRepository(UserNewsletter::class)->findAll();

        foreach ($subscribers as $subscriber) {
            $email = (new Email())
                ->from('your_email@example.com')
                ->to($subscriber->getEmail())
                ->subject('Newsletter Subject')
                ->html('<p>Your newsletter content goes here.</p>');

            $this->mailer->send($email);
        }
    }
}