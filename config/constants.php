<?php

return [
    'STATUS_OPTIONS_en' => [
        1 => 'Active',
        2 => 'Pending',
        3 => 'Suspend',
        4 => 'Unverified',
        5 => 'Delete'
    ],

    'STATUS_OPTIONS_es' => [
        1 => 'Aktif',
        2 => 'Askıda olması',
        3 => 'Askıya almak',
        4 => 'Doğrulanmamış',
        5 => 'Deleted'
    ],

    'USER_STATUS' => [
        'Active'     => 1,
        'Pending'    => 2,
        'Suspend'    => 3,
        'Unverified' => 4,
        'Deleted'     => 5
    ],

    // in progress mean route is active...
    'QUOTE_STATUS_en' => [
        1 => 'In Progress',
        2 => 'Pending',
        3 => 'Completed',
        4 => 'Deleted'
    ],
    'QUOTE_STATUS_es' => [
        1 => 'Devam etmekte',
        2 => 'Askıda Olması',
        3 => 'Tamamlanmış',
        4 => 'Silindi'
    ],
    'QUOTE_STATUS' => [
        'In Progress' => 1,
        'Pending'     => 2,
        'Completed'   => 3,
        'Deleted'     => 4
    ],


    'ADDRESS_STATUS_en' => [
        1 => 'On Going',
        2 => 'Pending',
        3 => 'Completed',
        4 => 'Skipped'
    ],
    'ADDRESS_STATUS_es' => [
        1 => 'Devam Ediyor',
        2 => 'Beklemede',
        3 => 'Tamamlandı',
        4 => 'Atlandı'
    ],
    'ADDRESS_STATUS' => [
        'On Going' => 1,
        'Pending'  => 2,
        'Completed' => 3,
        'Skipped' => 4
    ],

    'SERVICES' => [
        1 => 'Digital Marketing',
        2 => 'Graphic Designing',
        3 => 'Website Development',
        4 => 'Search Engine Optimization',
        5 => 'App Development',
    ],

    'CONTRACTS' => [
        1 => 'One-time',
        2 => 'Monthly',
        3 => '3 Months',
        4 => '6 months',
        5 => 'Yearly',
    ],

    'INVOICES' => [
        1 => 'Daily Wages',
        2 => 'Weekly',
        3 => 'Monthly',
        4 => '6 months',
        5 => 'Yearly',
    ],

    'SERVICE_TYPES' => [
        '1' => 'Quote',
        '2' => 'Contract',
        '3' => 'Invoice',
    ],

    'LOCATIONS' => [
        'PK' => 'Pakistan',
        'ISB' => 'Islamabad',
        'UAE' => 'United Arab Emirates',
        'USA' => 'United States',
        'UK' => 'United Kingdom',
        'SA' => 'Saudi Arabia',
        'CAN' => 'Canada',
        'AUS' => 'Australia',
        'ERU' => 'Europe',
        'CHN' => 'China'
    ],

    'LOCATION_TYPES' => [
        '1' => 'Default',
        '2' => 'Permanent',
        '3' => 'Temporary',
    ],

    'CURRENCIES' => [
        'PKR' => 'Pakistani Rupee',
        'USD' => 'United States Dollar',
        'EUR' => 'Euro',
        'JPY' => 'Japanese Yen',
        'GBP' => 'British Pound Sterling',
        'AUD' => 'Australian Dollar',
        'CAD' => 'Canadian Dollar',
        'CHF' => 'Swiss Franc',
        'CNY' => 'Chinese Yuan Renminbi',
        'AED' => 'United Arab Emirates Dirham',
    ],

    'CURRENCY_TYPES' => [
        '1' => 'Default',
        '2' => 'Basic',
        '3' => 'Aditional',
    ],

    'PAYPAL' => [
        'CLIENT_ID' => 'AX5AHiCaQb9E7Y01nr0-X_ibBPgRuuU5bb-K0K6xcS5Yo4zUOwSZh7nOJg-QgfD4-7EEosSR0BBdZ9Ki',
        'CLIENT_SECRET' => 'EKIvOEbvrlTb3kdmxRMOtAHePyjViFWH2AveI8GX566SVcqxTVwA8CmSaOGS-sx-CZw9HLu__o-4ZcuT',
        'CURRENCY' => 'EUR'
    ],

    'TEMPLATE_FOR' => [
        1 => 'Quotation',
        2 => 'Contract',
        3 => 'Invoce'
    ],

    'TEMP_SAVE_AS' => [
        1 => 'Self',
        2 => 'Common',
    ],

    'TEMP_SAVE_AS_NAME' => [
        'Draft' => 1,
        'Common' => 2,
        'Self' => 3
    ],

    'TEMP_STATUS' => [
        'Active' => 1,
        'Deactive' => 2
    ],

    'STATUS' => [
        'Active' => 1,
        'Deactive' => 2,
        'Deleted' => 3
    ],
    
    'APP_STATUS' => [
        'In Process'=>1,
        'Pending'=>2,
        'Submitted'=>3,
    ],
    
    'APP_STATUS_NAME' => [
        1 => 'In Process',
        2 => 'Pending',
        3 => 'Submitted',
    ],
    'APP_STATUS_TYPE' => [
        1 => 'Application',
        // 2 => 'Appointment',
        3 => 'Pending Appointment',
        // 4 => 'Scheduled Appointment',
        5 => 'Hotel Booking',
    ],
    
    'VISA_STATUS'=>[
        'Approved'=>1,
        'Refused'=>2,
        'Administrative Processing'=>3,
    ],
    
    'VISA_STATUS_NAME'=>[
        1 => 'Approved',
        2 => 'Refused',
        3 => 'Administrative Processing',
    ],
    
    'COUNTRIES' => [
        ['name' => 'Australia', 'code' => 'AU'],
        ['name' => 'Austria', 'code' => 'AT'],
        ['name' => 'Azerbaijan', 'code' => 'AZ'],
        ['name' => 'Bahrain', 'code' => 'BH'],
        ['name' => 'Belgium', 'code' => 'BE'],
        ['name' => 'Brazil', 'code' => 'BR'],
        ['name' => 'Bulgaria', 'code' => 'BG'],
        ['name' => 'Cambodia', 'code' => 'KH'],
        ['name' => 'Canada', 'code' => 'CA'],
        ['name' => 'China', 'code' => 'CN'],
        ['name' => 'Czech Republic', 'code' => 'CZ'],
        ['name' => 'Denmark', 'code' => 'DK'],
        ['name' => 'Egypt', 'code' => 'EG'],
        ['name' => 'Estonia', 'code' => 'EE'],
        ['name' => 'Finland', 'code' => 'FI'],
        ['name' => 'France', 'code' => 'FR'],
        ['name' => 'Germany', 'code' => 'DE'],
        ['name' => 'Greece', 'code' => 'GR'],
        ['name' => 'Hungary', 'code' => 'HU'],
        ['name' => 'Iceland', 'code' => 'IS'],
        ['name' => 'Indonesia', 'code' => 'ID'],
        ['name' => 'Iran', 'code' => 'IR'],
        ['name' => 'Iraq', 'code' => 'IQ'],
        ['name' => 'Ireland', 'code' => 'IE'],
        ['name' => 'Italy', 'code' => 'IT'],
        ['name' => 'Japan', 'code' => 'JP'],
        ['name' => 'Jordan', 'code' => 'JO'],
        ['name' => 'Kazakhstan', 'code' => 'KZ'],
        ['name' => 'Kenya', 'code' => 'KE'],
        ['name' => 'Korea, South', 'code' => 'KR'],
        ['name' => 'Kuwait', 'code' => 'KW'],
        ['name' => 'Kyrgyzstan', 'code' => 'KG'],
        ['name' => 'Lebanon', 'code' => 'LB'],
        ['name' => 'Luxembourg', 'code' => 'LU'],
        ['name' => 'Malaysia', 'code' => 'MY'],
        ['name' => 'Maldives', 'code' => 'MV'],
        ['name' => 'Mauritius', 'code' => 'MU'],
        ['name' => 'Morocco', 'code' => 'MA'],
        ['name' => 'Netherlands', 'code' => 'NL'],
        ['name' => 'New Zealand', 'code' => 'NZ'],
        ['name' => 'Norway', 'code' => 'NO'],
        ['name' => 'Oman', 'code' => 'OM'],
        ['name' => 'Pakistan', 'code' => 'PK'],
        ['name' => 'Philippines', 'code' => 'PH'],
        ['name' => 'Poland', 'code' => 'PL'],
        ['name' => 'Portugal', 'code' => 'PT'],
        ['name' => 'Qatar', 'code' => 'QA'],
        ['name' => 'Romania', 'code' => 'RO'],
        ['name' => 'Russia', 'code' => 'RU'],
        ['name' => 'Singapore', 'code' => 'SG'],
        ['name' => 'South Africa', 'code' => 'ZA'],
        ['name' => 'Spain', 'code' => 'ES'],
        ['name' => 'Sri Lanka', 'code' => 'LK'],
        ['name' => 'Sweden', 'code' => 'SE'],
        ['name' => 'Switzerland', 'code' => 'CH'],
        ['name' => 'Syria', 'code' => 'SY'],
        ['name' => 'Taiwan', 'code' => 'TW'],
        ['name' => 'Thailand', 'code' => 'TH'],
        ['name' => 'Turkey', 'code' => 'TR'],
        ['name' => 'Ukraine', 'code' => 'UA'],
        ['name' => 'United Arab Emirates', 'code' => 'AE'],
        ['name' => 'United Kingdom', 'code' => 'GB'],
        ['name' => 'United States of America', 'code' => 'US'],
        ['name' => 'Uzbekistan', 'code' => 'UZ'],
        ['name' => 'Vietnam', 'code' => 'VN'],
    ],
    'VFSEMBASSY' => [
        'Gerry’s Islamabad',
        'Gerry’s Lahore',
        'Gerry’s Faisalabad',
        'Gerry’s Gujranwala',
        'Gerry’s Hyderabad',
        'Gerry’s Multan',
        'Gerry’s Sialkot',
        'Gerry’s Sukkur',
        'Gerry’s Quetta',
        'Gerry’s Mirpur',
        'Gerry’s Karachi',
        'AEG Islamabad',
        'AEG Lahore',
        'AEG Faisalabad',
        'AEG Gujranwala',
        'AEG Hyderabad',
        'AEG Multan',
        'AEG Sialkot',
        'AEG Peshawar',
        'AEG Quetta',
        'AEG Karachi',
        'Anatolia Islamabad',
        'Anatolia Lahore',
        'Anatolia Faisalabad',
        'Anatolia Gujranwala',
        'Anatolia Hyderabad',
        'Anatolia Sialkot',
        'Anatolia Peshawar',
    ],
    'CATEGORIES' => [
        ['name' => 'Tourist', 'type' => 'VISA'],
        ['name' => 'Business', 'type' => 'VISA'],
        ['name' => 'Family & Friend', 'type' => 'VISA'],
        ['name' => 'Work', 'type' => 'VISA'],
        ['name' => 'Family Reunion', 'type' => 'VISA'],
        ['name' => 'Interview Waiver', 'type' => 'VISA'],
        ['name' => 'Previously Refused', 'type' => 'VISA'],
        ['name' => 'Fresh', 'type' => 'VISA'],
        ['name' => 'Relative Permit', 'type' => 'VISA'],
        ['name' => 'Fresh', 'type' => 'DS160'],
        ['name' => 'Refused', 'type' => 'DS160'],
        ['name' => 'Waiver', 'type' => 'DS160'],
    ],
];
