<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\CaisseBundle\Entity\Perissable;
use Kebab\CaisseBundle\Form\PerissableType;

/**
 * Perissable controller.
 *
 */
class PerissableController extends Controller
{

    /**
     * Lists all Perissable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabCaisseBundle:Perissable')->findAll();

        return $this->render('KebabCaisseBundle:Perissable:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Perissable entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Perissable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('perissable_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabCaisseBundle:Perissable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Perissable entity.
     *
     * @param Perissable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Perissable $entity)
    {
        $form = $this->createForm(new PerissableType(), $entity, array(
            'action' => $this->generateUrl('perissable_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Perissable entity.
     *
     */
    public function newAction()
    {
        $entity = new Perissable();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabCaisseBundle:Perissable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Perissable entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Perissable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perissable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Perissable:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Perissable entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Perissable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perissable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Perissable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Perissable entity.
    *
    * @param Perissable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Perissable $entity)
    {
        $form = $this->createForm(new PerissableType(), $entity, array(
            'action' => $this->generateUrl('perissable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Perissable entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Perissable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Perissable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('perissable_edit', array('id' => $id)));
        }

        return $this->render('KebabCaisseBundle:Perissable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Perissable entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabCaisseBundle:Perissable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Perissable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('perissable'));
    }

    /**
     * Creates a form to delete a Perissable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('perissable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
