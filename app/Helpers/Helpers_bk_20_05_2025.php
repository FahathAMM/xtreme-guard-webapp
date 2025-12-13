<?php

use App\Models\Setting\Setting;
use App\Models\Category\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getBrowser')) {

    function getBrowser()
    {
        $userAgent =  request()->header('User-Agent');
        $pattern = "/(MSIE|Trident|Firefox|Chrome|Safari|Opera)/i";
        $log_browser = "";

        if (preg_match($pattern, $userAgent, $matches)) {
            $log_browser =  $matches[0];
        }

        return $log_browser;
    }
}

if (!function_exists('pdfToBase64')) {
    function pdfToBase64($pdfPath)
    {
        return  $b64Doc = chunk_split(base64_encode(file_get_contents($pdfPath)));
    }
}

if (!function_exists('logActivity')) {

    function logActivity($log_form_name = "", $log_form_record_code = "", $log_action = "",  $log_form_record_detail = "",  $log_user = "")
    {
        $log_user = auth()->user();
        $log_cdate = now();

        $userAgent =  request()->header('User-Agent');
        $pattern = "/(MSIE|Trident|Firefox|Chrome|Safari|Opera)/i";

        if (preg_match($pattern, $userAgent, $matches)) {
            $log_browser =  $matches[0];
        }

        $msg = " | ";
        $msg .= 'userID: ' . $log_user->id . " | ";
        $msg .= 'userName: ' . $log_user->full_name . " | ";
        $msg .= 'formName: ' . $log_form_name . " | ";
        $msg .= 'formRecordID: ' . $log_form_record_code . " | ";
        $msg .= 'Action: ' . $log_action . " | ";
        $msg .= 'formRecordDesc: ' . $log_form_record_detail . " | ";
        $msg .= 'Date: ' . $log_cdate . " | ";


        if ($log_user) {
            DB::table('user_logs')->insert([
                'user_id'        => $log_user->id,
                'user_name'      => $log_user->full_name,
                'form_name'      => $log_form_name,
                'form_record_id'      => $log_form_record_code,
                'log_action'     => $log_action,
                'browser'        => $log_browser,
                'create_date'    => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        Log::channel('userActivity')->info($msg);
    }
}

if (!function_exists('can')) {
    function can($per = '')
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            return true;
        }

        $LoggedUserAccesspermissions = collect(auth()->user()->getPermissionsViaRoles()->toArray())
            ->pluck('name')->unique()->values()->toArray();

        return  in_array($per, $LoggedUserAccesspermissions);
    }
}

if (!function_exists('getSolutionForHeader')) {
    function getSolutionForHeader()
    {
        $solutionTypes = [
            ['id' => 'time-management', 'name' => 'Time Management'],
            ['id' => 'people-counting-solution', 'name' => 'People Counting Solution'],
            ['id' => 'access-control-management', 'name' => 'Access Control Management'],
            ['id' => 'cloud-based-time-attendance-solution', 'name' => 'Cloud-based Time Attendance Solution'],
            ['id' => 'visitor-management-system', 'name' => 'Visitor Management System'],
            ['id' => 'elevator-control', 'name' => 'Elevator Control'],
            ['id' => 'parking-management', 'name' => 'Parking Management'],
            ['id' => 'hotel-management', 'name' => 'Hotel Management'],
        ];

        return $solutionTypes;
    }
}

if (!function_exists('getCategoriesForHeader')) {
    function getCategoriesForHeader()
    {
        return Category::with('subcategories')->get();
    }
}

if (!function_exists('getParentCategories')) {
    function getParentCategories()
    {
        return Category::whereNull('parent_id')->get();
    }
}

if (!function_exists('currentUserID')) {
    function currentUserID()
    {
        return auth()->user()->id;
    }
}

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return  $user = auth()->user();
        // return  $user->load('roles');
    }
}

