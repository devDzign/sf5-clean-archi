<?php

namespace App\Features;

use Behat\Behat\Context\Context;

class RegisterRecruiterContext implements Context
{
    /**
     * @Given /^I need to register to recruit new employees$/
     */
    public function iNeedToRegisterToRecruitNewEmployees()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^I can log in with my new account$/
     */
    public function iCanLogInWithMyNewAccount()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
