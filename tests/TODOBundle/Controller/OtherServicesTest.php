<?php

namespace tests\TODOBundle\Controller;


use TODOBundle\Services\OtherServices;
use TODOBundle\Entity\User;


class OtherServicesTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatorObjectSuccess()
    {
        $mockers = $this->getMockers();

        $testObject = new User('name');

        $mockers['validator']->expects($this->once())
            ->method('validate')
            ->with($testObject);

        $otherServices = new OtherServices($mockers['validator']);

        $this->assertEquals(false, $otherServices->validator($testObject));
    }

    public function testValidatorInvalidObject()
    {
        $mockers = $this->getMockers();

        $testObject = new User('name');

        $mockers['validator']->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $otherServices = new OtherServices($mockers['validator']);

        $this->assertEquals(true, $otherServices->validator($testObject));
    }

    //service method. returned mokers
    public function getMockers()
    {
        $validator = $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')
            ->disableOriginalConstructor()->getMock();

        return $mockers = [
            'validator' => $validator
        ];
    }
}
