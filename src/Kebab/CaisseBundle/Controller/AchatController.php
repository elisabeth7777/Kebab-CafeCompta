<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kebab\CaisseBundle\Entity\Achat;
use Kebab\CaisseBundle\Form\AchatType;

/**
 * Achat controller.
 *
 */
class AchatController extends Controller
{

    /**
     * Lists all Achat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KebabCaisseBundle:Achat')->findAll();

        return $this->render('KebabCaisseBundle:Achat:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Achat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Achat();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achat_show', array('id' => $entity->getId())));
        }

        return $this->render('KebabCaisseBundle:Achat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Achat entity.
     *
     * @param Achat $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Achat $entity)
    {
        $form = $this->createForm(new AchatType(), $entity, array(
            'action' => $this->generateUrl('achat_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Achat entity.
     *
     */
    public function newAction()
    {
        $entity = new Achat();
        $form   = $this->createCreateForm($entity);

        return $this->render('KebabCaisseBundle:Achat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Achat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Achat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Achat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Achat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Achat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achat entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KebabCaisseBundle:Achat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Achat entity.
    *
    * @param Achat $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Achat $entity)
    {
        $form = $this->createForm(new AchatType(), $entity, array(
            'action' => $this->generateUrl('achat_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Achat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KebabCaisseBundle:Achat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('achat_edit', array('id' => $id)));
        }

        return $this->render('KebabCaisseBundle:Achat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Achat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KebabCaisseBundle:Achat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Achat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achat'));
    }

    /**
     * Creates a form to delete a Achat entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achat_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
