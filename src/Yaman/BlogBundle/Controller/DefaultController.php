<?php

namespace Yaman\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Yaman\BlogBundle\Entity\Post;
use Yaman\BlogBundle\Form\Type\PostType;

class DefaultController extends Controller
{
    /**
     * @Route("/example/{name}", name="hellopage")
     */
    public function helloAction($name)
    {
        return $this->render('YamanBlogBundle:Default:hello.html.twig', array('name' => $name));
    }


    /**
     * @Route("/blog/create/", name="createpage")
     */
    public function createAction(Request $request)
    {
        $post = new Post();

        #$form = $this->createForm(new PostType(), $post);
        $form = $this->createForm('post', $post);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('hellopage',array( 'name' => 1111 ));
        }

        return $this->render('YamanBlogBundle:Default:create.html.twig', array(
            'form' => $form->createView(),
        ));

        //return $this->render('YamanBlogBundle:Default:create.html.twig', array('id' => $post->getId()));

    }

    /**
     * @Route("/blog/show/{post_id}", name="showpage")
     */
    public function showAction($post_id)
    {
        $post = $this->getDoctrine()
            ->getRepository('YamanBlogBundle:Post')
            ->find($post_id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No product found for id '.$post_id
            );
        }

        return $this->render('YamanBlogBundle:Default:show.html.twig', array('post' => $post));

    }

    /**
     * @Route("/blog/edit/{post_id}", name="editpage")
     */
    public function editAction($post_id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('YamanBlogBundle:Post')->find($post_id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No product found for id '.$post_id
            );
        }

        $form = $this->createForm('post', $post);

        $form->handleRequest($request);

        if( $form->isValid() ){

            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('hellopage',array( 'name' => 1111 ));

        }

        return $this->render('YamanBlogBundle:Default:create.html.twig', array('form' =>  $form->createView()));

    }


}
