<?php

namespace App\Tests\EndToEndTests;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Panther\PantherTestCase;

class RegistrationRecuiterTest extends PantherTestCase
{
    public function testRegistrationSuccess()
    {
        $client = static::createPantherClient();

        $crawler = $client->request(Request::METHOD_GET, '/registration');

        $form = $crawler->selectButton("S'inscrire")->form(
            [
                "registration[firstName]" => "mourad",
                "registration[lastName]" => "chabour",
                "registration[email]" => sprintf("email%s@email.com", random_int(1, 99999)),
                "registration[plainPassword][first]" => "admin1234",
                "registration[plainPassword][second]" => "admin1234",
                "registration[companyName]" => "Company Co",
            ]
        );

        $client->submit($form);

        $client->takeScreenshot('var\screen.png');

//        $client->getWebDriver()->findElement(WebDriverBy::className('btn'))->click();
        $client->waitFor('.FlashBag');
        $this->assertSelectorTextContains(
            '.FlashBag',
            "Bienvenue sur mon site ! Votre inscription a été effectuée avec succès !"
        );
    }
}
