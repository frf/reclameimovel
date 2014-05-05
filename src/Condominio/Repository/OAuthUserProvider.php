<?php

namespace Condominio\Repository;

use Gigablah\Silex\OAuth\Security\User\StubUser;
use Gigablah\Silex\OAuth\Security\Authentication\Token\OAuthTokenInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\DBAL\Connection;
use Condominio\Entity\User;
use Condominio\Repository\OAuthUserProviderInterface;

/**
 * OAuth in-memory stub user provider.
 *
 * @author Chris Heng <bigblah@gmail.com>
 */
class OAuthUserProvider implements UserProviderInterface, OAuthUserProviderInterface
{
    private $users;
    private $credentials;
 
    /**
     * Constructor.
     *
     * @param array $users       An array of users
     * @param array $credentials A map of usernames with
     */
    public function __construct(array $users = array(), array $credentials = array())
    {
        
        foreach ($users as $username => $attributes) {
            $password = isset($attributes['password']) ? $attributes['password'] : null;
            $email = isset($attributes['email']) ? $attributes['email'] : null;
            $enabled = isset($attributes['enabled']) ? $attributes['enabled'] : true;
            $roles = isset($attributes['roles']) ? (array) $attributes['roles'] : array();
      
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setRole($roles);
            $user->setEnabled($enabled);
            $user->setAccountNonExpired(true);
            $user->getCredentialsNonExpired(true);
            $user->setAccountNonLocked(true);
            
           //$user = new StubUser($username, $password, $email, $roles, $enabled, true, true, true);
            $this->createUser($user);            
        }
        
        $this->credentials = $credentials;
    }

    public function createUser(UserInterface $user)
    {
        if (isset($this->users[strtolower($user->getUsername())])) {
            throw new \LogicException('Another user with the same username already exist.');
        }

        $this->users[strtolower($user->getUsername())] = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        if (isset($this->users[strtolower($username)])) {
            $user = $this->users[strtolower($username)];
        } else {
            $user = new User();
            $user->setUsername($username);
            $user->setPassword('');
            $user->setEmail($username . 'fabiofarias.com.br');
            $user->setRole(array('ROLE_USER'));
            $user->setEnabled(true);
            $user->setAccountNonExpired(true);
            $user->getCredentialsNonExpired(true);
            $user->setAccountNonLocked(true);
            
            $this->createUser($user);
        }
        
        $user = new User();
        $user->setUsername($user->getUsername());
        $user->setPassword($user->getPassword());
        $user->setEmail($user->getEmail());
        $user->setRole($user->getRoles());
        $user->setEnabled($user->getEnabled());
        $user->setAccountNonExpired($user->getAccountNonExpired());
        $user->getCredentialsNonExpired($user->getCredentialsNonExpired());
        $user->setAccountNonLocked($user->getAccountNonLocked());

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthCredentials(OAuthTokenInterface $token)
    {
        foreach ($this->credentials as $username => $credentials) {
            foreach ($credentials as $credential) {
                if ($credential['service'] == $token->getService() && $credential['uid'] == $token->getUid()) {
                    return $this->loadUserByUsername($username);
                }
            }
        }

        $user = new User();
        $user->setUsername($token->getUsername());
        $user->setPassword('');
        $user->setEmail($token->getEmail());
        $user->setRole(array('ROLE_USER'));
        $user->setEnabled(true);
        $user->setAccountNonExpired(true);
        $user->getCredentialsNonExpired(true);
        $user->setAccountNonLocked(true);
        
        $this->createUser($user);

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Condominio\Entity\User' === $class;
    }
    
}
