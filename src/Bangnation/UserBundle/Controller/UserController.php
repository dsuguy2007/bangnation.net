<?php

namespace Bangnation\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bangnation\UserBundle\Entity\User;
use Bangnation\UserBundle\Entity\Friendship;

/**
 * User controller.
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/user", name="user")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BangnationUserBundle:User')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Lists all non-friends/non-requested User entities.
     *
     * @Route("/friends/inverse", name="friends_inverse")
     * @Template()
     */
    public function friendsInverseAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();

        $entities = $em->getRepository('BangnationUserBundle:User')->getNonFriendsForUser($user);

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/user/{id}/show", name="user_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BangnationUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Adds a friend to the current signed in user entity
     *
     * @Route("/friend/{id}/add", name="friend_add")
     * @Template()
     */
    public function friendAddAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $friendType = $this->getRequest()->request('friendType');

        $user = $this->getUser();
        $friendship = $em->getRepository('Friendship')->findOneBy(array('user_id' => $user->getId(), 'friend_id' => $id));

        if (!$friendship) {
            $friendship = new Friendship();
        }

        $friend = $em->getRepository('BangnationUserBundle:User')->find($id);

        if (!$friend) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $friendship->setUser($user);
        $friendship->setFriend($friend);
        $friendship->setFriendType($friendType);

        $em->persist($friendship);
        $em->flush();

        return array(
            'friendship' => $friendship,
        );
    }

    /**
     * Removes a friend from the current signed in user entity
     *
     * @Route("/friend/{id}/remove", name="friend_remove")
     * @Template()
     */
    public function friendRemoveAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();
        $friend = $em->getRepository('BangnationUserBundle:User')->find($id);

        if (!$friend) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $user->removeFriend($friend);

        $em->persist($friend);
        $em->flush();

        return array(
        );
    }

    /**
     * Retrieve a list of friends for the current user
     *
     * @Route("/friends", name="friends")
     * @Method({"GET"})
     * @Template()
     */
    public function friendsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();
        $friends = $em->getRepository('BangnationUserBundle:User')->getFriendsForUser($user);

        return array(
            'friends' => $friends,
        );
    }

    /**
     * Retrieve a list of friends for the current user
     *
     * @Route("/friend/requests", name="friends_requests")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function friendRequestsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();
        $friend_requests = $em->getRepository('BangnationUserBundle:User')->getFriendRequestsForUser($user);

        return array(
            'friend_requests' => $friend_requests,
        );
    }

    /**
     * Confirm a friend request
     *
     * @Route("/friend/request/{id}/confirm", name="friends_request_confirm")
     * @Method({"GET", "POST"})
     */
    public function friendRequestConfirmAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();
        $friend_request = $em->getRepository('BangnationUserBundle:User')->getFriendRequestForUser($id, $user);

        if ($friend_request) {
            $friend_request->setAccepted(new \DateTime);

            $em->persist($friend_request);
            $em->flush();
        }

        return $this->forward('BangnationUserBundle:User:friendRequests');
    }

    /**
     * Decline a friend request
     *
     * @Route("/friend/request/{id}/decline", name="friends_request_decline")
     * @Method({"GET", "POST"})
     */
    public function friendRequestDeclineAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();
        $friend_request = $em->getRepository('BangnationUserBundle:User')->getFriendRequestForUser($id, $user);

        if ($friend_request) {
            $em->remove($friend_request);
            $em->flush();
        }

        return $this->forward('BangnationUserBundle:User:friendRequests');
    }

    /**
     * Create a friend request
     *
     * @Route("/friend/request/{id}", name="friends_request")
     * @Method({"GET", "POST"})
     */
    public function friendRequestAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $friendType = $this->getRequest()->get('friend_type');

        $user = $this->getUser();
        $friend = $em->getRepository('BangnationUserBundle:User')->find($id);

        $friend_request = new Friendship();
        $friend_request->setUser($user);
        $friend_request->setFriend($friend);
        $friend_request->setFriendType($friendType);

        $em->persist($friend_request);
        $em->flush();

        return $this->forward('BangnationUserBundle:User:friendsInverse');
    }

}
