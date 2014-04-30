<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Reclamacao;

/**
 * Reclamacao repository
 */
class ReclamacaoRepository implements RepositoryInterface
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
     * Saves the reclamacao to the database.
     *
     * @param \Condominio\Entity\Reclamacao $reclamacao
     */
    public function save($reclamacao)
    {
        $reclamacaoData = array(
            'name' => $reclamacao->getName(),
            'short_biography' => $reclamacao->getShortBiography(),
            'biography' => $reclamacao->getBiography(),
            'soundcloud_url' => $reclamacao->getSoundCloudUrl(),
            'image' => $reclamacao->getImage(),
        );

        if ($reclamacao->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($reclamacao);
            if ($newFile) {
                $reclamacaoData['image'] = $reclamacao->getImage();
            }

            $this->db->update('reclamacao', $reclamacaoData, array('id' => $reclamacao->getId()));
        }
        else {
            // The reclamacao is new, note the creation timestamp.
            $reclamacaoData['created_at'] = time();

            $this->db->insert('reclamacao', $reclamacaoData);
            // Get the id of the newly created reclamacao and set it on the entity.
            $id = $this->db->lastInsertId();
            $reclamacao->setId($id);

            // If a new image was uploaded, update the reclamacao with the new
            // filename.
            $newFile = $this->handleFileUpload($reclamacao);
            if ($newFile) {
                $newData = array('image' => $reclamacao->getImage());
                $this->db->update('reclamacao', $newData, array('id' => $id));
            }
        }
    }

    /**
     * Deletes the reclamacao.
     *
     * @param \Condominio\Entity\Reclamacao $reclamacao
     */
    public function delete($reclamacao)
    {
        // If the reclamacao had an image, delete it.
        $image = $reclamacao->getImage();
        if ($image) {
            unlink('images/reclamacao/' . $image);
        }
        return $this->db->delete('reclamacao', array('id' => $reclamacao->getId()));
    }

    /**
     * Returns the total number of reclamacao.
     *
     * @return integer The total number of reclamacao.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM reclamacao');
    }

    /**
     * Returns an reclamacao matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Reclamacao|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $reclamacaoData = $this->db->fetchAssoc('SELECT * FROM reclamacao WHERE id = ?', array($id));
        return $reclamacaoData ? $this->buildReclamacao($reclamacaoData) : FALSE;
    }

    /**
     * Returns a collection of reclamacao, sorted by name.
     *
     * @param integer $limit
     *   The number of reclamacao to return.
     * @param integer $offset
     *   The number of reclamacao to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of reclamacao, keyed by reclamacao id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('dt_cadastro' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('reclamacao', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $reclamacaoData = $statement->fetchAll();

        $reclamacao = array();
        foreach ($reclamacaoData as $reclamacaoData) {
            $reclamacaoId = $reclamacaoData['id'];
            $reclamacao[$reclamacaoId] = $this->buildReclamacao($reclamacaoData);
        }
        return $reclamacao;
    }

    /**
     * Instantiates an reclamacao entity and sets its properties using db data.
     *
     * @param array $reclamacaoData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Reclamacao
     */
    protected function buildReclamacao($reclamacaoData)
    {
        $reclamacao = new Reclamacao();
        $reclamacao->setId($reclamacaoData['id']);
        $reclamacao->setIdu($reclamacaoData['idu']);
        $reclamacao->setIde($reclamacaoData['ide']);
        $reclamacao->setTitulo($reclamacaoData['titulo']);
        $reclamacao->setDescricao($reclamacaoData['descricao']);
        $createdAt = new \DateTime($reclamacaoData['dt_cadastro']);
        $reclamacao->setDt_cadastro($createdAt);
        return $reclamacao;
    }
}
