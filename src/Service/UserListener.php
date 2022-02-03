<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function slugifyName(User $user)
    {
        return;
        $slug = $this->slugger->slug($user->getFirstname() . ' ' . $user->getLastname())->toString();
        $user->setSlug($slug);
    }
}
