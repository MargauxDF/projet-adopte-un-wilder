<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('mailTo', array($this, 'mailTo')),
        );
    }

    public function mailTo(string $text)
    {
        if (preg_match_all('/[\p{L}0-9_.-]+@[0-9\p{L}.-]+\.[a-z.]{2,6}\b/u', $text, $mails)) {
            foreach ($mails[0] as $mail) {
                $text = str_replace($mail, 'mailto:' . $mail, $text);
            }
        }

        return $text;
    }
}
