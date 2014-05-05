<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * User repository
 */
class UserRepository implements RepositoryInterface, UserProviderInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder
     */
    protected $encoder;

    public function __construct(Connection $db, $encoder)
    {
        $this->db = $db;
        $this->encoder = $encoder;
    }

    /**
     * Saves the user to the database.
     *
     * @param \Condominio\Entity\User $user
     */
    public function save($user)
    {
        
        var_dump($user);exit;
        $userData = array(
            'username' => $user->getUsername(),
            'mail' => $user->getMail(),
            'role' => $user->getRole(),
        );
        // If the password was changed, re-encrypt it.
        if (strlen($user->getPassword()) != 88) {
            $userData['salt'] = uniqid(mt_rand());
            $userData['password'] = $this->encoder->encodePassword($user->getPassword(), $userData['salt']);
        }

        if ($user->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($user);
            if ($newFile) {
                $userData['image'] = $user->getImage();
            }

            $this->db->update('usuario', $userData, array('id' => $user->getId()));
        } else {
            // The user is new, note the creation timestamp.
            $userData['created_at'] = time();

            $this->db->insert('usuario', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->db->lastInsertId();
            $user->setId($id);

            // If a new image was uploaded, update the user with the new
            // filename.
            $newFile = $this->handleFileUpload($user);
            if ($newFile) {
                $newData = array('image' => $user->getImage());
                $this->db->update('usuario', $newData, array('id' => $id));
            }
        }
    }


    /**
     * Deletes the user.
     *
     * @param integer $id
     */
    public function delete($id)
    {
        return $this->db->delete('usuario', array('id' => $id));
    }

    /**
     * Returns the total number of usuario.
     *
     * @return integer The total number of usuario.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM usuario');
    }

    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\User|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE id = ?', array($id));
        return $userData ? $this->buildUser($userData) : FALSE;
    }

    /**
     * Returns a collection of usuario.
     *
     * @param integer $limit
     *   The number of usuario to return.
     * @param integer $offset
     *   The number of usuario to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of usuario, keyed by user id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('id' => 'ASC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('usuario', 'u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('u.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $usuarioData = $statement->fetchAll();

        $usuario = array();
        foreach ($usuarioData as $userData) {
            $userId = $userData['id'];
            $usuario[$userId] = $this->buildUser($userData);
        }

        return $usuario;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($idface)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('usuario', 'u')
            ->where('u.idface = :idface')
            ->setParameter('idface', $idface)
            ->setMaxResults(1);
        $statement = $queryBuilder->execute();
        $usuarioData = $statement->fetch();
       
        if (empty($usuarioData)) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }
        
        $user = $this->buildUser($usuarioData);
              
        return $user;
    }

    /**
     * Instantiates a user entity and sets its properties using db data.
     *
     * @param array $userData
     *   The array of db data.
     *
     * @return \Condominio\Entity\User
     */
    protected function buildUser($userData)
    {
        $user = new User();
        $user->setId($userData['id']);
        $user->setName($userData['name']);
        $user->setEmail($userData['email']);
        $user->setIdface($userData['idface']);
        $user->setLink($userData['link']);
        $user->setGender($userData['gender']);
        $user->setRole($userData['role']);
        $user->setSalt(md5('fuck'));
        $user->setPassword(md5('fuck'));
        $user->setUsername($userData['name']);
        return $user;
    }
    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        $id = $user->getId();
        $refreshedUser = $this->find($id);
        if (false === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id)));
        }

        return $refreshedUser;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Condominio\Entity\User' === $class;
    }

}
