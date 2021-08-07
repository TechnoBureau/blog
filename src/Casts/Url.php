<?php

namespace TechnoBureau\Blog\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Doctrine\RST\Parser;

class Url implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        $parser = new Parser();
        $document = $parser->parse(urldecode($value));
        return $document->render();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return urlencode($value);
    }
}