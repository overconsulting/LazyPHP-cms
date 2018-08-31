<?php

namespace Cms\controllers\cockpit;

use app\controllers\cockpit\CockpitController;
use Widget\widgets\Widget;
use Cms\models\Page;
use Core\Router;
use Core\Session;
use Helper\Email;
use Auth\models\User;

class PagesController extends CockpitController
{
    /**
     * @var string
     */
    private $pageTitle = '<i class="fa fa-file-text fa-purple"></i> Gestion des Pages';

    /**
     * @var Cms\models\Page
     */
    private $page = null;

    public function before()
    {
        if (!$this->checkPermission('cms_page_write')) {
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

        $pageClass = $this->loadModel('Page');
        $pages = $pageClass::getAll($where);

        $statusOptions = $pageClass::getCmsStatusOptions();

        $this->render(
            'cms::pages::index',
            array(
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Liste des pages',
                'pages' => $pages,
                'statusOptions' => $statusOptions
            )
        );
    }

    public function newAction()
    {
        $pageClass = $this->loadModel('Page');
        if (!isset($this->page)) {
            $this->page = new $pageClass();
            $this->page->status = 'draft';
        }

        $contentJson = json_encode(array(
            'title' => $this->page->pageTitle,
            'active' => $this->page->active,
            'sections' => array()
        ));

        $selectStatus = $this->checkPermission('cms_page_publish');
        $statusOptions = $pageClass::getCmsStatusOptions();

        $this->render(
            'cms::pages::edit',
            array(
                'page' => $this->page,
                'contentJson' => $contentJson,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Nouvelle page',
                'formAction' => Router::url('cockpit_cms_pages_create'),
                'selectStatus' => $selectStatus,
                'statusOptions' => $statusOptions,
                'fullwidthOptions' => $this->getFullwidthOptions(),
                'fontWeightOptions' => $this->getFontWeightOptions(),
                'widgets' => $this->getWidgets()
            )
        );
    }

    public function editAction($id)
    {
        $pageClass = $this->loadModel('Page');
        // $this->page = $pageClass::findById($id);
        $this->page = $pageClass::getLastRevision($id, '');

        $contentJson =
            $this->page->content != '' ?
            $this->page->content :
            json_encode(array(
                'title' => $this->page->pageTitle,
                'active' => $this->page->active,
                'sections' => array()
            ));

        $selectStatus = $this->checkPermission('cms_page_publish');
        $statusOptions = $pageClass::getCmsStatusOptions();

        $this->render(
            'cms::pages::edit',
            array(
                'page' => $this->page,
                'contentJson' => $contentJson,
                'pageTitle' => $this->pageTitle,
                'boxTitle' => 'Modification page',
                'formAction' => Router::url('cockpit_cms_pages_update_'.$id),
                'selectStatus' => $selectStatus,
                'statusOptions' => $statusOptions,
                'fullwidthOptions' => $this->getFullwidthOptions(),
                'fontWeightOptions' => $this->getFontWeightOptions(),
                'widgets' => $this->getWidgets()
            )
        );
    }

    public function createAction()
    {
        $pageClass = $this->loadModel('Page');
        $this->page = new $pageClass();

        $post = $this->request->post;

        if (!isset($post['site_id'])) {
            $post['site_id'] = $this->site->id;
        }

        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        if (!isset($post['show_page_title'])) {
            $post['show_page_title'] = 0;
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

        $sendEmailPending = $this->page->status != 'pending' && $post['status'] == 'pending';

        if ($this->page->save($post)) {
            $revision = new $pageClass();
            $revision->page_id = $this->page->id;
            $revision->save($post);

            $this->addFlash('Page ajoutée', 'success');
            if ($post['submit'] == 'save_published' || $post['submit'] == 'save_pending') {
                $this->redirect('cockpit_cms_pages_index');
            } else {
                $this->redirect('cockpit_cms_pages_edit_'.$this->page->id);
            }
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function updateAction($id)
    {
        $pageClass = $this->loadModel('Page');
        $this->page = $pageClass::findById($id);

        $post = $this->request->post;

        if (!isset($post['site_id'])) {
            $post['site_id'] = $this->site->id;
        }

        if (!isset($post['active'])) {
            $post['active'] = 0;
        }

        if (!isset($post['show_page_title'])) {
            $post['show_page_title'] = 0;
        }

        $post['user_id'] = $this->current_user->id;

        $sendEmailPending = $this->page->status != 'pending' && $post['status'] == 'pending';

        $isContentModified = $post['content'] != $this->page->content || $post['title'] != $this->page->title;

        $createRevision = $isContentModified;

        switch ($post['submit']) {
            case 'save':
                if ($this->page->status == 'published' && !$this->checkPermission('cms_page_publish')) {
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

        if ($this->page->save($post)) {
            if ($createRevision) {
                $revision = new $pageClass();
                $revision->page_id = $this->page->id;
            } else {
                $revision = $pageClass::getLastRevision($this->page->id);
            }
            $revision->save($post);

            if ($sendEmailPending) {
                $this->sendEmailPending($this->page);
            }

            $this->addFlash('Page modifiée', 'success');
            if ($post['submit'] == 'save_published' || $post['submit'] == 'save_pending') {
                $this->redirect('cockpit_cms_pages_index');
            } else {
                $this->redirect('cockpit_cms_pages_edit_'.$this->page->id);
            }
        } else {
            $this->addFlash('Erreur(s) dans le formulaire', 'danger');
        }

        $this->editAction($id);
    }

    public function deleteAction($id)
    {
        $pageClass = $this->loadModel('Page');
        $page = $pageClass::findById($id);
        $page->delete();
        $this->addFlash('Page supprimée', 'success');
        $this->redirect('cockpit_cms_pages');
    }

    public function renderAction()
    {
        $params = array(
            'error' => false,
            'message' => 0,
            'renderType' => 'editor'
        );

        $html = isset($this->request->post['html']) ? $this->request->post['html'] : '';

        $this->render($html, $params);
    }

    public function setstatusAction($id, $status)
    {
        $pageClass = $this->loadModel('Page');
        $page = $pageClass::findById($id);

        $sendEmailPending = $page->status != 'pending' && $status == 'pending';

        $page->status = $status;
        $page->user_id = $this->current_user->id;
        $page->save();

        $revision = $page->revisions[0];
        $revision->status = $status;
        $revision->save();

        if ($sendEmailPending) {
            $this->sendEmailPending($page);
        }

        $this->redirect('cockpit_cms_pages');
    }

    public function revisionsAction($id)
    {
        $this->redirect('cockpit_cms_pages');
    }

    private function sendEmailPending($page)
    {
        $groupClass = $this->loadModel('Group');
        $groupAdminsCe = $groupClass::findBy('code', 'admins_ce');

        $userClass = $this->loadModel('User');
        $adminsCe = $userClass::findAll('site_id = '.$page->site_id.' and group_id = '.$groupAdminsCe->id);
        $to = array();
        if (!empty($adminsCe)) {
            foreach ($adminsCe as $admin) {
                $to[] = $admin->email;
            }

            $pageLink = 'http://'.$this->site->host.'/cockpit/cms/pages/edit/'.$page->id;

            $tpl =
                '<html>'.
                    '<head>'.
                    '</head>'.
                    '<body>'.
                        '<p style="">Il y a une nouvelle page à valider</p>'.
                        '<p><a href="{{pageLink}}">Voir la page</a>'.
                    '</body>'.
                '</html>';
            $tpl = str_replace(
                array(
                    '{{pageLink}}'
                ),
                array(
                    $pageLink
                ),
                $tpl
            );

            $resEmail = Email::send(
                array(
                    'from' => 'No reply <noreply@test.com>',
                    'replyTo' => 'No reply <noreply@test.com>',
                    'to' => $to,
                    'subject' => 'Page à valider',
                    'html' => $tpl
                )
            );
            if ($resEmail) {
                $mailStatus = 'OK';
            } else {
                $mailStatus = Email::$lastError;
            }
        }
    }

    private function getFullwidthOptions()
    {
        return array(
            array('label' => 'Pleine largeur (container-fluid)', 'value' => '1'),
            array('label' => 'Recadré (container)', 'value' => '0')
        );
    }

    private function getFontWeightOptions()
    {
        return array(
            array('label' => '---', 'value' => ''),
            array('label' => 'normal', 'value' => 'normal'),
            array('label' => 'bold', 'value' => 'bold'),
            array('label' => 'bolder', 'value' => 'bolder'),
            array('label' => 'lighter', 'value' => 'lighter'),
            array('label' => '100', 'value' => '100'),
            array('label' => '200', 'value' => '200'),
            array('label' => '300', 'value' => '300'),
            array('label' => '400', 'value' => '400'),
            array('label' => '500', 'value' => '500'),
            array('label' => '600', 'value' => '600'),
            array('label' => '700', 'value' => '700'),
            array('label' => '800', 'value' => '800'),
            array('label' => '900', 'value' => '900')
        );
    }

    private function getWidgets()
    {
        $widgets = array();

        foreach(Widget::$widgetTypes as $widgetType => $widget) {
            $widgets[$widgetType] = $widget;
            $widgetClass = $widget['class'];

            if (isset($widget['params']) && !empty($widget['params'])) {
                foreach ($widget['params'] as $paramName => $param) {
                    if ($param['type'] == 'table') {
                        if (strpos($param['model'], '\\') !== false) {
                            $class = $param['model'];
                        } else {
                            $class = $this->loadModel($param['model']);
                        }
                        $widgets[$widgetType]['params'][$paramName]['options'] = $class::getOptions();
                    }
                }
            }
        }

        return $widgets;
    }
}
