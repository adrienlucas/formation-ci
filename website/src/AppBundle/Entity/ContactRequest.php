<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

/**
 * ContactRequest
 *
 * @ORM\Table(name="contact_request")
 * @ORM\Entity()
 */
class ContactRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     * @Length(min=5, max=256, minMessage="Le sujet doit contenir au moins 5 caractéres")
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Email
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     * @Length(max=1024)
     */
    private $message;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return ContactRequest
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ContactRequest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return ContactRequest
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

