<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use APP\Entity\CigarettesStat;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/api/stats/cigarettes')]
class StatsCigarettesController extends AbstractController 
{
    #[Route('/stats', name: 'get_cigarettes_stats',methods: ['GET'])]
    public function getCigarettesStats(Security $security,Request $request,UserRepository $userRepository,SerializerInterface $serializer, EntityManagerInterface $em): Response
    {
        $firstDate = date("Y-m-d", strtotime("monday this week"));
        $lastDate = date("Y-m-d", strtotime("sunday this week"));
        $token = $request->headers->get('Authorization');
        $userId = $security->getUser($token);
        $query = $em->createQuery("SELECT u FROM App\Entity\CigarettesStat u WHERE u.user = '$userId' AND u.date BETWEEN '$firstDate' AND '$lastDate' ");
        $cigarettesStats = $query->getResult();
        $data = $serializer->serialize($cigarettesStats, 'json', ['groups' => 'user_cigarettesStats']);
        $json_array = json_decode($data, true);
        // $stepsSum = 0;
        // foreach ($json_array['cigarettesStats'] as $value) {
        //     $stepsSum += $value['cigarettes'];
        // }
        // $json_array['totalCigarettes'] = $stepsSum;
        $data = json_encode($json_array);
        return new Response($data);
    }

    #[Route('/', name: 'new_cigarettes_stats',methods: ['POST'])]
    public function newCigarettesStats(UserRepository $userRepository,SerializerInterface $serializer): Response
    {
        $user = $userRepository->find('2');
        return new Response('test');
    }

}
