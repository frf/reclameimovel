<?php

namespace Condominio\Repository;

use Doctrine\DBAL\Connection;
use Condominio\Entity\Imagem;

/**
 * Imagem repository
 */
class ImagemRepository implements RepositoryInterface
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
     * Saves the imagem to the database.
     *
     * @param \Condominio\Entity\Imagem $imagem
     */
    public function save($imagem)
    {
        $imagemData = array(
            'name' => $imagem->getName(),
            'short_biography' => $imagem->getShortBiography(),
            'biography' => $imagem->getBiography(),
            'soundcloud_url' => $imagem->getSoundCloudUrl(),
            'image' => $imagem->getImage(),
        );

        if ($imagem->getId()) {
            // If a new image was uploaded, make sure the filename gets set.
            $newFile = $this->handleFileUpload($imagem);
            if ($newFile) {
                $imagemData['image'] = $imagem->getImage();
            }

            $this->db->update('imagem', $imagemData, array('id' => $imagem->getId()));
        }
        else {
            // The imagem is new, note the creation timestamp.
            $imagemData['created_at'] = time();

            $this->db->insert('imagem', $imagemData);
            // Get the id of the newly created imagem and set it on the entity.
            $id = $this->db->lastInsertId();
            $imagem->setId($id);

            // If a new image was uploaded, update the imagem with the new
            // filename.
            $newFile = $this->handleFileUpload($imagem);
            if ($newFile) {
                $newData = array('image' => $imagem->getImage());
                $this->db->update('imagem', $newData, array('id' => $id));
            }
        }
    }

    /**
     * Deletes the imagem.
     *
     * @param \Condominio\Entity\Imagem $imagem
     */
    public function delete($imagem)
    {
        // If the imagem had an image, delete it.
        $image = $imagem->getImage();
        if ($image) {
            unlink('images/imagem/' . $image);
        }
        return $this->db->delete('imagem', array('id' => $imagem->getId()));
    }

    /**
     * Returns the total number of imagem.
     *
     * @return integer The total number of imagem.
     */
    public function getCount() {
        return $this->db->fetchColumn('SELECT COUNT(id) FROM imagem');
    }

    /**
     * Returns an imagem matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Condominio\Entity\Imagem|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $imagemData = $this->db->fetchAssoc('SELECT * FROM imagem WHERE id = ?', array($id));
        return $imagemData ? $this->buildImagem($imagemData) : FALSE;
    }
    /**
     * Returns a collection of imagem, sorted by name.
     *
     * @param integer $limit
     *   The number of imagem to return.
     * @param integer $offset
     *   The number of imagem to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of imagem, keyed by imagem id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('id' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('imagem', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $imagemData = $statement->fetchAll();

        $imagem = array();
        foreach ($imagemData as $imagemData) {
            $imagemId = $imagemData['id'];
            $imagem[$imagemId] = $this->buildImagem($imagemData);
        }
        return $imagem;
    }
    public function findAllByReclamacao($idReclamacao = null,$orderBy = array())
    {
        if(!$idReclamacao){
            return false;
        }
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('id' => 'DESC');
        }

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('imagem', 'a');
        $queryBuilder->where("idr = $idReclamacao");
        $queryBuilder->orderBy('a.' . key($orderBy), current($orderBy));
        
        $statement = $queryBuilder->execute();
        $imagemData = $statement->fetchAll();

        $imagem = array();
        foreach ($imagemData as $imagemData) {
            $imagemId = $imagemData['id'];
            $imagem[$imagemId] = $this->buildImagem($imagemData);
        }
        return $imagem;
    }

    /**
     * Instantiates an imagem entity and sets its properties using db data.
     *
     * @param array $imagemData
     *   The array of db data.
     *
     * @return \Condominio\Entity\Imagem
     */
    protected function buildImagem($imagemData)
    {
        $imagem = new Imagem();
        $imagem->setId($imagemData['id']);
        $imagem->setIdr($imagemData['idr']);
        $imagem->setFile($imagemData['file']);
        return $imagem;
    }
    
}