if (!function_exists('actionBtns')) {
    function actionBtns($id = "",  $editRouteName = '', $url = '', $deleteDisplayValue = "", $permission = [])
    {
        // <div class="fs-15 gap-3 hstack">
        //  <a href="javascript:void(0);" class="link-primary"><i class="ri-settings-4-line"></i></a>
        //  <a href="javascript:void(0);" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
        // </div>

        $btn = "";
        $btn .= "<div class='d-flex justify-content-center fs-15 gap-3 hstack'>";
        if ($permission['isEdit']) {
            //edit btn
            $btn .= '<a href="' . route($editRouteName, $id) . '"class="link-primary"  title="Edit"><i class="ri-pencil-line"></i></a>';
        }

        if ($permission['isDelete']) {
            //delete btn
            $btn .= '<a href="#" delete-url="' . url($url) . '" delete-item="' . $deleteDisplayValue . '" class="delete link-danger" id= "' . $id . '"  title="Delete"><i class="ri-delete-bin-5-line"></i></a>';
        }

        if ($permission['isView']) {
            //view btn
            $btn .= '<a href="' . url($url . '/' . $id) . '"class="link-info" title="View"><i class="ri-eye-line"></i></a>';
        }

        if ($permission['isPrint']) {
            //print btn
        }

        if ($permission['isTracking'] ?? false) {
            $btn .= '<a href="#" tracking-url="' . url($url) . '" tracking-item="' . $deleteDisplayValue . '" class="link-danger tracking" id= "' . $id . '"  title="Tracking"><i class="ri-download-cloud-2-line"></i></a>';
        }

        if ($permission['isExtra'] ?? false) {
            //extra btn
            $btn .= '<a href="' . url($permission['isExtra']['url'] . '/' . $id) . '"class="btn btn-outline-primary btn-sm" title="' . $permission['isExtra']['title'] . '"><i class="' . $permission['isExtra']['icon'] . '"></i></a>';
        }

        $btn .= "</div>";
        return $btn;
    }
}

if (!function_exists('addBtn')) {
    function addBtn($title, $isAdd = false, $routeName = "")
    {
        if ($isAdd) {
            // Add button
            $className = 'btn btn-primary buttons-excel buttons-html5 bg-primary text-white border-primary me-1 ms-1';
            return '<a class="' . $className . '" href="' . route($routeName) . '" title="Add ' . $title . '">
            <i class="fa-lg fa-plus-circle fas" style="font-size: 12px;"></i> </a>';
        }
        return "";
    }
}

