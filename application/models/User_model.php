<?php
class User_model extends CI_Model {

        public $first_name;
        public $emailid;
        public $password;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function get_user()
        {
                $password = $this->input->post('psw');
                $emailid = $this->input->post('email');

                $this->db->where('emailid',$emailid);
                $this->db->where('password',$password);
                $query = $this->db->get('tb_users');
                $result = $query->row();

                return $result;//return $this->db->last_query();

        }

        public function insert_user()
        {
                $this->first_name = $this->input->post('first_name');
                $this->last_name = $this->input->post('last_name');
                $this->password = $this->input->post('psw');
                $this->emailid = $this->input->post('email');
                $this->mobileno = $this->input->post('mobileno');
                $this->address = $this->input->post('address');
                $this->country = $this->input->post('country');
                $this->state = $this->input->post('state');
                $this->city = $this->input->post('city');
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
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                $curl_response = curl_exec($curl);
                // Check for errors and display the error message
                if($errno = curl_errno($curl)) {
                    $error_message = curl_strerror($errno);
                    echo "cURL error ({$errno}):\n {$error_message}";
                }
                $curl_response = curl_exec($curl);
                curl_close($curl);
                return $curl_response;
        }

}
?>