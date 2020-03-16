<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ImageController extends Controller {
    protected $db;
    
    public function __construct(){
        $this->db = DB::connection('pgsql');
    }
    public function image_dashboard(Request $request){
        $data = array();
        $sql = 'Select u.username, i.date_uploaded, i.path, i.thumbnail, i.image_id, i.name, i.user_id from images i, users u where u.user_id = i.user_id';

        if (!empty($request->name)){
            if ($request->name == 'ASC'){
                $sql .= ' ORDER BY i.name ASC';
            } else {
                $sql .= ' ORDER BY i.name DESC';
            }
        }

        if (!empty($request->date)){
            if ($request->date == 'ASC'){
                $sql .= ' ORDER BY i.date_uploaded ASC';
            } else {
                $sql .= ' ORDER BY i.date_uploaded DESC';
            }
        }

        if (!empty($request->search)){
            $search = '%'.$request->search.'%';
            $sql .= ' and i.name LIKE ?';
            $data['images'] = $this->db->select($sql, [$search]);
        } else {
            $data['images'] = $this->db->select($sql);
        }

        $sql = 'Select c.comment, c.image_id, c.user_id, u.username from comments c, users u where u.user_id = c.user_id';
        $data['comments'] = $this->db->select($sql);

        return view('images', ['data' => $data]);
    }
    public function my_image_dashboard(Request $request){
        $data = array();
        $user_id = Session::get('user-id');
        $sql = 'Select u.username, i.date_uploaded, i.path, i.thumbnail, i.image_id, i.name, i.user_id from images i, users u where u.user_id = i.user_id and u.user_id = ?';

        if (!empty($request->name)){
            if ($request->name == 'ASC'){
                $sql .= ' ORDER BY i.name ASC';
            } else {
                $sql .= ' ORDER BY i.name DESC';
            }
        }

        if (!empty($request->date)){
            if ($request->date == 'ASC'){
                $sql .= ' ORDER BY i.date_uploaded ASC';
            } else {
                $sql .= ' ORDER BY i.date_uploaded DESC';
            }
        }

        if (!empty($request->search)){
            $search = '%'.$request->search.'%';
            $sql .= ' and i.name LIKE ?';
            $data['images'] = $this->db->select($sql, [$user_id, $search]);
        } else {
            $data['images'] = $this->db->select($sql, [$user_id]);
        }


        $sql = 'Select c.comment, c.image_id, c.user_id, u.username from comments c, users u where u.user_id = c.user_id';
        $data['comments'] = $this->db->select($sql);
        return view('images', ['data' => $data]);
    }

    public function edit_name(Request $request){
        if (!empty($request->id)){
            $sql = "UPDATE images set name = ? where image_id = ?";
            $row = $this->db->update($sql, [$request->name, $request->id]);

            if (isset($row) && $row >0){
                return [ 
                    'success' => 1,
                    'name' => $request->name,
                    'id' => $request->id
             ];
            } else {
                return ['error' => 'There was a problem changing the image name.'];
            }

        } else {
            return ['error' => 'There was a problem changing the image name.'];
        }
    }
    public function add_comment(Request $request){
        $user_id = Session::get('user-id');
        
        if (!empty($request->comment) && !empty($request->image_id)){
            $sql = "Insert into comments (user_id, image_id, comment) VALUES (?,?,?)";
            $row = $this->db->insert($sql, [$user_id, $request->image_id, $request->comment]);

            if (isset($row) && $row > 0){
                return ['succes' => 1];
            } else {
                return ['error' => "There was a problem adding a comment."];
            }
        } else {
            return ['error' => "There was a problem adding a comment."];
        }

    }
}