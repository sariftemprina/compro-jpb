<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images_model extends CI_Model {

    function decodeBase64($param){
        
        if (preg_match('/^data:image\/(\w+);base64,/', $param, $type)) {
            $param = substr($param, strpos($param, ',') + 1);
            $type = strtolower($type[1]);
        
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png', 'webp' ])) {
                $data['status'] = false;
                $data['message'] = "Ekstensi file yang di izinkan jpg, jpeg, gif, png, 'webp'";    
                echo json_encode($data);
                return false;
            }
            $size = (strlen($param) * 3 / 4) - substr_count(substr($param, -2), '=');
            $limit = 1; // 4MB
            if(($size/1024) > 0 && ($size/1024) < (1024*$limit)){ 
                $data['status'] = false;
                $data['message'] = "Size yang diijinkan 0 - {$limit} Mb";    
            }

            $image = base64_decode(str_replace( ' ', '+', $param));
        
            if ($image === false) {
                $data['status'] = false;
                $data['message'] = "Gagal membaca file base64";    
                echo json_encode($data);
                return false;
            }
        } else {
            $data['status'] = false;
            $data['message'] = "File tidak dikenali sebagai file yang valid";    
            echo json_encode($data);
            return false;
        }
                    
        $data['status'] = true;
        $data['images'] = $image;
        $data['type']   = $type;
        $data['size']   = $size;
        return $data;
    }


}
?>

