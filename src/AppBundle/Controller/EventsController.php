<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Repository\EventRepository;
use AppBundle\Form\Type\EventType;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class EventsController
 * @package AppBundle\Controller
 *
 * @RouteResource("event")
 */
class EventsController extends FOSRestController implements ClassResourceInterface {

    /**
     * Gets an individual Event
     *
     * @param  $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Event",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function getAction($id) {
        $event = $this->getEventRepository()->createFindOneByIdQuery($id)->getSingleResult();

        if ($event === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $event;
    }

    /**
     * Gets a collection of Events
     *
     * @return array
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Event",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction() {
        return $this->getEventRepository()->createFindAllQuery()->getResult();
    }

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="AppBundle\Form\Type\EventType",
     *     output="AppBundle\Entity\Event",
     *     statusCodes={
     *         201 = "Returned when a new Event has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request) {
        $form = $this->createForm(EventType::class, null, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        /**
         * @var $event Event
         */
        $event = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        $routeOptions = [
            'id' => $event->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_event', $routeOptions, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param      $id
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="AppBundle\Form\Type\EventType",
     *     output="AppBundle\Entity\Event",
     *     statusCodes={
     *         204 = "Returned when an existing Event has been successful updated",
     *         400 = "Return when errors",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function putAction(Request $request, $id) {
        /**
         * @var $event Event
         */
        $event = $this->getEventRepository()->find($id);

        if ($event === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EventType::class, $event, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id' => $event->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_event', $routeOptions, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @param      $id
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="AppBundle\Form\Type\EventType",
     *     output="AppBundle\Entity\Event",
     *     statusCodes={
     *         204 = "Returned when an existing Event has been successful updated",
     *         400 = "Return when errors",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function patchAction(Request $request, $id) {
        /**
         * @var $event Event
         */
        $event = $this->getEventRepository()->find($id);

        if ($event === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(EventType::class, $event, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id' => $event->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_event', $routeOptions, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  $id
     * @return View
     *
     * @ApiDoc(
     *     statusCodes={
     *         204 = "Returned when an existing Event has been successful deleted",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function deleteAction($id) {
        /**
         * @var $event Event
         */
        $event = $this->getEventRepository()->find($id);

        if ($event === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        return new View(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @return EventRepository
     */
    private function getEventRepository() {
        return $this->get('crv.doctrine_entity_repository.event');
    }

}
