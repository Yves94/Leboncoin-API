<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Entity\Job;
use App\Entity\Vehicle;
use App\Entity\RealEstate;

/**
 * @Route("/api")
 */
class AnnouncementController extends FOSRestController
{
	/**
	 * @Route("/announcement", name="get_announcement")
     */
    public function getAnnouncementsAction(): array
    {
        $em = $this->getDoctrine()->getManager();
        $announcement = $em->getRepository(Announcement::class)->findAll();

        if (!$announcement) {
            throw new HttpException(400, "Invalid data");
        }

        return $announcement;
    }

	/**
	 * @Route("/announcement/{id}", name="get_announcement")
     */
    public function getAnnouncementAction(int $id): ?object
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $em = $this->getDoctrine()->getManager();
        $announcement = $em->getRepository(Announcement::class)->find($id);

        if (!$announcement) {
            throw new HttpException(400, "Invalid data");
        }

        return $announcement;
	}

	/**
	 * @Route("/announcement/new", name="post_announcement")
     */
    public function postAnnouncementAction(Request $request): ?object
    {
        try {
            $data = json_decode($request->getContent(), true);

            $announcement = new Announcement();
            $form = $this->createForm(AnnouncementType::class, $announcement);

            $form->submit($data);

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $announcement->setUser($user);

            if ($data['category'] == 'job') {

                $job = new Job();
                $job->setSalary($data['salary']);
                $job->setContract($data['contract']);
                $announcement->setJob($job);
            }

            switch ($data['category']) {
                case 'job':
                    $job = new Job();
                    $job->setSalary($data['salary']);
                    $job->setContract($data['contract']);
                    $announcement->setJob($job);
                    break;
                case 'vehicle':
                    $vehicle = new Vehicle();
                    $vehicle->setPrice($data['price']);
                    $vehicle->setFuelType($data['fuelType']);
                    $announcement->setVehicle($vehicle);
                    break;
                case 'realEstate':
                    $realEstate = new RealEstate();
                    $realEstate->setPrice($data['price']);
                    $realEstate->setArea($data['area']);
                    $announcement->setRealEstate($realEstate);
                default:
                    throw new HttpException(400, "Invalid data");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($announcement);
            $em->flush();

            return new JsonResponse('Announcement successfully created', 201);
        }
        catch (\Exception $e) {
            throw new HttpException(400, "Invalid data");
        }
    }

	// /**
	//  * @Route("/announcement/edit/{id}", name="put_announcement")
	//  */
    // public function putAnnouncementAction(Request $request, int $id): ?object
    // {
    //     try {
    //         $data = json_decode($request->getContent(), true);
    //         $em = $this->getDoctrine()->getManager();
    //         $announcement = $em->getRepository(Announcement::class)->find($id);
    //         $form = $this->createForm(AnnouncementType::class, $announcement, ['method' => 'PUT']);
    //         $form->handleRequest($request);

    //         $em->persist($announcement);
    //         $em->flush();

    //         return new JsonResponse('Announcement successfully modified', 201);
    //     }
    //     catch (\Exception $e) {
    //         throw new HttpException(400, "Invalid data");
    //     }
    // }

	/**
	 * @Route("/announcement/remove/{id}", name="delete_announcement")
	 */
    public function deleteAnnouncementAction(int $id): ?object
    {
        $em = $this->getDoctrine()->getManager();
        $announcement = $em->getRepository(Announcement::class)->find($id);
        $em->remove($announcement);
        $em->flush();

        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        return new JsonResponse('Announcement successfully removed', 201);
    }
}

