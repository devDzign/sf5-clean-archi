<?php

namespace App\Tests\SystemTests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationTest extends WebTestCase
{
    public function testSuccessful()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/registration');

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form(
            [
                "registration[firstName]"             => "mourad",
                "registration[lastName]"              => "chabour",
                "registration[email]"                 => "mchabour@test.fr",
                "registration[companyName]"           => "Company co",
                "registration[plainPassword][first]"  => "test1234",
                "registration[plainPassword][second]" => "test1234",
            ]
        );

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }


    /**
     * @dataProvider provideFormData
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $companyName
     * @param array  $plainPassword
     * @param string $errorMessage
     */
    public function testFailed(
        string $firstName,
        string $lastName,
        string $companyName,
        string $email,
        array $plainPassword,
        string $errorMessage
    ) {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/registration');

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter("form")->form(
            [
                "registration[firstName]"             => $firstName,
                "registration[lastName]"              => $lastName,
                "registration[email]"                 => $email,
                "registration[companyName]"           => $companyName,
                "registration[plainPassword][first]"  => $plainPassword["first"],
                "registration[plainPassword][second]" => $plainPassword["second"],
            ]
        );

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains('html', $errorMessage);
    }

    /**
     * @return Generator
     */
    public function provideFormData(): Generator
    {
        yield [
            "",
            "chabour",
            "company co",
            "email@email.com",
            ["first" => "password", "second" => "password"],
            "This value should not be blank.",
        ];

        yield [
            "mourad",
            "",
            "company co",
            "email@email.com",
            ["first" => "password", "second" => "password"],
            "This value should not be blank.",
        ];

        yield [
            "mourad",
            "chabour",
            "",
            "email@email.com",
            ["first" => "password", "second" => "password"],
            "This value should not be blank.",
        ];

        yield [
            "mourad",
            "chabour",
            "company co",
            "",
            ["first" => "password", "second" => "password"],
            "This value should not be blank.",
        ];

        yield [
            "mourad",
            "chabour",
            "company co",
            "fail",
            ["first" => "password", "second" => "password"],
            "This value is not a valid email address.",
        ];


        yield [
            "mourad",
            "chabour",
            "company co",
            "email@email.com",
            ["first" => "", "second" => ""],
            "This value should not be blank.",
        ];

        yield [
            "mourad",
            "chabour",
            "company co",
            "email@email.com",
            ["first" => "fail", "second" => "fail"],
            "This value is too short. It should have 8 characters or more.",
        ];

        yield [
            "mourad",
            "chabour",
            "company co",
            "email@email.com",
            ["first" => "password", "second" => "fail_password"],
            "La confirmation doit être similaire au mot de passe",
        ];

        yield [
            "mourad",
            "chabour",
            "company co",
            "used_recruiter@mail.com",
            ["first" => "password", "second" => "password"],
            "This email address already exists.",
        ];
    }
}
