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
    protected $rules = [];

    /**
     * @var array
     */
    protected $uniques = [];

    /**
     * @param bool $prefix
     * @return array
     */
    public function getRules($prefix = false)
    {
        if (empty($prefix)) {
            return $this->transformRules();
        }

        return array_combine(
            array_map(function ($k) use ($prefix) {
                return "{$prefix}{$k}";
            }, array_keys($this->rules)),
            $this->transformRules()
        );
    }

    /**
     * @param bool $updating
     * @return array
     */
    protected function transformRules()
    {
        if (empty($this->uniques) or empty($this->rules)) {
            return $this->rules;
        }

        $rules = $this->rules;
        foreach ($this->rules as $field => $rules2) {
            if (array_search($field, $this->uniques) !== false) {
                $rules[$field] .= "|unique:{$this->getTable()},{$field},{$this->getKey()}";
            }
        }

        return $rules;
    }
}
