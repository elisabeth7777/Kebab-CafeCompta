<?php

namespace Kebab\ComptaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\ComptaBundle\Entity\Salarie;
use Kebab\ComptaBundle\Form\SalarieType;

/**
 * Salarie controller.
 *
 */
class SalarieController extends Controller
{

    /**
     * Lists all Salarie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabComptaBundle:Salarie')->findAll();

        return $this->render('KebabComptaBundle:Salarie:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Salarie entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Salarie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('salarie_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabComptaBundle:Salarie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Salarie entity.
     *
     * @param Salarie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Salarie $entity)
    {
        $form = $this->createForm(new SalarieType(), $entity, array(
            'action' => $this->generateUrl('salarie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Salarie entity.
     *
     */
    public function newAction()
    {
        $entity = new Salarie();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabComptaBundle:Salarie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Salarie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salarie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salarie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Salarie:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Salarie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salarie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salarie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabComptaBundle:Salarie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Salarie entity.
    *
    * @param Salarie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Salarie $entity)
    {
        $form = $this->createForm(new SalarieType(), $entity, array(
            'action' => $this->generateUrl('salarie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Salarie entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabComptaBundle:Salarie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salarie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('salarie_edit', array('id' => $id)));
        }

        return $this->render('KebabComptaBundle:Salarie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Salarie entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabComptaBundle:Salarie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Salarie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('salarie'));
    }

    /**
     * Creates a form to delete a Salarie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salarie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
