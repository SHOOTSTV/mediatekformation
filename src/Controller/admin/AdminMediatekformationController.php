<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;

/**
 * Description of AdminMediatekformationController
 *
 * @author axelx
 */
class AdminMediatekformationController extends AbstractController {
    
    /**
     *
     * @var FormationRepository
     */
    private $repository;

    /**
     * 
     * @param FormationRepository $repository
     */
    function __construct(FormationRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.formations")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->repository->findAll();
        return $this->render("admin/admin.formations.html.twig", [
            'formations' => $formations
        ]);
    }
}
