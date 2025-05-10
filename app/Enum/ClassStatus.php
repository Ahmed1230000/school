<?php

namespace App\Enum;

enum ClassStatus: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case RESERVED = 'reserved';
    case MAINTENANCE = 'maintenance';
    case UNDER_CONSTRUCTION = 'under_construction';
    case DECOMMISSIONED = 'decommissioned';
}