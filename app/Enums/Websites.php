<?php

namespace App\Enums;

enum Websites: string
{
    case freudefoto = 'freudefoto.local';
    case berlinerphotoblog = 'berlinerphotoblog.local';
    case streetphotoberlin = 'streetphotoberlin.local';
    case freude_now = 'blog.freude-now.local';


    public function label(): string
    {
        return match($this) {
            self::freudefoto => 'freudefoto',
            self::berlinerphotoblog => 'berlinerphotoblog',
            self::streetphotoberlin => 'streetphotoberlin',
            self::freude_now => 'blog.freude-now',
        };
    }
}
