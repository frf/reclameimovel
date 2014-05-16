<?php

namespace Condominio\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cpf', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),                   
                    'label' => 'CPF do proprietário.',
                ))
                ->add('dadosImovel',  'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Ex: Bloco 2 Ap 303, Casa 1 Bloco 10',
                    ),
                    'label' => 'Dados do Imovel',
                ))
                ->add('telCelular', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'label' => 'Número Telefone Celular'
                ))
                ->add('telResidencial', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'label' => 'Número Telefone Fixo',
                ))
                ->add('telContato', 'text', array(
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'label' => 'Número Telefone Contato'
                ))
                ->add('Salvar', 'submit', array('label' => "Salvar informação", 'attr' => array('class' => 'btn btn-primary separar','style'=>'margin-top:20px')));
    }

    public function getName() {
        return 'user';
    }

}
