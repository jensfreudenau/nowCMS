<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Websites: string
{
    case FREUDEFOTO = 'freudefoto.de';
    case BERLINERPHOTOBLOG = 'berlinerphotoblog.de';
    case STREETPHOTOBERLIN = 'streetphotoberlin.com';
    case FREUDE_NOW = 'blog.freude-now.de';


    public function label(): string
    {
        return match($this) {
            self::FREUDEFOTO => 'freudefoto',
            self::BERLINERPHOTOBLOG => 'berlinerphotoblog',
            self::STREETPHOTOBERLIN => 'streetphotoberlin',
            self::FREUDE_NOW => 'freude_now',
        };
    }


}
