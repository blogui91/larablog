<?php namespace App\Traits;

use Modules\Helpers\Validator;

trait ValidatorTrait
{
    /**
     * The Validator instance.
     *
     * @var Modules\Helpers\Validator
     */
    protected $validator;

    /**
     * Returns the Validator instance.
     *
     * @return Modules\Helpers\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Sets the Validator instance.
     *
     * @param  Modules\Helpers\Validator  $validator
     * @return $this
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
