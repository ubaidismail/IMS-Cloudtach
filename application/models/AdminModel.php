<?php
class AdminModel extends CI_Model
{

    function get_user_data()
    {
        $query = $this->db->get('cd_register')->result();
        return $query;
    }
    function getData()
    {
        $query = $this->db->get('user_attendance')->result();
        return $query;
    }


    function add_invoice_data(
        $user_id,
        $to,
        $address,
        $rece_phone,
        $invoice_type,
        $project,
        $qty,
        $price,
        $total,
        $sub_total,
        $tax_amount,
        $shipping_cost,
        $total_amount,
        $date_now
    ) {
        $project_name = implode(", ", $project);
        $qty2 = implode(", ", $qty);
        $price2 = implode(", ", $price);
        $total2 = implode(", ", $total);
        $data = array(
            'user_id' => $user_id,
            'company_name' => $to,
            'address' => $address,
            'client_phone' => $rece_phone,
            'project' => $project_name,
            'qty' => $qty2,
            'price' => $price2,
            'total' => $total2,
            'sub_total' => $sub_total,
            'tax_amount' => $tax_amount,
            'shipping_cost' => $shipping_cost,
            'total_amount' => $total_amount,
            'invoice_type' => $invoice_type,
            'date' => $date_now,
        );
            $this->db->insert('ct_invoice', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        
       
    }

    function get_invoice_data($user_id)
    {
        // $query = $this->db->get('ct_invoice')->result();
        // $this->db->select('st');
        $this->db->where('status', 1);
        $this->db->from('ct_invoice_logo');
        $this->db->join('ct_invoice', 'ct_invoice_logo.user_id = ct_invoice.user_id' , 'cross');
        $query = $this->db->get()->result();
        // print_r($query);
        return $query;
    }
    // ******* academu Fee *******
    function add_fee_data($st_name, $address, $st_phone, $date, $no_of_mont, $fee, $total_fee)
    {
        $date = implode(", ", $date);
        $no_of_mont = implode(", ", $no_of_mont);
        $fee = implode(", ", $fee);
        $total_fee = implode(", ", $total_fee);

        $data = array(
            'student_name' => $st_name,
            'address' => $address,
            'phone' => $st_phone,
            'fee_of_month' => $date,
            'month_count' => $no_of_mont,
            'fee' => $fee,
            'total' => $total_fee,
        );
        $this->db->insert('ct_academy_fee', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function get_fee_data()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('ct_academy_fee')->result();
        return $query;
    }

    function delete_invoice($id)
    {

        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('ct_invoice'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }

    function delete_acd_fee($id)
    {

        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('ct_academy_fee'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }
    function add_custom_company_logo_to_inv($userid, $image)
    {

        $this->db->where('user_id', $userid);
        $query = $this->db->get('ct_invoice_logo')->result();
        if($query){

            $this->db->set('company_logo', $image);
            $this->db->where('user_id', $userid);
            $this->db->update('ct_invoice_logo');
            
            return true;
        }else{
                $data = array(
                    'user_id' => $userid,
                    'company_logo' => $image,
                );
                $this->db->insert('ct_invoice_logo', $data);
                $insert_id = $this->db->insert_id();
                return $insert_id;
        }
    }
    function get_img_for_inv_logo($userid){
        
        $this->db->where('user_id', $userid);
        $query = $this->db->get('ct_invoice_logo')->result();
        return $query;
    }
    function remove_logo_inv($user_id){
        $this->db->set('company_logo', '');
        $this->db->where('user_id', $user_id);
        $this->db->update('ct_invoice_logo');
        return true;
    }

    function get_data_downloading_invoice($invoice_id){
        $this->db->where('ct_invoice.id', $invoice_id);
        $this->db->from('ct_invoice_logo');
        $this->db->join('ct_invoice', 'ct_invoice_logo.user_id = ct_invoice.user_id' , 'cross');
        $result = $this->db->get()->result();
        return $result;
    }
}
