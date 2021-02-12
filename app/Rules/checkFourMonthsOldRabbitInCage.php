<?php

namespace App\Rules;

use App\Models\Rabbit;
use Illuminate\Contracts\Validation\Rule;

class checkFourMonthsOldRabbitInCage implements Rule
{
    /**
     * The cage instance.
     *
     * @var mixed
     */
    public $cage;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($cage)
    {
        $this->cage = $cage;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rabbit = Rabbit::findOrFail($value);

        $ageExists = ($this->cage->rabbits->pluck('age_number'))->contains(function ($k, $v) {
            return 120 >= $v;
        });

        $maleRabbitsAlreadyExists = ($this->cage->rabbits->pluck('gender'))->contains(function ($k, $v) {
            return 'male' == $v;
        });

        // dd($ageExists);
        // dd($maleRabbitsAlreadyExists);

        return ! ($rabbit->isMale() && $rabbit->age_number >= 120) && $ageExists && $maleRabbitsAlreadyExists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Male :attribute that is 4months old can not be placed with any other rabbit.';
    }
}
