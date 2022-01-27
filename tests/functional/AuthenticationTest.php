<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationTest extends WebTestCase
{
    public function testWhenMailAndPasswordAreCorrect(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('btn-login', [
            'email' => 'user@mail.com',
            'password' => 'password'
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertRouteSame('app_index');
    }

    public function testWhenMailIsCorrectAndPasswordWrong(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('btn-login', [
            'email' => 'user@mail.com',
            'password' => 'wrong'
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertRouteSame('app_login');
        $this->assertSelectorTextContains('html', 'Identifiants invalides');
    }

    public function testWhenMailIsWrongAndPasswordIsCorrect(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('btn-login', [
            'email' => 'wrong@mail.com',
            'password' => 'password'
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertRouteSame('app_login');
        $this->assertSelectorTextContains('html', 'Identifiants invalides');
    }

    public function testWhenEmailAndPasswordAreWrong(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('btn-login', [
            'email' => 'wrong@mail.com',
            'password' => 'wrong'
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertSelectorTextContains('html', 'Identifiants invalides');
    }
}
