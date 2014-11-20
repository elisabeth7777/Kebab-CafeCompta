<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\CaisseBundle\Entity\Vente;
use Kebab\CaisseBundle\Form\VenteType;

/**
 * Vente controller.
 *
 */
class VenteController extends Controller
{

    /**
     * Lists all Vente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabCaisseBundle:Vente')->findBy(array(),array('date' => 'desc'));
        $articles = $em->getRepository('KebabCaisseBundle:Article')->findAll();
        return $this->render('KebabCaisseBundle:Vente:index.html.twig', array(
            'entities' => $entities,
            'articles' => $articles,
        ));
    }
    
    
    public function choixAction()
    {
        $entity = new Vente();
        $form1   = $this->createMonthYearForm();
//        $form2 = $this->createTrimestreYearForm();

        return $this->render('KebabCaisseBundle:Vente:choix.html.twig', array(
            'entity' => $entity,
            'form_M'   => $form1->createView(),
//            'form_T'   => $form2->createView(),
        ));
    }    
    
    public function venteMAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $form = $this->createMonthYearForm();
            $form->handleRequest($request);

             // $data is a simply array with your form fields 
             // like "query" and "category" as defined above.
            $date = $form->get('date')->getData();
            
            $year = $date->format('Y');
            $month = $date->format('m');
            
            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('KebabCaisseBundle:Vente')->findVenteByMonthYear($year, $month);
            $articles = $em->getRepository('KebabCaisseBundle:Article')->findAll();
//            $patronal = $em->getRepository('KebabComptaBundle:Taux')->findPatByYear($year);
//            $salariale = $em->getRepository('KebabComptaBundle:Taux')->findSalByYear($year);
            
            return $this->render('KebabCaisseBundle:Vente:vente_mensuelle.html.twig', array(
                'entities' => $entities,
                'date' => $date,
                'articles' => $articles,
//                'pat' => $patronal,
//                'sal' => $salariale,
            ));   
            
         }else{
             return $this->redirect($this->generateUrl('vente'));
         }

    }  
    
    private function createMonthYearForm()
    {
        $data = array();
        return $this->createFormBuilder($data)
            ->setMethod('POST')
            ->add('date', 'date', array(
                    'label' => 'Année',
                    'widget' => 'choice',
                    'years' => range(date('Y'), date('Y') - 10),))
            ->add('submit', 'submit', array('label' => 'Soumettre'))
            ->getForm()
        ;
    }
    
    /**
     * Creates a new Vente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Vente();
        $form = $this->createCreateForm($entity);
        
        
        
        $request = $this->getRequest();
        
            if ($request->getMethod() == 'POST') {   
                
                $form->bind($request);

                if ($form->isValid()) {
                    
                    $articleVenteClone = clone $entity->getArticleventes();
                    $entity->getArticleventes()->clear();
                    
                    $entity->setEspeces(0);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();
                    $solde = 0;
                    foreach ($articleVenteClone as $value) {

                        $em->persist($value->getArticle());
                        $em->flush();
                        
                        $value->setVente($entity);
                        $em->persist($value);
                        $em->flush();
                        $solde += $value->getMontant();
                    }
                    $especes = $solde - ($entity->getCB() + $entity->getCH());
                    $entity->setEspeces($especes);
                    $em->flush();
                    return $this->redirect($this->generateUrl('vente_show', array('id' => $entity->getId())));
                }
            }

        return $this->render('KebabCaisseBundle:Vente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Vente entity.
     *
     * @param Vente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vente $entity)
    {
        $form = $this->createForm(new VenteType(), $entity, array(
            'action' => $this->generateUrl('vente_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vente entity.
     *
     */
    public function newAction()
    {
        $entity = new Vente();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabCaisseBundle:Vente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Vente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Vente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Vente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Vente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Vente entity.
    *
    * @param Vente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vente $entity)
    {
        $form = $this->createForm(new VenteType(), $entity, array(
            'action' => $this->generateUrl('vente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
//        $entity = new Vente();
        $entity = $em->getRepository('KebabCaisseBundle:Vente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vente entity.');
        }
        $solde = 0;
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            foreach($entity->getArticleVentes() as $value){
                $value->setVente($entity);
                $solde += $value->getMontant();
            }
            
            $especes = $solde - ($entity->getCB() + $entity->getCH());
            $entity->setEspeces($especes);
            $em->flush();

            return $this->redirect($this->generateUrl('vente_show', array('id' => $id)));
        }

        return $this->render('KebabCaisseBundle:Vente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Vente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabCaisseBundle:Vente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vente'));
    }

    /**
     * Creates a form to delete a Vente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
