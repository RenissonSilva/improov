<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\RequisicaoController;
use App\Commit;

class UpdateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        // $focus = 0;
        // $last_update = Carbon::createFromDate($user->github_last_update);
        // if($user->github_last_update === null || !$last_update->isToday()) {
        //     $commitsLastMonth = RequisicaoController::getCommitsLastMonth($user->name);

        //     // foreach($commitsLastMonth as $commit) {
        //     //     $created_at = Carbon::create($commit['created_at'])->subHours(3);

        //     //     Commit::updateOrCreate([
        //     //         'user_id' => $user->id,
        //     //         'created_at' => $created_at
        //     //     ]);
        //     // }

        //     $day = Carbon::now()->format('Y-m-d');
        //     $commitsFromUser = $user->commits()->orderBy('created_at', 'DESC')->get();

        //     foreach($commitsFromUser as $c) {
        //         $cday = new Carbon($c->created_at);
        //         $formatted_cday = $cday->format('Y-m-d');
        //         $diff = Carbon::parse($day)->diffInDays($cday->format('Y-m-d'));

        //         if ($diff === 1 || $day === $formatted_cday) {
        //             $day = $cday;
        //             $focus++;
        //         }
        //     }
        //     $user->focus_days = $focus;
        //     if($focus > $user->max_days_in_focus){
        //         $user->max_days_in_focus = $focus;
        //     }
        //     $user->github_last_update = Carbon::now();
        //     $user->save();
        // }


        return $next($request);
    }
}
