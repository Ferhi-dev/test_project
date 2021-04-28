<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Services\AntiSpam;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Start1Controller extends AbstractController
{
    /**
     * @Route("/show",name="show_room")
     * @Route("/delete/{id}",name="article_delete")
     */
    public function show(Article $article=null, ArticleRepository $repo,EntityManagerInterface $em)
    {
        if($article!==null)
        {
            $em->remove($article);
            $em->flush();
        }
        
        $MyArticles=$repo->findAll();
   
        
     
        return $this->render('/start1/show.html.twig',['MyArticles'=>$MyArticles]);
    }

    /**
     * @Route("/details/{id}",name="article_detail")
     */
    public function showArticle(Article $article, ArticleRepository $repo)
    {
 
     
        return $this->render('/start1/Articledetails.html.twig',['MyArticle'=>$article]);
    }



    /**
     * @Route("/add", name="article.add")
     * @Route("/edit/{id}",name="article_edit")
     */
    public function add(Article $article=null,Request $req, EntityManagerInterface $em,ArticleRepository $rep )
    {
        if($article==null)
        {
         $article=new Article();
         $exist=false;
        }
        else
        {
            $exist=true;
        }

    $myForm=$this->createForm(ArticleType::class,$article);

     
    $myForm->handleRequest($req);
    if($myForm->isSubmitted() && $myForm->isValid())
    {
      
        $article->setCreateAt(new \DateTime());

        $em->persist($article);
        $em->flush();

       return  $this->redirectToRoute('show_room');
        

    }
    
     return $this->render("start1/add.html.twig",['myForm'=>$myForm->createView(),'exist'=>$exist]);
    }
}
