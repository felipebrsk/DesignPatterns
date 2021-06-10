<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserFillableTest extends TestCase
{
    /**
     * check if user fillable are correctly.
     * @test
     */
    public function check_if_user_columns_are_correctly()
    {
        $user = new User();

        $expected = [
            'name',
            'email',
            'CPF',
            'birthday',
            'password',
        ];

        $arrayCompare = array_diff($expected, $user->getFillable());

        $this->assertEquals(0, count($arrayCompare));
    }
}
