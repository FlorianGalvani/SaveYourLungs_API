<?php

namespace App\Controller;

use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/stats/steps')]
class StepsStatsController extends AbstractController
{
    #[Route('/', name: 'get_steps_stats', methods: ['GET'])]
    public function getCigarettesStats(UserRepository $userRepository,SerializerInterface $serializer): Response
    {
        $user = $userRepository->find('2');
        $data = $serializer->serialize($user, 'json', ['groups' => 'user_stepsStats']);
        $json_array = json_decode($data, true);
        $stepsSum = 0;
        foreach ($json_array['stepsStats'] as $key => $value) {
            $stepsSum += $value['steps'];
        }
        $json_array['totalSteps'] = $stepsSum;
        $data = json_encode($json_array);
        return new Response($data);
    }

    #[Route('/', name: 'new_steps_stats', methods: ['POST'])]
    public function newCigarettesStats(UserRepository $userRepository,SerializerInterface $serializer): Response
    {
        
        return new Response('test');
    }
}
