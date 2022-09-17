<?php

namespace App\Action;

use App\Responder\ViewResponder;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route("/login", name: "app_login")]
class LoginAction
{
    public function __invoke(
        AuthenticationUtils $authenticationUtils,
        ViewResponder $responder,
        AdminUrlGenerator $adminUrlGenerator,
        UrlGeneratorInterface $urlGenerator
    ): Response {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $urlResetPassword = $urlGenerator->generate('app_forgot_password_request');

        return $responder('@EasyAdmin/page/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            'translation_domain' => 'admin',
            'page_title' => 'Admin',
            'csrf_token_intention' => 'authenticate',
            'target_path' => $urlGenerator->generate('admin'),
            'username_label' => 'Adresse email',
            'password_label' => 'Mot de passe',
            'sign_in_label' => 'Connexion',
            'forgot_password_label' => 'Mot de passe oublié ?',
            'forgot_password_path' => $urlResetPassword,
            'forgot_password_enabled' => true,
            'username_parameter' => 'email',
            'password_parameter' => 'password',
        ]);
    }
}