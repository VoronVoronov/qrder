<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserLogs;

trait UserLogsTrait{
    /**
     * @param $user
     * @param $request
     * @param $action
     */
        public function userLogs($user, $request, $action): void
        {
            if(empty($user->id)){
                $id = User::where(['phone' => preg_replace('/[^0-9]/', '', $request->phone)])->first()['id'];
            }else{
                $id = $user->id;
            }
            UserLogs::create([
                'user_id' => $id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => $action,
                'date' => now(),
            ]);
        }
}
