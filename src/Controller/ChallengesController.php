<?php

namespace App\Controller;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Challenge;
use App\Repository\UserRepository;
use App\Repository\ChallengeRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/api/challenges')]
class ChallengesController extends AbstractController
{
    #[Route('/', name: 'get_user_challenges')]
    public function getChallenges(Request $request, ChallengeRepository $challengeRepository, UserRepository $userRepository, SerializerInterface $serializer, Security $security): Response
    {
        $token = $request->headers->get('Authorization');
        $userId = $security->getUser($token);
        // $user = $userRepository->find($userId);
        $challenges = $challengeRepository->findBy(['user' => $userId, 'state' => 'active']);
        $data = $serializer->serialize($challenges, 'json', ['groups' => 'user_challenges']);

        return new Response($data);
    }

    #[Route('/newrandom', name: 'newrandom_Challenges')]
    public function newrandomChallenge(ValidatorInterface $validator, Request $request, ManagerRegistry $doctrine, SerializerInterface $serializer, Security $security): Response
    {
        $challenges = [
            [
                '1000',
                '1500',
                '2000',
                '2500',
                '3000',
                '3500',
                '4000',
                '4500',
                '5000',
                '5500',
                '6000',
                '6500'
            ],
            []
        ];
        $success = false;

        $token = $request->headers->get('Authorization');
        $entityManager = $doctrine->getManager();
        $userId = $security->getUser($token);
        $challengeType = 0;
        // $challengeType = rand(0,1);
        $randomChallenge = new Challenge();
        $randomChallenge->setType('step');
        $randomChallenge->setState('active');
        $randomChallenge->setUser($userId);
        $randomChallenge->setCreatedAt(new \DateTime());
        $randomChallenge->setUpdatedAt(new \DateTime());
        $randomChallenge->setGoal($challenges[$challengeType][rand(0, count($challenges[$challengeType]))]);
        $entityManager->persist($randomChallenge);
        $entityManager->flush();
        $success = true;

        return new Response(json_encode(['success' => $success]));
    }



    #[Route('/surrend', name: 'surrend_challenge')]
    public function surrendChallenge(Request $request, ManagerRegistry $doctrine, ChallengeRepository $challengeRepository, SerializerInterface $serializer): Response
    {
        $id = $request->query->get('id');
        $entityManager = $doctrine->getManager();
        $challenge = $entityManager->getRepository(Challenge::class)->find($id);
        $challenge->setState('surrendered');
        $entityManager->persist($challenge);
        $entityManager->flush();

        $data = $serializer->serialize($challenge, 'json', ['groups' => 'user_challenges']);
        return new Response($data);
    }

    #[Route('/update', name: 'update_Challenges')]
    public function updateChallenge(ManagerRegistry $doctrine, ChallengeRepository $challengeRepository, SerializerInterface $serializer): Response
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
