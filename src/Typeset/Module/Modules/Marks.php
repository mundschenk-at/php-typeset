<?php

/**
 * PHP Typeset / Marks Module
 *
 * Converts parenthesised marks to their proper equivalents.
 *
 * Processes for copyright, sound-recording copyright,
 * registered trademark, serice mark, and trademark symbols.
 */

namespace Typeset\Module\Modules;

use Typeset\Module\AbstractModule;
use Typeset\Support\Str;

class Marks extends AbstractModule
{
    /**
     * Define each mark with its unicode symbol code
     * @var array
     */
    protected $marks = [
        'C' => '24B8',
        'R' => '2117',
        'P' => '24C7',
        'SM' => '2120',
        'TM' => '2122',
    ];

    /**
     * @param  $text
     * @param  $node
     * @return string
     */
    public function process($text, $node)
    {
        foreach ($this->marks as $mark => $symbolCode) {
            $upperMark = "($mark)";
            $lowerMark = strtolower($upperMark);
            // Replace the lower and upper mark:
            $text = str_replace([$upperMark, $lowerMark], Str::uchr($symbolCode), $text);
            // Simple 501(c) reversal:
            $text = str_replace('501' . Str::uchr('24B8'), '501(c)', $text);
        }

        $this->result = $text;
    }
}
