<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'plans',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function booted(): void
    {
        parent::booted();

        static::observe(UserObserver::class);
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'orders', 'user_id', 'plan_id', 'id', 'id')
            ->withPivot('payed_at');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getPlan(): ?Plan
    {
        return $this->plans()
            ->latest('payed_at')
            ->first();
    }

    public function hasPlanByName(string $planName): bool
    {
        return $this->plans()->name($planName)->exists();
    }

    public function hasThisPlanMinimum(string $planName): bool
    {
        try {
            $minPlan = Plan::getByName($planName);

            $minStrength = $minPlan->strength;

            return $this->plans()->minStength($minStrength)->exists();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hasNotThisPlanMinimum(string $planName): bool
    {
        return !$this->hasThisPlanMinimum($planName);
    }

    public function hasPayedForPlanSince(Carbon $date): bool
    {
        try {
            return $this->plans()
                ->withPivot('payed_at')
                ->where('payed_at', '>=', $date)
                ->exists();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hasPayedForPlanBetween(Carbon $startDate, Carbon $endDate): bool
    {
        try {
            return $this->plans()
                ->withPivot('payed_at')
                ->whereBetween('payed_at', [$startDate, $endDate])
                ->exists();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hasNotPayedForPlanSince(Carbon $date): bool
    {
        return !$this->hasPayedForPlanSince($date);
    }

    public function hasPayedForPlanSinceMonth(): bool
    {
        $month = now()->subMonth();

        return $this->hasPayedForPlanSince($month);
    }

    public function hasNotPayedForPlanSinceMonth(): bool
    {
        return !$this->hasPayedForPlanSinceMonth();
    }

    public function doShowPlanPaymentRemainder(): bool
    {
        $start = now()
            ->subMonth();

        $end = now()
            ->subMonth()
            ->addDays(7);

        return $this->hasPayedForPlanBetween($start, $end);
    }

    public function canCreateTask(): bool
    {
        $tasksCount = $this->tasks()->count();
        $plan = $this->getPlan();

        if ($this->hasNotPlanAndHasLessThanFreePlanMaxTasks($plan, $tasksCount))
        {
            return true;
        }

        if ($this->hasFirstPlanAndHasLessThanFirstPlanMaxTasks($plan, $tasksCount))
        {
            return true;
        }

        if ($this->hasSecondPlan($plan))
        {
            return true;
        }

        return false;
    }

    private function hasNotPlanAndHasLessThanOneTask(?Plan $plan, int $tasksCount): bool
    {
        return is_null($plan) && $tasksCount < Plan::MAX_TASKS_PER_PLAN_FREE;
    }

    private function hasFirstPlanAndHasLessThanFirstPlanMaxTasks(?Plan $plan, int $tasksCount): bool
    {
        return $plan->name === PLAN::TYPE_FIRST && $tasksCount < PLAN::MAX_TASKS_PER_PLAN_FIRST;
    }

    private function hasSecondPlan(?Plan $plan): bool
    {
        return $plan->name === PLAN::TYPE_SECOND;
    }

}
