<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\CaisseBundle\Entity\FondCaisse;
use Kebab\CaisseBundle\Form\FondCaisseType;

/**
 * FondCaisse controller.
 *
 */
class FondCaisseController extends Controller
{

    /**
     * Lists all FondCaisse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabCaisseBundle:FondCaisse')->findAll();

        return $this->render('KebabCaisseBundle:FondCaisse:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FondCaisse entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FondCaisse();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fondcaisse_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabCaisseBundle:FondCaisse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FondCaisse entity.
     *
     * @param FondCaisse $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FondCaisse $entity)
    {
        $form = $this->createForm(new FondCaisseType(), $entity, array(
            'action' => $this->generateUrl('fondcaisse_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FondCaisse entity.
     *
     */
    public function newAction()
    {
        $entity = new FondCaisse();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabCaisseBundle:FondCaisse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FondCaisse entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:FondCaisse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FondCaisse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:FondCaisse:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FondCaisse entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:FondCaisse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FondCaisse entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:FondCaisse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FondCaisse entity.
    *
    * @param FondCaisse $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FondCaisse $entity)
    {
        $form = $this->createForm(new FondCaisseType(), $entity, array(
            'action' => $this->generateUrl('fondcaisse_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FondCaisse entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:FondCaisse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FondCaisse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fondcaisse_edit', array('id' => $id)));
        }

        return $this->render('KebabCaisseBundle:FondCaisse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FondCaisse entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabCaisseBundle:FondCaisse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FondCaisse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fondcaisse'));
    }

    /**
     * Creates a form to delete a FondCaisse entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fondcaisse_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
