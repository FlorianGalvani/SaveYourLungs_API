<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Repository\UserRepository;
use App\Repository\ChallengeRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api/challenges')]
class ChallengesController extends AbstractController
{
    #[Route('/', name: 'get_user_challenges')]
    public function getChallenges(ManagerRegistry $doctrine,ChallengeRepository $challengeRepository,SerializerInterface $serializer): Response
    {
        $userId = 1;
        $challenges = $challengeRepository->findBy(['user' => $userId]);  
        $data = $serializer->serialize($challenges, 'json', ['groups' => 'user_challenges']);
        return new Response($data);
    }
    #[Route('/update', name: 'update_Challenges')]
    public function updateChallenge(ManagerRegistry $doctrine,ChallengeRepository $challengeRepository,SerializerInterface $serializer): Response
    {
        $challengeId = '4';
        $entityManager = $doctrine->getManager();
        $challenge = $entityManager->getRepository(Challenge::class)->find($challengeId);
        $challenge->setState(1);
        $entityManager->flush();

        $data = $serializer->serialize($challenge, 'json', ['groups' => 'user_challenges']);
        return new Response($data);
    }
}
