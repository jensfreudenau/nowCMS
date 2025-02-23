<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Websites: string
{
    case freudefoto = 'freudefoto.de';
    case berlinerphotoblog = 'berlinerphotoblog.de';
    case streetphotoberlin = 'streetphotoberlin.com';
    case freude_now = 'blog.freude-now.de';


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
