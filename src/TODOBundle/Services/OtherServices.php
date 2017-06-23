<?php

namespace TODOBundle\Services;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class OtherServices
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validator($object_validate)
    {

        $errors = $this->validator->validate($object_validate);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $errorsString;

        }else{

            return false;
        }
    }
}