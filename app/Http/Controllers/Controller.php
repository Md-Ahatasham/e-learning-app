<?php

namespace App\Http\Controllers;

use App\Models\Affect;
use App\Models\Behavior;
use App\Models\Notification;
use App\Models\PatientActivityLog;
use App\Models\Rounder;
use App\Models\RounderActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Store a patient image in storage.
     * @date: 18-03-2022
     * @param  \Illuminate\Http\Request  $request
     * @return $image_url
     */
    public function uploadPatientPhoto($photo, $previous_image = null)
    {
        try {
            $uploadPath = public_path('patient_picture/');
            $newFileName = time() . '.' . $photo->getClientOriginalExtension();
            $imageUrl = asset('patient_picture' . '/' . $newFileName);
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, '', true, true);
            }
            $photo->move($uploadPath, $newFileName);
            if (!empty($previous_image)) {
                $this->deleteImage($previous_image);
            }
            return $imageUrl;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function uploadUserPhoto($photo, $previous_image = null)
    {
        try {
            $uploadPath = public_path('profile_photo/');
            $newFileName = time() . '.' . $photo->getClientOriginalExtension();
            $imageUrl = asset('profile_photo' . '/' . $newFileName);
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, '0777', true, true);
            }
            $photo->move($uploadPath, $newFileName);
            if (!empty($previous_image)) {
                $this->deleteImage($previous_image, $forRounder = 1);
            }
            return $imageUrl;
        } catch (Exception $ex) {
            return false;
        }
    }


    public function uploadCertificate($certificate, $folder)
    {
        try {
            $uploadPath = public_path($folder.'/');
            $newFileName = time() . '.' . $certificate->getClientOriginalExtension();
            $imageUrl = asset($folder . '/' . $newFileName);

            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }
            $certificate->move($uploadPath, $newFileName);
            return $imageUrl;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Delete specific image
     * @date: 18-03-2022
     * @param  $image path
     * @return always true
     */
    public function deleteImage($imagePath, $forRounder = null)
    {
        $file_name = substr($imagePath, strrpos($imagePath, '/') + 1);
        if ($file_name != 'default_avatar.png') {
            if (!empty($forRounder)) {
                $actual_path = 'rounder_photos/' . $file_name;
            } else {
                $actual_path = 'patient_picture/' . $file_name;
            }
            File::delete($actual_path);
        }
        return true;
    }

    /**
     * calculate age
     * @date: 18-03-2022
     * @param  date
     * @return age
     */
    public function calculateAge($date)
    {
        return intval(date('Y', time() - strtotime($date))) - 1970;
    }

    /**
     * board array
     * @date: 18-03-2022
     * @return array
     */
    public function board(): array
    {
        return [
            '' => 'Select',
            'Dhaka' => 'Dhaka',
            'Mymensingh' => 'Mymensingh',
            'Sylhet' => 'Sylhet',
            'Rangpur' => 'Rangpur',
            'Barishal' => 'Barishal',
            'Cumilla' => 'Cumilla',
            'Rajshahi' => 'Rajshahi',
            'Chottogram' => 'Chottogram',
            'Dinajpur' => 'Dinajpur',
        ];
    }

    /**
     * Role array list
     * @date: 14-05-2022
     * @param  null
     * @return array
     */
    public function role()
    {
        return [
            ['id' => 'student', 'name' => 'Student'],
            ['id' => 'teacher', 'name' => 'Teacher'],
            ['id' => 'admin', 'name' => 'Admin']
        ];
    }

    /**
     * get patient status array
     * @date: 18-03-2022
     * @return array
     */
    public function educationalQualification(): array
    {
        return [
            '' => 'Select',
            'SSC' => 'SSC',
            'HSC' => 'HSC',
            'HONORS' => 'HONORS',
            'B.A' => 'B.A',
            'B.sc' => 'B.sc',
            'M.sc' => 'M.sc',
            'M.A' => 'M.A',
            'M.sc' => 'M.sc',
        ];
    }

    /**
     * Interval array
     * @date: 18-03-2022
     * @param  null
     * @return array
     *
     */
    public function intervalSchedule()
    {
        return [
            '15' => '15 Min',
            '30' => '30 Min',
            '45' => '45 Min',
            '60' => '60 Min',
        ];
    }

    /**
     * patient behaviour array
     * @date: 05-04-2022
     * @param  null
     * @return array
     */
    public function behaviour()
    {
        $behaviorList = Behavior::pluck('behavior_name', 'behavior_name')->all();
        $behavior = array();
        foreach ($behaviorList as $key => $row) {
            $behavior[] = $key;
        }
        return $behavior;
    }

    /**
     * patient affect array
     * @date: 05-04-2022
     * @param  null
     * @return array
     */
    public function affect()
    {
        $affectList = Affect::pluck('affect_name', 'affect_name')->all();
        $affect = array();
        foreach ($affectList as $key => $row) {
            $affect[] = $key;
        }
        return $affect;
    }

    public function language()
    {
        return [
            'Abkhazian' => 'Abkhazian',
            'Afar' => 'Afar',
            'Afrikaans' => 'Afrikaans',
            'Akan' => 'Akan',
            'Albanian' => 'Albanian',
            'Amharic' => 'Amharic',
            'Arabic' => 'Arabic',
            'Aragonese' => 'Aragonese',
            'Armenian' => 'Armenian',
            'Assamese' => 'Assamese',
            'Avaric' => 'Avaric',
            'Avestan' => 'Avestan',
            'Aymara' => 'Aymara',
            'Azerbaijani' => 'Azerbaijani',
            'Bambara' => 'Bambara',
            'Bashkir' => 'Bashkir',
            'Basque' => 'Basque',
            'Belarusian' => 'Belarusian',
            'Bengali' => 'Bengali',
            'Bislama' => 'Bislama',
            'Bosnian' => 'Bosnian',
            'Breton' => 'Breton',
            'Bulgarian' => 'Bulgarian',
            'Burmese' => 'Burmese',
            'Catalan' => 'Catalan',
            'Chinese' => 'Chinese',
            'Cree' => 'Cree',
            'Croatian' => 'Croatian',
            'Czech' => 'Czech',
            'Danish' => 'Danish',
            'English' => 'English',
            'Esperanto' => 'Esperanto',
            'Estonian' => 'Estonian',
            'Ewe' => 'Ewe',
            'Fijian' => 'Fijian',
            'French' => 'French',
            'Galician' => 'Galician',
            'Ganda' => 'Ganda',
            'Georgian' => 'Georgian',
            'German' => 'German',
            'Greek' => 'Greek',
            'Gujarati' => 'Gujarati',
            'Haitian' => 'Haitian',
            'Hausa' => 'Hausa',
            'Hebrew' => 'Hebrew',
            'Hindi' => 'Hindi',
            'Hungarian' => 'Hungarian',
            'Icelandic' => 'Icelandic',
            'Indonesian' => 'Indonesian',
            'Irish' => 'Irish',
            'Italian' => 'Italian',
            'Japanese' => 'Japanese',
            'Kannada' => 'Kannada',
            'Kanuri' => 'Kanuri',
            'Kashmiri' => 'Kashmiri',
            'Kazakh' => 'Kazakh',
            'Kongo' => 'Kongo',
            'Korean' => 'Korean',
            'Lao' => 'Lao',
            'Latin' => 'Latin',
            'Lithuanian' => 'Lithuanian',
            'Macedonian' => 'Macedonian',
            'Malagasy' => 'Malagasy',
            'Malay' => 'Malay',
            'Malayalam' => 'Malayalam',
            'Maori' => 'Maori',
            'Marathi' => 'Marathi',
            'Mongolian' => 'Mongolian',
            'Nepali' => 'Nepali',
            'Norwegian' => 'Norwegian',
            'Punjabi' => 'Punjabi',
            'Pashto' => 'Pashto',
            'Persian' => 'Persian',
            'Polish' => 'Polish',
            'Portuguese' => 'Portuguese',
            'Romansh' => 'Romansh',
            'Russian' => 'Russian',
            'Serbian' => 'Serbian',
            'Sindhi' => 'Sindhi',
            'Slovak' => 'Slovak',
            'Slovenian' => 'Slovenian',
            'Somali' => 'Somali',
            'Spanish' => 'Spanish',
            'Swedish' => 'Swedish',
            'Tajik' => 'Tajik',
            'Tamil' => 'Tamil',
            'Tatar' => 'Tatar',
            'Telugu' => 'Telugu',
            'Thai' => 'Thai',
            'Tibetan' => 'Tibetan',
            'Tigrinya' => 'Tigrinya',
            'Turkish' => 'Turkish',
            'Uighur' => 'Uighur',
            'Ukrainian' => 'Ukrainian',
            'Urdu' => 'Urdu',
            'Uzbek' => 'Uzbek',
            'Vietnamese' => 'Vietnamese',
        ];
    }

    /**
     * check from where the request is commming
     * @date:01-04-2022
     * @param null
     * return boolean
     */

    public function checkIncommingRequest()
    {
        $incomming = explode('/', url()->previous());
        if (isset($incomming[4])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * patient activity log
     * @date: 11-04-2022
     * @param  $patient_id
     * @return boolean
     */
    public function patientActivityLog($patient_id, $event, $addOrUpdate = null)
    {
        $prepareData = array('patient_id' => $patient_id, 'date' => Carbon::now(), 'event' => $event, 'entry_by' => Auth::user()->id);
        PatientActivityLog::create($prepareData);
        if ($addOrUpdate == 1) {
            $intervalData = array('patient_id' => $patient_id, 'date' => Carbon::now(), 'event' => "Patient Interval Time Added", 'entry_by' => Auth::user()->id);
            PatientActivityLog::create($intervalData);
        }
        return true;
    }

    /**
     * Get gender name id numeric number.
     * @date: 12-04-2022
     * @return string;
     */

    public function getGender($gender)
    {
        if ($gender->gender == 1) {
            return "Male";
        } elseif ($gender->gender == 2) {
            return "Female";
        } elseif ($gender->gender == 3) {
            return "TransGender M->F";
        } else {
            return "TransGender F->M";
        }
    }

    /**
     * store rounder activity log .
     * @date: 27-04-2022
     * @return boolean;
     */

    public function storeRounderActivityLog($rounder_id, $event, $transfer_to = null)
    {
        $tablet_name = Rounder::where('user_id', $rounder_id)->first();
        if ($transfer_to != "") {
            $to_tablet = Rounder::where('user_id', $transfer_to)->first();
            $event = "Patient Transfer to " . $to_tablet->assign_tab;
        }
        RounderActivityLog::create(['rounder_id' => $rounder_id, 'tablet_name' => $tablet_name->assign_tab, 'event' => $event, 'entry_by' => $rounder_id]);
    }

    public function getBreadcrumb($breadcrumb=null,$title=null): array
    {
        $data['breadcrumb'] = $breadcrumb;
        $data['title'] = $title;
        return $data;
    }
}
