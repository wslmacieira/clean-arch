<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use DateTimeInterface;

final class Registration
{
    private string $name;
    private Email $email;
    private DateTimeInterface $birthDate;
    private Cpf $registrationNumber;
    private DateTimeInterface $registrationAt;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name 
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email 
     * @return self
     */
    public function setEmail(Email $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * @param DateTimeInterface $birthDate 
     * @return self
     */
    public function setBirthDate(DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return Cpf
     */
    public function getRegistrationNumber(): Cpf
    {
        return $this->registrationNumber;
    }

    /**
     * @param Cpf $registrationNumber 
     * @return self
     */
    public function setRegistrationNumber(Cpf $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRegistrationAt(): DateTimeInterface
    {
        return $this->registrationAt;
    }

    /**
     * @param DateTimeInterface $registrationAt 
     * @return self
     */
    public function setRegistrationAt(DateTimeInterface $registrationAt): self
    {
        $this->registrationAt = $registrationAt;
        return $this;
    }
}
