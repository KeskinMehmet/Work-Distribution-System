<?php

namespace App\Http\Controllers;

use App\Models\Work;

class JobController extends Controller
{

    public $devList = [
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function jobList()
    {

        $jobList = $this->_getData();

        $jobList = $this->store($jobList, $this->devList);

        $general_data = [
            'developers' => $this->_generalDeveloperTime(),
            'project_estimation' => $this->_totalProjectTime(),
        ];

        return view('job-list', compact('jobList', 'general_data'));
    }

    /**
     * @return array
     */
    private function _getData()
    {

        $jobListOne = [];
        $jobListTwo = [];

        $data = @file_get_contents('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        if ($data) {
            foreach (json_decode($data) as $key => $value) {
                $aa = get_object_vars($value);
                $jobListOne[] = $aa;
            }
        } else {
            $jobListOne = [];
        }

        $data = @file_get_contents("http://www.mocky.io/v2/5d47f235330000623fa3ebf7");
        if ($data) {
            foreach (json_decode($data) as $key => $value) {
                $aa = get_object_vars($value);
                $aa2 = $aa[array_key_first($aa)];
                $jobListTwo[] = [
                    'zorluk' => $aa2->level,
                    'sure' => $aa2->estimated_duration,
                    'id' => array_key_first($aa),
                ];
            }
        } else {
            $jobListTwo = [];
        }

        if ($jobListOne or $jobListTwo) {
            $jobList = array_merge($jobListOne, $jobListTwo);
        } else {
            $jobList = [];
        }

        return $jobList;
    }

    /**
     * @return array
     */
    private function _generalDeveloperTime()
    {
        $devTimeList = [];
        foreach ($this->devList as $key => $dev) {
            $developer_est = null;
            $jobs = $this->getJob($key);
            foreach ($jobs as $job) {
                $developer_est += $job->estimated_duration;
            }
            $devTimeList [] = [
                'averageOfWeekJob' => number_format(45 / ($developer_est / count($jobs)), 2),
                'total_time' => $developer_est,
                'jobsCount' => number_format(count($jobs)),
                'week_total_jobs_count' => number_format($developer_est / 45, 2),
                'jobs' => $jobs,
            ];
        }
        return $devTimeList;
    }

    /**
     * @return string
     */
    private function _totalProjectTime()
    {

        $time = Work::all()->pluck('estimated_duration');
        $totalTime = 0;
        foreach ($time as $data) {

            $totalTime += $data;

        }

        if ($totalTime < 45) {
            $totalTime = floor($totalTime) . ' Hour';
        } else if ($totalTime > 168) {
            $totalTime = floor($totalTime / 168) . ' Week';
        } else if ($totalTime > 730) {
            $totalTime = floor($totalTime / 730) . ' Month';
        } else if ($totalTime > 8765) {
            $totalTime = floor($totalTime / 8765) . ' Year';
        } else {
            $totalTime = 'Could not be calculated';
        }

        return $totalTime;
    }

    /**
     * @param $jobs
     * @return Work[]|\Illuminate\Database\Eloquent\Collection
     */
    public function store($jobs, $devList)
    {
        foreach ($jobs as $job) {
            foreach ($devList as $key => $dev) {
                if ($job['zorluk'] == $dev['zorluk']) {
                    try {
                        Work::create([
                            'job' => $job['id'],
                            'level' => $job['zorluk'],
                            'estimated_duration' => $job['sure'],
                            'dev_id' => $key,
                        ]);
                    } catch (\Illuminate\Database\QueryException $e) {
                        //
                    }
                }
            }
        }

        return Work::all();
    }

    /**
     * @param $id
     * @return Work[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getJob($dev_id)
    {
        return Work::where('dev_id', $dev_id)->get();
    }
}
