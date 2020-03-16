<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class LoginController extends Controller {
    protected $db;
    
    public function __construct(){
        $this->db = DB::connection('pgsql');
    }
    /**
     * Basic login function
     * logs user in and sets up basic session
     * creates user if they do not already have a user account
     */
    public function login(Request $request){
        $return = 0;
        $email = $request->email ?? '';
        $password = $request->password ?? '';

        if (!empty($email) && !empty($password)){
            $sql = "Select token, user_id from users where username = ?";
            $row = $this->db->selectOne($sql, [$email]);
            
            if (!empty($row->token) && !empty($row->user_id)){
                if (password_verify($password, stripcslashes($row->token))){
                    Session::regenerate();
                    Session::put('user', $email);
                    Session::put('user-id', $row->user_id);
                    $return = 1;
                } else {
                    $return = 0;
                }
            }
            
            if (empty($row)){
                $sql = "Insert into users (username, token) VALUES (?, ?)";
                $token = password_hash($password, PASSWORD_DEFAULT);
                $row = $this->db->insert($sql,[$email, $token]);

                if (isset($row) && $row > 0){
                    $sql = "Select user_id from users where username = ?";
                    $id = $this->db->selectOne($sql, [$email]);
                    
                    if (isset($id->user_id)){
                        Session::regenerate();
                        Session::put('user', $email);
                        Session::put('user-id', $id->user_id);
                        $return = 1;
                    } else {
                        $return = 0;
                    }
                } else {
                    $return = 0;
                }
            } 

        }
        return [ "success" => $return ]; 
    }
    /**
     * Logout the user
     */
    public function logout(){
        Session::flush();
        return redirect('/');
    }
}