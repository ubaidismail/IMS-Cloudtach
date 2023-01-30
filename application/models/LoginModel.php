<?php
class LoginModel extends CI_Model
{

	function get_user_login_details($name, $pass)
	{
		// if(!empty($name && $pass)){
		$query = $this->db->get_where('cd_register', ['name' => $name, 'password' => $pass])->result();
		return $query;
		// }
	}
	function add_data_to_databse($email_address, $name ,$pass )
	{
		$data = array(
			'user_role' => 'client',
			'name' => $name,
			'email' => $email_address,
			'password' => $pass,
			'email_status' => '0',
		);
		$q = $this->db->insert('cd_register', $data);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	function get_user_roles($name, $pass)
	{
		// $this->db->where('user_role', 'Account_activation');
		$this->db->select('user_role');
		$q = $this->db->get_where('cd_register', ['name' => $name, 'password' => $pass])->result();
		return $q;
	}

	function update_email_status($user_id){
		$data = array(
            'email_status' => 1,
        );

        $this->db->where('user_id', $user_id);
        $res = $this->db->update('cd_register', $data);
        return $res;

	}
}
