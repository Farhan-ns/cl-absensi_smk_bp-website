<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ABSENSI_LATE_LIMIT_IN_MINUTES
    |--------------------------------------------------------------------------
    |
    | How many minutes for submitted presence to be marked as Late,
    | If submitted above Checkin Limit
    |
    */
    'ABSENSI_LATE_LIMIT_IN_MINUTES' => env('ABSENSI_LATE_LIMIT_IN_MINUTES', 30),
];