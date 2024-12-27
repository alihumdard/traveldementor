<?php
function table_date($datetime)
{
    $date = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $datetime);
    if ($date instanceof DateTime) {
        return $date->format('M d, Y');
    } else {
        return 'Invalid datetime';
    }
}

function end_url()
{
    return url('/api') . '/';
}

function user_roles($role_no)
{
    switch ($role_no) {
        case 1:
            return 'Super Admin';
        case 2:
            return 'Staff';
        case 3:
            return 'User';
        default:
            return false;
    }
}

function auth_users()
{
    // status : 1 for active , 2 for pending, 3 for suspended , 4 for unverified ,5 for delete ...
    $user_status =  [1, 2];
    return $user_status;
}

function active_users()
{
    // status : 1 for active , 2 for pending, 3 for suspended , 4 for unverified ,5 for delete ...
    $user_status =  [1];
    return $user_status;
}

function user_role_no($role_no)
{
    switch ($role_no) {
        case 'Super Admin':
            return 1;
        case 'Staff':
            return 2;
        case 'User':
            return 3;
        default:
            return false;
    }
}

function view_permission($page_name)
{
    $user_role = Auth()->User()->role;
    switch ($user_role) {
        case 'Super Admin':
            switch ($page_name) {
                case 'index':
                case 'users':
                case 'staff':
                case 'currencies':
                case 'locations':
                case 'settings':
                case 'vfs':
                case 'categories':
                case 'countries':
                case 'application':
                case 'schedule_appointment':
                case 'pending_appointment':
                case 'insurance':
                case 'tracking':
                case 'blank-temp':
                    return true;
                default:
                    return false;
            }

        case 'Staff':
            switch ($page_name) {
                case 'index':
                    return true;
                default:
                    return false;
            }

        case 'User':
            switch ($page_name) {
                case 'index':
                    return true;

                default:
                    return false;
            }

        default:
            return false;
    }
}
