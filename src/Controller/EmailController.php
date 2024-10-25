<?php

namespace App\Controller;

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{

    #[Route('/send-test-email', name: 'send_test_email')]
    public function sendTestEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('test@example.com')
            ->to('recipient@example.com')
            ->subject('Hello from Symfony!')
            ->text('This is a test email sent from Symfony using Mailtrap.')
            ->html('<p>This is a test email sent from Symfony using Mailtrap.</p>');

        $mailer->send($email);

        return $this->json(['message' => 'Email sent successfully!']);
    }
}