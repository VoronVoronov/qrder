<?php

namespace App\Traits;

use App\Models\UserLogs;

trait UserLogsTrait{
    /**
     * @param $user
     * @param $request
     * @param $action
     */
        public function userLogs($user, $request, $action): void
        {
            UserLogs::create([
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => $action,
                'date' => now(),
            ]);
        }
}
