<?php
declare(strict_types=1);

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'first_name' => 'required|min:1|max:255',
            'last_name'  => 'required|min:1|max:255',
            'email'      => 'required|email|unique:users|min:1|max:255',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
