<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;

use Cms\models\Article;
use Cms\models\ArticleCategory;
use Auth\models\User;
use Core\models\Site;
use Core\Router;
use Core\Session;

class ArticlesController extends CockpitController
{
    /**
     * @var Cms\models\Article
     */
    private $article = null;

    /**
     * @var string
     */
    private $pageTitle = '<i class="fa fa-columns fa-red"></i> Gestion des articles';

    public function before()
    {
        if (!$this->checkPermission('cms_article_write')) {
            $this->addFlash('Vous n\'avez pas l\'autorisation d\'accéder à cette page', 'danger');
            $this->redirect('/cockpit');
        }
    }

    public function indexAction()
    {
        if ($this->site !== null) {
            $where = 'site_id = '.$this->site->id;
        } else {
            $where = '';
        }

        $articleClass = $this->loadModel('Article');
        $articles = $articleClass::getAll($where);

        $statusOptions = $articleClass::getCmsStatusOptions();

        $this->render(
            'cms::articles::index',
            array(
                'articles' => $articles,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Liste des articles',
                'statusOptions' => $statusOptions
            )
        );
    }

    public function showAction($id)
    {
        $articleClass = $this->loadModel('Article');
        $this->article = $articleClass::findById($id);

        $this->render(
            'cms::articles::show',
            array(
                'article' => $this->article,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Article n° '.$this->article->id
            )
        );
    }

    public function newAction()
    {
        $articleClass = $this->loadModel('Article');
        $articleCategoryClass = $this->loadModel('ArticleCategory');

        if (!isset($this->article)) {
            $this->article = new $articleClass();
        }

        if ($this->site !== null) {
            $where = 'site_id = '.$this->site->id;
        } else {
            $where = '';
        }

        $articleCategoryOptions = $articleCategoryClass::getOptions(array('where' => $where));
        $selectStatus = $this->checkPermission('cms_article_publish');
        $statusOptions = $articleClass::getCmsStatusOptions();
        $userOptions = User::getOptions(array('where' => 'group_id = 1'));
        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articles::edit',
            array(
                'article' => $this->article,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Ajouter un nouvel article',
                'formAction' => Router::url('cockpit_cms_articles_create'),
                'userOptions' => $userOptions,
                'articleCategoryOptions' => $articleCategoryOptions,
                'selectStatus' => $selectStatus,
                'statusOptions' => $statusOptions,
                'siteOptions' => $siteOptions,
                'selectSite' => $this->current_user->site_id === null
            )
        );
    }

    public function editAction($id)
    {
        $articleClass = $this->loadModel('Article');
        $articleCategoryClass = $this->loadModel('ArticleCategory');

        if (!isset($this->article)) {
            $this->article = $articleClass::findById($id);
        }

        if ($this->site !== null) {
            $where = 'site_id = '.$this->site->id;
        } else {
            $where = '';
        }

        $articleCategoryOptions = $articleCategoryClass::getOptions(array('where' => $where));
        $selectStatus = $this->checkPermission('cms_article_publish');
        $statusOptions = $articleClass::getCmsStatusOptions();
        $userOptions = User::getOptions(array('where' => 'group_id = 1'));
        $siteOptions = Site::getOptions();

        $this->render(
            'cms::articles::edit',
            array(
                'article'=> $this->article,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Modifier l\'article n° '.$id,
                'formAction' => Router::url('cockpit_cms_articles_update', array('id' => $id)),
                'userOptions' => $userOptions,
                'articleCategoryOptions' => $articleCategoryOptions,
                'selectStatus' => $selectStatus,
                'statusOptions' => $statusOptions,
                'siteOptions' => $siteOptions,
                'selectSite' => $this->current_user->site_id === null
            )
        );
    }

    public function createAction()
    {
        $articleClass = $this->loadModel('Article');
        $this->article = new $articleClass();

        $post = $this->request->post;

        if (!isset($post['site_id'])) {
            $post['site_id'] = $this->site->id;
        }

        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        $post['user_id'] = $this->current_user->id;

        switch ($post['submit']) {
            case 'save_draft':
                $post['status'] = 'draft';
                break;
            case 'save_pending':
                $post['status'] = 'pending';
                break;
            case 'save_published':
                $post['status'] = 'published';
                break;
            default:
                break;
        }

        if ($this->article->save($post)) {
            $revision = new $articleClass();
            $revision->article_id = $this->article->id;
            $revision->save($post);

            $this->addFlash('Article ajouté', 'success');
            $this->redirect('cockpit_cms_articles');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->newAction();
    }

    public function updateAction($id)
    {
        $articleClass = $this->loadModel('Article');
        $this->article = $articleClass::findById($id);

        $post = $this->request->post;

        if (!isset($post['site_id'])) {
            $post['site_id'] = $this->site->id;
        }

        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        if ($post['submit'] == 'publish') {
            $post['status'] = 'published';
        } else if (!isset($post['status'])) {
            $post['status'] = 'draft';
        } else {
            $post['status'] = 'draft';
        }

        $post['user_id'] = $this->current_user->id;

        $isContentModified = $post['content'] != $this->article->content || $post['title'] != $this->article->title;
        $createRevision = $isContentModified;

        switch ($post['submit']) {
            case 'save':
                if ($this->article->status == 'published' && !$this->checkPermission('cms_article_publish')) {
                    $createRevision = true;
                    $post['status'] = 'draft';
                }
                break;
            case 'save_draft':
                $post['status'] = 'draft';
                break;
            case 'save_pending':
                $post['status'] = 'pending';
                break;
            case 'save_published':
                $post['status'] = 'published';
                break;
            default:
                break;
        }

        if ($this->article->save($post)) {
            if ($createRevision) {
                $revision = new $articleClass();
                $revision->article_id = $this->article->id;
                echo "passer 1";
            } else {
                echo $this->article->id;
                $revision = $articleClass::getLastRevision($this->article->id);
                echo "passer 2";
            }
            $revision->save($post);

            $this->addFlash('Article modifié', 'success');
            $this->redirect('cockpit_cms_articles');
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $articleClass = $this->loadModel('Article');
        $article = $articleClass::findById($id);
        $article->delete();
        $this->addFlash('Article supprimé', 'success');
        $this->redirect('cockpit_cms_articles');
    }

    public function setstatusAction($id, $status)
    {
        $articleClass = $this->loadModel('Article');
        $article = $articleClass::findById($id);

        $article->status = $status;
        $article->user_id = $this->current_user->id;
        $article->save();

        $revision = $article->revisions[0];
        $revision->status = $status;
        $revision->save();

        $this->redirect('cockpit_cms_articles');
    }
}
