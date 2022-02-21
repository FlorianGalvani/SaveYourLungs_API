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

#[Route('/api/user')]
class UserController extends AbstractController
{
    #[Route('/profile', name: 'get_user_profile', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $parameters = json_decode($request->getContent(), true);
        //TODO: Ajouter identification via token
        $user = $userRepository->find($parameters['id']);
        $data = $serializer->serialize($user, 'json', ['groups' => 'user_profile']);
        return new Response($data);
    }

    #[Route('/signup', name: 'user_new', methods: ['POST'])]
    public function signup(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $user->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setAge(intval($data['age']))
            ->setGender($data['gender'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setRole($data['role'])
            ->setAvatar($data['avatar'])
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $form = $this->createForm(UserType::class, $user);

        $form->submit($data);
        echo('Is submited ? : ' . $form->isSubmitted() . ' | ');
        echo('Is valid ? : ' . $form->isValid() . ' | ' );
        if ($form->isSubmitted() && $form->isValid()) {
            // $data['password'] = encryptage mot de passe

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response('ok');
        }

        return new Response('an error occured');
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
