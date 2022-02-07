<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserSlugger
{
    private SluggerInterface $slugger;
    private UserRepository $userRepository;

    public function __construct(SluggerInterface $slugger, UserRepository $userRepository)
    {
        $this->slugger = $slugger;
        $this->userRepository = $userRepository;
    }

    public function findUniqueSlug(User $user): string
    {
        $slug = $this->slugger->slug($user->getFirstname() . ' ' . $user->getLastname())->toString();

        $usersWithSameSlug = $this->userRepository->findBy([
            'slug' => $slug,
        ]);

        if (!$usersWithSameSlug) {
            return $slug;
        }

        $originalSlug = $slug;
        $i = 1;

        do {
            $slug = $originalSlug . '-' . $i;
            $i++;

            $usersWithSameSlug = $this->userRepository->findBy([
                'slug' => $slug,
            ]);
        } while (count($usersWithSameSlug) !== 0);

        return $slug;
    }
}
