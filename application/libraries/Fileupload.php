<?php defined('BASEPATH') or exit('No direct script access allowed');

class Fileupload
{

    // To load this model
    // $this->fileupload->do_upload($upload_path = 'assets/images/profile/', $field_name = 'userfile');

    function do_upload($upload_path = null, $field_name = null, $default_Config =  [])
    {
        if (empty($_FILES[$field_name]['name'])) {
            return null;
        } else {
            //-----------------------------
            $ci = &get_instance();
            $ci->load->helper('url');

            //folder upload
            $file_path = $upload_path . date('Y-m-d') . "/";
            if (!is_dir($file_path))
                mkdir($file_path, 0755, true);
            //ends of folder upload 

            //set config 
            if (valArr($default_Config)) {
                $config = $default_Config;
                $config['upload_path'] = $file_path;
            } else {
                $config = [
                    'upload_path'   => $file_path,
                    'allowed_types' => 'gif|jpg|png|jpeg|ico',
                    'max_filename'  => 5,
                    'overwrite'     => false,
                    'maintain_ratio' => true,
                    'encrypt_name'  => false,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true
                ];
            }
            // $config['upload_path'] = $file_path;
            $ci->load->library('upload', $config);

            if (!$ci->upload->do_upload($field_name)) {
                return false;
            } else {
                $file = $ci->upload->data();
                return $file_path . $file['file_name'];
            }
        }
    }

    public function do_resize($file_path = null, $width = null, $height = null, $thumb = false)
    {
        $ci = &get_instance();
        $ci->load->library('image_lib');
        $config = [
            'image_library'  => 'gd2',
            'source_image'   => $file_path,
            'create_thumb'   => $thumb, //true,//false
            'maintain_ratio' => false,
            'width'          => $width,
            'height'         => $height,
        ];
        $ci->image_lib->initialize($config);
        $ci->image_lib->resize();
    }
}
