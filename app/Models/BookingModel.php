<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'booking';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'atas_nama', 'pembuat', 'id_petugas', 'id_layanan1', 'id_layanan2', 'id_layanan3',
        'jadwal_booking', 'catatan', 'status', 'pengupdate', 'confirmed_at', 'returned_at'
    ];

    public function getBooking($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getBookingNo($id = false)
    {
        return $this->where('YEAR(created_at)', date("Y"))->like('booking_no', 'CS')->countAllResults();
    }

    public function getCountBooking($id = false)
    {
        if ($id == false) {
            return $this->countAllResults();
        }

        return $this->where(['pembuat' => $id])->where('YEAR(booking.created_at)', date('Y'))->countAllResults();
    }

    public function getCountLastBooking($id = false)
    {
        if ($id == false) {
            return $this->countAllResults();
        }

        return $this->where(['pembuat' => $id])->where('YEAR(booking.created_at)', date('Y') - 1)->countAllResults();
    }

    public function getCountBookingAll($id = false)
    {

        return $this->countAllResults();
    }



    public function getCountYearMonth2($year2, $month2)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year2)->where('MONTH(created_at)', $month2)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalYearMonth2($year2, $month2)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year2)->where('MONTH(created_at)', $month2)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalMonthYear2($year2, $month2)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year2)->where('MONTH(created_at)', $month2)->orderBy('created_at', 'ASC')->countAllResults();
    }
}
