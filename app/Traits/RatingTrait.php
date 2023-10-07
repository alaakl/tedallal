<?php
namespace App\Traits;

use App\Models\Rating;

trait RatingTrait {
    public function addRating($rate_value, $user_id) {
        $rate = Rating::query()
            ->where('ratingable_type', $this->getMorphClass())
            ->where('ratingable_id', $this->id)
            ->where('user_id', $user_id)
            ->first();
        if ($rate) {
            $rate->update([
                'rating_value' => $rate_value
            ]);
        }else {
            $rate = Rating::query()->create([
                'rating_value' => $rate_value,
                'ratingable_id' => $this->id,
                'ratingable_type' => $this->getMorphClass(),
                'user_id' => $user_id
            ]);
        }
        return $rate;
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating_value');
    }

    public function sumRating()
    {
        return $this->ratings()->sum('rating_value');
    }

    public function timesRated()
    {
        return $this->ratings()->count();
    }

    public function usersRated()
    {
        return $this->ratings()->get()->groupBy('user_id');
    }

    public function getRatingsInfo()
    {
        $data['average_rating'] = $this->averageRating();
        $data['rating_count'] = $this->timesRated();
        return $data;
    }
}
