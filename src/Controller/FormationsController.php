<?php
namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of FormationsController
 *
 * @author emds
 */
class FormationsController extends AbstractController {
    
    private const PAGEFORMATIONS = "pages/formations.html.twig";

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
     * @Route("/formations", name="formations")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->repository->findAll();
        return $this->render(self::PAGEFORMATIONS, [
            'formations' => $formations
        ]);
    }
    
    /**
     * @Route("/formations/tri/{champ}/{ordre}", name="formations.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort($champ, $ordre): Response{
        $formations = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render(self::PAGEFORMATIONS, [
           'formations' => $formations
        ]);
    }

    /**
     * @Route("admin/admin.formations/tri/{champ}/{ordre}", name="adminformations.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sortAdmin($champ, $ordre): Response{
        $formations = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render("admin/admin.formations.html.twig" ,[
           'formations' => $formations
        ]);
    }    
        
    /**
     * @Route("/formations/recherche/{champ}", name="formations.findallcontain")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllContain($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $formations = $this->repository->findByContainValue($champ, $valeur);
            return $this->render("pages/formations.html.twig", [
                'formations' => $formations
            ]);
        }
        return $this->redirectToRoute("formations");
    }  

    /**
     * @Route("admin/admin.formations/recherche/{champ}", name="adminformations.findallcontain")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllContainAdmin($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $formations = $this->repository->findByContainValue($champ, $valeur);
            return $this->render("admin/admin.formations.html.twig", [
                'formations' => $formations
            ]);
        }
        return $this->redirectToRoute("formations");
    } 

    /**
     * @Route("/formations/recherche/niveau/{champ}", name="formations.findallbyniveau")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllbyNiveau($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $formations = $this->repository->findByNiveau($champ, $valeur);
            return $this->render("pages/formations.html.twig", [
                'formations' => $formations
            ]);
        }
        return $this->redirectToRoute("formations");
    }
    
    /**
     * @Route("admin/admin.formations/recherche/niveau/{champ}", name="adminformations.findallbyniveau")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllbyNiveauAdmin($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $formations = $this->repository->findByNiveau($champ, $valeur);
            return $this->render("admin/admin.formations.html.twig", [
                'formations' => $formations
            ]);
        }
        return $this->redirectToRoute("formations");
    }
    
    /**
     * @Route("/formations/formation/{id}", name="formations.showone")
     * @param type $id
     * @return Response
     */
    public function showOne($id): Response{
        $formation = $this->repository->find($id);
        return $this->render("pages/formation.html.twig", [
            'formation' => $formation
        ]);        
    }    
}
