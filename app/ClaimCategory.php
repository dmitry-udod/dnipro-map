<?php

namespace App;

class ClaimCategory
{
    public static function all()
    {
        return [
            1 => 'Розташування об\'єкту без належних документів',
            2 => 'Невідповідність міськбудівним нормам та правилам благоустрію населених пунктів',
            3 => 'Продаж алкогольних напоїв на розлив',
            4 => 'Сміття біля об\'єкту',
            5 => 'Скарга на викладача',
            6 => 'Скарга на адміністрацію закладу',
            7 => 'Невідповідність санітарним нормам',
            8 => 'Шум/порушення норм правопорядку',
            9 => 'Торгівля алкоголем або цигарками на відстані менше 300м. до навчального закладу',
            10 => 'Iнше',
        ];
    }
}
