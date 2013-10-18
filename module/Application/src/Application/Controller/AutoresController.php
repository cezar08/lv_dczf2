<?php

namespace Application\Controller;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Controller que gerencia os autores
 * @package Admin
 * @group Controller
 * @author Eu <eu@eu.com>
 * 
 */
class AutoresController extends AbstractActionController {

    public function indexAction() {

        $form = new \Application\Form\Busca();

        $repository = $this->getEm()->getRepository('Application\Model\Autor');

        $adapter = new DoctrineAdapter(new ORMPaginator($repository->createQueryBuilder('Autor')));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int) $this->params()->fromQuery('page');
        if ($page)
            $paginator->setCurrentPageNumber($page);

        return new ViewModel(array(
            'autores' => $paginator,
            'form' => $form
        ));
    }

    public function saveAction() {
        $request = $this->getRequest();
        $form = new \Application\Form\Autor();

        if ($request->isPost()) {
            $values = $request->getPost();

            $Autor = new \Application\Model\Autor();
            $form->setInputFilter($Autor->getInputFilter());
            $form->setData($values);
            if ($form->isValid()) {
                $values = $form->getData();
                
                if ((int) $values['id'] > 0) {
                    $Autor = $this->getEm()->find('\Application\Model\Autor', $values['id']);
                    
                }
                $Autor->setNome($values['nome']);
                $Autor->setSobrenome($values['sobrenome']);
                $this->getEm()->persist($Autor);

                try {

                    $this->getEm()->flush();
                    $this->flashMessenger()->addSuccessMessage('Autor armazenado com sucesso');
                    return $this->redirect()->toUrl('/application/autores');
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Um erro ocorreu, tente novamente mais tarde');
                }
            }
        }

        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id > 0) {

            $dados = $this->getEm()->find('\Application\Model\Autor', $id);
            $form->bind($dados);
            
        }

        return new ViewModel(array(
            'form' => $form)
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $Autor = $this->getEm()->find('\Application\Model\Autor', $id);
            $this->getEm()->remove($Autor);
            try{
                $this->getEm()->flush();
                $this->flashMessenger()->addSuccessMessage('Ok');
            }catch(\Exception $e){
                $this->flashMessenger()->addErrorMessage('Error');
            }
            return $this->redirect()->toUrl('/application/autores');
        }
        throw new \Exception('Passe o Id');
    }

    private function getEm() {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

}
