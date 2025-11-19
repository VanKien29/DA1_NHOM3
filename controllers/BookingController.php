<?php
class BookingController
{
    private $bookingQuery;

    function __construct()
    {
        $this->bookingQuery = new BookingQuery();
    }

    public function listBooking()
    {
        $bookings = $this->bookingQuery->getAllBooking();
        require './views/Booking/ListBooking.php';
    }

    public function detailBooking() {
    $id = $_GET['id'];

    $booking = $this->bookingQuery->getBooking($id);
    $guide = $this->bookingQuery->getGuideByBooking($id);
    $customers = $this->bookingQuery->getBookingCustomers($id);
    $attendance = $this->bookingQuery->getAttendance($id);
    require './views/Booking/DetailBooking.php';
    }


}
?>