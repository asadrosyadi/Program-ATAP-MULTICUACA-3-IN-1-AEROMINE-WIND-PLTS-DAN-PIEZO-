<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataModel extends CI_Model
{

    public function clearDataByEmail($email)
    {
        // Menghapus data berdasarkan email
        $this->db->where('HWID', $email);
        $this->db->delete('datasensor');
    }

    public function resetData()
    {
        // Set semua nilai arus_masuk menjadi 0
        $this->db->set('arus_masuk', 0);
        // Update semua data
        $this->db->update('datasensor');
    }
}
