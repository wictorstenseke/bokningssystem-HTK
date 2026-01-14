<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Reservation::truncate();
        
        $currentYear = (int) date('Y');
        $startYear = 2016;
        
        // Create bookings for each year from 2016 to current year
        for ($year = $startYear; $year <= $currentYear; $year++) {
            // Create 5-10 bookings per year
            $numBookings = rand(5, 10);
            
            for ($i = 0; $i < $numBookings; $i++) {
                $month = rand(1, 12);
                $day = rand(1, 28);
                $hour = rand(8, 20);
                $minute = rand(0, 59);
                
                $start = Carbon::create($year, $month, $day, $hour, $minute);
                $stop = clone $start;
                $stop->addHours(rand(1, 3));
                
                Reservation::create([
                    'name' => 'Test Bokning ' . $year . ' #' . ($i + 1),
                    'start' => $start,
                    'stop' => $stop,
                    'created_at' => $start->copy()->subHours(2),
                    'updated_at' => $start->copy()->subHours(2),
                ]);
            }
        }
        
        echo "Created bookings for years " . $startYear . " to " . $currentYear . "\n";
        echo "Total bookings: " . Reservation::count() . "\n";
    }
}
