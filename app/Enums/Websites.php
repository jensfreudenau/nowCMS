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
            self::freudefoto => 'freudefoto',
            self::berlinerphotoblog => 'berlinerphotoblog',
            self::streetphotoberlin => 'streetphotoberlin',
            self::freude_now => 'freude_now',
        };
    }


}
