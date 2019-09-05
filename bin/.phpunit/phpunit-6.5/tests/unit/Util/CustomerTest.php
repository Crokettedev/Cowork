<?php


namespace PHPUnit\Util;


use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testRegister()
    {
        $register = new Customer();
        $firstname = "Jesus";

        $register->setFirstname($firstname);
        $this->assertEquals("Salut", $register->getFirstname());
    }
}