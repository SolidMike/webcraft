<?php
/**
 * Created by PhpStorm.
 * User: Миша
 * Date: 18.07.2020
 * Time: 17:13
 */

namespace app\model;

use app\core\Model;

class User extends Model
{
    public $error;

    public  function getUsers() {
        $q = 'SELECT * FROM users';


        if(isset($_REQUEST['sort_by']) && !empty($_REQUEST['sort_by'])) {
            $q .=' ORDER BY '.$_REQUEST['sort_by'].' '.$_REQUEST['sort_desc'].'';
        }
        else {
            $q .= ' ORDER BY id DESC';
        }
        $result = $this->db->row("$q");

        /*if(isset($post) && !empty($post)) {
            $output = '';
            $order = $post['order'];
            if ($order == 'desc') {
                $order = 'asc';
            } else {
                $order = 'desc';
            }
            $result = $this->db->row("SELECT * FROM users ORDER BY " . $post['column_name'] . " " . $order . "");

            $output .= '            
            <table class="table table-dark table-responsive mt-3">
                <thead> 
                <tr>
                    <th scope="col">#</th>
                    <th class="column_sort" id="name" data-order="'.$order.'" href="#" scope="col">Имя</th>
                    <th class="column_sort" id="email" data-order="'.$order.'" href="#" scope="col">Email</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Авторизация</th>
                </tr>
                </thead>';
            echo $output;
        }*/

        return $result;
    }

    public function validate($input, $post, $files = null) {
        $image = $files['image'];
        $rules = [
            'email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail адрес указан не верно',
            ],
            'name' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Логин указан не верно (разрешены только латинские буквы и цифры от 3 до 15 символов',
            ],
        ];

        foreach ($input as $val) {
            if (!isset($post[$val]) || !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }

        }
        if (isset($files) && isset($image) && !empty($image['name'])) {

            if ($image['size'] > 200000) {
                $this->error = 'Слишком большой размер файла';
                return false;
            }

        }

        return true;
    }

    public function checkEmailExists($email) {
        $params = [
          'email' => $email,
        ];
        if ($this->db->column('SELECT id FROM users WHERE email = :email', $params)) {
            $this->error = 'Данный email уже используется';
            return false;
        }
        return true;
    }

    public function checkNameExists($name) {
        $params = [
            'name' => $name,
        ];
        if ($this->db->column('SELECT id FROM users WHERE name = :name', $params)) {
            $this->error = 'Данное имя уже используется';
            return false;
        }
        return true;
    }

    public function checkActivationExists($activation) {
        $params = [
            'activation' => $activation,
        ];
         return $this->db->column('SELECT id FROM users WHERE activation = :activation', $params);
    }

    public function checkApiKeyExists($api_key) {
        $params = [
            'api_key' => $api_key,
        ];
         return $this->db->column('SELECT id FROM users WHERE api_key = :api_key', $params);
    }

    public function activate($activation) {
        $params = [
            'activation' => $activation,
        ];

        $this->db->query('UPDATE users SET status = 1, activation = "" WHERE activation = :activation', $params);

    }

    public function createActivation() {
        return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 30)), 0, 30);
    }

    public function register($post, $files) {

        $activation = $this->createActivation();
        $api_key = $this->createActivation();

        $image = $files['image'];
        if (isset($files) && isset($image) && !empty($image['name'])){
        $imageFormat = explode('.', $image['name']);
        $imageFormat = $imageFormat[1];

        $imageFullName = 'images' . hash('crc32', time()) . '.' . $imageFormat;

        $imageType = $image['type'];

        $uploads_dir = 'uploads';

        if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
            if (move_uploaded_file($image['tmp_name'], $uploads_dir . '/' . $imageFullName)) {

            } else {
                $this->error = 'Загрузка изображения не удалась';
                return false;
            }
        }
    }
        $params = [
            'id' => NULL,
            'email' => $post['email'],
            'name' => $post['name'],
            'photo' => isset($imageFullName) ? $imageFullName  : NULL,
            'activation' => $activation,
            'status' => 0,
            'api_key' => $api_key,
        ];

        $this->db->query('INSERT INTO users (id, email, name, photo, activation, status, api_key)
                                      VALUES (
                                      :id, :email, :name, :photo, :activation, :status, :api_key
                                      )', $params);
        mail($post['email'], 'Register', 'Confirm: <a>http://webcraft.zzz.com.ua/confirm/'.$activation.'</a>', "From: solidmike@webcraft.zzz.com.ua");
        return true;
    }

    public function checkData($name, $email) {
        $params = [
            'name' => $name,
        ];
        $email_verify = $this->db->column('SELECT email FROM users WHERE name = :name', $params);
        if(!$email || $email != $email_verify) {
            $this->error = 'Логин и email не совпадают';
            return false;
        }
        return true;
    }

    public function checkStatus($type, $data) {
        $params = [
            $type => $data,
        ];
        $status = $this->db->column('SELECT status FROM users WHERE '.$type.'  = :'.$type, $params);
        if ($status != 1) {
            $this->error = 'Аккаунт ожидает подтверждения по E-mail';
            return false;
        }
        return true;

    }

    public function login($name) {
        $params = [
           'name' => $name,
        ];
        $data = $this->db->row('SELECT * FROM users WHERE name = :name', $params);
        $_SESSION['authorized'] = $data[0];
    }
}