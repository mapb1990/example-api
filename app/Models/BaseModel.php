<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
abstract class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:5|max:50',
    ];

    /**
     * @var array
     */
    protected $uniques = [];

    /**
     * @param bool $updating
     * @param bool $prefix
     * @return array
     */
    public function getRules($updating = false, $prefix = false)
    {
        if (empty($prefix)) {
            return $this->transformRules($updating);
        }

        return array_combine(
            array_map(function ($k) use ($prefix) {
                return "{$prefix}{$k}";
            }, array_keys($this->rules)),
            $this->transformRules($updating)
        );
    }

    /**
     * @param bool $updating
     * @return array
     */
    protected function transformRules($updating = false)
    {
        if (empty($this->uniques) or empty($this->rules)) {
            return $this->rules;
        }

        $rules = [];
        foreach ($this->rules as $field => $rules) {
            if (array_key_exists($field, $this->uniques)) {
                $rules[$field] = "{$rules}|unique:{$this->getTable()},{$field}" . ($updating ? ",{$this->getKey()}" : '');
            }
        }

        return $rules;
    }
}
