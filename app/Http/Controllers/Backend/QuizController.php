<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Option;
use App\Models\Answer;
use App\Models\QuizAnswer;
use App\Models\Result;
use App\Models\DayWinner;
use App\Models\WeeklyWinner;
use App\Models\MonthlyWinner;
use App\Device;
use Auth;
use Session;
use Validation;
use File;
use Mail;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function dailyWinner()
    {
        $data = DayWinner::with('created_by')->latest()->get();
        // dd($data);
        return view('admin.quiz.daily-winner')->with('data',$data);
    }

    public function weeklyWinner()
    {
        $data = DayWinner::latest()->get();
        return view('admin.quiz.weekly-winner')->with('data',$data);
    }

    public function monthlyWinner()
    {
        $data = DayWinner::latest()->get();
        return view('admin.quiz.monthly-winner')->with('data',$data);
    }

    public function participate()
    {
        $data = QuizAnswer::latest()->get();
        return view('admin.quiz.participate')->with('data',$data);
    }
}
