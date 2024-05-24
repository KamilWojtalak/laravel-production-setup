<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_users', 'user_id', 'plan_id', 'id', 'id')
            ->withPivot('plan_payed_at');;
    }

    public function getPlan()
    {
        return $this->plans()->first();
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
                ->withPivot('plan_payed_at')
                ->where('plan_payed_at', '>=', $date)
                ->exists();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hasPayedForPlanBetween(Carbon $startDate, Carbon $endDate): bool
    {
        try {
            return $this->plans()
                ->withPivot('plan_payed_at')
                ->whereBetween('plan_payed_at', [$startDate, $endDate])
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
}