if (!function_exists('convertToSqlDateFormat')) {
    function convertToSqlDateFormat($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}

if (!function_exists('displayDateFormat')) {
    function displayDateFormat($date)
    {
        return  $date ? date('d-m-Y', strtotime($date)) : "";
    }
}

if (!function_exists('currentDate')) {
    function currentDate()
    {
        return date('d-m-Y');
    }
}

if (!function_exists('getTimeFromDate')) {
    function getTimeFromDate($date)
    {
        return  $date ? date('H:i', strtotime($date)) : "";
    }
}

if (!function_exists('dl')) {
    function dl($arr)
    {
        echo "<pre>" . json_encode($arr, JSON_PRETTY_PRINT) . "</pre>";
        // die;
    }
}

if (!function_exists('customEncrypt')) {
    function customEncrypt($pass)
    {
        $str = $pass;
        $key = '4QcTlzuaNUcX289Z9D0ovPCzb';
        $iv = "1234567812345678";
        $encryption_key = base64_encode($key);
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', $encryption_key, true, $iv);
        $encrypted_data = base64_encode($encrypted);
        return ($encrypted_data);
    }
}

if (!function_exists('ApplicationVersion')) {
    function ApplicationVersion()
    {
        return session('appVersion');
    }
}

if (!function_exists('downloadAndAddFileFromCdn')) {
    function downloadAndAddFileFromCdn()
    {
        return;

        $files = [
            'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js',
            'https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js',
            'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js',
            'https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js',
            'https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js',
            'https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js',
            'https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
            'https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.min.js',
            'https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js',
        ];

        $savePath = 'D:/Install/laragon/www/oms/public/assets/report/js/';

        foreach ($files as $file) {
            return  $filename = basename($file);
            file_put_contents($savePath . $filename, fopen($file, 'r'));
            echo "Downloaded<br>: $filename\n";
        }

        echo "All files have been downloaded.";
    }
}

if (!function_exists('clearLog')) {
    function clearLog()
    {
        $logPath = storage_path('logs/laravel.log');
        if (File::exists($logPath)) {
            File::put($logPath, '');
        }
    }
}

if (!function_exists('getYouTubeVideoId')) {
    function getYouTubeVideoId($url)
    {
        preg_match(
            '/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/]+\/.*\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches,
        );
        return $matches[1] ?? null;
    }
}

if (!function_exists('hasCountryCode')) {
    function hasCountryCode($phoneNumber)
    {
        return preg_match('/^\+\d{1,3}/', $phoneNumber);
    }
}
if (!function_exists('removeCountryCode')) {
    function removeCountryCode($phoneNumber)
    {
        return preg_replace('/^\+\d{1,3}/', '', $phoneNumber);
    }
}

if (!function_exists('defualtProductDesc')) {
    function defualtProductDesc()
    {
        return 'An advanced access control device designed for secure and efficient authentication, supporting various identification methods such as biometric scanning, RFID, PIN codes, and remote access management';
    }
}

if (!function_exists('getWhatsappNumber')) {
    function getWhatsappNumber()
    {
        // return Setting::where('key', $key)->whereIsActive(1)->value('value');
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        return Setting::where('key', $key)->whereIsActive(1)->value('value');
    }
}

// public function getBannerImgAttribute($value)
// {
//     // Define the default image URL
//     $defaultImage = 'https://xtremeguard.org/site/images/home/game13.png';

//     // Check if the value is empty
//     if (!$value) {
//         return $defaultImage;
//     }

//     // Check if the file exists in storage
//     if (Storage::exists('public/' . $value)) {
//         return asset('storage/' . $value);
//     } else {
//         return $defaultImage;
//     }
// }

if (!function_exists('getImgUrl')) {
    function getImgUrl($path)
    {
        $defaultImage = 'https://xtremeguard.org/site/images/home/game13.png';
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return $defaultImage;
        }
    }
}

if (!function_exists('formatFileSize')) {
    function formatFileSize($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('getFileIcon')) {
    function getFileIcon($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $icons = [
            'pdf' => 'https://cdn-icons-png.flaticon.com/512/337/337946.png',
            'doc' => 'https://cdn-icons-png.flaticon.com/512/337/337932.png',
            'docx' => 'https://cdn-icons-png.flaticon.com/512/337/337932.png',
            'xls' => 'https://cdn-icons-png.flaticon.com/512/337/337947.png',
            'xlsx' => 'https://cdn-icons-png.flaticon.com/512/337/337947.png',
            'ppt' => 'https://cdn-icons-png.flaticon.com/512/337/337935.png',
            'pptx' => 'https://cdn-icons-png.flaticon.com/512/337/337935.png',
            'jpg' => 'https://cdn-icons-png.flaticon.com/512/337/337940.png',
            'jpeg' => 'https://cdn-icons-png.flaticon.com/512/337/337940.png',
            'png' => 'https://cdn-icons-png.flaticon.com/512/337/337940.png',
            'gif' => 'https://cdn-icons-png.flaticon.com/512/337/337940.png',
            'zip' => 'https://cdn-icons-png.flaticon.com/512/888/888879.png',
            'rar' => 'https://cdn-icons-png.flaticon.com/512/888/888879.png',
            'exe' => 'https://cdn-icons-png.flaticon.com/512/4228/4228896.png',
            'txt' => 'https://cdn-icons-png.flaticon.com/512/136/136538.png',
        ];

        // Default icon if extension not matched
        return $icons[$extension] ?? 'https://cdn-icons-png.flaticon.com/512/833/833524.png';
    }
}
