<?php
Class Upload_library
{
    var $CI = ''; 
    function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->library('upload');
    }
    
  



    function upload($upload_path, $file_name = '', $dau = '')
    {
        // $_FILES['img_a_Profile']['name'] = $dau . time();
        //pre($upload_path);
        if (!file_exists($upload_path)){
            @mkdir($upload_path, 0777, true);
        }
        $config = $this->config($upload_path, $dau);
        // if($upload_path == './upload/minhchung'){
        //     pre($config);
        // } else if($upload_path == './upload/hoso'){
        //     pre($config);
        // }
        $this->CI->upload->initialize($config);

        //thuc hien upload
        if($this->CI->upload->do_upload($file_name))
        {

            $data = $this->CI->upload->data();
        }else{
            //khong upload thanh cong
            $data = $this->CI->upload->display_errors();
        }
        return $data;
        
    }
    
    /*
     * Upload nhieu file
     * @$upload_path : Duong dan luu file
     * @$file_name : ten the input upload file
     */
    function upload_file($upload_path = '', $file_name = '')
    {
        if (!file_exists($upload_path)){
            @mkdir($upload_path, 0777, true);
        }
        //lay thong tin cau hinh upload
        $config = $this->config($upload_path);

        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES['image_list'];
        $count = count($file['name']);//lấy tổng số file được upload
        
        $image_list = array(); //luu ten cac file anh upload thanh cong
        for($i=0; $i<=$count-1; $i++) {
        
            $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
            $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
            $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
            $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
            //load thư viện upload và cấu hình
            $this->CI->load->library('upload', $config);
            //thực hiện upload từng file
            if($this->CI->upload->do_upload())
            {
                //nếu upload thành công thì lưu toàn bộ dữ liệu
                $data = $this->CI->upload->data();
                //in cấu trúc dữ liệu của các file
                $image_list[] = $data['file_name'];
            }
        }
        return $image_list;
    }
    
    /*
     * Cau hinh upload file
     */
    function config($upload_path = '', $dau = '')
    {
        //Khai bao bien cau hinh
        $config = array();
        //thuc mục chứa file
        $config['upload_path']   = $upload_path;
        //Định dạng file được phép tải
        $config['allowed_types'] = 'jpg|jpeg|png';
        //Dung lượng tối đa
        $config['max_size']      = '1200000';
        //Chiều rộng tối đa
        $config['max_width']     = '10280';
        //Chiều cao tối đa
        $config['max_height']    = '10280';

        // $random = time();
        // $random = time();
        // $new_name = $dau. "-" .$random;
        // $config['file_name'] = $new_name;
        // $random = $dinhDanh;
        $new_name = $dau;
        $config['file_name'] = $new_name;
        
        return $config;
    }
}
