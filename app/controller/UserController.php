<?php

namespace app\controller;

use app\core\Controller;

class UserController extends Controller
{
    // Регистрация
    public function registerAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['name', 'email',], $_POST, $_FILES)) {
                $this->view->message('Ошибка', $this->model->error);
            }
            elseif (!$this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('Ошибка', $this->model->error);
            }
            elseif (!$this->model->checkNameExists($_POST['name'])) {
                $this->view->message('Ошибка', $this->model->error);
            }
            $this->model->register($_POST, $_FILES);
            $this->view->message('Успех','Регистрация прошла успешно. Код активации пришел на ваш Email.');
        }
        $this->view->render('регистрация');
    }

    public function confirmAction() {
        if (!$this->model->checkActivationExists($this->route['activation'])) {
            $this->view->redirect('/login');
        }
        $this->model->activate($this->route['activation']);
        $this->view->render('Регистрация завершена');
    }

    // Вход
    public function loginAction() {
        if (!empty($_POST)) {
            if (!$this->model->validate(['name', 'email',], $_POST)) {
                $this->view->message('Ошибка', $this->model->error);
            }
            elseif (!$this->model->checkData($_POST['name'], $_POST['email'])) {
                $this->view->message('Ошибка', $this->model->error);
            }
            elseif (!$this->model->checkStatus('name', $_POST['name'])) {
                $this->view->message('Ошибка', $this->model->error);
            }
            $this->model->login($_POST['name']);
            $this->view->location('/show');
        }

        $this->view->render('логин');
    }

    public function showAction() {

        $result = $this->model->getUsers();

        $vars = [
            'users' => $result,
        ];

        $this->view->render('Показать пользователей', $vars);
    }

    public function apiAction() {
        if (isset($_SESSION['authorized']['id'])) {
            if ($this->model->checkApiKeyExists($this->route['apikey'])) {
                $result = $this->model->getUsers();
                if(isset($_REQUEST['format']) && !empty($_REQUEST['format'])) {
                    switch ($_REQUEST['format']) {
                        case 'json':
                            $json_result = json_encode($result);

                            echo  "<div style='padding: 5rem 15px;word-break: break-word;'>
                                    $json_result</div>";
                            break;
                        case 'xml':
                            $xml = '<div style=\'padding: 5rem 15px;word-break: break-word;\'>';
                            $xml .= htmlspecialchars("<XML>", ENT_QUOTES);
                            foreach ($result as $value){
                                $xml .= htmlspecialchars("<user>", ENT_QUOTES);
                                foreach ($value as $key => $val) {
                                    $myVar = htmlspecialchars("<$key>$val</$key>\n", ENT_QUOTES);
                                    $xml .= "<pre>$myVar</pre>";
                                }
                                $xml .= htmlspecialchars("</user>", ENT_QUOTES);

                            }
                            $xml .= htmlspecialchars("</XML>", ENT_QUOTES);
                            $xml .= '</div>';
                            echo $xml;
                    }
                }

                $vars = [
                    'users' => $result,
                ];
                $this->view->render('Регистрация завершена', $vars);
            }
            
        }


    }


}
