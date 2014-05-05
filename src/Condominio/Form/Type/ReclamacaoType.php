<?php

namespace Condominio\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class ReclamacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden')
            ->add('ide', 'hidden')
            ->add('idu', 'hidden')
            ->add('descricao', 'textarea', array(
                'attr' => array(
                    'rows' => '10',
                    'class'=>'form-control',
                    'placeholder'=>'Preencher todo o seu problema,coloque todas as informações.',
                ),
                'label'=>'Descrição'
                
            ))->add('Salvar', 'submit', array(
                'attr' => array(
                    'class'=>'btn btn-primary'
                )));
    }

    public function getName()
    {
        return 'reclamacao';
    }
}
