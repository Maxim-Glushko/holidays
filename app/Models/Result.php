<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable = ['date', 'name'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return string[]
     */
    public static function validationRules()
    {
        return [
            'date' => 'required|date_format:Y-m-d',
            'name' => 'string|max:255'
        ];
    }

    /**
     * @param array $options
     * @return bool
     * @throws \Exception
     */
    public function save(array $options = [])
    {
        $validator = Validator::make($this->attributes, static::validationRules());

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return parent::save($options);
    }
}
