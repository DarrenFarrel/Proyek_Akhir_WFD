<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            line-height: 1.6;
            color: #3A2D28;
            background-color: #F1EDE6;
            margin: 0;
            padding: 0;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            padding: 20px;
            background-color: #EBE3DB;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #D1C7BD;
        }
        .logo { 
            max-width: 150px;
            margin-bottom: 20px;
        }
        h1 {
            color: #3A2D28;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .booking-details { 
            background: #D1C7BD;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        h2, h3 {
            color: #3A2D28;
        }
        .footer { 
            margin-top: 30px; 
            text-align: center; 
            font-size: 12px; 
            color: #A48374;
            padding-top: 20px;
            border-top: 1px solid #D1C7BD;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: #CBAD8D;
            color: #3A2D28;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .highlight {
            color: #A48374;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="badge">CONFIRMED</span>
            <h1>Booking Confirmation</h1>
            <p>Thank you for choosing The Westin Jakarta</p>
        </div>
        
        <div class="booking-details">
            <h2>Booking #{{ $booking->booking_number }}</h2>
            <p><strong>Guest:</strong> {{ $booking->user->name }}</p>
            <p><strong>Room:</strong> {{ $booking->room->roomType->name }} (Room {{ $booking->room->room_number }})</p>
            <p><strong>Check-in:</strong> <span class="highlight">{{ $booking->check_in->format('l, F j, Y') }}</span></p>
            <p><strong>Check-out:</strong> <span class="highlight">{{ $booking->check_out->format('l, F j, Y') }}</span></p>
            <p><strong>Duration:</strong> {{ $booking->nights }} nights</p>
            <p><strong>Total:</strong> <span class="highlight">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span></p>
            
            @if($booking->special_requests)
            <p><strong>Special Requests:</strong> {{ $booking->special_requests }}</p>
            @endif
        </div>
        
        <div class="checkin-info">
            <h3>Check-in Information</h3>
            <p>Check-in time is at 2:00 PM</p>
            <p>Please bring a valid ID for check-in</p>
        </div>
        
        <div class="footer">
            <p>The Westin Jakarta</p>
            <p>Jalan HR Rasuna Said Kav C-22, Jakarta 12940, Indonesia</p>
            <p>Phone: +62 21 2788 7788 | Email: reservation@westinjakarta.com</p>
        </div>
    </div>
</body>
</html>