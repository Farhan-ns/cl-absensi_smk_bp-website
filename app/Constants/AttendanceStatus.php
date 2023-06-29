<?php 

namespace App\Constants;

class AttendanceStatus {
    /** @var int $PRESENT Hadir */
    public static $PRESENT = 1;

    /** @var int $ABSENT Tidak Hadir */
    public static $ABSENT = 2;

    /** @var int $PTO_LEAVE Izin Cuti */
    public static $PTO_LEAVE = 3;

    /** @var int $SICK_LEAVE Izin Sakit */
    public static $SICK_LEAVE = 4;

    /** @var int $OFFICIAL_LEAVE Izin Dinas */
    public static $OFFICIAL_LEAVE = 5;

    /** @var int $OTHER_LEAVE Izin lain-lain */
    public static $OTHER_LEAVE = 6;

    /** @var int $LATE_CHECKIN Telat Checkin */
    public static $LATE_CHECKIN = 7;

    /** @var int $LATE_CHECKOUT Telat Checkout */
    public static $LATE_CHECKOUT = 8;

    /** @var int $CHECKOUT Normal Checkout */
    public static $CHECKOUT = 9;

    /** @var int $EARLY_CHECKOUT Normal Checkout */
    public static $EARLY_CHECKOUT = 10;
}

