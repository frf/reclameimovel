<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\User;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * User repository
 */
class UserRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;


    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Saves the user to the database.
     *
     * @param \Condominio\Entity\User $user
     */
    public function save($user)
    {
       
    }

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
    
    public function isDados($id)
    {
        $userData = $this->db->fetchAssoc('SELECT * FROM usuario WHERE idu = ?', array($id));
        
        if($userData['cpf'] == ""){
            //throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($id)));
            return false;
        }        
        return true;        
    }
    
    public function saveAdicional($user)
    {
        $userData = array(
            'cpf'=>$user->getCpf(),
            'dadosImovel'=>$user->getDadosImovel(),
            'telCelular'=>$user->getTelCelular(),
            'telResidencial'=>$user->getTelResidencial(),
            'telContato'=>$user->getTelContato()
        );

        if ($user->getIdu()) {
            $this->db->update('usuario', $userData, array('idu' => $user->getIdu()));
        }else {
            $this->db->insert('usuario', $userData);             
            $id = $this->db->lastInsertId();
            $user->setIdu($id);
        }
    }

    public function findAll($limit, $offset = 0, $orderBy = array())
    {        
    }

    protected function buildUser($userData)
    {      
    }
    

}
