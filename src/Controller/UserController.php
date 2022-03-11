<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/api/user')]
class UserController extends AbstractController
{
    #[Route('/profile', name: 'get_user_profile', methods: ['GET'])]
    public function getUserProfile(Request $request, UserRepository $userRepository, SerializerInterface $serializer, Security $security): Response
    {
        $token = $request->headers->get('Authorization');
        $userId = $security->getUser($token);
        $user = $userRepository->find($userId);
        $data = $serializer->serialize($user, 'json', ['groups' => 'user_profile']);
        return new Response($data);
    }

    #[Route('/signup', name: 'user_new', methods: ['POST'])]
    public function signup(ManagerRegistry $doctrine, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $success = false;

        $entityManager = $doctrine->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $emailIsInUse = $doctrine->getRepository(User::class)->find('email');

            if (!$emailIsInUse) {

                // encode the plain password
    
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $user->setAvatar('https:\/\/picsum.photos\/200\/300?random=' . rand(0, 9999));
                $entityManager->persist($user);
                $entityManager->flush();
                $success = true;
                return new Response(json_encode([
                    'success' => $success,
                    'form' => $user,
                ]));
            }

            


            // return $this->redirectToRoute('app_homepage');
        } else {
            $errors = $form->getErrors();
            return new Response(json_encode([
                'success' => $success,
                'form' => json_decode($request->getContent(), true),
                'errors' => $form->getErrors()
            ]));
        }
        //    $success = false;
        //     try {
        //         $data = json_decode($request->getContent(), true);
        //         $user = $userRepository->findOneBy([
        //             'email' =>  $data['email'],
        //         ]);

        //         if (!is_null($user)) {
        //             return new Response('User already exist');
        //         }
        //         $date = new \DateTime();
        //         $user = new User();
        //         $plaintextPassword = $data['password'];
        //         $hashedPassword = $passwordHasher->hashPassword(
        //             $user,
        //             $plaintextPassword
        //         );
        //         $user->setFirstname($data['firstname'])
        //             ->setLastname($data['lastname'])
        //             ->setAge(intval($data['age']))
        //             ->setGender($data['gender'])
        //             ->setEmail($data['email'])
        //             ->setPassword($hashedPassword)
        //             ->setRoles(['ROLE_USER'])
        //             ->setAvatar('https://robohash.org/' .rand(0,999999))
        //             ->setCreatedAt($date)
        //             ->setUpdatedAt($date);
        //         $entityManager->persist($user);
        //         $entityManager->flush();

        //         return new Response(($success));
        //     } catch (\Throwable $th) {
        //         return new Response($th);
        //     }

    }
    #[Route('/checkTokenValidity', name: 'check_token_validity', methods: ['GET'])]
    public function show(Request $request, UserRepository $userRepository, SerializerInterface $serializer, Security $security): Response
    {
        $success = false;
        $token = $request->headers->get('Authorization');
        $userId = $security->getUser($token);
        if ($userId) {
            $success = true;
        }
        return new Response($success);
    }
    // #[Route('/{id}', name: 'user_show', methods: ['GET'])]
    // public function show(User $user): Response
    // {
    //     return $this->render('user/show.html.twig', [
    //         'user' => $user,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(UserType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('user/edit.html.twig', [
    //         'user' => $user,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
    // public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($user);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    // }
}
