<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\CaisseBundle\Entity\Versement;
use Kebab\CaisseBundle\Form\VersementType;

/**
 * Versement controller.
 *
 */
class VersementController extends Controller
{

    /**
     * Lists all Versement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabCaisseBundle:Versement')->findAll();

        return $this->render('KebabCaisseBundle:Versement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Versement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Versement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('versement_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabCaisseBundle:Versement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Versement entity.
     *
     * @param Versement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Versement $entity)
    {
        $form = $this->createForm(new VersementType(), $entity, array(
            'action' => $this->generateUrl('versement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Versement entity.
     *
     */
    public function newAction()
    {
        $entity = new Versement();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabCaisseBundle:Versement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Versement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Versement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Versement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Versement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Versement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Versement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Versement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Versement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Versement entity.
    *
    * @param Versement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Versement $entity)
    {
        $form = $this->createForm(new VersementType(), $entity, array(
            'action' => $this->generateUrl('versement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Versement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Versement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Versement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('versement_edit', array('id' => $id)));
        }

        return $this->render('KebabCaisseBundle:Versement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Versement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabCaisseBundle:Versement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Versement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('versement'));
    }

    /**
     * Creates a form to delete a Versement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('versement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
