<?php

namespace MChabour\Domain\Tests\Security;

use App\Infrastructure\Test\Adapter\Repository\Doctrine\UserRepository;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use MChabour\Domain\Security\Model\User;
use MChabour\Domain\Security\Presenter\LoginPresenterInterface;
use MChabour\Domain\Security\Request\LoginRequest;
use MChabour\Domain\Security\Response\LoginResponse;
use MChabour\Domain\Security\UseCase\Login;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class LoginTest
 * @package MChabour\Domain\Tests\Security
 */
class LoginTest extends TestCase
{

    /**
     * @var Login
     */
    private Login $useCase;

    /**
     * @var LoginPresenterInterface
     */
    private LoginPresenterInterface $presenter;

    protected function setUp(): void
    {
        $participantGateway = new UserRepository();

        $this->presenter = new class () implements LoginPresenterInterface {
            public LoginResponse $response;

            public function present(LoginResponse $response): void
            {
                $this->response = $response;
            }
        };

        $this->useCase = new Login($participantGateway);
    }

    public function testSuccessful(): void
    {

        $request = LoginRequest::create("new_used@email.com", "password");

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(LoginResponse::class, $this->presenter->response);

        $this->assertInstanceOf(User::class, $this->presenter->response->getUser());

        $this->assertTrue($this->presenter->response->isPasswordValid());
    }

    public function testIfEmailNotFound()
    {
        $request = LoginRequest::create("email@email.com", "password");

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(LoginResponse::class, $this->presenter->response);

        $this->assertNull($this->presenter->response->getUser());
    }
}
