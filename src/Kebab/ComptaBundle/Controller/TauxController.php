<?php

namespace Kebab\ComptaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\ComptaBundle\Entity\Taux;
use Kebab\ComptaBundle\Form\TauxType;

/**
 * Taux controller.
 *
 */
class TauxController extends Controller
{

    /**
     * Lists all Taux entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Taux')->findAll();

        return $this->render('KebabComptaBundle:Taux:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Taux entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Taux();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taux_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabComptaBundle:Taux:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Taux entity.
     *
     * @param Taux $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Taux $entity)
    {
        $form = $this->createForm(new TauxType(), $entity, array(
            'action' => $this->generateUrl('taux_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Taux entity.
     *
     */
    public function newAction()
    {
        $entity = new Taux();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabComptaBundle:Taux:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Taux entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Taux:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Taux entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Taux:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Taux entity.
    *
    * @param Taux $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Taux $entity)
    {
        $form = $this->createForm(new TauxType(), $entity, array(
            'action' => $this->generateUrl('taux_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Taux entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Taux')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taux entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('taux_edit', array('id' => $id)));
        }

        return $this->render('KebabComptaBundle:Taux:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Taux entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabComptaBundle:Taux')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Taux entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taux'));
    }

    /**
     * Creates a form to delete a Taux entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taux_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
