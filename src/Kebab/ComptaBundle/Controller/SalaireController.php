<?php

namespace Kebab\ComptaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\ComptaBundle\Entity\Salaire;
use Kebab\ComptaBundle\Entity\Taux;
use Kebab\ComptaBundle\Form\SalaireType;

/**
 * Salaire controller.
 *
 */
class SalaireController extends Controller
{

    /**
     * Lists all Salaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salaire')->findBy(array(),array('date' => 'desc'));

        return $this->render('KebabComptaBundle:Salaire:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    public function choixAction()
    {
        $entity = new Salaire();
        $form1   = $this->createMonthYearForm();
        $form2 = $this->createTrimestreYearForm();

        return $this->render('KebabComptaBundle:Salaire:choix.html.twig', array(
            'entity' => $entity,
            'form_M'   => $form1->createView(),
            'form_T'   => $form2->createView(),
        ));
    }    
    
    public function chargesMAction(Request $request)
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
            $entities = $em->getRepository('KebabComptaBundle:Salaire')->findSalairesByMonthYear($year, $month);
            $patronal = $em->getRepository('KebabComptaBundle:Taux')->findPatByYear($year);
            $salariale = $em->getRepository('KebabComptaBundle:Taux')->findSalByYear($year);
            
            return $this->render('KebabComptaBundle:Salaire:charges_mensuelles.html.twig', array(
                'entities' => $entities,
                'date' => $date,
                'pat' => $patronal,
                'sal' => $salariale,
            ));   
            
         }else{
             return $this->redirect($this->generateUrl('salaire'));
         }

    } 
    
    public function chargesTAction($trimestre)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salaire')->findAll();

        return $this->render('KebabComptaBundle:Salaire:charges_trimestrielles.html.twig', array(
            'entities' => $entities,
        ));
    } 
    
    public function chargesAAction($years)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salaire')->findAll();

        return $this->render('KebabComptaBundle:Salaire:charges_annuelles.html.twig', array(
            'entities' => $entities,
        ));
    } 
    
    public function salairesMTotalAction($years)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salaire')->findAll();

        return $this->render('KebabComptaBundle:Salaire:salaires_totales.html.twig', array(
            'entities' => $entities,
        ));
    }
  
    
    public function salairesMSalarieAction($years, $idSalarie)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salaire')->findAll();

        return $this->render('KebabComptaBundle:Salaire:salaire_salarie.html.twig', array(
            'entities' => $entities,
        ));
    }    
    /**
     * Creates a new Salaire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Salaire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setSalaireBrut();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('salaire_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabComptaBundle:Salaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Salaire entity.
     *
     * @param Salaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Salaire $entity)
    {
        $form = $this->createForm(new SalaireType(), $entity, array(
            'action' => $this->generateUrl('salaire_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Salaire entity.
     *
     */
    public function newAction()
    {
        $entity = new Salaire();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabComptaBundle:Salaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Salaire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Salaire:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Salaire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salaire entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Salaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Salaire entity.
    *
    * @param Salaire $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Salaire $entity)
    {
        $form = $this->createForm(new SalaireType(), $entity, array(
            'action' => $this->generateUrl('salaire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Salaire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setSalaireBrut();
            $em->flush();

            return $this->redirect($this->generateUrl('salaire_edit', array('id' => $id)));
        }

        return $this->render('KebabComptaBundle:Salaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Salaire entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabComptaBundle:Salaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Salaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('salaire'));
    }

    /**
     * Creates a form to delete a Salaire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salaire_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
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
    private function createTrimestreYearForm()
    {
        return $this->createFormBuilder()
            ->setMethod('POST')
                
            ->add('trimestre', 'choice', array(
                    'choices'   => array('1' => '1. Janvier-Février-Mars', '2' => '2.Avril-Mai-Juin', '3' => '3.Juillet-Août-Septembre', '4' => '4.Octobre-Novembre-Décembre'),
                    'required'  => true,
                ))
            ->add('date', 'date', array(
                    'label' => 'Année',
                    'widget' => 'choice',
                    'years' => range(date('Y'), date('Y') - 10),))
            ->add('submit', 'submit', array('label' => 'Soumettre'))
            ->getForm()
        ;
    }  
    
    private function createYearForm()
    {
        return $this->createFormBuilder()
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Soumettre'))
            ->getForm()
        ;
    }
    
    private function createYearSalarieForm()
    {
        return $this->createFormBuilder()
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Soumettre'))
            ->getForm()
        ;
    }    
    
}
