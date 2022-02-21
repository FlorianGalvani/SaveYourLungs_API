<?php

namespace App\Controller;

use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api/stats/cigarettes')]
class StatsCigarettesController extends AbstractController 
{
    #[Route('/', name: 'get_cigarettes_stats',methods: ['GET'])]
    public function getCigarettesStats(UserRepository $userRepository,SerializerInterface $serializer): Response
    {
        $user = $userRepository->find('3');
        $data = $serializer->serialize($user, 'json', ['groups' => 'user_cigarettesStats']);
        $json_array = json_decode($data, true);
        $stepsSum = 0;
        foreach ($json_array['cigarettesStats'] as $value) {
            $stepsSum += $value['cigarettes'];
        }
        $json_array['totalCigarettes'] = $stepsSum;
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
