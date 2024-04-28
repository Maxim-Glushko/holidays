<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holidays';

    protected $fillable = ['name', 'month', 'day', 'week', 'day_of_week'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param $id
     * @return array
     */
    public static function validationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'month' => 'required|integer|between:1,12',
            'day' => 'nullable|integer|between:1,31',
            'week' => 'nullable|integer|between:1,5',
            'day_of_week' => 'nullable|integer|between:1,7',
            Rule::unique('holidays')->ignore($id),
        ];
    }

    /**
     * @param array $attributes
     * @param array $rules
     * @return void
     * @throws ValidationException
     */
    public function validate(array $attributes, array $rules)
    {
        $validator = Validator::make($attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * @param array $options
     * @return bool
     * @throws ValidationException
     */
    public function save(array $options = [])
    {
        $this->validate($this->attributes, static::validationRules($this->id));
        return parent::save($options);
    }
}
