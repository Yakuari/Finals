<?php
require_once __DIR__ . '/../database/booking-process.php';

class BookingHandler extends BookingProcess {
    public function handleBooking($name, $phone, $email, $date) {
        // Check if booking already exists
        if (!$this->checkBooking($email, $date)) {
            echo "<script>
                    alert('Booking Already Exists!');
                    window.location.href = '../booking_online.php?error=bookingexists';
                  </script>";
            exit();
        }
        

        // Proceed to create a new booking
        $this->setBooking($name, $phone, $email, $date);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    $handler = new BookingHandler();
    $handler->handleBooking($name, $phone, $email, $date);

    header("location: ../index.php");
    exit();
}
