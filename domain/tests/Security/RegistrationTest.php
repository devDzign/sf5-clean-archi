<?php

namespace MChabour\Domain\Tests\Security;

use Assert\AssertionFailedException;
use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter;
use MChabour\Domain\Security\Model\User;
use MChabour\Domain\Security\Presenter\RegistrationPresenterInterface;
use MChabour\Domain\Security\Request\RegistrationRequest;
use MChabour\Domain\Security\Response\RegistrationResponse;
use MChabour\Domain\Security\UseCase\Registration;
use PHPUnit\Framework\TestCase;

/**
 * Class RegistrationTest
 * @package MChabour\Domain\Tests\Security
 */
class RegistrationTest extends TestCase
{

    /**
     * @var Registration
     */
    private Registration $useCase;

    /**
     * @var RegistrationPresenterInterface
     */
    private RegistrationPresenterInterface $presenter;


    protected function setUp()
    {
        $this->presenter = new class () implements RegistrationPresenterInterface {
            public RegistrationResponse $response;

            public function present(RegistrationResponse $response): void
            {
                $this->response = $response;
            }
        };

        $recruiterGateway = new class () implements RecruiterGatewayInterface {

            public function isEmailUnique(string $email): bool
            {
                return !in_array($email, ['usedEmail@codechallenge.fr', 'used@email.fr']);
            }

            public function register(Recruiter $recruiter): void
            {
            }

            public function getUserByMail(string $email): ?User
            {
            }
        };

        $this->useCase = new Registration($recruiterGateway);
    }

    public function testSuccessFull(): void
    {
        $request = RegistrationRequest::create(
            'mourad',
            'chabour',
            'Factory Co',
            'mchabour@codechallenge.fr',
            'password'
        );

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(RegistrationResponse::class, $this->presenter->response);
        $this->assertEquals('mchabour@codechallenge.fr', $this->presenter->response->getEmail());
    }

    /**
     * @dataProvider provideRequestData
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $companyName
     * @param string $plaiPassword
     */
    public function testFailed(
        string $firstName,
        string $lastName,
        string $companyName,
        string $email,
        string $plaiPassword
    ): void {

        $request = RegistrationRequest::create(
            $firstName,
            $lastName,
            $companyName,
            $email,
            $plaiPassword
        );


        $this->expectException(AssertionFailedException::class);
        $this->useCase->execute($request, $this->presenter);
    }

    public function provideRequestData(): \Generator
    {
        yield ["", "chabour", "company Name", "mchabour@codechallenge.fr", "password"];
        yield ["mourad", "", "company Name", "mchabour@codechallenge.fr", "password"];

        //case of company name failed
        yield ["mourad", "chabour", "", "mchabour@codechallenge.fr", "password"];

        // case password failed
        yield ["mourad", "chabour","company name", "mchabour@codechallenge.fr", ""];
        yield ["mourad", "chabour","company name", "mchabour@codechallenge.fr", "faild"];

        // case of mail failed
        yield ["mourad", "chabour","company name", "", "password"];
        yield ["mourad", "chabour","company name", "mchabour", "password"];
        yield ["mourad", "chabour","company name", "fail", "password"];
        yield ["mourad", "chabour","company name", "usedEmail@codechallenge.fr", "password"];
    }
}
