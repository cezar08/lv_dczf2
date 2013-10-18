<?php

namespace Application\Form;

use Zend\Form\Form;

class Livro extends Form {

    public function __construct($em) {

        parent::__construct('livro');

        $this->setAttribute('method', 'POST');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'titulo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titulo*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));
        $this->add(array(
            'name' => 'valor_livro',
            'type' => 'Text',
            'options' => array(
                'label' => 'Valor*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'quantidade',
            'type' => 'Text',
            'options' => array(
                'label' => 'Quantidade*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'sinopse',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Sinopse*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'edicao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Edição*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'isbn',
            'type' => 'Text',
            'options' => array(
                'label' => 'ISBN*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'paginas',
            'type' => 'Text',
            'options' => array(
                'label' => 'Paginas*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));

        $this->add(array(
            'name' => 'ano',
            'type' => 'Text',
            'options' => array(
                'label' => 'Ano*',
                'label_attributes' => array('class' => 'label_form')
            ),
        ));


        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'categoria',
            'options' => array(
                'label' => 'Categoria*',
                'object_manager' => $em,
                'target_class' => 'Application\Model\Categoria',
                'property' => 'descricao',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('descricao' => 'ASC'),
                    ),
                ),
            ),
        ));


        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'idioma',
            'options' => array(
                'label' => 'Idioma*',
                'object_manager' => $em,
                'target_class' => 'Application\Model\Idioma',
                'property' => 'descricao',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('descricao' => 'ASC'),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'editora',
            'options' => array(                
                'label' => 'Editora*',
                'object_manager' => $em,
                'target_class' => 'Application\Model\Editora',
                'property' => 'nome',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('nome' => 'ASC'),
                    ),
                ),
            ),            
        ));

         $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'autor',
            'options' => array(                
                'label' => 'Autor*',
                'object_manager' => $em,
                'target_class' => 'Application\Model\Autor',
                'property' => 'nome',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('nome' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'multiple' => 'multiple',                
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitbutton',
            ),
        ));
    }

}
