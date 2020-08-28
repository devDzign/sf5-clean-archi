<?php

namespace App\Tests\EndToEndTests;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Class ParticipantTest
 * @package App\Tests\EndToEndTests
 */
class VisitorTest extends PantherTestCase
{
    public function testVisite()
    {
        $client = static::createPantherClient();


        $client->request(Request::METHOD_GET, '/');

        $crawler = $client->clickLink("S'inscrire");

        $email = sprintf("email%s@email.com", random_int(1, 99999));


        $form = $crawler->filter("form")->form(
            [
                "registration[firstName]" => "mourad",
                "registration[lastName]" => "chabour",
                "registration[email]" => $email,
                "registration[plainPassword][first]" => "admin1234",
                "registration[plainPassword][second]" => "admin1234",
                "registration[companyName]" => "Company Co",
            ]
        );

        $client->submit($form);

//        $client->takeScreenshot('var\screen.png');
//        $client->getWebDriver()->findElement(WebDriverBy::className('btn'))->click();

        $client->waitFor('.FlashBag');
        $this->assertSelectorTextContains(
            '.FlashBag',
            "Bienvenue sur mon site ! Votre inscription a été effectuée avec succès !"
        );

        sleep(2);
        $crawler = $client->clickLink("Se connecter");
        $form = $crawler->filter("form")->form([
            "email" => $email,
            "password" => "admin1234"
        ]);
        sleep(2);
        $client->submit($form);
        sleep(2);
        $this->assertSelectorTextContains(
            '.FlashBag',
            'Bon retour sur Code Challenge !'
        );

        $client->clickLink("Déconnexion");
        sleep(2);
    }
}
