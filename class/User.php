<?php

class User {
    private $_db = null;
    private $_formItem = [];

    public function validasiInsert($formMethod) {
        $validate = new Validate($formMethod);

        $this->_formItem['username'] = $validate->setRules('username','Username',[
            'sanitize' => 'string',
            'required' => 'true',
            'min_char' => 4,
            'regexp' => '/^[A-Za-z0-9]+$/',
            'unique' => ['users','username'],
            ]);

        $this->_formItem['password'] = $validate->setRules('password','Password',[
            'sanitize' => 'string',
            'required' => true,
            'min_char' => 6,
            'regexp' => '/[A-Za-z]+[0-9]|[0-9]+[A-Za-z]/'
        ]);

        $this->_formItem['ulangi_password'] = $validate->setRules('ulangi_password','Ulangi Password',[
            'sanitize' => 'string',
            'required' => true,
            'matches' => 'password'
        ]);

        $this->_formItem['email'] = $validate->setRules('email','Email',[
            'sanitize' => 'string',
            'required' => true,
            'email' => true
        ]);

        if (!$validate->passed()) {
            return $validate->getError();
        }
    }

    public function getItem($item){
        return isset($this->_formItem[$item]) ? $this->_formItem[$item] : '';
    }

    public function insert(){
        $this->_db = DB::getInstance();
        $newUser = [
            'username' => $this->getItem('username'),
            'password' => password_hash($this->getItem('password'),PASSWORD_DEFAULT),
            'email' => $this->getItem('email')
        ];
        return $this->_db->insert('users',$newUser);
    }

    public function validasiLogin($formMethod){
        $validate = new Validate($formMethod);

        $this->_formItem['username'] = $validate->setRules('username', 'Username',[
            'sanitize' => 'string',
            'required' => true
        ]);

        $this->_formItem['password'] = $validate->setRules('password','Password',[
            'sanitize' => 'string',
            'required' => true
        ]);

        if (!$validate->passed()) {
            return $validate->getError();
        }else {
            $this->_db = DB::getInstance();
            $this->_db->select('password');
            $result = $this->_db->getWhereOnce('users',['username','=', $this->_formItem['username']]);
            if (empty($result) || !password_verify($this->_formItem['password'], $result->password)) {
                $pesanError[] = 'Maaf, username / password salah' ;
                return $pesanError;
            }
        }

    }

    public function login(){
        $_SESSION['username'] = $this->getItem('username');
        header('Location: tampil_barang.php');
    }

}