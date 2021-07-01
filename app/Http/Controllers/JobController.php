<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobController extends Controller
{

    private $dev1;
    private $dev2;
    private $dev3;
    private $dev4;
    private $dev5;

    public function jobList()
    {

        // Data 1
        $data = file_get_contents('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        $jobListOne = [];
        foreach (json_decode($data) as $key => $value) {
            $aa = get_object_vars($value);
            $jobListOne[] = $aa;
        }

        // Data 2
        $data = file_get_contents("http://www.mocky.io/v2/5d47f235330000623fa3ebf7");
        $jobListTwo = [];
        foreach (json_decode($data) as $key => $value) {
            $aa = get_object_vars($value);
            $aa2 = $aa[array_key_first($aa)];
            $jobListTwo[] = [
                'zorluk' => $aa2->level,
                'sure' => $aa2->estimated_duration,
                'id' => array_key_first($aa),
            ];
        }

        $jobList = array_merge($jobListOne, $jobListTwo);

        $devList = [
            1 => [
                'sure' => 1,
                'zorluk' => 1
            ],

            2 => [
                'sure' => 1,
                'zorluk' => 2
            ],

            3 => [
                'sure' => 1,
                'zorluk' => 3
            ],

            4 => [
                'sure' => 1,
                'zorluk' => 4
            ],

            5 => [
                'sure' => 1,
                'zorluk' => 5
            ]
        ];

        $this->_distribute($devList, $jobList);

        $dev1 = $this->dev1;
        $dev2 = $this->dev2;
        $dev3 = $this->dev3;
        $dev4 = $this->dev4;
        $dev5 = $this->dev5;

        $general_data = [
            'time' => $this->_generalDeveloperTime(),
            'week' => $this->_generalDeveloperWeek(),
            'totalJob' => $this->_developerTotalJob(),
            'averageWeek' => $this->_developerAverageWeek(),
            'totalProjectTime' => $this->_totalProjectTime(),
        ];

        return view('job-list', compact('jobList','dev1','dev2','dev3','dev4','dev5','general_data'));
    }

    private function _distribute($devList, $jobList)
    {
        $devAndJobList = [];

        // Zorluk derecesine göre işler developer lara paylaştırıldı ve $devAndJobList dizi sine atıldı
        foreach ($jobList as $key => $job) {
            foreach ($devList as $devKey => $dev) {
                if ($job['zorluk'] == $dev['zorluk']) {
                    $devAndJobList [] = [
                        'is_id' => $job['id'],
                        'dev_id' => $devKey,
                    ];
                }
            }
        }

        //
        foreach ($devAndJobList as $data) {
            foreach ($jobList as $job) {
                if ($data['is_id'] == $job['id']) {
                    // job developer a atanıyor (Job lar  array gönderiliyot ve Developer id gönderiliyor)
                    $this->_assignJobDeveloper($job,$data['dev_id']);
                }
            }

        }
    }

    private function _assignJobDeveloper($job,$dev_id)
    {

        // işler dizi şeklinde developer ların dizilerine atanıyor
        if($dev_id == 1){
            $this->dev1 [] = $job;
        }else if($dev_id == 2){
            $this->dev2 [] = $job;
        }else if($dev_id == 3){
            $this->dev3 [] = $job;
        }else if($dev_id == 4){
            $this->dev4 [] = $job;
        }else if($dev_id == 5){
            $this->dev5 [] = $job;
        }
    }

    private function _generalDeveloperTime (){

        foreach ($this->dev1 as $value){
            $totalTime [] = $value['sure'];
        }
        $devOneTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devTwoTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devThreeTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devFourTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devFiveTime = array_sum($totalTime);

        $devTimeList = [
                1 => floor($devOneTime / 1),
                2 => floor($devTwoTime / 2),
                3 => floor($devThreeTime / 3),
                4 => floor($devFourTime / 4),
                5 => floor($devFiveTime / 5),
        ];

        return $devTimeList;
    }

    private function _generalDeveloperWeek (){

        foreach ($this->dev1 as $value){
            $totalTime [] = $value['sure'];
        }
        $devOneTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devTwoTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devThreeTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devFourTime = array_sum($totalTime);

        foreach ($this->dev2 as $value){
            $totalTime [] = $value['sure'];
        }
        $devFiveTime = array_sum($totalTime);

        $devTimeList = [
                1 => floor(($devOneTime / 45) / 1),
                2 => floor(($devTwoTime / 45) / 2),
                3 => floor(($devThreeTime / 45) / 3),
                4 => floor(($devFourTime / 45) / 4),
                5 => floor(($devFiveTime / 45) / 5),
        ];

        return $devTimeList;
    }

    private function _developerTotalJob(){

        $devJobs = [
            1 => count($this->dev1) ?: 0,
            2 => count($this->dev2) ?: 0,
            3 => count($this->dev3) ?: 0,
            4 => count($this->dev4) ?: 0,
            5 => count($this->dev5) ?: 0,
        ];

        return $devJobs;
    }

    private function _developerAverageWeek(){

        $jobs = $this->_developerTotalJob();

        $week = $this->_generalDeveloperWeek();

        $developerAverageWeek = [
            1 => floor($jobs[1] / $week[1]),
            2 => floor($jobs[2] / $week[2]),
            3 => floor($jobs[3] / $week[3]),
            4 => floor($jobs[4] / $week[4]),
            5 => floor($jobs[5] / $week[5]),
        ];

        return $developerAverageWeek;
    }

    private function _totalProjectTime(){

        $totalTime = $this->_generalDeveloperTime();
        $totalTime = array_sum($totalTime); // Time

        if($totalTime < 45){
            $totalTime = floor($totalTime) . ' Saat';
        }else if($totalTime > 168 ){
            $totalTime = floor($totalTime / 168) . ' Hafta';
        }else if($totalTime > 730){
            $totalTime = floor($totalTime / 730) . ' Ay';
        }else if($totalTime > 8765){
            $totalTime = floor($totalTime / 8765) . ' Yıl';
        }else{
            $totalTime = 'Hesaplanamadı';
        }

        return $totalTime;
    }
}
