<?php

namespace App\Tests\IntegrationTests;

use App\Infrastructure\Test\IntegrationTestCase;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginTest
 * @package App\Tests\IntegrationTests
 */
class LoginTest extends IntegrationTestCase
{
    public function testSuccessful()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/login');

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form([
            "email" => "used@email.com",
            "password" => "password"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider provideFormData
     * @param string $email
     * @param string $password
     * @param string $errorMessage
     */
    public function testFailed(string $email, string $password, string $errorMessage)
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/login');

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form([
            "email" => $email,
            "password" => $password
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return Generator
     */
    public function provideFormData(): Generator
    {
        yield [
            "new_used@email.com",
            "fail",
            "Wrong credentials !"
        ];

        yield [
            "used@email.com",
            "password",
            "User not Found !"
        ];

        yield [
            "",
            "password",
            "Email should not be blank."
        ];

        yield [
            "fail@email.com",
            "",
            "Password should not be blank."
        ];
    }
}
