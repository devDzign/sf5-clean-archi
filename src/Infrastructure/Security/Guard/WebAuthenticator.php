<?php

namespace App\Infrastructure\Security\Guard;

use App\Infrastructure\Doctrine\Entity\User;
use Assert\AssertionFailedException;
use MChabour\Domain\Security\Presenter\LoginPresenterInterface;
use MChabour\Domain\Security\Request\LoginRequest;
use MChabour\Domain\Security\Response\LoginResponse;
use MChabour\Domain\Security\UseCase\Login;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class WebAuthenticator extends AbstractFormLoginAuthenticator implements LoginPresenterInterface
{

    public const LOGIN_ROUTE = 'app.login';

    /**
     * @var SessionInterface
     */
    private SessionInterface $session;

    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * @var Login
     */
    private Login $login;

    /**
     * @var LoginResponse
     */
    private LoginResponse $response;

    /**
     * WebAuthenticator constructor.
     *
     * @param Login                     $login
     * @param SessionInterface          $session
     * @param UrlGeneratorInterface     $urlGenerator
     */
    public function __construct(
        Login $login,
        SessionInterface $session,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->session          = $session;
        $this->urlGenerator     = $urlGenerator;
        $this->login            = $login;
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

    public function supports( Request $request )
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials( Request $request )
    {
        return new LoginRequest(
            $request->get("email", ""),
            $request->get("password", "")
        );
    }

    public function getUser( $credentials, UserProviderInterface $userProvider )
    {
        try {
            $this->login->execute($credentials);
        } catch (AssertionFailedException $e) {
            throw new AuthenticationException($e->getMessage());
        }

        if(($userModel = $this->response->getUser()) === null){
            throw new UsernameNotFoundException('User not Found !');
        }

        $user = new User();

        return $user
            ->setId($userModel->getId())
            ->setFirstName($userModel->getFirstName())
            ->setLastName($userModel->getLastName())
            ->setEmail($userModel->getEmail())
            ->setPassword($userModel->getPassword())
            ;

    }

    public function checkCredentials( $credentials, UserInterface $user )
    {
        if (!$this->response->isPasswordValid()) {
            throw new AuthenticationException('Wrong credentials !');
        }

        return true;
    }

    public function onAuthenticationSuccess( Request $request, TokenInterface $token, string $providerKey )
    {
        $this->session->getFlashBag()->add("success", 'Bon retour sur Code Challenge !');
        return new RedirectResponse("/");
    }

    public function present( LoginResponse $response ): void
    {
         $this->response =  $response;
    }
}
