<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Session;

class UploadController extends Controller {
    protected $db;
    
    public function __construct(){
        $this->db = DB::connection('pgsql');
    }
    /**
     * Uploads image to directory and saves path information to db with user id.
     */
    public function upload(){
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 10000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "uploads/".$fileNameNew;
                    $fileDestinationThumb = "thumbnails/".$fileNameNew;
                    $this->compressImage($fileTmpName, $fileDestinationThumb, 20);
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $user_id = Session::get('user-id');
                    
                    $sql = "INSERT INTO images (user_id, path, thumbnail, date_uploaded, name) values (?, ?, ?, now(), ?)";
                    $row = $this->db->insert($sql, [$user_id, $fileDestination, $fileDestinationThumb, $fileName]);

                    if (isset($row) && $row >0){
                        return ["success" => 1];
                    } else {
                        ['error' => "There was an error uploading your file." ];
                    }
                } else {
                    return [ "error" => "Your file is too large."];
                }
            } else {
                return [ "error" => "There was an error uploading your file."];
            }
        } else {
            return ["error" => "You cannot upload files of this type."];
        }
    }
    function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);
      
        if ($info['mime'] == 'image/jpeg') 
          $image = imagecreatefromjpeg($source);
      
        elseif ($info['mime'] == 'image/gif') 
          $image = imagecreatefromgif($source);
      
        elseif ($info['mime'] == 'image/png') 
          $image = imagecreatefrompng($source);
      
        imagejpeg($image, $destination, $quality);
      
      }
}