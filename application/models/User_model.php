<?php
class User_model extends CI_Model {

        public $name;
        public $emailid;
        public $password;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_user()
        {
                $this->name = $this->input->post('name');
                $this->password = $this->input->post('psw');
                $this->emailid = $this->input->post('email');
                $this->db->insert('tb_users', $this);

        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }

        public function getCountries()
        {
                $url = 'https://geodata.solutions/api/api.php?type=getCountries';
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $curl_response = curl_exec($curl);
                curl_close($curl);
                return $curl_response;
        }

}
?>