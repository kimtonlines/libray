<?php

namespace Kimt\Controller;

use Slim\Views\Twig;
use Slim\Http\Request;
use Kimt\Model\Article;
use Slim\Http\Response;
use Kimt\Repository\ArticleRepository;

class ArticleController
{
    protected $container;

    // constructor receives container instance
    public function __construct($container) {
        $this->container = $container;
    }
 
    public function index(Request $request, Response $response){
        
        $manager = new ArticleRepository();
        
        $articles = $manager->findAll();
        
        return $this->container->view->render($response, 'article/index.html.twig', compact('articles'));
    }

    public function create(Request $request, Response $response) {

        

        if ($request->getMethod() === 'POST') {

            $manager = new ArticleRepository();
            $article = new Article();

            $libelle = $request->getParam('libelle');
            $prix = $request->getParam('prix');
            $categorie = $request->getParam('categorie');

            $article->setLibelle($libelle);
            $article->setPrix($prix);
            $article->setCategorie($categorie);
            $manager->save($article);

            return $response->withStatus(200)->withHeader('Location', '/articles');
        }
        return $this->container->view->render($response, 'article/create.html.twig');

    }

    public function edit(Request $request, Response $response, array $args) {

            $id = $args['id'];

            $manager = new ArticleRepository();
            
            $article = $manager->findOne($id);

            if ($request->getMethod() === "PUT") {
                $libelle = $request->getParam('libelle');
                $prix = $request->getParam('prix');
                $categorie = $request->getParam('categorie');

                $article->setLibelle($libelle);
                $article->setPrix($prix);
                $article->setCategorie($categorie);

                $manager->update($article);

                return $response->withStatus(200)->withHeader('Location', '/articles/edit/'.$article->getId());
            }
            

            return $this->container->view->render($response, 'article/edit.html.twig', compact('article'));
    }
    
    public function  show(Request $request, Response $response, array $args ){

        $id = $args['id'];

        $manager = new ArticleRepository();

        $article = $manager->findOne($id);

        
        return $this->container->view->render($response, 'article/show.html.twig', compact('article'));
    }

    public function  remove(Request $request, Response $response, array $args ) {

        if ($request->getMethod() === "DELETE") {
            $id = $args['id'];

            $manager = new ArticleRepository();

            $article = $manager->findOne($id);
            $manager->delete($article);
            return $response->withStatus(200)->withHeader('Location', '/articles');
        }


    }
}